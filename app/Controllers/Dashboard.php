<?php

namespace App\Controllers;

use App\Models\EventosModel;
use IonAuth\Libraries\IonAuth;   
use CodeIgniter\API\ResponseTrait;
use \Hermawan\DataTables\DataTable;
helper('eventos_helper');

class Dashboard extends BaseController{
    protected $ionAuth; 

    public function __construct(){
        $this->ionAuth = new IonAuth();
    }

    public function index(){
        if(!$this->ionAuth->loggedIn() && !$this->ionAuth->isAdmin()){
            return redirect()->to('/auth/')->withCookies();
        }

        return view('dashboard/index');
    }

    public function obtener_eventos(){
        
        $fecha_inicio = $this->request->getVar('fecha_inicio');
        $fecha_fin = $this->request->getVar('fecha_fin');

        $data = eventos("",  $fecha_inicio, $fecha_fin);
        return $this->response->setJSON($data);
    }

    public function eventos_registrados(){
        $db = db_connect();
        $query = $db->table('vista_eventos_registros')
        ->select('id_evento, nombre_evento, fecha_inicio, fecha_fin, recinto, estado, created_at, clave_evento, status')
        ->where('status', 1);
    
        $hoy = strtotime(date('Y-m-d H:i'));
    
        return DataTable::of($query)
            ->edit('fecha_inicio', function($row) {

                // Formateo para mostrar en el tooltip del botón
                $inicio = $this->formatear_hora($row->fecha_inicio);
                $fin = $this->formatear_hora($row->fecha_fin);
    
                return '<span>'.$inicio.' - '.$fin.'</span>';
            })
            ->edit('recinto', function($row){
                return '<span><b>'. $row->recinto.' ('.$row->estado.')</b></span>';
            })
            ->edit('status', function($row) use ($hoy) {

                $inicio = strtotime($row->fecha_inicio);
                $fin = strtotime($row->fecha_fin);

                if ($hoy < $inicio) {
                    $estado = 'Próximo';
                    $btn_class = 'btn-primary';
                } elseif ($hoy >= $inicio && $hoy <= $fin) {
                    $estado = 'En curso';
                    $btn_class = 'btn-info';
                } else {
                    $estado = 'Finalizado';
                    $btn_class = 'btn-success';
                }
    
                return '<a 
                        href="'. base_url('Eventos/index/' . esc($row->id_evento, 'url')) .'"
                        class="btn '.$btn_class.' btn-rounded"
                        title="Del '.$this->formatear_hora($row->fecha_inicio).' al '.$this->formatear_hora($row->fecha_fin).'"
                    >'.$estado.
                '</a>';

            }, 'last')
            ->add('action', function($row){
                return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-light">
                            <i class="bi bi-gear"></i>
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                        data-bs-target=".bd-example-modal-lg" data-modo="editar" id="btnEditar" data-id="'. $row->id_evento .'">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="borrarEvento(this)" id="btnBorrar" data-id="'. $row->id_evento .'">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>';
            }, 'last')
            ->hide('id_evento')
            ->hide('fecha_fin')
            ->hide('recinto_ub')
            ->hide('estado')
            ->addNumbering()
            ->toJson();
    }

    private function formatear_hora($hora){
        $hora_formateada = date('d/m/Y H:i', strtotime($hora));
        return $hora_formateada;
    }

}
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
        ->select('id_evento, nombre_evento, fecha_inicio, fecha_fin, recinto, created_at, clave_evento, status');
    
        return DataTable::of($query)
        ->edit('fecha_inicio', function($row){
            return '<span>'. $row->fecha_inicio.' - '. $row->fecha_fin.'</span>';
        })
        ->edit('recinto', function($row){
            return '<span><b>'. $row->recinto.'</b></span>';
        })
        ->edit('status', function($row){
            return '
            <a 
                href="'. base_url('Eventos/index/' . esc($row->id_evento, 'url')) .'"
                class="btn btn-success btn-rounded">Completado
            </a>';
        }, 'last')
        ->add('action', function($row){
            return '
                <div class="btn-group">
                    <button type="button" class="btn btn-light">
                        <i class="bi bi-gear"></i>
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                    data-bs-target=".bd-example-modal-lg" data-modo="editar" id="btnBorrar" data-id="'. $row->id_evento .'">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger" id="btnBorrar" data-id="'. $row->id_evento .'">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>';
        }, 'last')
        ->hide('id_evento')
        ->hide('fecha_inicio')
        ->hide('recinto_ub')
        ->addNumbering()
        ->toJson();
    }
}
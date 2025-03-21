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
        $EventosModel = new EventosModel();
        $eventos = $EventosModel->select('id, nombre_evento, fecha_inicio, fecha_fin, recinto, recinto_ub, created_at');
    
        return DataTable::of($eventos)
        ->edit('fecha_inicio', function($row){
            return '<span>'. $row->fecha_inicio.' - '. $row->fecha_fin.'</span>';
        })
        ->edit('recinto', function($row){
            return '<span><b>'. $row->recinto.'</b> '. $row->recinto_ub.'</span>';
        })
        ->add('action', function($row){
            return '
            <a 
                href="'. base_url('Eventos/index/' . esc($row->id, 'url')) .'"
                class="btn btn-success btn-rounded">Completado
            </a>';
        }, 'last')
        ->add('action', function($row){
            return '
                <div class="btn-group">
                    <button type="button" class="btn btn-light">
                        <i class="bi bi-gear"></i>
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>';
        }, 'last')
        ->hide('id')
        ->hide('fecha_fin')
        ->hide('recinto_ub')
        ->addNumbering()
        ->toJson();
    }
}
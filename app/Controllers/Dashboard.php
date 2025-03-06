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
        if(!$this->ionAuth->loggedIn()){
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
        ->hide('id')
        ->addNumbering()
        ->toJson();
    }

}
<?php

namespace App\Controllers;
use IonAuth\Libraries\IonAuth;
use App\Models\EventosModel;
use \Hermawan\DataTables\DataTable;

class Eventos extends BaseController{
    protected $ionAuth;

    public function __construct(){
        $this->ionAuth = new IonAuth();
    }

    public function index(){
        if(!$this->ionAuth->loggedIn()){
            return redirect()->to('/auth/')->withCookies();
        }

        return view('eventos/index');
    }

    public function historial(){
        if(!$this->ionAuth->loggedIn()){
            return redirect()->to('/auth/')->withCookies();
        }

        return view('eventos/registros');
    }

    public function guardar_evento(){
        $clave = "";
        $EventosModel = new EventosModel();
        // Recibir los datos como JSON
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->response->setJSON(['success' => false, 'message' => 'No se recibieron datos', 'data' => null]);
        }

        $data = [
            'id_evento'     => $json['id_evento'] ?? null,
            'evento'        => $json['evento'] ?? null,
            'fecha_inicio'  => $json['fecha_inicio'] ?? null,
            'fecha_fin'     => $json['fecha_fin'] ?? null,
            'recinto'       => $json['recinto'] ?? null,
            'recinto_ub'    => $json['recinto_ub'] ?? null,
            'nombre_evento' => $json['nombre_evento'] ?? null,
            'id_user'       => 0,
        ];

        do{
            $clave = generarClave();
        } while ($this->ionAuth->usernameCheck($clave));
        
        $username = $clave;
        $password = "password";
        $email = 'evento@email.com';
        $additional_data = array(
            'first_name' => $data["nombre_evento"],
            'last_name' => $data["evento"],
        );
        $group = array('2');

        $registro = $this->ionAuth->register($username, $password, $email, $additional_data, $group);
        
		if (!$registro){
			$errors = $this->ionAuth->errors();
			return $this->response->setJSON(["success" => false, "msg" => $errors]);
		}

        $data["id_user"] = $registro;

        $insert = $EventosModel->insert($data);

        // Aquí puedes insertar los datos en la base de datos con un modelo
        // $this->eventoModel->insert($data);
        
        return $this->response->setJSON(['success' => true, 'message' => 'Evento guardado', 'data' => $insert]);
    }

}
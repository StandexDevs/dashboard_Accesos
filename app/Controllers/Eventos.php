<?php

namespace App\Controllers;

use App\Models\EventosModel;
use IonAuth\Libraries\IonAuth;
use App\Models\inputsOutputsModel;
use \Hermawan\DataTables\DataTable;
helper('eventos_helper');

class Eventos extends BaseController{
    protected $ionAuth;

    public function __construct(){
        $this->ionAuth = new IonAuth();
    }

    public function index($id = null) {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/')->withCookies();
        }
    
        $isAdmin = $this->ionAuth->isAdmin();
        $user = $this->ionAuth->user()->row(); 

        // Si el usuario no es admin, obtener la info del evento asociado a su ID
        if (!$isAdmin) {
            $id = $id ?? $user->id; // Si no hay ID, usa el del usuario logueado
        }
            
        // Si no hay ID, lanzar error
        if (!$id) {
            return $this->response->setStatusCode(400, 'ID requerido');
        }
    
        $evento = obtener_info_evento($id);
        $registros = obtener_registros($id);

        if (!$evento) {
            return $this->response->setStatusCode(404, 'Evento no encontrado');
        }
    
        $data['evento'] = $evento;
        $data['registros'] = $registros;

        return view('eventos/index', $data);
    }

    public function historial($id_evento, $hora, $tipo){
        $token = $this->request->getGet('token');
        $tipoRegistro = null;

        // Verificar que el token sea válido
        if (!isset($_SESSION['token_evento'][$id_evento]) || $_SESSION['token_evento'][$id_evento] !== $token) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Acceso denegado']);
        }

        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/')->withCookies();
        }
        
        // Verificar que el tipo sea válido
        if (!in_array($tipo, ['Entrada', 'Salida', 'General'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Tipo no válido']);
        }else{
            $tipoRegistro = $tipo;
        }

        $horaBase = '08:00';

        $inputsOutputsModel = new inputsOutputsModel();
        /*
            $registros = $inputsOutputsModel
            ->where('id_evento', $id_evento)->where('type', $tipoRegistro)
            ->findAll();
        */

        $hora_busqueda = '08:00'; // Formato HH:MM

        $registros = $inputsOutputsModel
            ->select('*')
            ->where("TIME_FORMAT(STR_TO_DATE(hour, '%h:%i:%s %p'), '%H:%i')", $hora_busqueda)
            ->findAll();

        return $this->response->setJSON([
            'id_evento' => $id_evento,
            'hora' => $hora,
            'tipo' => $tipo,
            'registros' => $registros
        ]);   
        
        if (!$registros) {
            return $this->response->setStatusCode(404, 'No hay registros para este evento');
        }
        
        $data["registros"] = $registros;

        return view('eventos/registros', $data);
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
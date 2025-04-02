<?php

namespace App\Controllers;

use App\Models\EventosModel;
use IonAuth\Libraries\IonAuth;
use App\Models\InputsOutputsModel;
use \Hermawan\DataTables\DataTable;
helper('eventos_helper');
helper('reportes_helper');

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
            $eventoData = obtener_id_evento($user->id);
            $id = $eventoData->id; // Si no hay ID, usa el del usuario logueado
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

        $fecha_fin = formatear_hora($evento->fecha_fin);
        $fecha_inicio = formatear_hora($evento->fecha_inicio);
        $rango_dias = obtener_dias_evento($fecha_inicio, $fecha_fin);  

        $data['evento'] = $evento;
        $data['rango_dias'] = $rango_dias;
        $data['registros'] = $registros;

        return view('eventos/index', $data);
    }

    public function historial($id_evento, $label, $tipo){
        
        // return $this->response->setJSON([$id_evento, $hora, $tipo, $dia]);

        $inputsOutputsModel = new InputsOutputsModel();
        $tipoRegistro = null;

        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/')->withCookies();
        }
        
        // Verificar que el tipo sea válido
        if (!in_array($tipo, ['Entrada', 'Salida', 'General'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Tipo no válido']);
        }else{
            $tipoRegistro = $tipo;
        }

        $registros = $inputsOutputsModel->where('id_evento', $id_evento);

        // Manejo de fechas y horas
        if (preg_match('/^\d{8}$/', $label)) {
            // Es una fecha en formato ddmmyyyy
            $day = substr($label, 0, 2);
            $month = substr($label, 2, 2);
            $year = substr($label, 4, 4);

            $registros = $registros
                ->where('day', $day)
                ->where('month', $month)
                ->where('year', $year);
        } elseif (preg_match('/^\d{2}:\d{2}$/', $label)) {
            // Es una hora en formato hh:mm
            $hora_formateada = date('H:i:s', strtotime($label));
            $hora_fin = date('H:i:s', strtotime($hora_formateada) + 3599); // 1 hora después

            $registros = $registros
                ->where('hour >=', $hora_formateada)
                ->where('hour <=', $hora_fin);
        } elseif($label !== "todos"){
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Parámetro inválido']);
        }

        if($tipo != 'General'){
            $inputsOutputsModel->where('type', $tipoRegistro);
        }

        $registros = $registros
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->orderBy('day', 'DESC')
            ->orderBy('hour', 'DESC')
            ->findAll();

        if (!$registros) {
            return $this->response->setStatusCode(404, 'No hay registros para este evento');
        }

        $evento = obtener_info_evento($id_evento);
        
        $excelData = exportar_historial_excel($registros, $evento->nombre_evento);

        $data["tipo"] = $tipo;
        $data["registros"] = $registros;
        $data["reporte"] = base64_encode($excelData);
        $data["evento"] = $evento;

        return view('eventos/registros', $data);
    }

    public function guardar_evento($modo){
        $clave = "";
        $intentos = 0;
        $EventosModel = new EventosModel();

        // Recibir los datos como JSON
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->response->setJSON(['success' => false, 'msg' => 'No se recibieron datos', 'data' => $json]);
        }

        $data = [
            'id_evento'     => $json['id_evento'] ?? null,
            'evento'        => $json['evento'] ?? null,
            'fecha_inicio'  => $json['fecha_inicio'] ?? null,
            'fecha_fin'     => $json['fecha_fin'] ?? null,
            'recinto'       => $json['recinto'] ?? null,
            'recinto_ub'    => $json['recinto_ub'] ?? null,
            'nombre_evento' => $json['nombre_evento'] ?? null,
            'sic_id'        => $json['sic_id'] ?? null,
            'id_user'       => $json['id_user'] ?? null
        ];

        $email = "{$data['evento']}@gmail.com";

        if($modo === "editar"){

            $dataUser = array(
                'first_name' => $data["nombre_evento"],
                'last_name' => $data['evento'],
                'email' => $email
            );
            
            $updateuser = $this->ionAuth->update($data["id_user"], $dataUser);

            if(!$updateuser){
                return $this->response->setJSON(['success' => false, 'msg' => 'Error al actualizar el usuario', 'data' => $update]);        
            }

            $update = $EventosModel->update($data["id_evento"], $data);

            if(!$update){
                return $this->response->setJSON(['success' => false, 'msg' => 'Error al actualizar', 'data' => $update]);        
            }

            return $this->response->setJSON(['success' => true, 'msg' => 'Evento guardado', 'data' => $update]);
        }

		return $this->response->setJSON([$data, $modo]);

        do {
            $clave = generarClave();
            $intentos++;
            if ($intentos > 10) { // Evita bucles infinitos
                break;
            }
        } while ($this->ionAuth->usernameCheck($clave));
                
        $username = $clave;
        $password = 'password';
         //Recordar que el Email debe ser unico si no la libreria no te dejará registrar
        $additional_data = array(
            'first_name' => $data["nombre_evento"],
            'last_name' => $data['evento']
        );
        $group = array('2');

        $registro = $this->ionAuth->register($username, $password, $email, $additional_data, $group);
        
		if (!$registro){
			return $this->response->setJSON(["success" => false, "msg" => $this->ionAuth->messages()]);
		}

        $data["id_user"] = $registro;

        $insert = $EventosModel->insert($data);

        if(!$insert){
            return $this->response->setJSON(['success' => false, 'msg' => 'Error al guardar', 'data' => $insert]);        
        }

        return $this->response->setJSON(['success' => true, 'msg' => 'Evento guardado', 'data' => $insert]);
    }

    public function obtener_evento($id_evento){

        if(!$id_evento){
            return $this->response->setJSON(['success' => false, 'msg' => 'No se ha enviado un evento', 'data' => null]);
        } 

        $evento = obtener_info_evento($id_evento);

        if(!$evento){
            return $this->response->setJSON(['success' => false, 'msg' => 'No se ha encontrado el evento', 'data' => null]);
        }

        return $this->response->setJSON(['success' => true, 'msg' => 'Evento encontrado', 'data' => $evento]);

    }

    public function eliminar_evento($id){
        $EventosModel = new EventosModel();

        if(!$id){
            return $this->response->setJSON(['success' => false, 'msg' => 'No se ha enviado un evento', 'data' => null]);
        } 

        $data = [
            'status_evento' => 0,
        ];

        $update = $EventosModel->update($id, $data);

        if(!$update){
            return $this->response->setJSON(['success' => false, 'msg' => 'Error al eliminar', 'data' => $update]);
        }

        return $this->response->setJSON(['success' => true, 'msg' => 'Evento eliminado', 'data' => $update]);
    }

    public function obtener_registros_general($id_evento) {
        $inputsOutputsModel = new InputsOutputsModel();
    
        // Obtener los días únicos donde hay registros para el evento
        $dias_disponibles = $inputsOutputsModel
            ->select('day, month, year')
            ->where('id_evento', $id_evento)
            ->groupBy('day, month, year')
            ->findAll();
    
        $resultados = [];
    
        foreach ($dias_disponibles as $dia) {
            $dia_actual = $dia['day'];
            $mes_actual = $dia['month'];
            $anio_actual = $dia['year'];
    
            // Formatear la fecha como DD/MM/YYYY
            $fecha_formateada = sprintf('%02d/%02d/%04d', $dia_actual, $mes_actual, $anio_actual);
    
            // Contar registros de tipo "Entrada"
            $entradas = $inputsOutputsModel
                ->where('id_evento', $id_evento)
                ->where('day', $dia_actual)
                ->where('month', $mes_actual)
                ->where('year', $anio_actual)
                ->where('type', 'Entrada')
                ->countAllResults();
    
            // Contar registros de tipo "Salida"
            $salidas = $inputsOutputsModel
                ->where('id_evento', $id_evento)
                ->where('day', $dia_actual)
                ->where('month', $mes_actual)
                ->where('year', $anio_actual)
                ->where('type', 'Salida')
                ->countAllResults();
    
            // Guardar resultados en un array
            $resultados[] = [
                'dia' => $fecha_formateada,
                'entradas' => $entradas,
                'salidas' => $salidas
            ];
        }
        return $this->response->setJSON($resultados);
    }
    
    public function obtener_registros_por_dia($id_evento, $dia) {
        $resultados = obtener_registros($id_evento, $dia);
        return $this->response->setJSON($resultados);
    }
}
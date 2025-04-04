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

        // Verificar si lo que recibe es una hora o es una fecha
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

        if($tipo != 'General'){//especificando el tipo de acceso
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

    public function historial_datatable(){
        return DataTable::of($query)
        ->edit('type', function($row) {
            if ($row->type === "Entrada") {
                return '<svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1.00002" y="1" width="61" height="61" rx="29" stroke="#2BC155" stroke-width="2"/>
                            <g clip-path="url(#clip0)">
                                <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155"/>
                            </g>
                        </svg>';
            } else {
                return '<svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="61" height="61" rx="29" stroke="#FF2E2E" stroke-width="2"/>
                            <g clip-path="url(#clip1)">
                                <path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E"/>
                            </g>
                        </svg>';
            }
        })
        ->edit('nombreCompleto', function($row) {
            return '<h6 class="fs-16 font-w600 mb-0">'.esc($row->nombreCompleto).'</h6>
                    <span class="fs-14">'.esc($row->empresa).'</span>';
        })
        ->edit('day', function($row) {
            return '<h6 class="fs-16 text-black font-w400 mb-0">'.$row->day.' de '.obtenerMes($row->month).' del '.$row->year.'</h6>
                    <span class="fs-14">'.$row->hour.'</span>';
        })
        ->edit('userRegistration', function($row) {
            return '<span class="fs-16 text-black font-w500">'.esc($row->userRegistration).'</span>';
        })
        ->edit('type', function($row) {
            return '<span class="text-'.($row->type === "Entrada" ? "success" : "danger").' fs-16 font-w500 text-end d-block">'.esc($row->type).'</span>';
        })
        ->rawColumns(['type', 'nombreCompleto', 'day', 'userRegistration'])
        ->make(true);
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
<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RestModel;
use CodeIgniter\Cookie\Cookie;
use DateTime;
use App\Libraries\Vcard;

class ControlAccesos extends ResourceController
{
    use ResponseTrait;
    protected $modelName = 'App\Models\RestModel';
    protected $format    = 'json';
    protected $Vcard;

    public function __construct()
    {
        $this->Vcard = new vCard();
    }

    public function index() {
        // Conexión a la base de datos
        $db = null;
		if ( $db == null ) $db = db_connect();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

        $param1 = $this->request->getGet("facility");
        $param2 = $this->request->getGet("card");
        $param3 = $this->request->getGet("type");


        return $this->response->setJSON([$param1, $param2,  $param3]);

    }

    public function getSalidas()
    {
        return $this->genericResponse($this->model->where('type', 'Salida')->orderBy('id', 'DESC')->findAll(), "", 200);
    }

    public function getEntradas()
    {
        return $this->genericResponse($this->model->where('type', 'Entrada')->orderBy('id', 'DESC')->findAll(), "", 200);
    }
    
    public function countAllEntradas()
    {
        $model = new RestModel();

        $data = $model
        ->where('type', 'Entrada')
        //->where('day', '31')
        ->countAllResults();

        if ($data > 0) {
            return $this->genericResponse($data, "Se encontraron registros", 200);
        }else{
            return $this->genericResponse($data, "No se encontraron registros", 401);
        }

    }

    public function countAllSalidas()
    {
        $model = new RestModel();

        $data = $model
        ->where('type', 'Salida')
        //->where('day', '31')
        ->countAllResults();

        if ($data > 0) {
            return $this->genericResponse($data, "Se encontraron registros", 200);
        }else{
            return $this->genericResponse($data, "No se encontraron registros", 401);
        }

    }
    public function SessionUser()
    {
        $session = \Config\Services::session();
        if (isset($_SESSION['username'])) {
            $data = [
                'messages' => [
                    'msj' => 'Sesión: ' . $_SESSION['username'] . '
' . 'Tipo: ' . $_SESSION['type']
                ],
                'user' => $session->get('username'),
                'type' => $session->get('type')
            ];
            return $this->genericResponse($data, "Sesión activa", 200);
        }else{
            $data = [
                'messages' => [
                    'msj' => 'No hay una sesión activa en este dispositivo'
                ]
            ];

            return $this->genericResponse($data, "No hay una sesión activa", 401);

        }

    }
    private function genericResponse($data, $msj, $code)
    {
        if ($code == 200) {
            return $this->respond(
                array("data" => $data, "code" => $code)
            );
        }else{
            return $this->respond(
                array("msj" => $msj, "code" => $code)
            );
        }
    }
    public function createUser()
    {
        // $session = \Config\Services::session($config);
        $session = \Config\Services::session();
        $user = $this->request->getJsonVar('user');
        $type = $this->request->getJsonVar('type');
        if (($user != '') && ($type !='')) {
            $newdata = [
                'username'  =>  $this->request->getJsonVar('user'),
                'type'     => $this->request->getJsonVar('type'),
                'logged_in' => true,
            ];
            
            $session->set($newdata);
    
            $response = [
                'status'   => 201,
                'success'    => 'Sesión creada correctamente',
                'messages' => [
                    'success' => 'Mientras usas la aplicacion no salirse de esta app'
                ]
            ];
        }else{
            $response = [
                'status'   => 402,
                'error'    => 'Campos vacios',
                'messages' => [
                    'danger' => 'Por favor llena todos los campos correctamente'
                ]
            ];
        }



        return $this->respondCreated($response);

        
    }
    function OutputvCard(vCard $vCard)
	{

	/*	if ($vCard -> URL)
		{
			foreach ($vCard -> URL as $URL)
			{
				if (is_scalar($URL))
				{
					return $URL;
				}
				else
				{
					return $URL['Value'];
				}
			}
		}*/
		
		
		return $vCard -> FN[0];

	}
	
	function obtenerNombre(vCard $vCard)
	{
	    foreach ($vCard -> N as $Name)
		{
			return $Name['FirstName'].' '.$Name['LastName'];
		}
	}
	
	public function categoriaUser(vCard $vCard)
	{
	    if ($vCard -> URL)
    		{
    			foreach ($vCard -> URL as $URL)
    			{
    				if (is_scalar($URL))
    				{
    					return $URL;
    				}
    				else
    				{
    					return $URL['Value'];
    				}
    			}
    		}
	}
	
	public function obtenerIdUsuario(vCard $vCard)
	{
	   if ($vCard -> URL)
		{
			foreach ($vCard -> URL as $URL)
			{
				if (is_scalar($URL))
				{
					return $URL;
				}
				else
				{
					return $URL['Value'];
				}
			}
			echo '</p>';
		}
	}
    public function create()
    {
        $session = \Config\Services::session();
        $model = new RestModel();
        date_default_timezone_set("America/Mexico_City");
        $barcode = $this->request->getJsonVar('barcode');        
       if (isset($_SESSION['type'])) {
           
            $vCard = new vCard(false,$barcode);

            if (count($vCard) == 0)
            {
                $id_user = 'No se pudo indentificar al participante';
            }
            else
            {
                $nombreCompleto = $this->obtenerNombre($vCard);
                $idUser = $this->obtenerIdUsuario($vCard);
            }

            $data = [
                'day' => date("d"),
                'month'  => date("m"),
                'year'  => date("Y"),
                'hour'  => date('h:i:s A'),
                'idUser'  => $idUser,
                'type'  => $session->get('type'),
                'userRegistration' => $session->get('username'),
                'nombreCompleto' => $nombreCompleto
            ];

            if (isset($idUser)) {
                switch ($session->get('type')) {
                    case 'Entrada':

                        $contarEntradas = $model
                        ->where('idUser', $idUser)
                        ->where('day', date("d"))
                        ->where('month', date("m"))
                        ->where('year', date("Y"))
                        ->where('type', 'Entrada')
                        ->countAllResults();

                        if($contarEntradas == 0){
                            $tipo = 'Salida';
                        }else{
                            $contarUltimoRegistro = $model
                            ->where('idUser', $idUser)
                            ->where('day', date("d"))
                            ->where('month', date("m"))
                            ->where('year', date("Y"))
                            ->orderBy('id', 'DESC')
                            ->limit(1)
                            ->get();
    
                            foreach ($contarUltimoRegistro->getResult() as $row) {
                                $tipo = $row->type;
                            }

                        }

                        if ($tipo == 'Salida') {
                            $response = [
                                'status'   => 201,
                                'error'    => null,
                                'type' => $session->get('type'),
                                'session active' => $session->get('username'),
                                'messages' => [
                                    'success' => 'Registro agregado correctamente, Nombre de usuario: '.$nombreCompleto,
                                ]
                            ];
                            $model->insert($data);
                            }else{
                                $response = [
                                    'status'   => 401,
                                    'error'    => null,
                                    'type' => 'Error al registrar la entrada',
                                    'messages' => [
                                        'danger' => 'No se puede registrar una entrada sin una salida, comunicate con el supervisor del control de accesos.',
                                    ]
                                ];
                        }
                        break;

                        case 'Salida':

                            $contarSalidas = $model
                            ->where('idUser', $idUser)
                            ->where('day', date("d"))
                            ->where('month', date("m"))
                            ->where('year', date("Y"))
                            ->where('type', 'Entrada')
                            ->countAllResults();
    
                            if($contarSalidas == 0){
                                $tipo = 'Salida';
                            }else{
                                $contarUltimoRegistro = $model
                                ->where('idUser', $idUser)
                                ->where('day', date("d"))
                                ->where('month', date("m"))
                                ->where('year', date("Y"))
                                ->orderBy('id', 'DESC')
                                ->limit(1)
                                ->get();
        
                                foreach ($contarUltimoRegistro->getResult() as $row) {
                                    $tipo = $row->type;
                                }
    
                            }
                            if ($tipo == 'Entrada') {
                                $response = [
                                    'status'   => 201,
                                    'error'    => null,
                                    'type' => $session->get('type'),
                                    'session active' => $session->get('username'),
                                    'messages' => [
                                        'success' => 'Registro agregado correctamente, nombre: '.$nombreCompleto,
                                    ]
                                ];
                             $model->insert($data);
                            }else{
                                $response = [
                                    'status'   => 401,
                                    'error'    => null,
                                    'type' => 'Error al registrar la salida',
                                    'messages' => [
                                        'danger' => 'No se puede registrar una salida sin un registro de entrada, comunicate con el supervisor del control de accesos.',
                                    ]
                                ];
                            }
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }else{
                $response = [
                    'status'   => 401,
                    'error'    => null,
                    'type' => 'Error al guardar',
                    'messages' => [
                        'danger' => 'No hay un ID en el codigo QR.',
                    ]
                ];
            }



        }else{
            $response = [
                'status'   => 401,
                'error'    => null,
                'type' => 'Error al guardar',
                'messages' => [
                    'danger' => 'No hay una sesión activa en este dispositivo',
                ]
            ];
        }

      return $this->respondCreated($response);

    }

        // single user
        public function show($id = null){
            $model = new RestModel();
            $data = $model->where('id', $id)->first();
            if($data){
                return $this->genericResponse($data, "", 200);
            }else{
                return $this->failNotFound('Registro no encontrado');
            }
        }
        // delete
        public function delete($id = null){
            $model = new RestModel();
            $data = $model->where('id', $id)->delete($id);
            if($data){
                $model->delete($id);
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => [
                        'success' => 'Registro eliminado correctamente'
                    ]
                ];
                return $this->respondDeleted($response);
            }else{
                return $this->failNotFound('Registro no encontrado');
            }
        }
}

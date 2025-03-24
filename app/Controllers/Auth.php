<?php namespace App\Controllers;

use CodeIgniter\HTTP\IncomingRequest;
helper('eventos_helper');

class Auth extends \IonAuth\Controllers\Auth
{
    public function index(){
		$data['identity'] = [
			'name'  => 'identity',
			'id'    => 'identity',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => set_value('identity'),
		];

		if (!$this->ionAuth->loggedIn())
		{
			return view('auth/login', $data);
		}else{
			$data['title'] = lang('Auth.index_heading');
			$data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : $this->session->getFlashdata('message');
			$data['users'] = $this->ionAuth->users()->result();

			return view('auth/login', $data);
		}
	}

	public function login(){
		$db = \Config\Database::connect();
		$this->data['title'] = lang('Auth.login_heading');

		// validate form input
		$this->validation->setRule('identity', str_replace(':', '', lang('Auth.login_identity_label')), 'required');

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()){
			$remember = (bool)$this->request->getVar('remember');
			//IonAuth valida si el user exite
			if ($this->ionAuth->login($this->request->getVar('identity'), 'password', $remember)){
				
				$user = $this->ionAuth->user()->row(); 
				$isAdmin = $this->ionAuth->isAdmin();

				$evento = null;

				if(!$isAdmin){
					$eventoData = obtener_id_evento($user->id);
					$evento = obtener_info_evento($eventoData->id);
				}

				$sessionData = [
					'user'    => $user,
					'is_admin'   => $isAdmin,
					'evento' => $evento
				];

				session()->set($sessionData);

				if($isAdmin){
					return redirect()->to('/dashboard/')->withCookies();
				}else{
					return redirect()->to('/eventos/')->withCookies();
				}
				
			}else{
				$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
				return redirect()->back()->withInput();
			}

		}else{
			$data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : $this->session->getFlashdata('message');

			$data['identity'] = [
				'name'  => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => set_value('identity'),
			];
			
			return view('auth/login', $data);
		}
	}

	public function logout(){
		$this->data['title'] = 'Logout';
		$this->ionAuth->logout();
		$this->session->setFlashdata('message', $this->ionAuth->messages());
		return redirect()->to('/auth/login')->withCookies();
	}

	public function registrar(){

		$username = $this->request->getPost('username');
		$email = $this->request->getPost('email');
		$nombre = $this->request->getPost('first_name');
		$apellido = $this->request->getPost('last_name');
		$grupo = $this->request->getPost('group');
		
		$password = 'password';
		$additional_data = array(
			'first_name' => $nombre,
			'last_name' => $apellido,
		);

		$group = array($grupo); // Sets user to admin.
		
		$registro = $this->ionAuth->register($username, $password, $email, $additional_data, $group);

		if (!$registro){
			$errors = $this->ionAuth->errors();
			return $this->response->setJSON(["success" => false, "msg" => $errors]);
		}
		$messages = $this->ionAuth->messages();
		return $this->response->setJSON(["success" => true, "msg" => $messages]);

	}

	public function crearGrupo(){
		// $request = $this->request->getJSON();
		$nombreGrupo = $this->request->getPost('nombreGrupo');
		$descripcion = $this->request->getPost('descripcion');
		return $this->response->setJSON([$nombreGrupo, $descripcion]);

		$group = $this->ionAuth->createGroup($nombreGrupo, $descripcion);

		if (!$group){
			$viewErrors = $this->ionAuth->messages();
			return $this->response->setJSON(["success" => false, "msg" => $viewErrors]);
		}
		$newGroupId = $group;

		return $this->response->setJSON(["success" => true, "msg" => $newGroupId]);

	}
}
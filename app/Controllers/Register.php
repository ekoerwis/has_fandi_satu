<?php

namespace App\Controllers;
use App\Models\RegisterModel;
use \Config\App;

class Register extends \App\Controllers\BaseController
{
	protected $model = '';
	
	public function __construct() {
		parent::__construct();
		$this->model = new RegisterModel;	
		$this->data['site_title'] = 'Register';
		
		helper(['cookie', 'form']);
		
	}
	
	public function index()
	{
        // $this->currentModule['nama_module'] = 'Register'; 
        $this->mustNotLoggedIn();

		$data = $this->data;

		// $data['message'] =  ['status' => 'warning', 'message' => 'Test ok'];
		// $msg = [];
		// $msg['status'] = 'warning';
		// $msg['content'] = 'Tidak ada menu yang diupdate';
		// $data['msg'] = $msg;
		$data['register_status'] = 'register_gagal';
		$data['role_register'] = $this->model->getRoleRegister();

		if(isset($_POST['submit'])){
			if($this->request->getPost('password') != $this->request->getPost('password_confirm')){
				$data['message'] =  ['status' => 'warning', 'message' => 'Konfirmasi Password Tidak Sama, Mohon Ulangi Memasukan Password !','dismiss'=>true];
			} else {
				$action = $this->model->saveData();
				$data['message'] =  [
					'status' => $action['status'], 
					'message' => $action['message'],
					'dismiss' => false
				];

				if($action['status'] == 'ok'){
					$data['register_status'] = 'register_sukses';
				}
			}
		}
		echo view('registerform', $data);
	}

	public function register(){

	}
	
}

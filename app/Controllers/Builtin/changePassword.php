<?php

namespace App\Controllers\Builtin;
use App\Models\Builtin\UserModel;
use \Config\App;

class changePassword extends \App\Controllers\BaseController
{
	protected $model;
	protected $moduleURL;
	
	public function __construct() {
		
		parent::__construct();
		
		$this->model = new UserModel;	
		$this->formValidation =  \Config\Services::validation();
		$this->data['site_title'] = 'Halaman Profil';
		
		$this->addJs($this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/date-picker.js');
		$this->addJs($this->config->baseURL . 'public/themes/modern/builtin/js/user.js');
		$this->addStyle($this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
		
		helper(['cookie', 'form']);
	}
	
	public function index()
	{
		$form_errors = null;
		$this->data['status'] = '';
		
		if ($this->request->getPost('submit')) 
		{
			$result = $this->model->getUserById($this->user['id_user']);
			$error = false;
			
			if ($result) {
				
				if (!password_verify($this->request->getPost('password_old'), $result->password)) {
					$error = true;
					$this->data['msg'] = ['status' => 'error', 'message' => 'Password lama tidak cocok'];
				}
			} else {
				$error = true;
				$this->data['msg'] = ['status' => 'error', 'message' => 'Data user tidak ditemukan'];
			}
		
			if (!$error) {
		
				$this->formValidation->setRule('password_new', 'Password', 'trim|required');
				$this->formValidation->setRule('password_new_confirm', 'Confirm Password', 'trim|required|matches[password_new]');
					
				$this->formValidation->withRequest($this->request)->run();
				$errors = $this->formValidation->getErrors();
				
				$custom_validation = new \App\Libraries\FormValidation;
				$custom_validation->checkPassword('password_new', $this->request->getPost('password_new'));
			
				$form_errors = array_merge($custom_validation->getErrors(), $errors);
					
				if ($form_errors) {
					$this->data['msg'] = ['status' => 'error', 'message' => $form_errors];
				} else {
					$update = $this->model->updatePassword();
					if ($update) {
						$this->data['msg'] = ['status' => 'ok', 'message' => 'Password Anda berhasil diupdate'];
					} else {
						$this->data['msg'] = ['status' => 'error', 'message' => 'Password Anda gagal diupdate... Mohon hubungi admin. Terima Kasih...'];
					}
				}
			}
		}
		
		$this->data['title'] = 'Edit Password';
		$this->data['form_errors'] = $form_errors;
		$this->data['user'] = $this->model->getUserById($this->user['id_user']);
		$this->view('builtin/user/form-edit-password.php', $this->data);
	}
	
	
}

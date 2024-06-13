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

        
		// $this->addJs($this->config->baseURL . 'public/vendors/jquery.pwstrength.bootstrap/pwstrength-bootstrap.min.js');
		// $this->addJs($this->config->baseURL . 'public/themes/modern/js/password-meter.js');
		
		helper(['cookie', 'form']);
		
	}
	
	public function index()
	{
        // $this->currentModule['nama_module'] = 'Register'; 
        $this->mustNotLoggedIn();

		echo view('registerform', $this->data);
	}
	
}

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

		
        echo "<script>console.log('reg');</script>";

		
		echo view('registerform', $this->data);
	}
	
}

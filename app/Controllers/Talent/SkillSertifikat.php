<?php

namespace App\Controllers\Talent;
use App\Models\Talent\SkillSertifikatModel;
use \Config\App;
use App\Libraries\Tablesigniter;

class SkillSertifikat extends \App\Controllers\BaseController
{
	protected $model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new SkillSertifikatModel;	
		$this->data['site_title'] = 'Data Keluarga';
		
		$this->addJs ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js' );
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/date-picker.js');
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/image-upload.js');
		
		// $this->addJs ( $this->config->baseURL . 'public/vendors/datatables/datatables.min.js');
		// $this->addStyle ( $this->config->baseURL . 'public/vendors/datatables/datatables.min.css');
		
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables_20240617/datatables.min.js');
		$this->addStyle ( $this->config->baseURL . 'public/vendors/datatables_20240617/datatables.min.css');

		// $this->addJs ( $this->config->baseURL . 'public/vendors/datatables_20240617_2/datatables.min.js');
		// $this->addStyle ( $this->config->baseURL . 'public/vendors/datatables_20240617_2/datatables.min.css');

		// $this->addJs ( $this->config->baseURL . 'public/vendors/datatables/datatables-2.0.8/js/dataTables.js');
		// $this->addStyle ( $this->config->baseURL . 'public/vendors/datatables/datatables-2.0.8/css/dataTables.dataTables.css');

		// $this->addJs ( $this->config->baseURL . 'public/themes/modern/js/data-tables.js');

		$this->addStyle ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.css');
	}
	
	public function index()
	{
		$this->cekHakAkses('read_data');
		$this->cekHakAkses('create_data');
		$this->cekHakAkses('update_data');
		
		$breadcrumb['Add'] = '';
		$data = $this->data;
		$data['title'] = 'Sertifikasi Keahlian';
		$data['msg'] = [];
		
        
		// tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role
		$data['auth_tambah']=$this->actionUser['create_data'];
		$data['auth_ubah']=$this->actionUser['update_data'];
		$data['auth_hapus']=$this->actionUser['delete_data'];
		// batas tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role

		$error = false;

		
		if ($this->request->getPost('submit'))
		{
			$action = $this->model->saveData($this->user['id_user']);
			
			$data['message'] =  [
				'status' => $action['status'], 
				'message' => $action['message'],
				'dismiss' => isset($action['dismiss']) ? $action['dismiss'] : 'false',
			];
			
			// $data['data_akun'] =  $this->model->getMainSql($this->user['id_user']);
		}

        $data['data']=$this->model->getMainSql($this->user['id_user'],'id_user');
		
		$this->view('../../Talent/SkillSertifikat/SkillSertifikatView', $data);
	}

    public function getParameter(){
		
        $this->cekHakAkses('read_data');
        
        $result = $this->model->getParameter();

        echo json_encode($result);

    }
	
}

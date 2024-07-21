<?php

namespace App\Controllers\Recruiter;
use App\Models\Recruiter\PublishTalentModel;
use \Config\App;
use App\Libraries\Tablesigniter;

class PublishTalent extends \App\Controllers\BaseController
{
	protected $model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new PublishTalentModel;	
		$this->data['site_title'] = 'Talent List';
		
		$this->addJs ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js' );
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/image-upload.js');
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/date-picker.js');
		
		$this->addStyle ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.css');
	}
	
	public function index()
	{
		$this->cekHakAkses('read_data');
		

		$data = $this->data;

		// tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role
		$data['auth_tambah']=$this->actionUser['create_data'];
		$data['auth_ubah']=$this->actionUser['update_data'];
		$data['auth_hapus']=$this->actionUser['delete_data'];
		// batas tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role


		if(isset($_GET['action']) and ($_GET['action'] == 'add' or $_GET['action'] == 'edit' or $_GET['action'] == 'delete') ){
            $data['message'] =   [
                'status' => 'error', 
                'message' => 'Content Ini Tidak Memiliki Fitur '.$_GET['action'],
                'dismiss' => 'true',
            ];
        }

        
		$data['dataBaseUrl'] = $this->config->baseURL;

		$this->view('../../Recruiter/PublishTalent/PublishTalentView', $data);
	}

	public function fetchAll(){
		$this->cekHakAkses('read_data');

		$result = [];
        $publish_filter =isset($_GET['publish_filter']) ? strval($_GET['publish_filter']) : "";


		$page = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
		$perPage = 6; // Jumlah item per halaman

        $data = $this->model->getDataTalent($publish_filter);

		$totalPages = ceil($data['recordsTotal'] / $perPage);

		$result = [
			'items' => $data['data'],
			'total_pages' => $totalPages,
			'current_page' => $page
		];

		echo json_encode($result);

	}

	
	public function details()
	{
		$this->cekHakAkses('read_data');
		
		$data = $this->data;

		// tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role
		$data['auth_tambah']=$this->actionUser['create_data'];
		$data['auth_ubah']=$this->actionUser['update_data'];
		$data['auth_hapus']=$this->actionUser['delete_data'];
		// batas tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role


		if(isset($_GET['id']) and  $_GET['id'] != '' ){
			$data['dataUser'] = $this->model->getDataTalent($_GET['id']);

			if(empty($data['dataUser'])){
				$data['message'] =   [
					'status' => 'error', 
					'message' => 'ID Tidak Ada',
					'dismiss' => 'true',
				];
			}
		}
		else{
            $data['message'] =   [
                'status' => 'error', 
                'message' => 'Harus Ada ID',
                'dismiss' => 'true',
            ];
        }
        
		$data['dataBaseUrl'] = $this->config->baseURL;

		$this->view('../../Recruiter/PublishTalent/PublishTalentDetailView', $data);
	}

	
}

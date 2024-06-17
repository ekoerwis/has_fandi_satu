<?php

namespace App\Controllers\GeneralApps;
use App\Models\GeneralApps\ParameterAppsModel;
use \Config\App;
use App\Libraries\Tablesigniter;

class ParameterApps extends \App\Controllers\BaseController
{
	protected $model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new ParameterAppsModel;	
		$this->data['site_title'] = 'Parameter Apps';
		
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
		

		$data = $this->data;

		// tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role
		$data['auth_tambah']=$this->actionUser['create_data'];
		$data['auth_ubah']=$this->actionUser['update_data'];
		$data['auth_hapus']=$this->actionUser['delete_data'];
		// batas tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role

		$this->view('../../GeneralApps/ParameterApps/ParameterAppsView', $data);
	}

	public function fetchAll(){
		$this->cekHakAkses('read_data');

		$result = [];
        $columns = ['id_group','kode_group', 'nama_group'];
        $limit = isset($_POST['length']) ? intval($_POST['length']) : 0;
        $start =isset($_POST['start']) ? intval($_POST['start']) : 0;
        // $order = $columns[$_POST['order'][0]['column']];
        $orders = isset($_POST['order'][0]['column']) ? strval($_POST['order'][0]['column']) : '0';
        $order = $columns[$orders];
        $dir =  isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : ' asc ';
        $search =  isset($_POST['search']['value']) ? strval($_POST['search']['value']) : '';
        
		

        $result = $this->model->getGroupParameter($limit, $start, $order, $dir, $search);

		$data = [];
		
        $data = [
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" =>$result['recordsFiltered'],
            "data" => $result['data']
        ];

        echo json_encode($data);

	}
	
	public function add() 
	{
		$this->cekHakAkses('create_data');
		
		$breadcrumb['Add'] = '';
		$data = $this->data;
		$data['title'] = 'Tambah ' . $this->currentModule['judul_module'];
		$data['msg'] = [];
		
		$error = false;
		if ($this->request->getPost('submit'))
		{
			$action = $this->model->saveData();
			$data['message'] =  [
				'status' => $action['status'], 
				'message' => $action['message'],
				'dismiss' => isset($action['dismiss']) ? $action['dismiss'] : 'false',
			];
		}
		
		$this->view('../../GeneralApps/ParameterApps/ParameterAppsAddView', $data);

	}
	
	public function edit() 
	{
		$this->cekHakAkses('update_data');
		
		$breadcrumb['Add'] = '';
		$data = $this->data;
		$data['title'] = 'Edit ' . $this->currentModule['judul_module'];
		$data['msg'] = [];
		
		$error = false;

		if(!empty($_GET['id'])){
			$data['dataEdit'] =  $this->model->getEditData($_GET['id']);
		}
			// echo json_encode($data['dataEdit']);
			// exit;

		if ($this->request->getPost('submit'))
		{
			$action = $this->model->saveData();
			$data['message'] =  [
				'status' => $action['status'], 
				'message' => $action['message'],
				'dismiss' => isset($action['dismiss']) ? $action['dismiss'] : 'false',
			];
		}
		
		$this->view('../../GeneralApps/ParameterApps/ParameterAppsEditView', $data);

	}
	
}

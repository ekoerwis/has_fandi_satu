<?php

namespace App\Controllers\Admin;
use App\Models\Admin\TalentListModel;
use \Config\App;
use App\Libraries\Tablesigniter;

class TalentList extends \App\Controllers\BaseController
{
	protected $model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new TalentListModel;	
		$this->data['site_title'] = 'Talent List';
		
		// $this->addJs ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js' );
		// $this->addJs ( $this->config->baseURL . 'public/themes/modern/js/date-picker.js');
		// $this->addJs ( $this->config->baseURL . 'public/themes/modern/js/image-upload.js');
		
		// $this->addJs ( $this->config->baseURL . 'public/vendors/datatables/datatables.min.js');
		// $this->addStyle ( $this->config->baseURL . 'public/vendors/datatables/datatables.min.css');
		
		// $this->addJs ( $this->config->baseURL . 'public/vendors/datatables_20240617/datatables.min.js');
		// $this->addStyle ( $this->config->baseURL . 'public/vendors/datatables_20240617/datatables.min.css');

		// $this->addJs ( $this->config->baseURL . 'public/vendors/datatables_20240617_2/datatables.min.js');
		// $this->addStyle ( $this->config->baseURL . 'public/vendors/datatables_20240617_2/datatables.min.css');

		// $this->addJs ( $this->config->baseURL . 'public/vendors/datatables/datatables-2.0.8/js/dataTables.js');
		// $this->addStyle ( $this->config->baseURL . 'public/vendors/datatables/datatables-2.0.8/css/dataTables.dataTables.css');

		// $this->addJs ( $this->config->baseURL . 'public/themes/modern/js/data-tables.js');

		// $this->addStyle ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.css');
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

		$this->view('../../Admin/TalentList/TalentListView', $data);
	}

	public function fetchAll(){
		$this->cekHakAkses('read_data');

		$result = [];
        $columns = ['fotopribadi','id_user', 'username','nama','sex_label'];
        $limit = isset($_POST['length']) ? intval($_POST['length']) : 0;
        $start =isset($_POST['start']) ? intval($_POST['start']) : 0;
        // $order = $columns[$_POST['order'][0]['column']];
        $orders = isset($_POST['order'][1]['column']) ? strval($_POST['order'][1]['column']) : '1';
        $order = $columns[$orders];
        $dir =  isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : ' asc ';
        $search =  isset($_POST['search']['value']) ? strval($_POST['search']['value']) : '';

        $result = $this->model->getDataTable($limit, $start, $order, $dir, $search);

		$data = [];
		
        $data = [
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" =>$result['recordsFiltered'],
            "data" => $result['data']
        ];

        echo json_encode($data);

	}
	
	
}

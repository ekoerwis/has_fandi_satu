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
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/datatables.min.js');
		$this->addStyle ( $this->config->baseURL . 'public/vendors/datatables/datatables.min.css');
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/data-tables.js');
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

        $columns = ['nama', 'npm'];
        $limit = isset($_POST['length']) ? intval($_POST['length']) : 0;
        $start =isset($_POST['start']) ? intval($_POST['start']) : 0;
        $order = $columns[$_POST['order'][0]['column']];
        $dir =  isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : ' asc ';
        $search =  isset($_POST['search']['value']) ? strval($_POST['search']['value']) : '';
        
        $result = $this->model->getGroupParameter($limit, $start, $order, $dir, $search);
        $totalData = count($this->model->getCountGroupParameter());
        $totalFiltered = count($this->model->getCountGroupParameterFilter($search));


        $data = [];
        if (!empty($results)) {
            foreach ($results as $result) {
                $nestedData['nama'] = $result['nama'];
                $nestedData['npm'] = $result['npm'];

                $data[] = $nestedData;
            }
        }

        $json_data = [
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $totalData,
            "recordsFiltered" =>$totalFiltered,
            "data" => $result
        ];

        echo json_encode($json_data);

	}
	
}

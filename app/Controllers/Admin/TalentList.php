<?php

namespace App\Controllers\Admin;
use App\Models\Admin\TalentListModel;
use \Config\App;
use App\Libraries\Tablesigniter;

use App\Models\Talent\ProfileModel;
use App\Models\Talent\DataDiriModel;
use App\Models\Talent\DataBajuPreferenceModel;
use App\Models\Talent\RiwayatPendidikanModel;
use App\Models\Talent\RiwayatPekerjaanModel;
use App\Models\Talent\DataKeluargaModel;
use App\Models\Talent\SkillBahasaModel;
use App\Models\Talent\SkillSertifikatModel;
use App\Models\Talent\PengalamanPraktisModel;
use App\Models\Talent\UploadFileTalentModel;

class TalentList extends \App\Controllers\BaseController
{
	protected $model;
	protected $profile_model;
	protected $datadiri_model;
	protected $databaju_model;
	protected $datapendidikan_model;
	protected $datapekerjaan_model;
	protected $datakeluarga_model;
	protected $databahasa_model;
	protected $datasertifikat_model;
	protected $datapengalamanpraktis_model;
	protected $datauploadfile_model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new TalentListModel;	
		$this->profile_model = new ProfileModel;	
		$this->datadiri_model = new DataDiriModel;	
		$this->databaju_model = new DataBajuPreferenceModel;	
		$this->datapendidikan_model = new RiwayatPendidikanModel;	
		$this->datapekerjaan_model = new RiwayatPekerjaanModel;	
		$this->datakeluarga_model = new DataKeluargaModel;	
		$this->databahasa_model = new SkillBahasaModel;	
		$this->datasertifikat_model = new SkillSertifikatModel;	
		$this->datapengalamanpraktis_model = new PengalamanPraktisModel;	
		$this->datauploadfile_model = new UploadFileTalentModel;	
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
        $publish_filter =isset($_POST['publish_filter']) ? strval($_POST['publish_filter']) : "";

		// $this->consoleLogs($publish_filter);

        $result = $this->model->getDataTable($limit, $start, $order, $dir, $search, $publish_filter);

		$data = [];
		
        $data = [
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" =>$result['recordsFiltered'],
            "data" => $result['data']
        ];

        echo json_encode($data);

	}

	public function consoleLogs($data=""){
		
        // echo '<script>alert(data = "'.$data.'")</script>';
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

		$this->view('../../Admin/TalentList/TalentListDetailView', $data);
	}

	public function getTab()
    {
		$page = isset($_GET['page'])?strval($_GET['page']):'';
		$data=[];
		$data = $this->data;

		
		$data['data_profile'] = $this->profile_model->getRowMainSql($_GET['id']);
		$data['data_datadiri'] = $this->datadiri_model->getRowFullLabel($_GET['id']);
		$data['data_databaju'] = $this->databaju_model->getRowFullLabel($_GET['id']);
		$data['data_riwayatpendidikan'] = $this->datapendidikan_model->getResultFullLabel($_GET['id']);
		$data['data_riwayatpekerjaan'] = $this->datapekerjaan_model->getResultFullLabel($_GET['id']);
		$data['data_datakeluarga'] = $this->datakeluarga_model->getResultFullLabel($_GET['id']);
		$data['data_skillbahasa'] = $this->databahasa_model->getResultFullLabel($_GET['id']);
		$data['data_skillsertifikat'] = $this->datasertifikat_model->getResultFullLabel($_GET['id']);
		$data['data_pengalamanpraktis'] = $this->datapengalamanpraktis_model->getResultFullLabel($_GET['id']);
		$data['data_fileupload'] = $this->datauploadfile_model->getResultFullLabel($_GET['id']);
		$data['data_publishtalent'] = $this->model->getPublishTalent($_GET['id']);
        return view('Admin/TalentList/'.$page , $data);
    }
	
	
    public function downloadFile(){
		
        $this->cekHakAkses('read_data');
		$id= isset($_GET['id'])?strval($_GET['id']):'';
		$id_file= isset($_GET['id_file'])?strval($_GET['id_file']):'';

		
		$filePath = 'public/files/talent/'.$id.'/'.$id_file;

		$data = $this->data;


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

		
		if($id =='' or $id_file ==''){			
			$data['message'] =   [
				'status' => 'warning', 
				'message' => 'File Tidak Ada',
				'dismiss' => 'true',
			];
			$data['loadTabs'] = 'file_upload';

			// return view('Admin/TalentList/TalentListDetailView' , $data); 
			$this->view('../../Admin/TalentList/TalentListDetailView', $data);
		}
			
		$data['dataBaseUrl'] = $this->config->baseURL;
			

		if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            return redirect()->back()->with('message', 'File tidak ditemukan.');
        }

    }
	
	
    public function publishTalent(){
		
        $this->cekHakAkses('read_data');
		$id_talent= isset($_POST['id_talent'])?strval($_POST['id_talent']):'';
		$new_expired= isset($_POST['new_expired'])?strval($_POST['new_expired']):'';

		$data = $this->data;

		if(isset($_POST['id_talent']) and  $_POST['id_talent'] != '' ){
			$data['dataUser'] = $this->model->getDataTalent($_POST['id_talent']);

			$action = $this->model->publishTalent($this->user['id_user']);
			$data['message'] =  [
				'status' => $action['status'], 
				'message' => $action['message'],
				'dismiss' => isset($action['dismiss']) ? $action['dismiss'] : 'false',
			];
		}
		else{
				$data['message'] =   [
					'status' => 'error', 
					'message' => 'Harus Ada ID',
					'dismiss' => 'true',
				];
		}

		$this->view('../../Admin/TalentList/TalentListDetailView', $data);

    }
	
}

<?php

namespace App\Controllers\Recruiter;
use App\Models\Recruiter\PublishTalentModel;
use \Config\App;
use App\Libraries\Tablesigniter;

use App\Models\Talent\DataDiriModel;
use App\Models\Talent\DataBajuPreferenceModel;
use App\Models\Talent\RiwayatPendidikanModel;
use App\Models\Talent\RiwayatPekerjaanModel;
use App\Models\Talent\SkillBahasaModel;
use App\Models\Talent\SkillSertifikatModel;
use App\Models\Talent\PengalamanPraktisModel;
use App\Models\Talent\UploadFileTalentModel;

class PublishTalent extends \App\Controllers\BaseController
{
	protected $model;
	protected $datadiri_model;
	protected $databaju_model;
	protected $datapendidikan_model;
	protected $datapekerjaan_model;
	protected $databahasa_model;
	protected $datasertifikat_model;
	protected $datapengalamanpraktis_model;
	protected $datauploadfile_model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new PublishTalentModel;		
		$this->datadiri_model = new DataDiriModel;	
		$this->databaju_model = new DataBajuPreferenceModel;	
		$this->datapendidikan_model = new RiwayatPendidikanModel;	
		$this->datapekerjaan_model = new RiwayatPekerjaanModel;
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

		$this->view('../../Recruiter/PublishTalent/PublishTalentView', $data);
	}

	public function fetchAll(){
		$this->cekHakAkses('read_data');

		$result = [];
        $p_jenis_sertifikat_jepang =isset($_GET['p_jenis_sertifikat_jepang']) ? strval($_GET['p_jenis_sertifikat_jepang']) : "";
        $p_sertifikasi =isset($_GET['p_sertifikasi']) ? strval($_GET['p_sertifikasi']) : "";
        $p_pengalaman_praktis =isset($_GET['p_pengalaman_praktis']) ? strval($_GET['p_pengalaman_praktis']) : "";


		$page = isset($_GET['page']) ? strval($_GET['page']) : 1;
		$perPage = 10; // Jumlah item per halaman
		$DataNum = ($page - 1) * $perPage;

        $data = $this->model->getDataTalent($perPage, $DataNum, $p_jenis_sertifikat_jepang,$p_sertifikasi,$p_pengalaman_praktis);

		$totalPages = ceil($data['recordsTotal'] / $perPage);

		$result = [
			'items' => $data['data'],
			'total_pages' => $totalPages,
			'current_page' => $page
		];

		echo json_encode($result);

	}

	
	public function detailTalent()
	{
		$this->cekHakAkses('read_data');
		
		$data = $this->data;

		// tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role
		$data['auth_tambah']=$this->actionUser['create_data'];
		$data['auth_ubah']=$this->actionUser['update_data'];
		$data['auth_hapus']=$this->actionUser['delete_data'];
		// batas tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role


		if(isset($_GET['id']) and  $_GET['id'] != '' ){
			$data['dataUser'] = $this->model->getDataPickTalent($_GET['id']);

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

    public function getParameter(){
		
        $this->cekHakAkses('read_data');
        
        $result = $this->model->getParameter();

        echo json_encode($result);

    }
	

	public function getTab()
    {
		$page = isset($_GET['page'])?strval($_GET['page']):'';
		$data=[];
		$data = $this->data;

		$data['data_datadiri'] = $this->datadiri_model->getRowFullLabel($_GET['id']);
		$data['data_databaju'] = $this->databaju_model->getRowFullLabel($_GET['id']);
		$data['data_riwayatpendidikan'] = $this->datapendidikan_model->getResultFullLabel($_GET['id']);
		$data['data_riwayatpekerjaan'] = $this->datapekerjaan_model->getResultFullLabel($_GET['id']);
		$data['data_skillbahasa'] = $this->databahasa_model->getResultFullLabel($_GET['id']);
		$data['data_skillsertifikat'] = $this->datasertifikat_model->getResultFullLabel($_GET['id']);
		$data['data_pengalamanpraktis'] = $this->datapengalamanpraktis_model->getResultFullLabel($_GET['id']);
		$data['data_fileupload'] = $this->datauploadfile_model->getResultFullLabel($_GET['id']);

        return view('Recruiter/PublishTalent/'.$page , $data);
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
			$this->view('../../Recruiter/PublishTalent/PublishTalentDetailView', $data);
		}
			
		$data['dataBaseUrl'] = $this->config->baseURL;
			

		if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            return redirect()->back()->with('message', 'File tidak ditemukan.');
        }

    }

	
}

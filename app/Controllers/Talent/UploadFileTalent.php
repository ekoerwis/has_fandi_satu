<?php

namespace App\Controllers\Talent;
use App\Models\Talent\UploadFileTalentModel;
use \Config\App;
use App\Libraries\Tablesigniter;
use CodeIgniter\HTTP\Files\UploadedFile;

class UploadFileTalent extends \App\Controllers\BaseController
{
	protected $model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new UploadFileTalentModel;	
		$this->data['site_title'] = 'Upload File';
		
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

		helper(['file','filesystem']);
	}
	
	public function index()
	{
		$this->cekHakAkses('read_data');
		$this->cekHakAkses('create_data');
		$this->cekHakAkses('update_data');
		
		$breadcrumb['Add'] = '';
		$data = $this->data;
		$data['title'] = 'Upload File';
		$data['subtitle'] = 'Upload Dokumen Foto ,Sertifikat, Piagam Prestasi, dll. Yang dapat menunjukan kelebihan anda  ';
		$data['msg'] = [];
		
        
		// tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role
		$data['auth_tambah']=$this->actionUser['create_data'];
		$data['auth_ubah']=$this->actionUser['update_data'];
		$data['auth_hapus']=$this->actionUser['delete_data'];
		// batas tambahan by eko : berfungsi untuk nilai otorisasi berdasarkan role

		$error = false;
		
		if ($this->request->getPost('submit'))
		{
			$data['message'] =  [
				'status' => 'error', 
				'message' => 'Proses gagal, Tidak Ada Data yang disimpan !',
				'dismiss' => true,
			];

			if(isset($_POST['jenis_dokumen']) )
            {
                if($_POST['jenis_dokumen'][0] != ''){
					$listDetailForm=array();
					for($i = 0 ; $i < count($_POST['jenis_dokumen']); $i++){
						$id_talent = $this->user['id_user'];
						$id=isset($_POST['id'][$i])?intval($_POST['id'][$i]):0;
                        $jenis_dokumen=isset($_POST['jenis_dokumen'][$i])?strval($_POST['jenis_dokumen'][$i]):'';
                        $keterangan=isset($_POST['keterangan'][$i])?strval($_POST['keterangan'][$i]):'';

						$saveAction=$this->model->saveData($id , $id_talent, $jenis_dokumen , $keterangan);
						$data['message'] =  [
							'status' => $saveAction['status'], 
							'message' => $saveAction['message'] ,
							// 'message' => $saveAction['message'] . ' - '.$saveAction['id_data'],
							'dismiss' => isset($saveAction['dismiss']) ? $saveAction['dismiss'] : 'false',
						];

						if($saveAction['status'] =='ok'){
							
							$img = $this->request->getFileMultiple('fileupload');

							if( !empty($img) ){
								if($img[$i] !=''){
									$uploadAction = $this->upload($img[$i], $saveAction['id_data'], $this->user['id_user'],$i);
									
									if($uploadAction['status'] !='ok'){
										$data['message'] =  [
											'status' => $uploadAction['status'], 
											'message' => $uploadAction['message'],
											'dismiss' => isset($uploadAction['dismiss']) ? $uploadAction['dismiss'] : 'false',
										];
									} 
								}
							}
							
							array_push($listDetailForm,"'".$saveAction['id_data']."'");
						} 
					}
					
					if(count($listDetailForm) > 0){
						$implodelistDetailForm = implode(" , ",$listDetailForm);
						$delete=$this->model->clearDataByUser($this->user['id_user'],$implodelistDetailForm);


					}
				} 
			}

		// Menghapus File 

				$directoryPath = 'public/files/talent/'.$this->user['id_user'].'/';
				$registeredFiles = $this->model->getMainSql($this->user['id_user']);

				// Buat array dari nama file yang terdaftar di database
				$registeredFileNames = array_map(function($file) use ($directoryPath) {
					return $directoryPath . $file['nama_file_new'];
				}, $registeredFiles);

				// Dapatkan daftar semua file yang ada di direktori
				$allFiles = glob($directoryPath . '*');

				// Hapus file yang tidak terdaftar di database
				foreach ($allFiles as $file) {
					if (is_file($file) && !in_array($file, $registeredFileNames)) {
						if (unlink($file)) {
							// echo "<script> console.log('File $file berhasil dihapus') ; </script>";
						} else {
							// echo "<script> console.log('Gagal Hapus File $file ') ; </script>";
						}
					}
				}

		 //Batas Menghapus File
			
		}
        $data['data']=$this->model->getMainSql($this->user['id_user'],'id_user');
		
		$this->view('../../Talent/UploadFileTalent/UploadFileTalentView', $data);
	}

    public function upload($img, $id, $id_user,$urut)
    {
        $result=[];

        $validationRule = [
            'fileupload' => [
                'label' => 'Image File',
                'rules' => 'uploaded[fileupload.'.$urut.']'
					. '|ext_in[fileupload,jpg,jpeg,png,pdf]'  // Membatasi format file hanya jpg, jpeg, png, dan pdf
					. '|mime_in[fileupload,image/jpg,image/jpeg,image/png,application/pdf]' // Menambahkan mime type untuk pdf
					. '|max_size[fileupload,10241]' // Batasan ukuran file dalam KB, 10240 = 10MB
                   // . '|max_dims[file_talent,1920,1080]', // Batasan ukuran gambar
            ],
        ];

        if (!$this->validate($validationRule)) {
            $result['status']='warning';
            $result['message']=$this->validator->getErrors();
            $result['dismiss']=true;

            return $result;
        }

		$prevFile = '';

        if ( $img and !$img->hasMoved()) {
            $path = 'public/files/talent/'.$id_user.'/';
            $newName = $id_user.'_'.$img->getRandomName();
            $oldName = $img->getName();
            $uploadProses = $img->move($path, $newName);

            if($uploadProses){
                
				$result['status']='ok';
                $result['message']='filepath : ' . $path . '+++ img name : '.$img->getName();
                $result['dismiss']=true;
                $result['newName']=$newName;

                $updateFileUploadDB = $this->model->updateFileUpload($id,$oldName,$newName);
                if(!$updateFileUploadDB){
                    $result['status']='warning';
                    $result['message']='Gagal Update Data FileUpload';
                    $result['dismiss']=true;
                }
            }
        }

        return $result;
    }

	

    public function downloadFile(){
		
        $this->cekHakAkses('read_data');
		$id= isset($_GET['id'])?strval($_GET['id']):'';
		$data = $this->model->getRowMainSql($id,'id');

		
		$filePath = 'public/files/talent/'.$this->user['id_user'].'/'.$data['nama_file_new'];

		if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName($data['nama_file_ori']);
        } else {
            return redirect()->back()->with('message', 'File tidak ditemukan.');
        }

    }

    public function getParameter(){
		
        $this->cekHakAkses('read_data');
        
        $result = $this->model->getParameter();
        echo json_encode($result);

    }
	
}

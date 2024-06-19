<?php

namespace App\Controllers\Talent;
use App\Models\Talent\ProfileModel;
use \Config\App;
use App\Libraries\Tablesigniter;
use CodeIgniter\HTTP\Files\UploadedFile;

class Profile extends \App\Controllers\BaseController
{
	protected $model;
	public function __construct() {
		
		parent::__construct();
		$this->mustLoggedIn();
		
		$this->model = new ProfileModel;	
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

		$data['title'] = 'Profile';
        $data['data_akun']=$this->model->getRowMainSql($this->user['id_user']);
        // $this->user;

		if ($this->request->getPost('submit'))
		{
			$action = $this->model->saveData($data['data_akun']['id_user']);
			$data['message'] =  [
				'status' => $action['status'], 
				'message' => $action['message'],
				'dismiss' => isset($action['dismiss']) ? $action['dismiss'] : 'false',
			];

            if($action['status'] == 'ok'){
                $uploadAction = $this->upload($data['data_akun']['id_user']);
                
                if($uploadAction['status'] !='ok'){
                    $data['message'] =  [
                        'status' => $uploadAction['status'], 
                        'message' => $uploadAction['message'],
                        'dismiss' => isset($uploadAction['dismiss']) ? $uploadAction['dismiss'] : 'false',
                    ];
                }
            }
		}

		$this->view('../../Talent/Profile/ProfileView', $data);
	}

    public function upload($id)
    {
        $result=[];

        $validationRule = [
            'avatar' => [
                'label' => 'Image File',
                'rules' => 'uploaded[avatar]'
                    . '|is_image[avatar]'
                    . '|mime_in[avatar,image/jpg,image/jpeg,image/png]'
                    . '|max_size[avatar,300]' // Batasan ukuran file dalam KB
                    . '|max_dims[avatar,300,300]', // Batasan ukuran gambar
            ],
        ];

        if (!$this->validate($validationRule)) {
            $result['status']='warning';
            $result['message']=$this->validator->getErrors();
            $result['dismiss']=true;

            return $result;
        }

        $img = $this->request->getFile('avatar');

        if ( $img and !$img->hasMoved()) {
            $path = 'public/images/user/';
            $newName = $id.'_'.$img->getRandomName();
            $uploadProses = $img->move($path, $newName);

            if($uploadProses){
                
                $result['status']='ok';
                $result['message']='filepath : ' . $path . '+++ img name : '.$img->getName();
                $result['dismiss']=true;
                
                $updateAvatarDB = $this->model->updateAvatar($id,$newName);
                if(!$updateAvatarDB){
                    $result['status']='warning';
                    $result['message']='Gagal Update Data Avatar';
                    $result['dismiss']=true;
                }
            }
        }

        return $result;
    }
}

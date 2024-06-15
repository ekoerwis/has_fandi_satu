<?php

namespace App\Controllers;
use App\Models\RegisterModel;
use CodeIgniter\Encryption\EncrypterInterface;
use \Config\App;
use Config\Encryption;

class Register extends \App\Controllers\BaseController
{
	protected $model = '';
	
	public function __construct() {
		parent::__construct();
		$this->model = new RegisterModel;	
		$this->data['site_title'] = 'Register';
		
		helper(['cookie', 'form','text']);
		
	}
	
	public function index()
	{
        // $this->currentModule['nama_module'] = 'Register'; 
        $this->mustNotLoggedIn();

		$data = $this->data;

		// $data['message'] =  ['status' => 'warning', 'message' => 'Test ok'];
		// $msg = [];
		// $msg['status'] = 'warning';
		// $msg['content'] = 'Tidak ada menu yang diupdate';
		// $data['msg'] = $msg;
		$data['register_status'] = 'register_gagal';
		$data['role_register'] = $this->model->getRoleRegister();

		if(isset($_POST['submit'])){
			if($this->request->getPost('password') != $this->request->getPost('password_confirm')){
				$data['message'] =  ['status' => 'warning', 'message' => 'Konfirmasi Password Tidak Sama, Mohon Ulangi Memasukan Password !','dismiss'=>true];
			} else {
				$action = $this->model->saveData();
				$data['message'] =  [
					'status' => $action['status'], 
					'message' => $action['message'],
					'dismiss' => false
				];

				if($action['status'] == 'ok'){
					$data['register_status'] = 'register_sukses';
					$this->sendEmailForVerification($_POST['nama'], $_POST['email']);
				}
			}
		}
		echo view('registerform', $data);
	}

	public function sendEmailForVerification($namaTarget='', $emailTarget=''){

		$datax = [];
		$datax['nama'] = $namaTarget;
		$datax['email'] = $emailTarget;


		$email = \Config\Services::email();

			$email->initialize([
				'SMTPHost' => 'a001.dapurhosting.com',
				'SMTPPort' => 465,
				'SMTPUser' => 'adminepms@mitraandalan.com',
				'SMTPPass' => 'Mitra123$',
				'SMTPCrypto' => 'ssl',
				'protocol' => 'smtp',
				'mailType' => 'html',
				'mailPath' => '/usr/sbin/sendmail',
				'SMTPAuth' => true,
				'fromEmail' => 'adminepms@mitraandalan.com',
				'fromName' => 'Hashira',
				'subject' => 'Verifikasi Pendaftaran',
			]);

			$email->setTo($emailTarget);
			$email->setMessage(view('MailTemplate/verificationMail.php', $datax));

			$response = $email->send();

			$response ? log_message("error", "Email has been sent") : log_message("error", $email->printDebugger());
			// echo $response;
			return $response;
	}

	public function reVerifikasi()
	{
        // $this->currentModule['nama_module'] = 'Register'; 
        $this->mustNotLoggedIn();

		$data = $this->data;

		$data['register_status'] = 'register_gagal';
		$data['role_register'] = $this->model->getRoleRegister();

		if(isset($_POST['submit'])){

			$dataUser = $this->model->checkEmail($_POST['email']);

			if(empty($dataUser)){
				$data['message'] =  ['status' => 'error', 'message' => 'Email Belum Terdaftar, Mohon Pastikan Email Telah Benar !','dismiss'=>false];
			} else {
				if($dataUser['verified'] == ''){
					$this->sendEmailForVerification($dataUser['nama'], $dataUser['email']);
					$data['message'] =  ['status' => 'ok', 'message' => 'Email Verifikasi Telah Dikirim, Mohon Cek Email Kembali','dismiss'=>false];
				} else {
					$data['message'] =  ['status' => 'warning', 'message' => 'Email telah terverifikasi, Mohon Login Pada Halaman Awal','dismiss'=>false];
				}
			}

			
		}
		echo view('reverificationform', $data);
	}

	public function resetPassword()
	{
        // $this->currentModule['nama_module'] = 'Register'; 
        $this->mustNotLoggedIn();

		$data = $this->data;

		$data['register_status'] = 'register_gagal';
		$data['role_register'] = $this->model->getRoleRegister();

		if(isset($_POST['submit'])){

			$dataUser = $this->model->checkEmail($_POST['email']);

			if(empty($dataUser)){
				$data['message'] =  ['status' => 'error', 'message' => 'Email Belum Terdaftar, Mohon Pastikan Email Telah Benar !','dismiss'=>false];
			} else {
				// $this->sendEmailForVerification($dataUser['nama'], $dataUser['email']);
				// $artiPassword = $this->encryptPassword($newPassword,2, $dataUser['nama']);
				$newPassword = random_string('crypto', 10);

				$data['message'] =  ['status' => 'error', 'message' => 'Password Gagal Direset, Mohon ulangi proses beberapa waktu lagi','dismiss'=>false];

				$gantiPassword = $this->model->gantiPassword($dataUser['id_user'],$newPassword);

				if($gantiPassword){
					$sendEmail = $this->sendEmailForResetPassword($dataUser['nama'], $dataUser['email'], $newPassword);
					if($sendEmail){
						$data['message'] =  ['status' => 'ok', 'message' => 'Password Baru Telah Dikirim, Mohon Cek Email Kembali','dismiss'=>false];
					}
				}

			}

			
		}
		echo view('resetpasswordform', $data);
	}

	
	public function sendEmailForResetPassword($namaTarget='', $emailTarget='', $newPass=''){

		$datax = [];
		$datax['nama'] = $namaTarget;
		$datax['email'] = $emailTarget;
		$datax['newPass'] = $newPass;


		$email = \Config\Services::email();

			$email->initialize([
				'SMTPHost' => 'a001.dapurhosting.com',
				'SMTPPort' => 465,
				'SMTPUser' => 'adminepms@mitraandalan.com',
				'SMTPPass' => 'Mitra123$',
				'SMTPCrypto' => 'ssl',
				'protocol' => 'smtp',
				'mailType' => 'html',
				'mailPath' => '/usr/sbin/sendmail',
				'SMTPAuth' => true,
				'fromEmail' => 'adminepms@mitraandalan.com',
				'fromName' => 'Hashira',
				'subject' => 'Verifikasi Pendaftaran',
			]);

			$email->setTo($emailTarget);
			$email->setMessage(view('MailTemplate/resetPassMail.php', $datax));

			$response = $email->send();

			$response ? log_message("error", "Email has been sent") : log_message("error", $email->printDebugger());
			// echo $response;
			return $response;
	}

	public function encryptPassword($newWord='',$type=1, $namaTarget){
		// $type 1 = Encryp;
		// $type 2 = decrypt;
		
		$encrypter = service('encrypter');

		$result = '';
		if($type == 1){
			$result = $encrypter->encrypt($newWord);
		} else {
			$result = $encrypter->decrypt($newWord);
		}

		return $result;
	}
	
}

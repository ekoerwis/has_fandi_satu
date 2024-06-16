<?php

namespace App\Models;

class RegisterModel extends \App\Models\BaseModel
{	
	public function saveData() 
	{
		$result = [];

		$data_db['nama'] = $this->request->getPost('nama');
		$data_db['sex'] = $this->request->getPost('gender');
		$data_db['username'] = $this->request->getPost('username');
		$data_db['email'] = $this->request->getPost('email');
		$data_db['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
		$data_db['id_role'] = $this->request->getPost('id_role');

		if(!empty($this->checkUsername($data_db['username']))){
			$result['status']='error';
			$result['message']='Username telah digunakan, mohon gunakan username lain !';
		} elseif (!empty($this->checkEmail($data_db['email']))){
			$result['status']='error';
			$result['message']='Email telah terdaftar dalam sistem, mohon masuk menggunakan username yang terhubung email tersebut ! <br>';
		} else {

			$save = $this->db->table('user')->insert($data_db);

			if($save){
				$result['status']='ok';
				$result['message']='Pendaftaran berhasil dilakukan, mohon periksa email yang telah didaftarkan untuk melakukan verifikasi akun';
			} else {
				$result['status']='error';
				$result['message']='Gagal Mendaftar';
			}
		}

		// $this->db->table('user')->insert($data_db);

		return $result;
	}
	
	public function checkUsername($id=''){
		$result='false';

		$sql = "SELECT * FROM user where username = '$id'";
		$result = $this->db->query($sql)->getRowArray();

		return $result;
	}
	
	public function checkEmail($id=''){
		$result='false';

		$sql = "SELECT * FROM user where email = '$id'";
		$result = $this->db->query($sql)->getRowArray();

		return $result;
	}
	
	public function getRoleRegister(){
		$result='false';

		$sql = "SELECT * FROM role where registry_form=1";
		$result = $this->db->query($sql)->getResultArray();

		return $result;
	}
	
	public function gantiPassword($id_user,$newPassword){
		$result='false';
		
		$password = password_hash($newPassword, PASSWORD_DEFAULT);

		$sql = "update user set password = '$password' where id_user = '$id_user'";
		$result = $this->db->query($sql);

		return $result;
	}
	
	public function activation($id_user){

		$result =[];
		
		$result['status']='error';
		$result['message']='User Tidak Ditemukan';

		// $cekUser = "";
		$sqlUser = "SELECT * FROM user where id_user = '$id_user' and verified is null ";
		$resultUser = $this->db->query($sqlUser)->getRowArray();

		if($resultUser and !empty($resultUser)){

			$sqlAction = "update user set verified = now() where id_user = '$id_user'";
			$resultAction = $this->db->query($sqlAction);

			if($resultAction){
				$result['status']='ok';
				$result['message']='User Telah Berhasil DiVerifikasi, Mohon Login Ulang Untuk Memasuki Aplikasi';
			}

		}

		return $result;
	}

	
	/* See base model
	public function checkUser($username) 
	{
		
	} */
}
?>
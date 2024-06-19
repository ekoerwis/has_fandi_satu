<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class ProfileModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql(){
        $mainSQL = "SELECT * FROM user";

        return $mainSQL;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from user where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function cekEmail($id='',$email){

        $sql = "select * from user where id_user != '$id' and email = '$email'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function saveData($id='') 
	{
        $result = [];

		$data_db['nama'] = $this->request->getPost('nama');
		$data_db['email'] = $this->request->getPost('email');
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;
        
		if(empty($this->getRowMainSql($id,'id_user'))){
			$result['status']='error';
			$result['message']='Kode Tidak Ditemukan, Mohon Periksa Kembali !';
			$result['dismiss']=true;
		} else {

            if(!empty($this->cekEmail($id,$data_db['email']))){
                $result['status']='error';
                $result['message']='Proses gagal, Email Telah Digunakan Oleh Akun Lain !';
                $result['dismiss']=true;
            } else {
                $update = $this->db->table('user')->update($data_db, ['id_user' => $id]);
                if($update){
                    $result['status']='ok';
                    $result['message']='Data Berhasil Diubah';
                    $result['dismiss']=false;
                } 
            }

		}

		return $result;

	}

    public function updateAvatar($id='',$avatar='') 
	{
		$data_db['avatar'] =$avatar;
        $result = $this->db->table('user')->update($data_db, ['id_user' => $id]);;

		return $result;

	}
}
?>
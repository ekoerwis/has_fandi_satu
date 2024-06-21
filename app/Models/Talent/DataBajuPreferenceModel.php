<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class DataBajuPreferenceModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql(){
        $mainSQL = "SELECT * FROM databaju_tambahan";

        return $mainSQL;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from databaju_tambahan where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function saveData($id='') 
	{
        $result = [];

		$data_db['id_user'] = $id;
		$data_db['ukuran_baju'] = isset($_POST['ukuran_baju'])?strval($_POST['ukuran_baju']):'';
		$data_db['ukuran_celana'] = isset($_POST['ukuran_celana'])?strval($_POST['ukuran_celana']):'';
		$data_db['ukuran_pinggang'] = isset($_POST['ukuran_pinggang'])?strval($_POST['ukuran_pinggang']):'';
		$data_db['ukuran_sepatu'] = isset($_POST['ukuran_sepatu'])?strval($_POST['ukuran_sepatu']):'';
		$data_db['vaksin'] = isset($_POST['vaksin'])?strval($_POST['vaksin']):'';
		$data_db['status_merokok'] = isset($_POST['status_merokok'])?strval($_POST['status_merokok']):'';
        $data_db['status_alkohol'] = isset($_POST['status_alkohol'])?strval($_POST['status_alkohol']):'';
		$data_db['intensitas_alkohol'] = isset($_POST['intensitas_alkohol'])?strval($_POST['intensitas_alkohol']):'';
		$data_db['status_tato'] = isset($_POST['status_tato'])?strval($_POST['status_tato']):'';
		$data_db['kesehatan_badan'] = isset($_POST['kesehatan_badan'])?strval($_POST['kesehatan_badan']):'';
		$data_db['status_penyakit'] = isset($_POST['status_penyakit'])?strval($_POST['status_penyakit']):'';
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;
        
		if(empty($this->getRowMainSql($id,'id_user'))){
            $save = $this->db->table('databaju_tambahan')->insert($data_db);
            if($save){
                $result['status']='ok';
                $result['message']='Data Berhasil Ditambah';
                $result['dismiss']=false;
            } 
		} else {
            $update = $this->db->table('databaju_tambahan')->update($data_db, ['id_user' => $id]);
            if($update){
                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false;
            } 

		}

		return $result;
	}
    
    public function getParameter($id='',$column='id_parameter'){

        if(isset($_POST['id'])){
            $id = isset($_POST['id']) ? strval($_POST['id']) :'';
            $column = isset($_POST['column']) ? strval($_POST['column']) :'id_parameter';
        }

        $sql = "select * from parameter_detail where $column = '$id' order by sequence";
        $result = $this->db->query($sql)->getResultArray();

        return $result;
    }
}
?>
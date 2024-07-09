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

    public function getRowFullLabel($id='',$column='id_user'){

        $sql = "SELECT A.* FROM (SELECT a.id, a.id_user, 
        a.ukuran_baju, ukuran_baju.label_parameter ukuran_baju_label,
        a.ukuran_celana, ukuran_celana.label_parameter ukuran_celana_label,
        a.ukuran_pinggang,
        a.ukuran_sepatu, 
        a.vaksin, vaksin.label_parameter vaksin_label,
        a.status_merokok, status_merokok.label_parameter status_merokok_label,
        a.status_alkohol, status_alkohol.label_parameter status_alkohol_label,
        a.intensitas_alkohol, intensitas_alkohol.label_parameter intensitas_alkohol_label,
        a.status_tato, status_tato.label_parameter status_tato_label,
        a.kesehatan_badan, kesehatan_badan.label_parameter kesehatan_badan_label,
        a.status_penyakit, status_penyakit.label_parameter status_penyakit_label
        FROM databaju_tambahan a
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=21) ukuran_baju
        ON a.ukuran_baju = ukuran_baju.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=22) ukuran_celana
        ON a.ukuran_celana = ukuran_celana.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=23) vaksin
        ON a.vaksin = vaksin.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=24) status_merokok
        ON a.status_merokok = status_merokok.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=25) status_alkohol
        ON a.status_alkohol = status_alkohol.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=26) intensitas_alkohol
        ON a.intensitas_alkohol = intensitas_alkohol.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=27) status_tato
        ON a.status_tato = status_tato.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=28) kesehatan_badan
        ON a.kesehatan_badan = kesehatan_badan.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=29) status_penyakit
        ON a.status_penyakit = status_penyakit.value_parameter
        ) A where $column = '$id'";

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
<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class UploadFileTalentModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}

	public function getMainSql($id='',$column='id_user'){
        $mainSQL = "SELECT * FROM file_upload where $column = '$id'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from file_upload where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function saveData($id='', $id_user='', $jenis_dokumen='' ,$keterangan='') 
	{
        $result = [];
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;

        if(!empty($id_user)){
            $data_db['jenis_dokumen']=isset($jenis_dokumen)?strval($jenis_dokumen):'';
            $data_db['keterangan']=isset($keterangan)?strval($keterangan):'';

            if($id=='' or $id==0){
                $data_db['id_user']=isset($id_user)?strval($id_user):'';

                $save = $this->db->table('file_upload')->insert($data_db);
                if($save){

                    $sqlSearchSave = "select * from file_upload where id_user = '$id_user' 
                    and jenis_dokumen = '".$data_db['jenis_dokumen']."'
                    and keterangan = '".$data_db['keterangan']."'
                    and nama_file_ori is null
                    and nama_file_new is null ";

                    $dataHasSave = $this->db->query($sqlSearchSave)->getRowArray();

                    // array_push($listDetailForm,"'".$dataHasSave['id']."'");

                    $result['status']='ok';
                    $result['message']='Data Berhasil Ditambah';
                    $result['dismiss']=false;
                    $result['id_data']=$dataHasSave['id'];
                } 
            } else {
                $update = $this->db->table('file_upload')->update($data_db, ['id' => $id]);

                if($update){
                    $result['status']='ok';
                    $result['message']='Data Berhasil Diubah';
                    $result['dismiss']=false;
                    $result['id_data']=$id;
                } 
            }
        }

        return $result;


	}

    

    public function updateFileUpload($id='',$oldName='',$newName='') 
	{
		$data_db['nama_file_ori'] =$oldName;
		$data_db['nama_file_new'] =$newName;
        $result = $this->db->table('file_upload')->update($data_db, ['id' => $id]);;

		return $result;

	}
    
    public function clearDataByUser($id_user='',$implodelistDetailForm=''){

        if($id_user != '' and $implodelistDetailForm != ''){

            $sqlDelete = "DELETE FROM file_upload WHERE id_user = '$id_user'  AND id NOT IN ($implodelistDetailForm)";
            $delete = $this->db->query($sqlDelete);

        }

        return true;
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
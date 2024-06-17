<?php

namespace App\Models\GeneralApps;
// use CodeIgniter\Database\RawSql;

class ParameterAppsModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql(){
        $mainSQL = "SELECT * FROM parameter_group";

        return $mainSQL;
    }

    public function getSubSql(){
        $subSQL = "SELECT * FROM parameter_group";

        return $subSQL;
    }

	public function getGroupParameter($limit, $start, $order, $dir, $search = null) 
	{

        $result = [];
        $sql = $this->getMainSql();

        $countMainSQL = count($this->db->query($sql)->getResultArray());
        
        if ($search) {
            $sql .= " WHERE kode_group LIKE '%$search%' OR nama_group LIKE '%$search%'";
        }

        $countFilterSQL = count($this->db->query($sql)->getResultArray());

        $sql .= " ORDER BY $order $dir LIMIT $start, $limit";

        $dataSql = $this->db->query($sql)->getResultArray();

        $result['recordsTotal']=$countMainSQL;
        $result['recordsFiltered']=$countFilterSQL;
        $result['data']=$dataSql;

        return $result;

	}

    public function saveData() 
	{

        $result = [];

		$data_db['kode_group'] = $this->request->getPost('kode_group');
		$data_db['nama_group'] = $this->request->getPost('nama_group');
        

		if(!empty($this->getRowMainSql($data_db['kode_group'],'kode_group'))){
			$result['status']='error';
			$result['message']='Kode telah digunakan, mohon gunakan Kode lain !';
			$result['dismiss']=true;
		} else {

			$save = $this->db->table('parameter_group')->insert($data_db);

			if($save){

                $idHeader = $this->getRowMainSql($data_db['kode_group'],'kode_group');

                if(!empty($idHeader['id_group'])){
                    
                    $data_db_detail['id_group'] = $idHeader['id_group'];

                    $jmlDetail = count($_POST['value_parameter']);

                    for($i=0 ; $i < $jmlDetail ; $i++){
                        $data_db_detail['value_parameter'] = $_POST['value_parameter'][$i];
                        $data_db_detail['label_parameter'] = $_POST['label_parameter'][$i];
                        $this->db->table('parameter_detail')->insert($data_db_detail);
                    }

                    $result['status']='ok';
                    $result['message']='Data Berhasil Disimpan';
			        $result['dismiss']=false;
            }
			} else {
				$result['status']='error';
				$result['message']='Proses gagal mohon ulangi kembali !';
			    $result['dismiss']=true;
        }
		}

		return $result;

	}

    public function getRowMainSql($id='',$column='id_group'){

        $sql = "select * from parameter_group where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }


}
?>
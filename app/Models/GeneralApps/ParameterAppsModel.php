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

        $dataFull = array();
        
        $dataSql = $this->db->query($sql)->getResultArray();

        foreach($dataSql as $data){
            // $dataPlot['dataDetail'] = array();
			$dataDetail['dataDetail'] = $this->getDetail($data['id_group'],'id_group');

			$data = array_merge($data, $dataDetail);

			array_push($dataFull, $data);

        }

        $result['recordsTotal']=$countMainSQL;
        $result['recordsFiltered']=$countFilterSQL;
        $result['data']=$dataFull;

        return $result;

	}

    public function getDetail($id = '', $column='id_parameter')
	{
		$sql = "select * from parameter_detail where $column = '$id' order by sequence , value_parameter asc";

		$result = array();

		$result = $this->db->query($sql)->getResultArray();

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
                        $data_db_detail['sequence'] = $_POST['sequence'][$i];
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

	public function getEditData($search = null) 
	{

        // $result = [];
        $sql = $this->getMainSql();

        
        if ($search) {
            $sql .= " WHERE id_group = $search ";
        }
        
        $dataSql = $this->db->query($sql)->getRowArray();
        
        $dataDetail['dataDetail'] = $this->getDetail($dataSql['id_group'],'id_group');

        $data = array_merge($dataSql, $dataDetail);

        $result=$data;

        return $result;

	}

    

    public function editData() 
	{
        $result = [];

		$id_group = $this->request->getPost('id_group');
		$kode_group = $this->request->getPost('kode_group');
		$data_db['nama_group'] = $this->request->getPost('nama_group');
        
        $listDetailForm=array();
		$implodeListDetailForm = "";

		if(empty($this->getRowMainSql($id_group,'id_group'))){
			$result['status']='error';
			$result['message']='Kode Tidak Ditemukan, Mohon Periksa Kembali !';
			$result['dismiss']=true;
		} else {

			$update = $this->db->table('parameter_group')->update($data_db, ['id_group' => $id_group]);

			if($update){

                $jmlDetail = count($_POST['value_parameter']);

                for($i=0 ; $i < $jmlDetail ; $i++){
                    $id_parameter = isset($_POST['id_parameter'][$i])? strval($_POST['id_parameter'][$i]):'';
                    $data_db_detail['value_parameter'] = $_POST['value_parameter'][$i];
                    $data_db_detail['label_parameter'] = $_POST['label_parameter'][$i];
                    $data_db_detail['sequence'] = isset($_POST['sequence'][$i]) ? strval($_POST['sequence'][$i]):'';
                    $data_db_detail['id_group'] = $id_group;

                    if(empty($id_parameter)){
                        $this->db->table('parameter_detail')->insert($data_db_detail);
                    } else {
                            $this->db->table('parameter_detail')->update($data_db_detail, ['id_parameter' => $id_parameter]);
                    }
                    array_push($listDetailForm,"'".$data_db_detail['value_parameter']."'");
                }
                
                if(count($listDetailForm) > 0){
                    $implodeListDetailForm = implode(" , ",$listDetailForm);
                    $sqlDelete = "DELETE FROM parameter_detail WHERE id_group = '$id_group'  AND value_parameter NOT IN ($implodeListDetailForm)";
                    $delete = $this->db->query($sqlDelete);
                }

                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false;
                // }
			} else {
				$result['status']='error';
				$result['message']='Proses gagal mohon ulangi kembali !';
			    $result['dismiss']=true;
        }
		}

		return $result;

	}

    public function deleteData($id) 
	{
        $result = [];

		if(empty($id)){
			$result['status']='error';
			$result['message']='Kode Tidak Ditemukan, Mohon Periksa Kembali !';
			$result['dismiss']=true;
		} else {

			$sqlDeleteDetail = "delete from parameter_detail where id_group = $id";
            $deleteDetail = $this->db->query($sqlDeleteDetail);

			if($deleteDetail){

                $sqlDeleteGroup = "delete from parameter_group where id_group = $id";
                $deleteGroup = $this->db->query($sqlDeleteGroup);

                if($deleteGroup){
                    $result['status']='ok';
                    $result['message']='Data Berhasil DiHapus';
                    $result['dismiss']=true;
                } else {
                    $result['status']='error';
                    $result['message']='Proses Hapus Group Gagal !';
                    $result['dismiss']=true;
                }
			} else {
				$result['status']='error';
				$result['message']='Proses Hapus Detail Gagal !';
			    $result['dismiss']=true;
            }
		}

		return $result;

	}

}
?>
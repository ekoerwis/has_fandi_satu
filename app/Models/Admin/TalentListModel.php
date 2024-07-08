<?php

namespace App\Models\Admin;
// use CodeIgniter\Database\RawSql;

class TalentListModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql(){
        $mainSQL = "SELECT x.* FROM (  SELECT a.*, c.jumlah_data datadiri, b.jumlah_data databaju_tambahan, d.jumlah_data riwayat_pendidikan , e.jumlah_data riwayat_pekerjaan
        , f.jumlah_data data_keluarga
        , g.jumlah_data skill_bahasa 
        , h.jumlah_data skill_sertifikat
        , i.jumlah_data pengalaman_praktis
        , j.jumlah_data file_upload
        , k.nama_file_new fotopribadi 
        , l.sex sex , l.label_parameter sex_label FROM (
        SELECT a.id_user, a.email, a.username, a.nama, a.created, a.verified, a.phone FROM user a WHERE a.id_role=12) a
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM databaju_tambahan GROUP BY id_user ) b
        ON a.id_user = b.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM datadiri GROUP BY id_user ) c
        ON a.id_user = c.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM riwayat_pendidikan GROUP BY id_user ) d
        ON a.id_user = d.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM riwayat_pekerjaan GROUP BY id_user ) e
        ON a.id_user = e.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM data_keluarga GROUP BY id_user ) f
        ON a.id_user = f.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM skill_bahasa GROUP BY id_user ) g
        ON a.id_user = g.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM skill_sertifikat GROUP BY id_user ) h
        ON a.id_user = h.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM pengalaman_praktis GROUP BY id_user ) i
        ON a.id_user = i.id_user
        LEFT JOIN
        (SELECT id_user, COUNT(*) jumlah_data FROM file_upload GROUP BY id_user ) j
        ON a.id_user = j.id_user
        LEFT JOIN
        (SELECT * FROM file_upload WHERE jenis_dokumen=1 ) K
        ON a.id_user = k.id_user
        LEFT JOIN
        (SELECT datadiri.id_user , datadiri.sex, sexdata.label_parameter 
		  FROM datadiri LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=7) sexdata ON  datadiri.sex = sexdata.value_parameter ) l
        ON a.id_user = l.id_user
        ) x
        ";

        return $mainSQL;
    }

    public function getSubSql(){
        $subSQL = "SELECT * FROM parameter_group";

        return $subSQL;
    }

	public function getDataTable($limit, $start, $order, $dir, $search = null) 
	{

        $result = [];
        $sql = $this->getMainSql();

        $countMainSQL = count($this->db->query($sql)->getResultArray());
        
        if ($search) {
            $sql .= " WHERE username LIKE '%$search%' OR email LIKE '%$search%' OR id_user LIKE '%$search%' OR nama LIKE '%$search%'";
        }

        $countFilterSQL = count($this->db->query($sql)->getResultArray());

        $sql .= " ORDER BY $order $dir LIMIT $start, $limit";

        $dataFull = array();
        
        $dataSql = $this->db->query($sql)->getResultArray();

        // foreach($dataSql as $data){
		// 	$dataDetail['dataDetail'] = $this->getDetail($data['id_group'],'id_group');
		// 	$data = array_merge($data, $dataDetail);
		// 	array_push($dataFull, $data);
        // }

        $result['recordsTotal']=$countMainSQL;
        $result['recordsFiltered']=$countFilterSQL;
        $result['data']=$dataSql;
        // $result['data']=$dataFull;

        return $result;

	}

    // public function getDetail($id = '', $column='id_parameter')
	// {
	// 	$sql = "select * from parameter_detail where $column = '$id' order by sequence , value_parameter asc";

	// 	$result = array();

	// 	$result = $this->db->query($sql)->getResultArray();

	// 	return $result;
	// }

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
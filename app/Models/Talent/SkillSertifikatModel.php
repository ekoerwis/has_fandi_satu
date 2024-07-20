<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class SkillSertifikatModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}

	public function getMainSql($id='',$column='id_user'){
        $mainSQL = "SELECT * FROM skill_sertifikat where $column = '$id'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from skill_sertifikat where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function getResultFullLabel($id='',$column='id_user'){

        // $sql = "select * from skill_sertifikat where $column = '$id'";
        $sql = "SELECT a.id, a.id_user, a.kategori, kategori.label_parameter kategori_label,kategori.sequence kategori_sequence,a.no_sertifikat, 
        a.bulan_terbit, bulan_terbit.label_parameter bulan_terbit_label,
        a.tahun_terbit, a.penerbit, a.keterangan
        FROM (select * from skill_sertifikat where $column = '$id') a
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=30) bulan_terbit
        ON a.bulan_terbit = bulan_terbit.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=37) kategori
        ON a.kategori = kategori.value_parameter
        ORDER BY  a.id,kategori.sequence , a.tahun_terbit, a.bulan_terbit";

        $result = $this->db->query($sql)->getResultArray();

        return $result;
    }

	public function getDataSqlByKodeBahasa($id='',$column='id_user', $kode_bahasa = 0){
        $mainSQL = "SELECT * FROM skill_sertifikat where $column = '$id' and kode_bahasa = '$kode_bahasa' order by id";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function saveData($id_user='') 
	{
        $result = [];

        $listDetailForm=array();
		$implodeListDetailForm = "";

		$data_db['id_user'] = $id_user;
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;

        if(!empty($id_user)){

            // anak
            if(isset($_POST['kategori']) )
            {
                if($_POST['no_sertifikat'][0] != ''){
                    for($i=0 ; $i < count($this->request->getPost('no_sertifikat')) ; $i++ ){

                        $id=isset($_POST['id'][$i])?intval($_POST['id'][$i]):0;
                        $data_db['kategori']=isset($_POST['kategori'][$i])?strval($_POST['kategori'][$i]):'';
                        $data_db['no_sertifikat']=isset($_POST['no_sertifikat'][$i])?strval($_POST['no_sertifikat'][$i]):'';
                        $data_db['bulan_terbit']=isset($_POST['bulan_terbit'][$i])?strval($_POST['bulan_terbit'][$i]):'';
                        $data_db['tahun_terbit']=isset($_POST['tahun_terbit'][$i])?strval($_POST['tahun_terbit'][$i]):'';
                        $data_db['keterangan']=isset($_POST['keterangan'][$i])?strval($_POST['keterangan'][$i]):'';

                        if(empty($this->getRowMainSql($id,'id'))){
                            $save = $this->db->table('skill_sertifikat')->insert($data_db);
                            if($save){

                                $sqlSearchSave = "select * from skill_sertifikat where id_user = '$id_user' 
                                and kategori = '".$data_db['kategori']."'
                                and no_sertifikat = '".$data_db['no_sertifikat']."'
                                and bulan_terbit = '".$data_db['bulan_terbit']."'
                                and tahun_terbit = '".$data_db['tahun_terbit']."'
                                and keterangan = '".$data_db['keterangan']."'";

                                $dataHasSave = $this->db->query($sqlSearchSave)->getRowArray();

                                array_push($listDetailForm,"'".$dataHasSave['id']."'");

                                $result['status']='ok';
                                $result['message']='Data Berhasil Ditambah';
                                $result['dismiss']=false;
                            } 
                        } else {
                            $update = $this->db->table('skill_sertifikat')->update($data_db, ['id' => $id]);
                            if($update){
                                $result['status']='ok';
                                $result['message']='Data Berhasil Diubah';
                                $result['dismiss']=false;
                            } 
                            array_push($listDetailForm,"'".$id."'");
                        }
                        
                    }
                        
                    if(count($listDetailForm) > 0){
                        $implodelistDetailForm = implode(" , ",$listDetailForm);
                        $sqlDelete = "DELETE FROM skill_sertifikat WHERE id_user = '$id_user'  AND id NOT IN ($implodelistDetailForm)";
                        $delete = $this->db->query($sqlDelete);
                    }

                } else {
                    $result['status']='warning';
                    $result['message']='No sertifikat Tidak Boleh Kosong';
                    $result['dismiss']=true;
                }
                    
            } else {
                $sqlDelete = "DELETE FROM skill_sertifikat WHERE id_user = '$id_user'";
                $delete = $this->db->query($sqlDelete);
                
                $result['status']='ok';
                $result['message']='Data Berhasil Dihapus';
                $result['dismiss']=true;
            }


        } else {
            $result['status']='error';
            $result['message']='Proses gagal, Tidak Ada Data yang disimpan !';
            $result['dismiss']=true;
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
<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class SkillBahasaModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}

	public function getMainSql($id='',$column='id_user'){
        $mainSQL = "SELECT * FROM skill_bahasa where $column = '$id'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from skill_bahasa where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function getResultFullLabel($id='',$column='id_user'){

        // $sql = "select * from skill_bahasa where $column = '$id'";
        $sql = "SELECT a.id, a.id_user, a.kode_bahasa, kode_bahasa.label_parameter kode_bahasa_label,kode_bahasa.sequence kode_bahasa_sequence,
        a.ket_bahasa, a.level, a.jenis_sertifikat,
        case 
        when a.kode_bahasa = 1 then jenis_sertifikat_35.label_parameter 
        when a.kode_bahasa = 2 then jenis_sertifikat_36.label_parameter 
        ELSE '' END jenis_sertifikat_label, 
        a.no_sertifikat, 
        a.bulan_terbit, bulan_terbit.label_parameter bulan_terbit_label, a.tahun_terbit, a.penerbit, a.keterangan 
        FROM (select * from skill_bahasa where $column = '$id') a
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=34) kode_bahasa
        ON a.kode_bahasa = kode_bahasa.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=30) bulan_terbit
        ON a.bulan_terbit = bulan_terbit.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=35) jenis_sertifikat_35
        ON a.jenis_sertifikat = jenis_sertifikat_35.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=36) jenis_sertifikat_36
        ON a.jenis_sertifikat = jenis_sertifikat_36.value_parameter
        ORDER BY kode_bahasa.sequence , a.id, a.tahun_terbit, a.bulan_terbit";

        $result = $this->db->query($sql)->getResultArray();

        return $result;
    }

	public function getDataSqlByKodeBahasa($id='',$column='id_user', $kode_bahasa = 0){
        $mainSQL = "SELECT * FROM skill_bahasa where $column = '$id' and kode_bahasa = '$kode_bahasa' order by id";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function saveData($id_user='') 
	{
        $result = [];

        $listDetailForm_lain=array();
		$implodeListDetailForm_lain = "";

		$data_db['id_user'] = $id_user;
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;

        if(!empty($id_user)){

            // jepang
            $id=isset($_POST['id_jepang'])?intval($_POST['id_jepang']):0;
            $data_db['kode_bahasa']=1;
            $data_db['ket_bahasa']='';
            $data_db['level']='';
            $data_db['jenis_sertifikat']=isset($_POST['jenis_sertifikat_jepang'])?strval($_POST['jenis_sertifikat_jepang']):'';
            $data_db['no_sertifikat']='';
            $data_db['bulan_terbit']=isset($_POST['bulan_terbit_jepang'])?strval($_POST['bulan_terbit_jepang']):'';
            $data_db['tahun_terbit']=isset($_POST['tahun_terbit_jepang'])?strval($_POST['tahun_terbit_jepang']):'';
            $data_db['penerbit']='';
            $data_db['keterangan']='';

            if($data_db['jenis_sertifikat'] ==''){
                $sqlDelete = "DELETE FROM skill_bahasa WHERE id_user = '$id_user'  AND kode_bahasa='1'  ";
                $delete = $this->db->query($sqlDelete);
                
                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false;
            } else{
                if(empty($this->getRowMainSql($id,'id'))){
                    $save = $this->db->table('skill_bahasa')->insert($data_db);
                    $result['status']='ok';
                    $result['message']='Data Berhasil Ditambah';
                    $result['dismiss']=false;
                } else {
                    $update = $this->db->table('skill_bahasa')->update($data_db, ['id' => $id]);
                    $result['status']='ok';
                    $result['message']='Data Berhasil Diubah';
                    $result['dismiss']=false;
                }

            }

            // inggris
            $id=isset($_POST['id_inggris'])?intval($_POST['id_inggris']):0;
            $data_db['kode_bahasa']=2;
            $data_db['ket_bahasa']='';
            $data_db['level']=isset($_POST['level_inggris'])?strval($_POST['level_inggris']):'';
            $data_db['jenis_sertifikat']=isset($_POST['jenis_sertifikat_inggris'])?strval($_POST['jenis_sertifikat_inggris']):'';
            $data_db['no_sertifikat']='';
            $data_db['bulan_terbit']=isset($_POST['bulan_terbit_inggris'])?strval($_POST['bulan_terbit_inggris']):'';
            $data_db['tahun_terbit']=isset($_POST['tahun_terbit_inggris'])?strval($_POST['tahun_terbit_inggris']):'';
            $data_db['penerbit']='';
            $data_db['keterangan']='';

            if($data_db['jenis_sertifikat'] ==''){
                $sqlDelete = "DELETE FROM skill_bahasa WHERE id_user = '$id_user'  AND kode_bahasa='2'  ";
                $delete = $this->db->query($sqlDelete);
                
                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false;
            } else{
                if(empty($this->getRowMainSql($id,'id'))){
                    $save = $this->db->table('skill_bahasa')->insert($data_db);

                    $result['status']='ok';
                    $result['message']='Data Berhasil Ditambah';
                    $result['dismiss']=false;
                    
                } else {
                    $update = $this->db->table('skill_bahasa')->update($data_db, ['id' => $id]);
                    $result['status']='ok';
                    $result['message']='Data Berhasil Diubah';
                    $result['dismiss']=false; 
                }
            }


            // anak
            if(isset($_POST['ket_bahasa_lain'])  )
            {
                if($_POST['ket_bahasa_lain'][0] != ''){
                    for($i=0 ; $i < count($this->request->getPost('ket_bahasa_lain')) ; $i++ ){

                        $id=isset($_POST['id_lain'][$i])?intval($_POST['id_lain'][$i]):0;
                        $data_db['kode_bahasa']=99;
                        $data_db['ket_bahasa']=isset($_POST['ket_bahasa_lain'][$i])?strval($_POST['ket_bahasa_lain'][$i]):'';
                        $data_db['level']=isset($_POST['level_lain'][$i])?strval($_POST['level_lain'][$i]):'';
                        $data_db['jenis_sertifikat']='';
                        $data_db['no_sertifikat']=isset($_POST['no_sertifikat_lain'][$i])?strval($_POST['no_sertifikat_lain'][$i]):'';
                        $data_db['bulan_terbit']=isset($_POST['bulan_terbit_lain'][$i])?strval($_POST['bulan_terbit_lain'][$i]):'';
                        $data_db['tahun_terbit']=isset($_POST['tahun_terbit_lain'][$i])?strval($_POST['tahun_terbit_lain'][$i]):'';
                        $data_db['penerbit']='';
                        $data_db['keterangan']=isset($_POST['keterangan_lain'][$i])?strval($_POST['keterangan_lain'][$i]):'';

                        if(empty($this->getRowMainSql($id,'id'))){
                            $save = $this->db->table('skill_bahasa')->insert($data_db);
                            if($save){

                                $sqlSearchSave = "select * from skill_bahasa where id_user = '$id_user' 
                                and kode_bahasa = '".$data_db['kode_bahasa']."'
                                and ket_bahasa = '".$data_db['ket_bahasa']."'
                                and level = '".$data_db['level']."'
                                and jenis_sertifikat = '".$data_db['jenis_sertifikat']."'
                                and no_sertifikat = '".$data_db['no_sertifikat']."'
                                and bulan_terbit = '".$data_db['bulan_terbit']."'
                                and tahun_terbit = '".$data_db['tahun_terbit']."'
                                and penerbit = '".$data_db['penerbit']."'
                                and keterangan = '".$data_db['keterangan']."'";

                                $dataHasSave = $this->db->query($sqlSearchSave)->getRowArray();

                                array_push($listDetailForm_lain,"'".$dataHasSave['id']."'");

                                $result['status']='ok';
                                $result['message']='Data Berhasil Ditambah';
                                $result['dismiss']=false;
                            } 
                        } else {
                            $update = $this->db->table('skill_bahasa')->update($data_db, ['id' => $id]);
                            if($update){
                                $result['status']='ok';
                                $result['message']='Data Berhasil Diubah';
                                $result['dismiss']=false;
                            } 
                            array_push($listDetailForm_lain,"'".$id."'");
                        }
                        
                    }
                        
                    if(count($listDetailForm_lain) > 0){
                        $implodelistDetailForm_lain = implode(" , ",$listDetailForm_lain);
                        $sqlDelete = "DELETE FROM skill_bahasa WHERE id_user = '$id_user'  AND kode_bahasa='99'  AND id NOT IN ($implodelistDetailForm_lain)";
                        $delete = $this->db->query($sqlDelete);
                    }

                }

            } else {
                $sqlDelete = "DELETE FROM skill_bahasa WHERE id_user = '$id_user'  AND kode_bahasa='99'";
                $delete = $this->db->query($sqlDelete);

                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false;
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
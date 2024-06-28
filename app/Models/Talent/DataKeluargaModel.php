<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class DataKeluargaModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}

	public function getMainSql($id='',$column='id_user'){
        $mainSQL = "SELECT * FROM data_keluarga where $column = '$id'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from data_keluarga where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

	public function getDataSqlByTipeKeluarga($id='',$column='id_user', $tipe_keluarga = 0){
        $mainSQL = "SELECT * FROM data_keluarga where $column = '$id' and tipe_keluarga = '$tipe_keluarga'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function saveData($id_user='') 
	{
        $result = [];

        $listDetailForm_anak=array();
		$implodeListDetailForm_anak = "";

        $listDetailForm_saudara=array();
		$implodeListDetailForm_saudara = "";

		$data_db['id_user'] = $id_user;
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;

        if(isset($_POST['tanggal_lahir_ayah']) and isset($_POST['tanggal_lahir_ibu'])){
            
            // $data_db['tipe_keluarga']=[];
            // $data_db['jenis_kelamin']=[];
            // $data_db['pendidikan']=[];
            // $data_db['profesi']=[];
            // $data_db['tanggal_lahir']=[];

            // ayah
            $id=isset($_POST['id_ayah'])?intval($_POST['id_ayah']):0;
            $data_db['tipe_keluarga']=1;
            $data_db['jenis_kelamin']='';
            $data_db['pendidikan']='';
            $data_db['profesi']=isset($_POST['profesi_ayah'])?strval($_POST['profesi_ayah']):'';
            
            $exp = explode('-', $_POST['tanggal_lahir_ayah']);
            $tgl_lahir = $exp[2].'-'.$exp[1].'-'.$exp[0];
            $data_db['tanggal_lahir'] = isset($_POST['tanggal_lahir_ayah'])? $tgl_lahir :'';

            if(empty($this->getRowMainSql($id,'id'))){
                $save = $this->db->table('data_keluarga')->insert($data_db);
            } else {
                $update = $this->db->table('data_keluarga')->update($data_db, ['id' => $id]);
            }

            // ibu
            $id=isset($_POST['id_ibu'])?intval($_POST['id_ibu']):0;
            $data_db['tipe_keluarga']=2;
            $data_db['jenis_kelamin']='';
            $data_db['pendidikan']='';
            $data_db['profesi']=isset($_POST['profesi_ibu'])?strval($_POST['profesi_ibu']):'';
            
            $exp = explode('-', $_POST['tanggal_lahir_ibu']);
            $tgl_lahir = $exp[2].'-'.$exp[1].'-'.$exp[0];
            $data_db['tanggal_lahir'] = isset($_POST['tanggal_lahir_ibu'])? $tgl_lahir :'';

            if(empty($this->getRowMainSql($id,'id'))){
                $save = $this->db->table('data_keluarga')->insert($data_db);

                $result['status']='ok';
                $result['message']='Data Berhasil Ditambah';
                $result['dismiss']=false;
                
            } else {
                $update = $this->db->table('data_keluarga')->update($data_db, ['id' => $id]);
                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false; 
            }

            // pasangan
            $id=isset($_POST['id_pasangan'])?intval($_POST['id_pasangan']):0;
            $data_db['tipe_keluarga']=3;
            $data_db['jenis_kelamin']='';
            $data_db['pendidikan']='';
            $data_db['profesi']=isset($_POST['profesi_pasangan'])?strval($_POST['profesi_pasangan']):'';
            
            $exp = explode('-', $_POST['tanggal_lahir_pasangan']);
            $tgl_lahir = $exp[2].'-'.$exp[1].'-'.$exp[0];
            $data_db['tanggal_lahir'] = isset($_POST['tanggal_lahir_pasangan'])? $tgl_lahir :'';

            if(empty($this->getRowMainSql($id,'id'))){
                $save = $this->db->table('data_keluarga')->insert($data_db);

                $result['status']='ok';
                $result['message']='Data Berhasil Ditambah';
                $result['dismiss']=false;
            } else {
                $update = $this->db->table('data_keluarga')->update($data_db, ['id' => $id]);
                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false;
            }


            // anak
            if(isset($_POST['tanggal_lahir_anak']) )
                if($_POST['tanggal_lahir_anak'] != '')
                    for($i=0 ; $i < count($this->request->getPost('tanggal_lahir_anak')) ; $i++ ){
                        $id=isset($_POST['id_anak'][$i])?intval($_POST['id_anak'][$i]):0;
                        $data_db['tipe_keluarga']=4;
                        $data_db['jenis_kelamin']=isset($_POST['jenis_kelamin_anak'][$i])?strval($_POST['jenis_kelamin_anak'][$i]):'';
                        $data_db['profesi']='';
                        $data_db['pendidikan']=isset($_POST['pendidikan_anak'][$i])?strval($_POST['pendidikan_anak'][$i]):'';
                        
                        $exp = explode('-', $_POST['tanggal_lahir_anak'][$i]);
                        $tgl_lahir = $exp[2].'-'.$exp[1].'-'.$exp[0];
                        $data_db['tanggal_lahir'] = isset($_POST['tanggal_lahir_anak'][$i])? $tgl_lahir :'';

                        if(empty($this->getRowMainSql($id,'id'))){
                            $save = $this->db->table('data_keluarga')->insert($data_db);
                            if($save){

                                $sqlSearchSave = "select * from data_keluarga where tipe_keluarga = '".$data_db['tipe_keluarga']."'
                                and jenis_kelamin = '".$data_db['jenis_kelamin']."'
                                and pendidikan = '".$data_db['pendidikan']."'
                                and profesi = '".$data_db['profesi']."'
                                and tanggal_lahir = '".$data_db['tanggal_lahir']."'";

                                $dataHasSave = $this->db->query($sqlSearchSave)->getRowArray();

                                array_push($listDetailForm_anak,"'".$dataHasSave['id']."'");

                                $result['status']='ok';
                                $result['message']='Data Berhasil Ditambah';
                                $result['dismiss']=false;
                            } 
                        } else {
                            $update = $this->db->table('riwayat_pekerjaan')->update($data_db, ['id' => $id]);
                            if($update){
                                $result['status']='ok';
                                $result['message']='Data Berhasil Diubah';
                                $result['dismiss']=false;
                            } 
                            array_push($listDetailForm_anak,"'".$id."'");
                        }
                        
                    }
                        
                    if(count($listDetailForm_anak) > 0){
                        $implodeListDetailForm_anak = implode(" , ",$listDetailForm_anak);
                        $sqlDelete = "DELETE FROM data_keluarga WHERE id_user = '$id_user'  AND tipe_keluarga='4'  AND id NOT IN ($implodeListDetailForm_anak)";
                        $delete = $this->db->query($sqlDelete);
                    }

            // anak
            if(isset($_POST['tanggal_lahir_saudara']) )
                if($_POST['tanggal_lahir_saudara'] != '')
                    for($i=0 ; $i < count($this->request->getPost('tanggal_lahir_saudara')) ; $i++ ){
                        $id=isset($_POST['id_saudara'][$i])?intval($_POST['id_saudara'][$i]):0;
                        $data_db['tipe_keluarga']=5;
                        $data_db['jenis_kelamin']=isset($_POST['jenis_kelamin_saudara'][$i])?strval($_POST['jenis_kelamin_saudara'][$i]):'';
                        $data_db['profesi']=isset($_POST['profesi_saudara'][$i])?strval($_POST['profesi_saudara'][$i]):'';
                        $data_db['pendidikan']='';
                        
                        $exp = explode('-', $_POST['tanggal_lahir_saudara'][$i]);
                        $tgl_lahir = $exp[2].'-'.$exp[1].'-'.$exp[0];
                        $data_db['tanggal_lahir'] = isset($_POST['tanggal_lahir_saudara'])? $tgl_lahir :'';

                        if(empty($this->getRowMainSql($id,'id'))){
                            $save = $this->db->table('data_keluarga')->insert($data_db);
                            if($save){

                                $sqlSearchSave = "select * from data_keluarga where tipe_keluarga = '".$data_db['tipe_keluarga']."'
                                and jenis_kelamin = '".$data_db['jenis_kelamin']."'
                                and pendidikan = '".$data_db['pendidikan']."'
                                and profesi = '".$data_db['profesi']."'
                                and tanggal_lahir = '".$data_db['tanggal_lahir']."'";

                                $dataHasSave = $this->db->query($sqlSearchSave)->getRowArray();

                                array_push($listDetailForm_saudara,"'".$dataHasSave['id']."'");

                                $result['status']='ok';
                                $result['message']='Data Berhasil Ditambah';
                                $result['dismiss']=false;
                            } 
                        } else {
                            $update = $this->db->table('riwayat_pekerjaan')->update($data_db, ['id' => $id]);
                            if($update){
                                $result['status']='ok';
                                $result['message']='Data Berhasil Diubah';
                                $result['dismiss']=false;
                            } 
                            array_push($listDetailForm_saudara,"'".$id."'");
                        }
                        
                    }
                        
                    if(count($listDetailForm_saudara) > 0){
                        $implodeListDetailForm_saudara = implode(" , ",$listDetailForm_saudara);
                        $sqlDelete = "DELETE FROM data_keluarga WHERE id_user = '$id_user'  AND tipe_keluarga='5' AND id NOT IN ($implodeListDetailForm_saudara)";
                        $delete = $this->db->query($sqlDelete);
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
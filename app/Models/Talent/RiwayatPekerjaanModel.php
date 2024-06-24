<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class RiwayatPekerjaanModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql($id='',$column='id_user'){
        $mainSQL = "SELECT * FROM riwayat_pekerjaan where $column = '$id'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from riwayat_pekerjaan where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

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

        if(count($this->request->getPost('tipe_pekerjaan'))>0){

            for($i=0 ; $i < count($this->request->getPost('tipe_pekerjaan')) ; $i++ ){
                $id=isset($_POST['id'][$i])?intval($_POST['id'][$i]):0;
                $data_db['tipe_pekerjaan'] = isset($_POST['tipe_pekerjaan'][$i])?strval($_POST['tipe_pekerjaan'][$i]):'';
                $data_db['lokasi_pekerjaan'] = isset($_POST['lokasi_pekerjaan'][$i])?strval($_POST['lokasi_pekerjaan'][$i]):'';
                $data_db['nama_perusahaan'] = isset($_POST['nama_perusahaan'][$i])?strval($_POST['nama_perusahaan'][$i]):'';
                $data_db['nama_kota'] = isset($_POST['nama_kota'][$i]) ?strval($_POST['nama_kota'][$i]):'';
                $data_db['bidang_pekerjaan'] = isset($_POST['bidang_pekerjaan'][$i]) ?strval($_POST['bidang_pekerjaan'][$i]):'';
                $data_db['bulan_masuk'] = isset($_POST['bulan_masuk'][$i])?strval($_POST['bulan_masuk'][$i]):'';
                $data_db['tahun_masuk'] = isset($_POST['tahun_masuk'][$i])?strval($_POST['tahun_masuk'][$i]):'';
                $data_db['bulan_keluar'] = isset($_POST['bulan_keluar'][$i])?strval($_POST['bulan_keluar'][$i]):'';
                $data_db['tahun_keluar'] = isset($_POST['tahun_keluar'][$i])?strval($_POST['tahun_keluar'][$i]):'';

                if(empty($this->getRowMainSql($id,'id'))){
                    $save = $this->db->table('riwayat_pekerjaan')->insert($data_db);
                    if($save){

                        $sqlSearchSave = "select * from riwayat_pekerjaan where tipe_pekerjaan = '".$data_db['tipe_pekerjaan']."'
                        and lokasi_pekerjaan = '".$data_db['lokasi_pekerjaan']."'
                        and nama_perusahaan = '".$data_db['nama_perusahaan']."'
                        and nama_kota = '".$data_db['nama_kota']."'
                        and bidang_pekerjaan = '".$data_db['bidang_pekerjaan']."'
                        and bulan_masuk = '".$data_db['bulan_masuk']."'
                        and tahun_masuk = '".$data_db['tahun_masuk']."'
                        and bulan_keluar = '".$data_db['bulan_keluar']."'
                        and tahun_keluar = '".$data_db['tahun_keluar']."'";

                        $dataHasSave = $this->db->query($sqlSearchSave)->getRowArray();

                        array_push($listDetailForm,"'".$dataHasSave['id']."'");

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
                    array_push($listDetailForm,"'".$id."'");
                }
                
            }
            
                
            if(count($listDetailForm) > 0){
                $implodeListDetailForm = implode(" , ",$listDetailForm);
                $sqlDelete = "DELETE FROM riwayat_pekerjaan WHERE id_user = '$id_user'  AND id NOT IN ($implodeListDetailForm)";
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
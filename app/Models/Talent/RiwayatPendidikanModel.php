<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class RiwayatPendidikanModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql($id='',$column='id_user'){
        $mainSQL = "SELECT * FROM riwayat_pendidikan where $column = '$id'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from riwayat_pendidikan where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function saveData($id_user='') 
	{
        $result = [];

		$data_db['id_user'] = $id_user;
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;

        if(count($this->request->getPost('jenjang'))>0){

            for($i=0 ; $i < count($this->request->getPost('jenjang')) ; $i++ ){

                $id=isset($_POST['id'][$i])?intval($_POST['id'][$i]):0;
                $data_db['jenjang'] = isset($_POST['jenjang'][$i])?strval($_POST['jenjang'][$i]):'';
                $data_db['nama_instansi'] = isset($_POST['nama_instansi'][$i])?strval($_POST['nama_instansi'][$i]):'';
                $data_db['jurusan'] = isset($_POST['jurusan'][$i])?strval($_POST['jurusan'][$i]):'';
                $data_db['bulan_masuk'] = isset($_POST['bulan_masuk'][$i])?strval($_POST['bulan_masuk'][$i]):'';
                $data_db['tahun_masuk'] = isset($_POST['tahun_masuk'][$i])?strval($_POST['tahun_masuk'][$i]):'';
                $data_db['bulan_lulus'] = isset($_POST['bulan_lulus'][$i])?strval($_POST['bulan_lulus'][$i]):'';
                $data_db['tahun_lulus'] = isset($_POST['tahun_lulus'][$i])?strval($_POST['tahun_lulus'][$i]):'';

                if(empty($this->getRowMainSql($id,'id'))){
                    $save = $this->db->table('riwayat_pendidikan')->insert($data_db);
                    if($save){
                        $result['status']='ok';
                        $result['message']='Data Berhasil Ditambah';
                        $result['dismiss']=false;
                    } 
                } else {
                    $update = $this->db->table('riwayat_pendidikan')->update($data_db, ['id' => $id]);
                    if($update){
                        $result['status']='ok';
                        $result['message']='Data Berhasil Diubah';
                        $result['dismiss']=false;
                    } 
        
                }
                
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
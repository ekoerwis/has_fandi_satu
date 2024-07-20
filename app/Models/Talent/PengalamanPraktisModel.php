<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class PengalamanPraktisModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}

	public function getMainSql($id='',$column='id_user'){
        $mainSQL = "SELECT * FROM pengalaman_praktis where $column = '$id'";

        $result = $this->db->query($mainSQL)->getResultArray();

        return $result;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from pengalaman_praktis where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function getResultFullLabel($id='',$column='id_user'){

        // $sql = "select * from pengalaman_praktis where $column = '$id'";
        $sql = "SELECT a.id, a.id_user, a.jenis_pengalaman, 
        jenis_pengalaman.label_parameter jenis_pengalaman_label,jenis_pengalaman.sequence jenis_pengalaman_sequence,
       a.nama_pengalaman, a.detail_pengalaman,
       a.bulan_awal, bulan_awal.label_parameter bulan_awal_label,
       a.tahun_awal, 
       a.bulan_akhir, bulan_akhir.label_parameter bulan_akhir_label,
       a.tahun_akhir, a.keterangan
       FROM (select * from pengalaman_praktis where $column = '$id') a
       LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=30) bulan_awal
       ON a.bulan_awal = bulan_awal.value_parameter
       LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=30) bulan_akhir
       ON a.bulan_akhir = bulan_akhir.value_parameter
       LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=38) jenis_pengalaman
       ON a.jenis_pengalaman = jenis_pengalaman.value_parameter
       ORDER BY a.id, jenis_pengalaman.sequence , a.tahun_awal, a.bulan_awal";

        $result = $this->db->query($sql)->getResultArray();

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

            if(isset($_POST['jenis_pengalaman']) )
            {
                if($_POST['jenis_pengalaman'][0] != ''){
                    for($i=0 ; $i < count($this->request->getPost('jenis_pengalaman')) ; $i++ ){

                        $id=isset($_POST['id'][$i])?intval($_POST['id'][$i]):0;
                        $data_db['jenis_pengalaman']=isset($_POST['jenis_pengalaman'][$i])?strval($_POST['jenis_pengalaman'][$i]):'';
                        $data_db['nama_pengalaman']=isset($_POST['nama_pengalaman'][$i])?strval($_POST['nama_pengalaman'][$i]):'';
                        $data_db['bulan_awal']=isset($_POST['bulan_awal'][$i])?strval($_POST['bulan_awal'][$i]):'';
                        $data_db['tahun_awal']=isset($_POST['tahun_awal'][$i])?strval($_POST['tahun_awal'][$i]):'';
                        $data_db['bulan_akhir']=isset($_POST['bulan_akhir'][$i])?strval($_POST['bulan_akhir'][$i]):'';
                        $data_db['tahun_akhir']=isset($_POST['tahun_akhir'][$i])?strval($_POST['tahun_akhir'][$i]):'';
                        $data_db['detail_pengalaman']=isset($_POST['detail_pengalaman'][$i])?strval($_POST['detail_pengalaman'][$i]):'';
                        $data_db['keterangan']=isset($_POST['keterangan'][$i])?strval($_POST['keterangan'][$i]):'';

                        if(empty($this->getRowMainSql($id,'id'))){
                            $save = $this->db->table('pengalaman_praktis')->insert($data_db);
                            if($save){

                                $sqlSearchSave = "select * from pengalaman_praktis where id_user = '$id_user' 
                                and jenis_pengalaman = '".$data_db['jenis_pengalaman']."'
                                and nama_pengalaman = '".$data_db['nama_pengalaman']."'
                                and bulan_awal = '".$data_db['bulan_awal']."'
                                and tahun_awal = '".$data_db['tahun_awal']."'
                                and bulan_akhir = '".$data_db['bulan_akhir']."'
                                and tahun_akhir = '".$data_db['tahun_akhir']."'
                                and detail_pengalaman = '".$data_db['detail_pengalaman']."'
                                and keterangan = '".$data_db['keterangan']."'";

                                $dataHasSave = $this->db->query($sqlSearchSave)->getRowArray();

                                array_push($listDetailForm,"'".$dataHasSave['id']."'");

                                $result['status']='ok';
                                $result['message']='Data Berhasil Ditambah';
                                $result['dismiss']=false;
                            } 
                        } else {
                            $update = $this->db->table('pengalaman_praktis')->update($data_db, ['id' => $id]);
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
                        $sqlDelete = "DELETE FROM pengalaman_praktis WHERE id_user = '$id_user'  AND id NOT IN ($implodelistDetailForm)";
                        $delete = $this->db->query($sqlDelete);
                    }

                } else {
                    $result['status']='warning';
                    $result['message']='No sertifikat Tidak Boleh Kosong';
                    $result['dismiss']=true;
                }
                    
            } else {
                $sqlDelete = "DELETE FROM pengalaman_praktis WHERE id_user = '$id_user'";
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
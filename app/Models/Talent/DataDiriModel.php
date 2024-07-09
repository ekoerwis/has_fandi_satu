<?php

namespace App\Models\Talent;
// use CodeIgniter\Database\RawSql;

class DataDiriModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql(){
        $mainSQL = "SELECT * FROM datadiri";

        return $mainSQL;
    }

    public function getRowMainSql($id='',$column='id_user'){

        $sql = "select * from datadiri where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function getRowFullLabel($id='',$column='id_user'){

        $sql = "SELECT A.* FROM (SELECT  a.id,  a.id_user,  a.nama_depan,  a.nama_tengah,  a.nama_belakang,  
        a.nama_panggilan,  a.nama_katakana,  a.tempat_lahir,  a.tanggal_lahir,  a.sex,  
        sex.label_parameter sex_label,
        a.status, 
        status.label_parameter status_label,
         a.kerja_shift,  
        shift.label_parameter kerja_shift_label,
        a.kerja_overtime,  
        overtime.label_parameter kerja_overtime_label,
        a.kerja_offday, 
        offday.label_parameter kerja_offday_label,
        a.kacamata, 
        kacamata.label_parameter kacamata_label,
        a.mata_kiri,  
        mata_kiri.label_parameter mata_kiri_label,
        a.mata_kanan,  
        mata_kanan.label_parameter mata_kanan_label,
        a.tinggi_badan,  a.berat_badan,  
        a.golongan_darah,  
        golongan_darah.label_parameter golongan_darah_label,
        a.tangan_dominan, 
        tangan_dominan.label_parameter tangan_dominan_label, 
        a.agama, 
        agama.label_parameter agama_label, 
        a.kelebihan, a.kekurangan, a.hobi 
        from datadiri a
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=7) sex
        ON a.sex = sex.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=19) status
        ON a.status = status.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=12) shift
        ON a.kerja_shift = shift.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=13) overtime
        ON a.kerja_overtime = overtime.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=14) offday
        ON a.kerja_offday = offday.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=15) kacamata
        ON a.kacamata = kacamata.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=16) mata_kiri
        ON a.mata_kiri = mata_kiri.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=16) mata_kanan
        ON a.mata_kanan = mata_kanan.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=20) golongan_darah
        ON a.golongan_darah = golongan_darah.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=17) tangan_dominan
        ON a.tangan_dominan = tangan_dominan.value_parameter
        LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group=18) agama
        ON a.agama = agama.value_parameter
        ) A  where $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function saveData($id='') 
	{
        $result = [];

		$data_db['id_user'] = $id;
		$data_db['nama_depan'] = isset($_POST['namadepan'])?strval($_POST['namadepan']):'';
		$data_db['nama_tengah'] = isset($_POST['namatengah'])?strval($_POST['namatengah']):'';
		$data_db['nama_belakang'] = isset($_POST['namabelakang'])?strval($_POST['namabelakang']):'';
		$data_db['nama_katakana'] = isset($_POST['nama_katakana'])?strval($_POST['nama_katakana']):'';
		$data_db['nama_panggilan'] = isset($_POST['nama_panggilan'])?strval($_POST['nama_panggilan']):'';
		$data_db['tempat_lahir'] = isset($_POST['tempat_lahir'])?strval($_POST['tempat_lahir']):'';

        $exp = explode('-', $_POST['tanggal_lahir']);
		$tgl_lahir = $exp[2].'-'.$exp[1].'-'.$exp[0];
		$data_db['tanggal_lahir'] = isset($_POST['tanggal_lahir'])? $tgl_lahir :'';
		
        $data_db['sex'] = isset($_POST['sex'])?strval($_POST['sex']):'';
		$data_db['status'] = isset($_POST['status'])?strval($_POST['status']):'';
		$data_db['kerja_shift'] = isset($_POST['kerja_shift'])?strval($_POST['kerja_shift']):'';
		$data_db['kerja_overtime'] = isset($_POST['kerja_overtime'])?strval($_POST['kerja_overtime']):'';
		$data_db['kerja_offday'] = isset($_POST['kerja_offday'])?strval($_POST['kerja_offday']):'';
		$data_db['kacamata'] = isset($_POST['kacamata'])?strval($_POST['kacamata']):'';
		$data_db['mata_kiri'] = isset($_POST['mata_kiri'])?strval($_POST['mata_kiri']):'';
		$data_db['mata_kanan'] = isset($_POST['mata_kanan'])?strval($_POST['mata_kanan']):'';
		$data_db['tinggi_badan'] = isset($_POST['tinggi_badan'])?floatval($_POST['tinggi_badan']):'';
		$data_db['berat_badan'] = isset($_POST['berat_badan'])?floatval($_POST['berat_badan']):'';
		$data_db['golongan_darah'] = isset($_POST['golongan_darah'])?strval($_POST['golongan_darah']):'';
		$data_db['tangan_dominan'] = isset($_POST['tangan_dominan'])?strval($_POST['tangan_dominan']):'';
		$data_db['agama'] = isset($_POST['agama'])?strval($_POST['agama']):'';
		$data_db['kelebihan'] = isset($_POST['kelebihan'])?strval($_POST['kelebihan']):'';
		$data_db['kekurangan'] = isset($_POST['kekurangan'])?strval($_POST['kekurangan']):'';
		$data_db['hobi'] = isset($_POST['hobi'])?strval($_POST['hobi']):'';
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;
        
		if(empty($this->getRowMainSql($id,'id_user'))){
            $save = $this->db->table('datadiri')->insert($data_db);
            if($save){
                $result['status']='ok';
                $result['message']='Data Berhasil Ditambah';
                $result['dismiss']=false;
            } 
		} else {
            $update = $this->db->table('datadiri')->update($data_db, ['id_user' => $id]);
            if($update){
                $result['status']='ok';
                $result['message']='Data Berhasil Diubah';
                $result['dismiss']=false;
            } 

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
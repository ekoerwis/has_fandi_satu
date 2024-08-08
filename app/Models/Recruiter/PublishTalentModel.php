<?php

namespace App\Models\Recruiter;
// use CodeIgniter\Database\RawSql;

class PublishTalentModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql($p_jenis_sertifikat_jepang="", $p_sertifikasi="", $p_pengalaman_praktis=""){

        $paramAdditional =" WHERE id_user <> 0  ";

        if($p_jenis_sertifikat_jepang != ""){
            $paramAdditional .=" AND  sertifikat_jepang_kode = '$p_jenis_sertifikat_jepang' ";
        }
        if($p_sertifikasi != ""){
            $paramAdditional .=" AND  sertifikat_keahlian_kode = '$p_sertifikasi' ";
        }
        if($p_pengalaman_praktis != ""){
            $paramAdditional .=" AND  pengalaman_praktis_kode = '$p_pengalaman_praktis' ";
        }

        $mainSQL = "SELECT y.* from ( SELECT x.* FROM (  
            SELECT user_publish.*, datadiri.nama_depan, datadiri.nama_tengah, datadiri.nama_belakang
            , ifnull(concat(datadiri.nama_depan,' ',datadiri.nama_tengah,' ',datadiri.nama_belakang),'-') nama_lengkap
            , datadiri.tanggal_lahir, ifnull(YEAR(NOW())-YEAR(datadiri.tanggal_lahir),0) umur 
            , ifnull(sertifikat_keahlian.kategori ,'-')  sertifikat_keahlian_kode
            , ifnull(sertifikat_keahlian.sertifikat_keahlian ,'-')  sertifikat_keahlian
            , ifnull(pengalaman_praktis.jenis_pengalaman ,'-') pengalaman_praktis_kode
            , ifnull(pengalaman_praktis.pengalaman_praktis ,'-') pengalaman_praktis
            , ifnull(sertifikat_jepang.jenis_sertifikat ,'-') sertifikat_jepang_kode
            , ifnull(sertifikat_jepang.jenis_sertifikat_bahasa ,'-') sertifikat_jepang
            , foto.nama_file_new foto 
            ,interest.action_time
            , case when interest.action_time IS NULL then 0 ELSE 1 END status_interest
            FROM
            (
            SELECT a.* /*,case when a.publish_expired > NOW() then 1 ELSE 0 END status_publish */ 
            FROM talent_publish a , (SELECT a.id_user,  max(a.publish_time) publish_time FROM talent_publish a GROUP BY a.id_user) b, user c
            WHERE a.id_user = b.id_user AND a.publish_time = b.publish_time AND a.publish_expired > NOW() AND  a.id_user = c.id_user AND c.id_role = 12 AND c.aktif = 1 
            ) user_publish
            LEFT JOIN datadiri 
            ON user_publish.id_user = datadiri.id_user
            LEFT JOIN (
            SELECT a.*, b.label_parameter sertifikat_keahlian FROM
            (
            SELECT  a.id_user, a.kategori,min(a.id) id FROM skill_sertifikat a GROUP BY a.id_user
            ) a ,parameter_detail b
            WHERE a.kategori = b.value_parameter AND b.id_group = 37) sertifikat_keahlian
            ON user_publish.id_user = sertifikat_keahlian.id_user
            LEFT JOIN (
            SELECT a.*, b.label_parameter pengalaman_praktis FROM
            (
            SELECT  a.id_user, a.jenis_pengalaman,min(a.id) id FROM pengalaman_praktis a GROUP BY a.id_user
            ) a ,parameter_detail b
            WHERE a.jenis_pengalaman = b.value_parameter AND b.id_group = 38
            ) pengalaman_praktis
            ON user_publish.id_user = pengalaman_praktis.id_user
            LEFT JOIN (
            SELECT a.*, b.label_parameter jenis_sertifikat_bahasa
            FROM (
            SELECT a.id_user, a.kode_bahasa, a.jenis_sertifikat, min(a.id) id FROM skill_bahasa a WHERE a.kode_bahasa =1 GROUP by a.id_user) a
            LEFT JOIN (SELECT * FROM parameter_detail WHERE id_group = 35) b
            ON a.jenis_sertifikat = b.value_parameter
            ) sertifikat_jepang 
            ON user_publish.id_user = sertifikat_jepang.id_user
            LEFT JOIN
            (SELECT a.id_user, a.jenis_dokumen, a.nama_file_new, min(a.id) id FROM file_upload a WHERE a.jenis_dokumen =1 GROUP by a.id_user) foto
            ON user_publish.id_user = foto.id_user
            LEFT JOIN (
            SELECT id_talent, MAX(action_time) action_time FROM recruiter_talent_interest WHERE id_recruiter = ".$this->session->get('user')['id_user']." GROUP by id_talent) interest
            ON user_publish.id_user = interest.id_talent
        ) x $paramAdditional ) y
        ";

        return $mainSQL;
    }

	public function getDataTalent( $perPage=0, $DataNum=0,  $p_jenis_sertifikat_jepang='',$p_sertifikasi='',$p_pengalaman_praktis='') 
	{

        $result = [];
        $sql = $this->getMainSql($p_jenis_sertifikat_jepang, $p_sertifikasi, $p_pengalaman_praktis);

        $dataSql = $this->db->query($sql)->getResultArray();

        $countDataAll = count($dataSql);

        // $result = $dataSql;

        $sqlPage = "SELECT a.* FROM (
            $sql
        ) a LIMIT $perPage OFFSET $DataNum";
        $dataSqlPage =  $this->db->query($sqlPage)->getResultArray();

        $result['recordsTotal']=$countDataAll;
        // $result['data']=$dataSql;
        $result['data']=$dataSqlPage;

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

    public function getDataPickTalent($id='',$column='id_user'){

        $sql = "select * from user where id_role=12 and $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

    public function actionRecruiterForTalent($recruiter=0, $talent=0) 
	{
        $result = [];

		$data_db['id_recruiter'] = $recruiter;
		$data_db['id_talent'] = $talent;
        $data_db['action_time']=date('Y-m-d H:i:s');

        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;
        
		$save = $this->db->table('recruiter_talent_interest')->insert($data_db);
        if($save){
            $result['status']='ok';
            $result['message']='Data Berhasil Ditambah';
            $result['dismiss']=false;
        } 

		return $result;

	}


}
?>
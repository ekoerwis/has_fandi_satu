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


	public function getMainSql($publish_filter=""){

        $param_publish ="  ";

        if($publish_filter =="1"){
            $param_publish ="  WHERE status_publish = '1' ";
        }

        if($publish_filter =="0"){
            $param_publish ="  WHERE status_publish is null or  status_publish != 1 ";
        }

        $mainSQL = "SELECT y.* from ( SELECT x.* FROM (  
            SELECT user_publish.*, datadiri.nama_depan, datadiri.nama_tengah, datadiri.nama_belakang
            , ifnull(concat(datadiri.nama_depan,' ',datadiri.nama_tengah,' ',datadiri.nama_belakang),'-') nama_lengkap
            , datadiri.tanggal_lahir, ifnull(YEAR(NOW())-YEAR(datadiri.tanggal_lahir),0) umur 
            , ifnull(sertifikat_keahlian.sertifikat_keahlian ,'-')  sertifikat_keahlian
            , ifnull(pengalaman_praktis.pengalaman_praktis ,'-') pengalaman_praktis
            , ifnull(sertifikat_jepang.jenis_sertifikat_bahasa ,'-') sertifikat_jepang
            , foto.nama_file_new foto FROM
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
        ) x $param_publish ) y
        ";
        // tambahan 
        for($x=0 ; $x<10 ;$x++){
            $mainSQL .= "union all SELECT y.* from ( SELECT x.* FROM (  
                SELECT user_publish.*, datadiri.nama_depan, datadiri.nama_tengah, datadiri.nama_belakang
                , ifnull(concat($x,' ',datadiri.nama_tengah,' ',datadiri.nama_belakang),'$x') nama_lengkap
                , datadiri.tanggal_lahir, ifnull(YEAR(NOW())-YEAR(datadiri.tanggal_lahir),0) umur 
                , ifnull(sertifikat_keahlian.sertifikat_keahlian ,'-')  sertifikat_keahlian
                , ifnull(pengalaman_praktis.pengalaman_praktis ,'-') pengalaman_praktis
                , ifnull(sertifikat_jepang.jenis_sertifikat_bahasa ,'-') sertifikat_jepang
                , foto.nama_file_new foto FROM
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
            ) x $param_publish ) y
            ";
        }

        // batas tambahan untuk test

        return $mainSQL;
    }

	public function getDataTalent( $perPage=0, $DataNum=0, $publish_filter="") 
	{

        $result = [];
        $sql = $this->getMainSql($publish_filter);

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


}
?>
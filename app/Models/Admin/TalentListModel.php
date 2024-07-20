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


	public function getMainSql($publish_filter=""){

        $param_publish ="  ";

        if($publish_filter =="1"){
            $param_publish ="  WHERE status_publish = '1' ";
        }

        if($publish_filter =="0"){
            $param_publish ="  WHERE status_publish is null or  status_publish != 1 ";
        }

        $mainSQL = "SELECT y.* from ( SELECT x.* FROM (  SELECT a.*, c.jumlah_data datadiri, b.jumlah_data databaju_tambahan, d.jumlah_data riwayat_pendidikan , e.jumlah_data riwayat_pekerjaan
        , f.jumlah_data data_keluarga
        , g.jumlah_data skill_bahasa 
        , h.jumlah_data skill_sertifikat
        , i.jumlah_data pengalaman_praktis
        , j.jumlah_data file_upload
        , k.nama_file_new fotopribadi 
        , l.sex sex , l.label_parameter sex_label
		  , m.publish_time
		  , m.publish_expired
		  , m.status_publish FROM (
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
        LEFT JOIN
        (SELECT a.*, 
case 
when a.publish_expired > NOW() then 1
ELSE 0 END status_publish FROM talent_publish a , (SELECT a.id_user,  max(a.publish_time) publish_time FROM talent_publish a group by a.id_user) b
WHERE a.id_user = b.id_user AND a.publish_time = b.publish_time) m
ON a.id_user = m.id_user
        ) x $param_publish ) y
        ";

        return $mainSQL;
    }

    public function getSubSql(){
        $subSQL = "SELECT * FROM parameter_group";

        return $subSQL;
    }

    public function getDataTalent($id='',$column='id_user'){

        $sql = "select * from user where id_role=12 and $column = '$id'";

        $result = $this->db->query($sql)->getRowArray();

        return $result;
    }

	public function getDataTable($limit, $start, $order, $dir, $search = null, $publish_filter="") 
	{

        $result = [];
        $sql = $this->getMainSql($publish_filter);

        // echo '<script>console.log("$publish_filter")</script>';

        $countMainSQL = count($this->db->query($sql)->getResultArray());

        $filterPublishScript = "";

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


    public function getPublishTalent($id='',$column='id_user'){

        $sql = "SELECT id, id_user, publish_by, publish_time, publish_expired FROM talent_publish
        where $column = '$id'
        ORDER BY publish_time DESC ";

        $result = $this->db->query($sql)->getResultArray();

        return $result;
    }
    
    public function publishTalent($id='') 
	{
        $result = [];

		$data_db['id_user'] = isset($_POST['id_talent'])?strval($_POST['id_talent']):'';
		$data_db['publish_by'] = $id;
		$data_db['publish_time'] = date('Y-m-d H:i:s');

        
        $exp = explode('-', $_POST['new_expired']);
		$tgl_expired = $exp[2].'-'.$exp[1].'-'.$exp[0]. ' 23:59:59';
		$data_db['publish_expired'] = isset($_POST['new_expired'])? $tgl_expired :'';
        
        $result['status']='error';
        $result['message']='Proses gagal mohon ulangi kembali !';
        $result['dismiss']=true;
        
        $cekData = $this->getPublishTalent($data_db['id_user']);

        if(!empty($cekData[0]['publish_expired']) and $tgl_expired == $cekData[0]['publish_expired']){
            $result['status']='error';
            $result['message']='Tanggal Sudah Sesuai Dengan Data Terakhir !';
            $result['dismiss']=true;
        } else {
            $save = $this->db->table('talent_publish')->insert($data_db);
            if($save){
                $result['status']='ok';
                $result['message']='User Berhasil Publish';
                $result['dismiss']=true;
            } 

        }

		

		return $result;

	}


}
?>
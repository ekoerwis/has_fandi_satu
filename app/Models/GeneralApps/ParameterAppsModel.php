<?php

namespace App\Models\GeneralApps;
// use CodeIgniter\Database\RawSql;

class ParameterAppsModel extends \App\Models\BaseModel
{
	// private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		// $this->fotoPath = 'public/images/foto/';
	}


	public function getMainSql(){
        $mainSQL = "SELECT * FROM mahasiswa";

        return $mainSQL;
    }

	public function getGroupParameter($limit, $start, $order, $dir, $search = null) 
	{

        $result = [];
        $sql = $this->getMainSql();

        $countMainSQL = count($this->db->query($sql)->getResultArray());
        
        if ($search) {
            $sql .= " WHERE nama LIKE '%$search%' OR npm LIKE '%$search%'";
        }

        $countFilterSQL = count($this->db->query($sql)->getResultArray());

        $sql .= " ORDER BY $order $dir LIMIT $start, $limit";

        $dataSql = $this->db->query($sql)->getResultArray();

        $result['recordsTotal']=$countMainSQL;
        $result['recordsFiltered']=$countFilterSQL;
        $result['data']=$dataSql;

        return $result;

	}

}
?>
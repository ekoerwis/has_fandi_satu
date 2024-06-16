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

        $sql = $this->getMainSql();
        
        if ($search) {
            $sql .= " WHERE nama LIKE '%$search%' OR npm LIKE '%$search%'";
        }

        $sql .= " ORDER BY $order $dir LIMIT $start, $limit";

        return $this->db->query($sql)->getResultArray();

	}

    public function getCountGroupParameter() 
	{
        $sql = $this->getMainSql();
        return $this->db->query($sql)->getResultArray();

	}public function getCountGroupParameterFilter($search = null) 
	{
        $sql = $this->getMainSql();
        if ($search) {
            $sql .= " WHERE nama LIKE '%$search%' OR npm LIKE '%$search%'";
        }
        return $this->db->query($sql)->getResultArray();
	}

}
?>
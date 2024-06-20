<?php


namespace App\Models\Builtin;

class LoginModel extends \App\Models\BaseModel
{	
	public function recordLogin() 
	{
		$username = $this->request->getPost('username'); 
		$data_user = $this->db->query('SELECT id_user 
									FROM user
									LEFT JOIN role USING (id_role)
									LEFT JOIN module USING (id_module)
									WHERE username = ?', [$username]
								)
							->getRow();
		// echo '<pre>'; print_r($data_user->id_user); die;		
		$data = array('id_user' => $data_user->id_user
					, 'id_activity' => 1
					, 'time' => date('Y-m-d H:i:s')
				);
		
		//$db      = \Config\Database::connect();		
		//$db->table('user_login_activity')->insert($data);
		$this->db->table('user_login_activity')->insert($data);
	}
	
	
	
	public function checkUserVerified($username) 
	{
		$sql = 'SELECT * FROM user 
				WHERE verified is not null and username = ?';
		
		$query = $this->db->query($sql, [$username]);
		$result = $query->getRowArray();
		
		return $result;		
	}
	/* See base model
	public function checkUser($username) 
	{
		
	} */
}
?>
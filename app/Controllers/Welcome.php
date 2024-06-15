<?php 		
namespace App\Controllers;
use \Config\App;

class Welcome extends \App\Controllers\BaseController
{
	protected $model = '';
	private $nonce;
	
	public function __construct() {	
	
		parent::__construct();
	}
	
	public function index() 
	{
		$this->view('welcome.php', $this->data);
	}
}

<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;

class Home extends Controller {
	
	public function index() {
		
		$this->_set("title", "Home");
		
	}
	
}
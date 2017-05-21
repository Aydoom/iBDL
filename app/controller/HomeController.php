<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;

class HomeController extends Controller {
	
    public function index() {
        $this->_set("title", "Home");
    }
}
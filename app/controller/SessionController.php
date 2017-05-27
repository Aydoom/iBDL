<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;

class SessionController extends Controller {
	
	public function index() {
		
	}
	
	
	
	public function create() {
            $session = $this->loadModel('session');
            $error = '';
            $this->_set('title', 'Создание сессии' . $error);
	}
	
	
	
	public function update() {
		
	}
	
	
	
	public function remove() {
		
	}
	
	
	
	public function view() {
		
	}

	
}

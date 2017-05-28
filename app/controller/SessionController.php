<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;
use iBDL\Core\Request;

class SessionController extends Controller {
	
    public function index() {

    }

    /**
     * Create Session
     */
    public function create() {
        $session = $this->loadModel('session');
        $error = '';
        if ($this->isPut() && $session->validation() && $session->fileValidation()) {
            pr('yes');
        }
        
        $this->_set('title', 'Создание сессии' . $error);
    }



    public function update() {

    }



    public function remove() {

    }



    public function view() {

    }

	
}

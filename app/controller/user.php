<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;
use iBDL\APP\Model\UserModel;

class User extends Controller {
    
    public $layout = 'user';
    
    public function login() {
        $this->_set('title', 'Log In');
    }
	
    public function registrar() {
        $model = new UserModel();
        if($this->isPut() && $model->validation()) {
            pr('all ok');
        }
        pr('stop');
        
        $this->_set('title', 'Registration');
    }



    public function create() {

    }

    public function update() {

    }



    public function remove() {

    }



    public function view() {

    }

	
}

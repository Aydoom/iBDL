<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;
use iBDL\APP\Model\UserModel;

class UserController extends Controller {
    
    public $layout = 'user';
    
    public function login() {
        $this->_set('title', 'Log In');
    }
	
    public function registrar() {
        $model = new UserModel();
        if($this->isPut() && $model->validation()) {
            pr('all ok');
        }
        //pr(__METHOD__);
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

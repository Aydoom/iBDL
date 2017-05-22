<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;

class UserController extends Controller {
    
    public $layout = 'user';
    
    public function login() {
        $this->loadModel('user');
        $this->_set('title', 'Log In');
    }
	
    public function registrar() {
        $user = $this->loadModel('user');
        if($this->isPut() && $user->validation()) {
            pr('all ok');
            $user->save();
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

<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;
use \iBDL\Core\Request;

use PAuth\Core\Auth;

class UserController extends Controller {
    
    public $layout = 'user';
    
    public function login() {
        $this->loadModel('user');
        $this->_set('title', 'Log In');
    }
	
    public function registrar() {
        $user = $this->loadModel('user');
        $error = '';
        if($this->isPut() && $user->validation()) {
            if($user->save(Request::get('userForm'))) {
                Auth::login(Request::get('userForm.name'), Request::get('userForm.password'));
                $this->redirect(Auth::getFalseUrl());
            } else {
                $error = '<span class="text-danger"> - Error: something wrong</span>';
            }            
        }

        $this->_set('title', 'Registration' . $error);
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

<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;
use \iBDL\Core\Request;

use PAuth\Core\Auth;

class UserController extends Controller {
    
    public $layout = 'user';
    
    public function login() {
        logs(__METHOD__);
        $this->loadModel('user');
        $this->_set('title', 'Log In');
    }
	
    public function registrar() {
        logs(__METHOD__);
        $user = $this->loadModel('user');
        $error = '';
        if($this->isPut() && $user->validation()) {
            if($user->save(Request::get('userForm'))) {
                Auth::login(Request::get('userForm.name'), 
                        Request::get('userForm.password'));
                
                $preUri = Auth::getFalseUrl();
                if($preUri === "/user/registrar" || $preUri === "/user/login") {
                    $uri = "/";
                } else {
                    $uri = $preUri;
                }
                //pr(Request::get('userForm'), false);
                //pr($_COOKIE);
                pr($uri);
                $this->redirect($uri);
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

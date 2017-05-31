<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;
use iBDL\Core\Request;
use PAuth\Core\Auth;
use iBDL\Core\File;

class SessionController extends Controller {
	
    public function index() {
        $session = $this->loadModel('session');
        $this->_set('sessions', $session->find(
                                    ['where' => ['id_user' => Auth::$user['id']]]));
     }

    /**
     * Create Session
     */
    public function create() {
        $session = $this->loadModel('session');
        $error = '';
        if ($this->isPut() && $session->validation() && $session->fileValidation()) {
            if($session->save(Request::get("sessionForm"))) {
                $file = new File;
                $file->save();
                
                $this->redirect("session/index");
            }
            
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

<?php 

namespace iBDL\App\Controller;

use iBDL\Core\Controller;
use iBDL\Core\Request;
use PAuth\Core\Auth;
use iBDL\Core\File;

class SessionController extends Controller {
	
    public function index($page = 1) {
        $session = $this->loadModel('session');
        $session->usePagination(6);
        $sessions = $session->find([
            'where' => ['id_user' => Auth::$user['id']],
            'page'  => $page
        ]);
        $this->_set('sessions', $sessions);
        $this->_set('model', $session);
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

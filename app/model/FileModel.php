<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\App\Model;

use iBDL\Core\Model;

/**
 * Description of FileModel
 *
 * @author Aydoom
 */
class FileModel extends Model {
    public $validRules = [];
    
    
    public function save($data, $id_session) {
        
        foreach($data as $file) {
            parent::save([
                'id_session'    => $id_session,
                'name'          => $file['new_name'],
                'loadDate'      => date("Y-m-d H:i:s")
            ]);
        }
    }
    
}

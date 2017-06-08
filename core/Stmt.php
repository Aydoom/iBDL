<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iBDL\Core;

/**
 * Description of Stmt
 *
 * @author Aydoom
 */
class Stmt {

    //public $has_join = false;
    
    public function __construct($data) {
        $rows = $data->fetchAll(\PDO::FETCH_NUM);
        $columns = $this->getColumns($data);
        pr($rows);
        $output = [];
        foreach ($rows as $row) {
            $index = $row[0];
            foreach ($row as $colNum => $value) {
                $table = $columns[$colNum]['table'];
                $name = $columns[$colNum]['name'];
                if ($table == $columns[0]['table']) {
                    $output[$index][$name] = $value;
                } elseif ($name == 'id') {
                    $index2 = $value;
                    $output[$index][$table][$index2][$name] = $value;
                } else {
                    $output[$index][$table][$index2][$name] = $value;
                }
            }            
        }
        
        pr($output);
    }
    
    public function getColumns($data) {
        $countColumns = $data->columnCount();
        $result = [];
        for ($i = 0; $i < $countColumns; $i++) {
            $column = $data->getColumnMeta($i);
            $result[$i] = [
                'table' => $column['table'],
                'name' => $column['name']
            ];
        }
        
        return $result;
    }
}
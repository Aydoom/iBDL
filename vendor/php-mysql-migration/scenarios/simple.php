<?php

use \PMMigration\Tables as Table;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function scenarioRun($DB)
{
    $DB->add(new Table\UserTable());
    $DB->add(new Table\UserGroupTable());
    $DB->add(new Table\SessionTable());
    $DB->add(new Table\KeyTable());
    $DB->add(new Table\FileTable());
}
<?php
session_start();
// Report all errors except E_NOTICE
// This is the default value set in php.ini
error_reporting(E_ALL ^ E_NOTICE);

class controller {
    var $session;
    var $actions;
    
    function __construct() {
        $this->actions = new actions();
    }
    
}

?>
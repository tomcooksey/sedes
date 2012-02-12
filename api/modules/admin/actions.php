<?php

class admin {
    var $context;
    
    function setContext($context) {
        $this->context = $context;
    }
    
    function login() {
        $this->context->softError('Custom error');
    }
}

?>
<?php

class session {
    var $context;
    
    function setContext($context) {
        $this->context = $context;
    }
    
    function verbHandler() {
        
        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->get();
                 break;
            case 'POST':
                $this->post();
                break;
            case 'PUT':
                $this->put();
                break;
            case 'DELETE':
                $this->delete();
                break;
        }
    }
    
    function get() {
        $this->context->returnSuccess($this->context->getSessionVar('progress'));
    }
    
    function put() {
        $this->context->setSessionVar('progress', $this->context->headerVals);
        
        $this->context->returnSuccess(array());
    }
}

?>
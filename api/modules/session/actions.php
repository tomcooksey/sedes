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
        if(!$this->context->getSessionVar('progress')) {
            
            $defaultSession = array(
                "id" => 1,
                "order_id" => 0,
                "current_stage" => 1,
                "show_id" => 0,
                "performance_id" => 0
            );
            
            $this->context->setSessionVar('progress', $defaultSession);
        }
        
        $this->context->returnSuccess($this->context->getSessionVar('progress'));
    }
    
    function put() {
        print_r($this->context->headerVals);
        print_r($this->context->getSessionVar('progress'));
        $this->context->setSessionVar('progress', $this->context->headerVals);
        
        print_r($this->context->getSessionVar('progress'));
        
        $this->context->returnSuccess(array());
    }
}

?>
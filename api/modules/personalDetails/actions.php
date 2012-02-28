<?php

class personalDetails {
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
        
        $pd = $this->context->getSessionVar('personalDetails');
        
        if($pd == '') {
            $pd = array('id' => '1');   
        }
            
        $this->context->returnSuccess($pd); 
    }
    
    function put() {
        
        $this->context->setSessionVar('personalDetails', $this->context->headerVals);
        
        $this->context->returnSuccess(array());
    }
}

?>
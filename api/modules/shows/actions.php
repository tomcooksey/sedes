<?php

class shows {
    var $context;
    
    function setContext($context) {
        $this->context = $context;
    }
    
    function verbHandler() {
        
        $this->dummyData = array(
            array(
                show_id => 1,
                name => "Street car named desire"
            )
        );
        
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
        
        if(!$this->context->getGETVal('id')) {
            
            if($this->dummyData != "") {
                $this->context->returnSuccess($this->dummyData);
            }else{
                $this->context->error("No shows found");
            }
        }else{
            //Getting a specific
            $this->context->returnSuccess(array());
        }
    }
    
    function put() {
        //Getting a specific
        $this->context->returnSuccess(array());
    }
}

?>
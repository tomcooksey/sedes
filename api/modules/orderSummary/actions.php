<?php

class orderSummary {
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
        
        if(!$this->context->getGETVal('id')) {
            
            $prog = $this->context->getSessionVar('progress');
            
            
            
            if($prog['show_id'] == "" || $prog['show_id'] == "0") {
                print_r($prog);
                 $this->context->returnSuccess(array());
                 die();
            }

            $data = $this->dummyData[$prog['show_id']];
            
            
            if($data != "") {
                
                $this->context->returnSuccess($data);
            }else{
                $this->context->error("No performances found");
            }
        }else{
            //Getting a specific
            $this->context->returnSuccess(array());
        }
    }
    
    function put() {
           $this->context->returnSuccess(array());
    }
}

?>
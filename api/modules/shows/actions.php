<?php

class shows {
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
            
            $q = new ShowQuery();
            
            $q = $q->find()->toArray();

            if(count($q) === 1) {

                $prog = $this->context->getSessionVar('progress');
                $prog['show_id'] = $q[0]['id'];
                $this->context->setSessionVar('progress', $prog);
            }
            
            
            if(count($q) > 0) {
                $this->context->returnSuccess($q);
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
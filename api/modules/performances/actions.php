<?php

class performances {
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
                 $this->context->returnSuccess(array());
                 die();
            }
            
            $q = PerformanceQuery::create()->filterByShowId($prog['show_id']);
            
            $data = $q->find()->toArray();
            

            if(count($data) > 0) {
                
                foreach($data as $i => $v) {
                    foreach($v as $k => $l) {
                        if($k === 'name') {
                            $data[$i][$k] = date('l jS F Y g:ia', strtotime($l));
                        }
                    }
                }
                
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
<?php

class performances {
    var $context;
    
    function setContext($context) {
        $this->context = $context;
    }
    
    function verbHandler() {

        $this->dummyData = array(
            1 => array(
                array(
                    id => 1,
                    name => 'Thursday 9th March 2012 19:00'
                ),
                
                array(
                    id => 2,
                    name => 'Friday 10th March 2012 19:00'
                ),
                
                array(
                    id => 3,
                    name => 'Saturday 11th March 2012 14:00'
                ),
                
                array(
                    id => 4,
                    name => 'Saturday 11th March 2012 19:00'
                )
                
            ),
            
            2 => array(
                array(
                    id => 5,
                    name => 'Thursday 9th April 2012 19:00'
                ),
                
                array(
                    id => 6,
                    name => 'Friday 10th April 2012 19:00'
                ),
                
                array(
                    id => 7,
                    name => 'Saturday 11th April 2012 14:00'
                ),
                
                array(
                    id => 8,
                    name => 'Saturday 11th April 2012 19:00'
                )
                
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
            
            $prog = $this->context->getSessionVar('progress');
            
            if($prog['show_id'] == "" || $prog['show_id'] == "0") {
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
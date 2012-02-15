<?php

class ticketTypes {
    var $context;
    
    function setContext($context) {
        $this->context = $context;
    }
    
    function verbHandler() {

        $this->dummyData = array(
            1 => array(
                array(
                    id => 1,
                    name => 'Adults (14 and over)',
                    price => 14.5
                ),
                
                array(
                    id => 2,
                    name => 'Children (14 and under)',
                    price => 11.5
                )
                
            ),
            
            2 => array(
                array(
                    id => 3,
                    name => 'Dogs (3 and over)',
                    price => 12.5
                ),
                
                array(
                    id => 4,
                    name => 'Cats (12 and under)',
                    price => 17.5
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
        
        $ticketsSelected = $this->context->getSessionVar('ticketsSelected');
        
        
        
        if(!$ticketsSelected) {
            $ticketsSelected = array();
        }
        
        if(!$this->context->getGETVal('id')) {
            
            $prog = $this->context->getSessionVar('progress');
            
            if($prog['performance_id'] == "" || $prog['performance_id'] == "0") {
                 $this->context->returnSuccess(array());
                 die();
            }
            
           
            $data = $this->dummyData[$prog['performance_id']];
            
            
            if($data != "") {
                
                //Add in the quantities
                foreach($data as $k => $v) {
                    
                    $data[$k]['quantity'] = $ticketsSelected[$v['id']] ? $ticketsSelected[$v['id']] : 0;
                }
                
                $this->context->returnSuccess($data);
            }else{
                $this->context->error("No ticket types found");
            }
        }else{
            //Getting a specific
            $this->context->returnSuccess(array());
        }
    }
    
    function put() {
        //Getting a specific
        $id = $this->context->getGETVal('id');
        
        $ticketsSelected = $this->context->getSessionVar('ticketsSelected');
        
        if(!$ticketsSelected) {
            $ticketsSelected = array();
        }
        
        if(!$ticketsSelected[$id]) {
            $ticketsSelected[$id] = array();
        }
        
        $ticketsSelected[$id] = $this->context->headerVals['quantity'];
        
        $this->context->setSessionVar('ticketsSelected', $ticketsSelected);
        
        $this->context->returnSuccess(array());
    }
}

?>
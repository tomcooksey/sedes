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
        
        $prog = $this->context->getSessionVar('progress');
        
        $perfId = $prog['performance_id'];
        
        if(!$ticketsSelected) {
            $ticketsSelected = array();
        }
        
        if(!$ticketsSelected[$perfId]) {
            $ticketsSelected[$perfId] = array();
        }
        
        if(!$this->context->getGETVal('id')) {
            
            if($perfId == "" || $perfId == "0") {
                 $this->context->returnSuccess(array());
                 die();
            }
            
            $q = new TicketTypeQuery();
            $q->filterByPerformanceId($perfId);
            $data = $q->find()->toArray();

            if(count($data)) {
                
                //Add in the quantities
                foreach($data as $k => $v) {
                    
                    $data[$k]['quantity'] = $ticketsSelected[$perfId][$v['id']] ? $ticketsSelected[$perfId][$v['id']] : 0;
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

        $id = $this->context->getGETVal('id');
        
        $ticketsSelected = $this->context->getSessionVar('ticketsSelected');
        
        $prog = $this->context->getSessionVar('progress');
        
        $perfId = $prog['performance_id'];
        
        if(!$ticketsSelected) {
            $ticketsSelected = array();
        }
        
        if(!$ticketsSelected[$perfId]) {
            $ticketsSelected[$perfId] = array();
        }
        
        if(!$ticketsSelected[$perfId][$id]) {
            $ticketsSelected[$perfId][$id] = array();
        }
        
        $ticketsSelected[$perfId][$id] = $this->context->headerVals['quantity'];
        
        $this->context->setSessionVar('ticketsSelected', $ticketsSelected);
        
        $this->context->returnSuccess(array());
    }
}

?>
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
                    price => 14.5,
                    quantity => 4
                ),
                
                array(
                    id => 2,
                    name => 'Children (14 and under)',
                    price => 11.5,
                    quantity => 2
                )
                
            ),
            
            2 => array(
                array(
                    id => 3,
                    name => 'Dogs (3 and over)',
                    price => 12.5,
                    quantity => 0
                ),
                
                array(
                    id => 4,
                    name => 'Cats (12 and under)',
                    price => 17.5,
                    quantity => 1
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
        //Return stubbed data for now...
        //echo "<pre>";
        //print_r($this->stubbedData);
        $prog = $this->context->getSessionVar('progress');
        $data = $this->dummyData[$prog['performance_id']];

        
        if($data != "") {
            $this->context->returnSuccess($data);
        }else{
            $this->context->error("No ticket types found");
        }

    }
    
    function put() {
        
    }
}

?>
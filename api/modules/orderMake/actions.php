<?php

class orderMake {
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
        
        //At this point we need to get ourselves an order ID and send it back to the client
        
        $personalDetails = $this->context->getSessionVar('personalDetails');
        $seats = $this->context->getSessionVar('seatsBooked');
        $ticketsSelected = $this->context->getSessionVar('ticketsSelected');
        $progress = $this->context->getSessionVar('progress');
        
        echo "<pre>";
        print_r($progress);
        print_r($personalDetails);
        print_r($seats);
        print_r($ticketsSelected);

        if(!$_SESSION['order_id']) {
            $orderObj = new Order();
        }else{
            $orderObj = new OrderQuery();
            $orderObj = $orderObj->findPK($_SESSION['order_id']);
        }
    
        $orderObj->setWhen(date('Y-m-d G:i:00'));
        $orderObj->setFullName($personalDetails['name']);
        $orderObj->setEmail($personalDetails['email']);
        $orderObj->setPerformanceId($progress['performance_id']);
        
        $orderObj->save();
        
        $order_id = $orderObj->getId();
        $_SESSION['order_id'] = $order_id;
        
    }
    
    function put() {
           $this->context->returnSuccess(array());
    }
}

?>
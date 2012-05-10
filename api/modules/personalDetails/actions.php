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
        
        $personalDetails= $this->context->getSessionVar('personalDetails');
        
        if(!$personalDetails) {
            $personalDetails = array();
        }
            
        $this->context->returnSuccess($personalDetails); 
    }
    
    function put() {
        
        $this->context->setSessionVar('personalDetails', $this->context->headerVals);
        
        $personalDetails = $this->context->headerVals;
        
        if(!$_SESSION['order_id']) {
            $orderObj = new Order();
            $orderObj->setWhen(date('Y-m-d G:i:00'));
        }else{
            $orderObj = new OrderQuery();
            $orderObj = $orderObj->findPK($_SESSION['order_id']);
        }
        
        $orderObj->setFullName($personalDetails['name']);
        $orderObj->setEmail($personalDetails['email']);
        $orderObj->setPerformanceId($progress['performance_id']);
        
        $orderObj->save();
        
        $this->context->returnSuccess(array());
    }
}

?>
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
        
        /*echo "<pre>";
        print_r($progress);
        print_r($personalDetails);
        print_r($seats);
        print_r($ticketsSelected);*/
        

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
        
        $order_id = $orderObj->getId();
        $_SESSION['order_id'] = $order_id;
        
        //Get any seats
        $orderSeats = OrderSeatQuery::create();
        $orderSeats->filterByOrderId($order_id);
        
        $orderSeats = $orderSeats->find();
        
        if(count($orderSeats)) {
            foreach($orderSeats as $k => $v) {
                $v->delete();
            }
        }
        
        $orderedSeats = $seats[$progress['performance_id']];
        
   
 
        if(count($orderedSeats)) {
            foreach($orderedSeats as $k => $seat) {
                $seatObj = new OrderSeat();
                $seatObj->setSeatId($seat);
                $seatObj->setOrderId($order_id);
                $seatObj->save();
            }
        }else{

            $orderObj->setWhen(date('Y-m-d G:i:00'));
            $orderObj->save();
        }
        
        
        $orderTicketTypes = OrderTicketTypeQuery::create();
        $orderTicketTypes->filterByOrderId($order_id);
        
        $orderTicketTypes = $orderTicketTypes->find();
        
        if(count($orderTicketTypes)) {
            foreach($orderTicketTypes as $k => $v) {
                $v->delete();
            }
        }
        
        $orderedTicketTypes = $ticketsSelected[$progress['performance_id']];
        

        foreach($orderedTicketTypes as $id => $quantity) {
            $seatObj = new OrderTicketType();
            $seatObj->setTypeId($id);
            $seatObj->setOrderId($order_id);
            $seatObj->setQuantity($quantity);
            $seatObj->save();
        }
        
        if($order_id) {
            $this->context->returnSuccess(array("order_id" => $order_id, "timestamp" => strtotime($orderObj->getWhen())));
        }else{
            
        }
        
    }
    
    
    function put() {
           $this->context->returnSuccess(array());
    }
    
    function killOrder() {
        
        
        $orderObj = new OrderQuery();
        $orderObj = $orderObj->findPK($_SESSION['order_id']);
        
                
        //echo $_SESSION['order_id'];
        
        if($orderObj) {
            
            if($orderObj->getFulfilled()) {
                $this->context->returnSuccess(array());
                die();
            }
            
            $orderSeats = OrderSeatQuery::create();
            $orderSeats->filterByOrderId($orderObj->getId());
            
            $orderSeats = $orderSeats->find();
            
            if(count($orderSeats)) {
                foreach($orderSeats as $k => $v) {
                    $v->delete();
                }
            }
            
            $orderTickets = OrderTicketTypeQuery::create();
            $orderTickets->filterByOrderId($orderObj->getId());
            
            $orderTickets = $orderTickets->find();
            
            if(count($orderTickets)) {
                foreach($orderTickets as $k => $v) {
                    $v->delete();
                }
            }
           
            
            $orderObj->delete();
        }
        
        unset($_SESSION['order_id']);
        $this->context->returnSuccess(array());
    }
    
    function killAllOutstandingOrders() {
        
        $cutoff = strtotime(date('Y-m-d H:i:s'));
        
        $orderObj = new OrderQuery();
        $orderObj->filterByFulfilled(null);
        
        $orderObj = $orderObj->find();
        
        if(count($orderObj)) {
            foreach($orderObj as $order) {
                
                echo $order.'<br/>';
                
                $date = strtotime($order->getWhen());
                

                if(($cutoff - $date) > 600) {
                                       
                   //Get any seats
                    $orderSeats = OrderSeatQuery::create();
                    $orderSeats->filterByOrderId($order->getId());
                    
                    $orderSeats = $orderSeats->find();
                    
                    if(count($orderSeats)) {
                        
                        foreach($orderSeats as $k => $v) {
                            echo $v .'<br/>';
                            $v->delete();
                        }
                    }
                    
                    $orderTickets = OrderTicketTypeQuery::create();
                    $orderTickets->filterByOrderId($order->getId());
                    
                    $orderTickets = $orderTickets->find();
                    
                    if(count($orderTickets)) {
                        foreach($orderTickets as $k => $v) {
                            $v->delete();
                        }
                    }
                   
                    $order->delete();
                }
            }
        }
        
    }
}

?>
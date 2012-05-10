<?php

class payment {
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
        
        
    }
    
    function getValuesWithKeys($var) {
        
        $string = '';
        
        foreach($var as $k=>$v) {
            $string = $string . $k. '=' .$v;
        }
        
        return $string;
        
    }
    
    function ipn() {
        

        //file_put_contents('post.html', $this->getValuesWithKeys($_POST));
        //file_put_contents('get.html', $this->getValuesWithKeys($_GET));
        
        

        $order = OrderQuery::create();
        $order = $order->findPK($_POST['custom']);
        
        if($_POST['payment_status'] == 'Completed') {
            $order->setFulfilled(true);
            $order->save();
            
            $order_id = $order->getId();
            
            //Get the seats and ticket types
            $orderSeats = OrderSeatQuery::create();
            $orderSeats->filterByOrderId($order_id);
            
            $orderSeats = $orderSeats->find();
            
            $rows = RowQuery::create();
            $rows->find();
            
            $rowsFinal = array();
            
            foreach($rows as $row) {
                $rowsFinal[$row->getId()] = $row;
            }
            
            $seats = SeatQuery::create();
            $seats->find();
            
            $seatsFinal = array();
            
            foreach($seats as $seat) {
                $seatsFinal[$seat->getId()] = $seat->getNumber();
            }
            
            $seatsBuildup = '';
            
            if(count($orderSeats)) {
                foreach($orderSeats as $k => $orderSeat) {
                    
                    $thisSeat = $seatsFinal[$orderSeat->getSeatId()];
                    $thisSeatNumber = $thisSeat->getNumber();
                    $thisRow = $rowsFinal[$thisSeat->getRowId()];
                    
                    $seatsBuildup .= ', '.$thisRow.$thisSeatNumber;
                    
                }
                
                file_put_contents('get.html', $seatsBuildup);
            }
        }else{
            if($order) {
            
                $orderSeats = OrderSeatQuery::create();
                $orderSeats->filterByOrderId($order->getId());
                
                $orderSeats = $orderSeats->find();
                
                if(count($orderSeats)) {
                    foreach($orderSeats as $k => $v) {
                        $v->delete();
                    }
                }
               
                
                $order->delete();

            }
        }
        
        
    
    }
    
    function put() {
           $this->context->returnSuccess(array());
    }
}

?>
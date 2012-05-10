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
            $rows = $rows->find();
            
            $rowsFinal = array();
            
            foreach($rows as $row) {
                $rowsFinal[$row->getId()] = $row->getName();
            }
            
            $seats = SeatQuery::create();
            $seats = $seats->find();
            
            $seatsFinal = array();
            
            foreach($seats as $seat) {
                $seatsFinal[$seat->getId()] = $seat;
            }
            
            $seatsBuildup = '';
            
            //Get performance
            $performance = PerformanceQuery::create();
            
            $performance = $performance->findById($order->getPerformanceId());
            
            $p = $performance->toArray();
            
            if(count($orderSeats)) {
                $x = 1;
                foreach($orderSeats as $k => $orderSeat) {
                    $x++;
                    $thisSeat = $seatsFinal[$orderSeat->getSeatId()];
                    $thisSeatNumber = $thisSeat->getNumber();
                    $thisRow = $rowsFinal[$thisSeat->getRowId()];
                    
                    $seatsBuildup .= $thisRow.$thisSeatNumber;
                    
                    if($x != count($orderSeats)) {
                        $seatsBuildup = $seatsBuildup . ', ';
                    }
                }
                
                $to = $_POST['payer_email'];
                $from = 'noreply@simplytheatre.net';
                $subject = 'Ticket Order Confirmation';
                
                file_put_contents('get.html', $performance['name']);
                
                $headers = 'From: noreply@simplytheatre.net' . "\r\n" .
                'Reply-To: noreply@simplytheatre.net' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                
                //TODO hardcoded name
                $body = "ORDER CONFIRMATION - PLEASE RETAIN\n\n";
                $body .= "Dear ".$_POST['first_name'].' ' . $_POST['last_name'] ."\n\n";
                $body .= 'Thank you for your order for tickets to see Street Car Named Desire on '. date('l jS F Y g:ia', strtotime($p[0]['name']))."\n\n";
                $body .= 'Your seats are: '. $seatsBuildup."\n\n";
                $body .= 'Thank you and enjoy the show!';
                
                mail($to, $subject, $body, $headers);
                
            }else{
                file_put_contents('get.html', 'nH'); 
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
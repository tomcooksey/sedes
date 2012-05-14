<?php

class seats {
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
        
        //TO DO Add booked and selected seats
        
        $prog = $this->context->getSessionVar('progress');
        $perfId = $prog['performance_id'];
        
        $seatsBooked = $this->context->getSessionVar('seatsBooked');
        
        $chosen = $seatsBooked[$perfId];
        
        if(!$chosen) {
            $chosen = array();
        }
        
        $orderObj = new OrderQuery();
        $orderObj = $orderObj->filterByPerformanceId($prog['performance_id']);
        $orderObj = $orderObj->find();
        
        $bookedSeats = array();

        if(count($orderObj)) {
            foreach($orderObj as $order) {
                $orderSeats = new OrderSeatQuery();
                $orderSeats->filterByOrderId($order->getId());
                $orderSeats = $orderSeats->find();
                
                if(count($orderSeats)) {
                    foreach($orderSeats as $os) {
                        array_push($bookedSeats, $os->getSeatId());
                    }
                }
            }
        }
        
  
        $q = new RowQuery();
        //Hardcoded Venue ID for now
        $q->filterByVenueId(1);
        $q = $q->find()->toArray();
        
        $avail = new SeatAvailabilityQuery();
        $avail = $avail->find()->toArray();
        
        $a = array();
        
        foreach($avail as $k => $av) {
            
            $a[$av['seatId']] = $av['forSale'];
            
        }
        
        $seats = array();
        
        foreach($q as $k => $row) {
            $rowSeats = new SeatQuery();
            $rowSeats->filterByRowId($row['id']);
            $rowSeats = $rowSeats->find()->toArray();
            
            foreach($rowSeats as $k2 => $seat) {
                $seat['row'] = $row['name'];
                
                unset($seat['name']);
                unset($seat['rowId']);
                
                $seat['forSale'] = $a[$seat['id']];
                
                if(in_array($seat['id'], $chosen)) {
                    $seat['selected'] = true;
                }
                
                if(in_array($seat['id'], $bookedSeats) && !$seat['selected']) {
                    $seat['booked'] = true;
                }
                
                
                
                
                array_push($seats, $seat);
            }
            
            
        }
        
        $this->context->returnSuccess($seats);
    }
    
    function put() {
        
        $prog = $this->context->getSessionVar('progress');
        $perfId = $prog['performance_id'];
        
        $seatsBooked = $this->context->getSessionVar('seatsBooked');
        
        if(!$seatsBooked) {
            $seatsBooked = array();
        }
        
        $stored = $seatsBooked[$perfId];
        
        if(!$stored) {
            $stored = array();
        }
        
        if($this->context->headerVals['selected']) {
            //Add it the array
            array_push($stored, $this->context->headerVals['id']);
        }else{
            $key = array_search($this->context->headerVals['id'], $stored);
            
            if($key > -1) {
                unset($stored[$key]);
            }
        }
        
        $seatsBooked[$perfId] = $stored;
        $this->context->setSessionVar('seatsBooked', $seatsBooked);
        
        //If we're admin update the forSale flag
        
        if($_SESSION['admin']) {
            $seatAvail = SeatAvailabilityQuery::create();
            $seatAvail->filterBySeatId($this->context->headerVals['id']);
            $seatAvail = $seatAvail->findOne();
            
            if($seatAvail) {
                $seatAvail->setForSale($this->context->headerVals['forSale']);
                $seatAvail->save();
            }
        }
        
        $this->context->returnSuccess(array());

    }
}

?>
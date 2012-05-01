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
        $prog = $this->context->getSessionVar('progress');
        $perfId = $prog['performance_id'];
        
        $seatsBooked = $this->context->getSessionVar('seatsBooked');
        
        $chosen = $seatsBooked[$perfId];
        
        if(!$chosen) {
            $chosen = array();
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
        
        $this->context->returnSuccess(array());

    }
}

?>
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
        //Manually feed in the seats for now
        $rows = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j');
        
        $prog = $this->context->getSessionVar('progress');
        $perfId = $prog['performance_id'];
        
        $seatsBooked = $this->context->getSessionVar('seatsBooked');
        
        $chosen = $seatsBooked[$perfId];
        
        if(!$chosen) {
            $chosen = array();
        }
        
        $unique = 1;
        
        $buildup = array();
        
        for($x=count($rows) - 1; $x>=0; $x-=1) {
            
            $seatNumber = 1;
            
            for($y=1; $y<27; $y+=1) {
                $forSale = true;
                
                $selected = in_array($unique, $chosen, false);
                
                if($rows[$x] == 'j') {
                    if($seatNumber < 5) {
                        $forSale = false;
                    }
                    
                    if($y < 4 || $y===26 || $y===8) {
                        
                        array_push($buildup, array(
                            id => $unique,
                            row => $rows[$x],
                            number => '',
                            booked => false,
                            forSale => false,
                            selected => $selected,
                            noSeat => true
                        ));
                    }else{
                        
                        array_push($buildup, array(
                            id => $unique,
                            row => $rows[$x],
                            number => $seatNumber,
                            booked => false,
                            forSale => $forSale,
                            selected => $selected
                        ));
                        $seatNumber +=1;
                        
                    }
                }else{
                    
                    $booked = false;
                    
                    if($rows[$x] == 'e') {
                        if($seatNumber > 5 && $seatNumber < 22) {
                            $booked = true;
                        }
                    }
                    array_push($buildup, array(
                        id => $unique,
                        row => $rows[$x],
                        number => $seatNumber,
                        booked => $booked,
                        forSale => $forSale,
                        selected => $selected
                    ));
                   
                    $seatNumber +=1;
                   
                }
                 $unique +=1;
                
            }
        }
        
        $this->context->returnSuccess($buildup);
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
<?php

class stub {
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
        
        $venue = new Venue();
        $venue->setName('Rhoda McGaw Theatre');
        $venue->setAddress('The Ambassadors
                            Peacocks Centre
                            Woking
                            Surrey
                            GU21 6GQ');
        $venue->save();
        
        $venueId = $venue->getId();
        
        echo 'Venue ID: ' . $venueId .'<br/>';
        
        $show = new Show();
        $show->setName('Street Car Named Desired');
        
        $show->save();
        
        $show_id = $show->getId();
        
        echo 'Show ID: ' . $show_id .'<br/>';
        
        $performance = new Performance();
        $performance->setShowId($show_id);
        $performance->setVenueId($venueId);
        $performance->setName(date('Y-m-d G:i:00'));
 
        $performance->save();
        
        $performance_id = $performance->getId();
        
        echo 'Performance ID: ' . $performance_id . '<br/>';
        
        $ticketType1 = new TicketType();
        $ticketType1->setPerformanceId($performance_id);
        $ticketType1->setName('Adults');
        $ticketType1->setPrice('14.00');
        
        $ticketType1->save();
        
        $ticket_type_1_id = $ticketType1->getId();
        
        echo 'Ticket Type 1 ID: ' . $ticket_type_1_id . '<br/>';
        
        $ticketType2 = new TicketType();
        $ticketType2->setPerformanceId($performance_id);
        $ticketType2->setName('Children');
        $ticketType2->setPrice('10.00');
        
        $ticketType2->save();
        
        $ticket_type_2_id = $ticketType2->getId();
        
        echo 'Ticket Type 2 ID: ' . $ticket_type_2_id . '<br/>';
        
        $rows = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j');
        
        for($x=count($rows) - 1; $x>=0; $x-=1) {
            
            $seatNumber = 1;
            
            $row = new Row();
            $row->setVenueId($venueId);
            $row->setName($rows[$x]);
            $row->save();
            
            $row_id = $row->getId();
            
            echo "Row ID: " . $row_id .'<br/>';
            
            $seatNo = 0;
            
            for($y=1; $y<27; $y+=1) {
                $forSale = true;
                
                $noSeat = false;
                
                if($rows[$x] == 'j') {
                    if($y < 4 || $y===26 || $y===8) {
                        $noSeat = true;
                    }else{
                        $seatNo +=1;
                    }
                }else{
                    $seatNo +=1;
                }
                
                $printSeat = !$noSeat ? $seatNo : '';
                
                $seat = new Seat();
                $seat->setRowId($row_id);
                $seat->setNumber($printSeat);
                $seat->setNoSeat($noSeat);
                
                $seat->save();
                $seat_id = $seat->getId();
                
                echo "Seat ID: " . $seat_id .'<br/>';
                
                //Add availability
                $avail = new SeatAvailability();
                $avail->setSeatId($seat_id);
                $avail->setForSale(true);
                
                $avail->save();
                
                $avail_id = $avail->getId();
                
                echo "Seat Availability: " . $avail_id . "<br/>";                   
            }
        }
    }
}

?>
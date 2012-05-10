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

        error_reporting(E_ALL ^ E_NOTICE); 
  
        $header = ""; 
        $emailtext = ""; 
        // Read the post from PayPal and add 'cmd' 
        $req = 'cmd=_notify-validate'; 
        if(function_exists('get_magic_quotes_gpc')) {  
            $get_magic_quotes_exists = true; 
        } 
        
        foreach ($_POST as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1){  
                $value = urlencode(stripslashes($value)); 
            } else { 
                $value = urlencode($value); 
            } 
            $req .= "&$key=$value"; 
        } 
        // Post back to PayPal to validate 
        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; 
        $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30); 
        // Process validation from PayPal 
        // TODO: This sample does not test the HTTP response code. All 
        // HTTP response codes must be handled or you should use an HTTP 
        // library, such as cUrl 
            if (!$fp) { // HTTP ERROR
                echo 'HTTP error';
            } else {
    
                // NO HTTP ERROR 
                fputs ($fp, $header . $req); 
                while (!feof($fp)) { 
                    $res = fgets ($fp, 1024);
                    
                    
        
                    if (strcmp ($res, "VERIFIED") == 0) {
                        
                        die('here');
                        
                        // TODO: 
                        // Check the payment_status is Completed 
                        // Check that txn_id has not been previously processed 
                        // Check that receiver_email is your Primary PayPal email 
                        // Check that payment_amount/payment_currency are correct 
                        // Process payment 
                        // If 'VERIFIED', send an email of IPN variables and values to the 
                        // specified email address 
                        foreach ($_POST as $key => $value){ 
                            $emailtext .= $key . " = " .$value ."\n\n"; 
                        } 
                        
                        
                        
                    } else if (strcmp ($res, "INVALID") == 0) {

                        // If 'INVALID', send an email. TODO: Log for manual investigation. 
                        foreach ($_POST as $key => $value){ 
                            $emailtext .= $key . " = " .$value ."\n\n"; 
                        } 
                        
                    }  
                }
                
                echo $emailtext;
            } 
        fclose ($fp);
    
    }
    
    function put() {
           $this->context->returnSuccess(array());
    }
}

?>
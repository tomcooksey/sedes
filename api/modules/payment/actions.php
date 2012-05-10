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
        
        
        //$result = file_get_contents();
        
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,'https://www.sandbox.paypal.com/cgi-bin/websrc?cmd=_notify-validate'. $this->getValuesWithKeys($_POST));
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Simply');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        
        
    echo $query;
        file_put_contents('get.html', $query);
    
    }
    
    function put() {
           $this->context->returnSuccess(array());
    }
}

?>
<?php
class actions {
    
    var $modulesPath;
    var $method;
    var $requesURI;
    
    var $currentModule;
    var $currentAction;
    
    var $getVals;
    var $postVals;
    var $headerVals;
    
    var $total;
    
    var $isAuthenticated;
    
    function __construct() {
        $this->session = $_SESSION;
        $this->modulesPath = MODULES_PATH;
        
        //Load in the json
        $this->routingMap = json_decode(file_get_contents('../api/config/routing.json'), true);
        
        $this->routing();
    }
    
    function routing() {
        $this->method = $_POST ? 'POST' : 'GET';
        $this->requestURI = str_replace('/api.php', '', $_SERVER['REQUEST_URI']);
        $tempParts = explode('?', $this->requestURI);
        
        $this->requestURI = $tempParts[0];
        
        $this->getVals = array();
        
        foreach($this->routingMap as $url => $elements) {
            $this->requestURIParts = explode('/', $this->requestURI);
            
            array_shift($this->requestURIParts);

            //Clean it up
            if(count($this->requestURIParts) > 1 && $this->requestURIParts[count($this->requestURIParts) -1] == '') array_pop($this->requestURIParts);
            
            //Split each one up
            $parts = explode('/:', $url);

            $beforeQueryString = array_shift($parts);

            $queryStringItems = array();
            for($x=0; $x<=count($this->requestURIParts) + 1; $x++) {
                if('/' . implode('/', $this->requestURIParts) == $beforeQueryString) {
                    
                    //See if it's set to secure
                    if($elements['secure']) {
                        $this->authenticateRequest($elements['accessLevel'] || 1);
                    }
                    
                    if(count($queryStringItems) !== count($parts)) {
                        $this->error(QUERY_STRING_MISMATCH);
                    }
                    
                    if(count($queryStringItems) && count($parts)) {
                        $queryStringItems = array_reverse($queryStringItems);
                        foreach($parts as $i => $part) {
                            $this->getVals[$part] = $queryStringItems[$i];
                        }
                    }
                    
                    $currentModule = $elements['module'];
                    $currentAction = $elements['action'];
   
                    $file = $this->modulesPath . $currentModule .'/actions.php';
                    $this->postVals = $_POST;
                    
                    //Set values from the request payload too
                    $raw = '';
                    $httpContent = fopen('php://input', 'r');
                    while ($kb = fread($httpContent, 1024)) {
                        $raw .= $kb;
                    }
                    fclose($httpContent);
                    
                    //print_r($raw);
                    $this->headerVals = json_decode($raw, true);
                    //print($this->headerVals);
                    
                    //echo 'here:<br/>';
                    //echo $raw;
                
                  
                    if(file_exists($file)) {
                        require_once($file);
                        
                        
                        
                        if(class_exists($currentModule)) {
                            if(method_exists($currentModule, $currentAction)) {
                                //instantiate
                                $userClass = new $currentModule;
                                $userClass->setContext($this);
                                call_user_func(array($userClass, $currentAction));
                            }else{
                                $this->error(ACTION_NOT_FOUND);
                            }
                        }else{
                            $this->error(MODULE_NOT_FOUND);
                        }
                        
                    }else{
                        $this->error(MODULE_NOT_FOUND);
                    }

                    return;
                }else{
                    array_push($queryStringItems, array_pop($this->requestURIParts));
                }
            }
        }

        //If we get to here we are 404
        $this->pageNotFound();
    }
    
    
    function getMethod() {
        return $this->method;
    }
    
    function getPOSTvals() {
        return $this->postVals;
    }
    
    function getHEADERvals() {
        return $this->headerVals;
    }
    
    function getPostVal($key) {
        
        $vals = $this->getPostVals();
        if(isset($vals[$key])) {
            //print($key);
            return $vals[$key];
        }else{
            //print('here');
            $vals = $this->getHEADERvals();
            //print_r($vals);
            //print('here2');
            if(isset($vals[$key])) {
                return $vals[$key];
            }
        }
        return false;
    }
    
    function getGETVals() {
        return $this->getVals;
    }
    
    function getGetVal($key) {
        
        return $this->getPostVal($key);
        
    }
    
    function returnSuccess($object) {
        header('Content-Type: text/html; charset=utf-8');
        $this->jsonOutput($object);
    }
    
    function pageNotFound() {
        header("HTTP/1.0 404 Not Found");
        $this->jsonOutput($this->createResponse(TYPE_ERROR, CODE_404, CODE_404_MESSAGE));
        die();
    }
    
    function error($msg) {
        header("HTTP/1.0 500 Internal Server Error");
        $this->jsonOutput($this->createResponse(INTERNAL_ERROR, CODE_500, $msg));
        die();
    }
    
    function softError($msg) {
        $errors['success'] = false;
        $errors['message'] = $msg;
        $this->jsonOutput($errors);
    }
    
    function notLoggedIn() {
        header("HTTP/1.0 403 Not logged in");
        $this->jsonOutput($this->createResponse(NOT_LOGGED_IN, CODE_403, NOT_LOGGED_IN));
        die();
    }
    
    function setSessionVar($var, $val) {
        $_SESSION[$var] = $val;
    }
    
    function getSessionVar($var) {
        if(isset($_SESSION[$var])){
            return $_SESSION[$var];
        }
        return false;
    }
    
    function unsetSessionVar($var) {
        unset($_SESSION[$var]);
    }
    
    function authenticateRequest($level) {
        if(!isset($_SESSION['userAccess']) || $_SESSION['userAccess'] < $level) {
            $this->notLoggedIn(NOT_LOGGED_IN);
        }
    }
    
    function createResponse($type, $code, $text) {
        $message = array();
        $message['responseType'] = $type;
        $message['responseCode'] = $code;
        $message['responseMessage'] = $text;
        
        return $message;
    }
    
    function jsonOutput($json) {
        echo json_encode($json);
    }
    
    /**
     * Generic function to get the ExtJS filters from the REQUEST data
     *
     */
    function getFilters(){
        
        
        if (get_magic_quotes_gpc()) {
            $_REQUEST['filter'] = stripslashes($_REQUEST['filter']);
         }
         $f = json_decode($_REQUEST['filter']);
         if ( is_array($f) ){
            foreach ($f as $key=>$obj){
               $filters[$obj->property] = $obj->value;
            }
         }
         
         return $filters;
    }
    
    /**
     * Generic function to get the ExtJS sort from the REQUEST data
     *
     */
    function getSort(){
        
        
        if (get_magic_quotes_gpc()) {
            $_REQUEST['sort'] = stripslashes($_REQUEST['sort']);
         }
         $f = json_decode($_REQUEST['sort']);
         if ( is_array($f) ){
            foreach ($f as $key=>$obj){
               $sort[$obj->property] = $obj->direction;
            }
         }
         
         return $sort;
    }
    
}

?>

<?php
session_start();
if($_POST) {
    
    if($_POST['username'] == "simply1" && $_POST['password'] == "magenta1") {
        
        $_SESSION['admin'] = true;
        
        header("Location: index.php");
        die();
    }
    
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    
<html>

    <head>
        <title>Simply Tickets</title>
        
        <link rel="stylesheet" type="text/css" href="css/simplyTickets.css" />
        
        
    </head>
    
    <body onload="document.getElementById('username').focus();">
        
	<div class="header">
	    <div class="inner">
		<img src="images/common/logo.png" alt="Simply Theatre" class="logo" />
	    </div>
	</div>
	
	<div class="app">
	    
	    <h1>Admin Login</h1>
            
            <p>Please login below.  Please note this is only for the use of Simply Theatre staff.</p>
            
            <form action="login.php" method="POST" id="loginForm">
                <div class="fieldWrapper">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" /><br/>
                </div>
                
                <div class="fieldWrapper">
                    <label for="password">Password:</label>
                    <input type="password" name="password" />
                </div>
                
                <div class="buttonWrapper" onclick="document.getElementById('loginForm').submit();">
                    <button>Login</button>
                </div>
            </form>
	    
	</div>
	
	<div class="footer">
	    Powered by <a href="#">Sedes</a> v0.1.0 | &copy; 2012
	</div>

    </body>
    
</html>
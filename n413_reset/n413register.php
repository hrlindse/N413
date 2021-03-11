<?php
	//workaround for older version of PHP (older than 5.5) that does not support password_hash()
	//require "lib/password.php";
	
    include("n413connect.php");
    
    function sanitize($item){
        global $link;
        $item = html_entity_decode($item);
        $item = trim($item);
        $item = stripslashes($item);
        $item = strip_tags($item);
        $item = mysqli_real_escape_string( $link, $item );
        return $item;
    }
        
	$messages = array();
    $messages["status"] = 0;
    $messages["errors"] = 0;
    $messages["username_length"] = "";
    $messages["password_length"] = "";
    $messages["username_exists"] = "";
    $messages["email_exists"] = "";
    $messages["email_validate"] = "";
    $messages["success"] = "";
    $messages["failed"] = ""; 
               
    $username = "";
    $email = "";
    $password = "";
        
    if(isset($_POST["username"])) { $username = $_POST["username"]; }
    trim($username); //delete leading and trailing spaces
    if(strlen($username) < 5){
        $messages["errors"] = 1;
        $messages["username_length"] = "The username must have at least 5 characters.";
    }else{
        $username = sanitize($username); 
    }
    
    if(isset($_POST["email"])) { $email = $_POST["email"]; }   
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    	$email = sanitize($email);
    }else{
    	$messages["errors"] = 1;
    	$messages["email_validate"] = "There are problems with the e-mail address.  Please correct them.";
    }
	    
    if(isset($_POST["password"])) { $password = $_POST["password"];}
    trim($password); //delete leading and trailing spaces          
    if(strlen($password) < 8){
        $messages["errors"] = 1;
        $messages["password_length"] = "The password must have at least 8 characters.";
    }else{
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		if($encrypted_password){ 
			$password = $encrypted_password; 
		}else{
			$messages["errors"] = 1;
			$messages["password_length"] = "Password encryption failed.  You cannot register at this time";
		}
    } 

	if( ! $messages["errors"] ){
		$sql = "SELECT * FROM `users_hash` WHERE username = '".$username."'";
		$result = mysqli_query($link, $sql); 
		if(mysqli_num_rows($result) > 0){
			$messages["errors"] = 1;
        	$messages["username_exists"] = "This username already exists.  Please select another username.";
		}

		$sql = "SELECT * FROM `users_hash` WHERE email = '".$email."'";
		$result = mysqli_query($link, $sql); 
		if(mysqli_num_rows($result) > 0){
			$messages["errors"] = 1;
        	$messages["email_exists"] = "This email is already in use.  You cannot register another account with this email address.";
		}
	}
    
    if( ! $messages["errors"] ){
        $sql = "INSERT INTO `users_hash` (`id`, `username`, `email`, `password`, `role`) 
                VALUES (NULL, '".$username."', '".$email."', '".$password."', '0')";
        $result = mysqli_query($link, $sql);  
    
        $user_id = mysqli_insert_id($link);
        if($user_id){
            session_start();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["role"] = "0";
        } // if($user_id)
    }  // if( ! $messages["errors"] )  
//	
	if(isset($_SESSION["user_id"])){
    	$messages["status"] = "1";
        $messages["success"] = '<h3 class="text-center">You are now Registered and Logged In.</h3>';
    }else{
        $messages["failed"] = '<h3 class="text-center">The Registration was not successful.</h3><div class="col-12 text-center"><a href="register.php" class="text-center"><button class="btn btn-primary mt-5">Try Again</button></a></div>';
    }
	     
    echo json_encode($messages);

 ?>
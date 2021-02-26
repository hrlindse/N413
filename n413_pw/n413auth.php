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
	$messages["role"] = "";
    $messages["success"] = "";
    $messages["failed"] = "";
    
    $username = "";
    $password = "";
        
    if(isset($_POST["username"])) { $username = sanitize($_POST["username"]); }
    if(isset($_POST["password"])) { $password = $_POST["password"]; }
    
    $sql= "SELECT * FROM `users_hash` 
           WHERE username = '".$username."'
           LIMIT 1";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);    

    if(password_verify($password, $row["password"])){
        session_start();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["role"] = $row["role"];
    } 
    
    if(isset($_SESSION["user_id"])){
        $messages["status"] = "1";
		$messages["role"] = $_SESSION["role"];
        $messages["success"] = '<h3 class="text-center">You are now Logged In.</h3>';
    }else{
        $messages["failed"] = '<h3 class="text-center">The Log-in was not successful.</h3>
        <div class="col-12 text-center"><a href="login.php"><button type="button" class="btn btn-primary mt-5">Try Again</button></a></div>';
    }  
    
    echo json_encode($messages);
?>

<?php
    include("n413connect.php");

    $messages = array();
    $messages["status"] = 0;
    $messages["errors"] = 0;
    $messages["password_error"] = "";
    $messages["user_message"] = ""; 

    $password = "";
    $user_id = 0;
	$token = '';
	$validated = false;
	
	if(isset($_POST["id"])){ 
	    $user_id = intval($_POST["id"]); 
    }else{
	    $messages["errors"] = true;
	    $messages["password_error"] = 'Password cannot be reset';
    }
	
	//revalidate the token and the user id
	if(isset($_POST["token"])){ $token = $_POST["token"]; }
	if($token > ''){
		$sql="SELECT * from password_reset_log WHERE reset_token = '".$token."'";
		$result = mysqli_query($link, $sql); 
		if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_BOTH);
            if($user_id == $row["user_id"]){ $validated = true; }
		}
	} //if($token > '')
    
	if( $validated ){  
		if(isset($_POST["password"])) { 
			$password = $_POST["password"];
			trim($password); //delete leading and trailing spaces          
			if(strlen($password) < 8){
			    $messages["errors"] = true;
			    $messages["password_error"] = "The password must have at least 8 characters.";
		    }else{
			    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
			    if($encrypted_password){ 
				    $password = $encrypted_password; 
			    }else{
				    $messages["errors"] = true;
				    $messages["password_error"] = "Password encryption failed.  You cannot reset your password at this time.";
				} //if($encrypted_password)
			} //if(strlen($password) < 8)
		} //end - else - if(isset($_POST["password"]))
	}else{  
		$messages["errors"] = true;
	} // if ($validated)

    if( ! $messages["errors"] ){
	    $sql = "UPDATE users_hash set `password` = '".$password."' WHERE id = '".$user_id."' ";
		$result = mysqli_query($link, $sql); 
		if(mysqli_affected_rows($link) == 1){
			session_start();
			$_SESSION["user_id"] = $user_id;
		}else{
			$messages["errors"] = true;
			$messages["password_error"]  = 'There was a problem with the database.<br/>Your password cannot be reset';
	    }  // if( ! mysqli_affected_rows($link) == 1
    } // if ( ! $messages["errors"]  )

    if ($_SESSION["user_id"] > 0){
        $messages["status"] = 'success';
        $messages["user_message"] = '<p>Your password has been successfully reset.<br/><br/>
		<a href="login.php"><button type="button" class="btn btn-info">Log In</button></a></p>';
        echo json_encode($messages);
    }else{ 
        $messages["status"] = 'failed';
	    echo json_encode($messages);
    } // -end else- if ($_SESSION["user_id"] > 0)
	
	$sql = "DELETE from password_reset_log WHERE reset_token = '".$token."'";
	$result = mysqli_query($link, $sql); 

    session_write_close();

?>
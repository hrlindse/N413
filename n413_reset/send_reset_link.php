<?php
    include("n413connect.php");
	include("n413_email_config.php");
    
    $messages = array();
    $messages["status"] = 0;
    $messages["errors"] = 0;
    $messages["email_error"] = "";
    $messages["user_message"] = ""; 

    $user_id = 0;
    $email = "";
    if(isset($_POST["email"])){
        $email = html_entity_decode($_POST["email"]);
        $email = trim($email);
        //check for an empty username
        if (strlen($email) < 1){
            $messages["errors"] = true;
            $messages["email_error"] = 'You must enter your email address.';
        } // if (strlen($email < 1)

        //check for valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $messages["errors"] = true;
            $messages["email_error"] = 'You must enter a valid email address.';
        }else{  //  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            $email = stripslashes($email);
            $email = strip_tags($email);
            $email = mysqli_real_escape_string( $link, $email );
        }  // -end else-  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	
    }  //  if(isset($_POST["email"]))

    if(! $messages["errors"] ){
        $sql = "SELECT id FROM users_hash 
                WHERE email = '".$email."' ";
        $result = mysqli_query($link, $sql); 

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_BOTH);
            $user_id = $row["id"];
            $token = sha1($email.time());
	 
            $sql = "INSERT INTO `password_reset_log` (`id`, `user_id`, `reset_token`, `timestamp`) 
                    VALUES (NULL, '".$user_id."', '".$token."', NOW())";
            $result = mysqli_query($link, $sql); 

            if(mysqli_affected_rows($link) == 1){
                //define the headers
                $to = $_POST["email"];
                //$from is defined in the "config" file.
                $subject = 'Password Reset Request';
                $message_text = '
A password reset request has been made for your Bread Site account that uses this e-mail address.  If you did not initiate this request, please notify the security team at once.
			
If you made the request, please click on the link below to reset your password.  This link will expire one hour from the time this e-mail was sent.
			
'.$reset_link.'?token='.$token;  //$reset_link is defined in the "config" file.
			
                //be sure the /r/n (carriage return) characters are in DOUBLE QUOTES!  
                //PHP treats single quoted escaped characters differently, and things will break
                $headers = 'From: '.$from . "\r\n" .
                'Reply-To: '.$from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message_text, $headers);
            }else{
                $messages["errors"] = true;
                $messages["email_error"] = "There was a problem with the database.  Your password cannot be reset.";
            }
        }else{  // else - if(mysqli_num_rows($result) == 1)
            $messages["email_error"] = "The e-mail address you entered was not found in the database.<br>
            Check to be sure the e-mail address is correct and try again.";
        }  //  end else - if(mysqli_num_rows($result) == 1) 
    } // if (! $messages["errors"] )            

    if ((! $messages["errors"])&&($user_id > 0)){
        $messages["status"] = 'success';
        $messages["user_message"] = "A link to reset your password has been mailed to your e-mail address.<br/>The link is valid for 1 hour.";
        echo json_encode($messages);
    }else{
        $messages["status"] = 'failed';
        echo json_encode($messages);
    }   
?>
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



if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
    //if id is set in query, get user with that id

    //check if task exists in table
    $sql = "SELECT 1 FROM `users` WHERE id = ". $_GET['id'] ;
    $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
    if($result != "") {
        //get task
        $sql = "SELECT * FROM users WHERE id=". $_GET['id'];
        $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
        $records = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
            $records[] = $row;
        }
        echo json_encode($records); //convert php data to json data
    } else {
        echo("Error: User doesn't exist");
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //get current user session
    if(isset($_SESSION["user_id"])){
        echo("User logged in");
    } else {
        echo("Not logged in");
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messages = array();
    $messages["status"] = 0;
    $messages["role"] = "";
    $messages["success"] = "";
    $messages["failed"] = "";

    $username = "";
    $password = "";

    // Takes raw data from the request
    $json = file_get_contents('php://input');

    // Converts it into a PHP object
    $data = json_decode($json);

    if(isset($data->username)) { $username = sanitize($data->username); }
    if(isset($data->password)) { $password = $data->password; }

    $sql= "SELECT * FROM `users` 
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
        $messages["token"] = $_SESSION["user_id"];
    }else{
        $messages["failed"] = 'The Log-in was not successful, please try again';
    }

    echo json_encode($messages);

} else if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {


} else {
    echo "Error";
}

?>

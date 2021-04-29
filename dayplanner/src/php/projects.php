<?php
include("./n413connect.php");

if (isset($_GET['uid']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
    //if id is set in query, get task with that id
    $sql = "SELECT * FROM projects WHERE userID=". $_GET['uid'];
    $result = mysqli_query($link, $sql);
    $records = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $records[] = $row;
    }
    echo json_encode($records); //convert php data to json data
}


?>
<?php
include("./n413connect.php");

function sanitize($item){
    global $link;
    $item = html_entity_decode($item);
    $item = trim($item);
    $item = stripslashes($item);
    $item = strip_tags($item);
    $item = mysqli_real_escape_string( $link, $item );
    return $item;
}

// todo : add condition for user ID
if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
    //if id is set in query, get task with that id
    $sql = "SELECT events.id , events.userID, events.title, events.startDateTime, 
            events.endDateTime, events.description, events.priority, 
            events.tags, events.priority, projects.title AS projectTitle, 
            events.projectID AS projectID
            FROM events
            LEFT JOIN projects ON events.projectID = projects.id
            WHERE events.id=". $_GET['id'];
    $result = mysqli_query($link, $sql);
    $records = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $records[] = $row;
    }
    echo json_encode($records); //convert php data to json data
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $monday = $_GET['monday'];
    $sunday = $_GET['sunday'];
    $uid = $_GET['uid'];


    // get request - get all tasks
    $sql = "SELECT * FROM `events` WHERE userID = ". $uid . "
                AND startDateTime BETWEEN '". substr($monday, 0, 10)."' AND '".substr($sunday, 0, 10) ."'";
    $result = mysqli_query($link, $sql);
    $records = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $records[] = $row;
    }
    echo json_encode($records); //convert php data to json data
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Takes raw data from the request
    $json = file_get_contents('php://input');

    // Converts it into a PHP object
    $data = json_decode($json);

    //update with post
    if (isset($data->id)) {
        //patch request
        $id = sanitize($data->id);

        //check if task exists in table
        $sql = "SELECT 1 FROM `events` WHERE id = ". $id ;
        $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
        if($result != "") {
            //update
            $sql = "UPDATE `events` SET";
            if (isset($data->title)) {
                $title = sanitize($data->title);
                $sql .= " title = '" . $title . "',";
            }
            if (isset($data->description)) {
                $description = sanitize($data->description);
                $sql .= " description = '" . $description . "',";
            }
            if (isset($data->startDateTime)) {
                $startDateTime = sanitize($data->startDateTime);
                $sql .= " startDateTime = '" . $startDateTime . "',";
            }
            if (isset($data->endDateTime)) {
                $endDateTime = sanitize($data->endDateTime);
                $sql .= " endDateTime = '" . $endDateTime . "',";
            }
            if (isset($data->project)) {
                $project = sanitize($data->project);
                $sql .= " projectID = " . $project . ",";
            }
            if (isset($data->tags)) {
                $tags = sanitize($data->tags);
                $sql .= " tags = '" . $tags . "',";
            }
            if (isset($data->priority)) {
                $priority = sanitize($data->priority);
                $sql .= " priority = " . $priority ;
            }

            // remove last comma if needed
            if(substr($sql, -1) === ",") {
                $sql = substr($sql, 0, strlen($sql)-1);
            }

            $sql .= " WHERE id = ". $id;
            $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
            echo $sql;
        } else {
            echo("Error: Task does not exist");
        }
    } else {
        //post request
        $title = sanitize($data->title);
        $uid = sanitize($data->uid);
        if (isset($data->description)) {
            $description = sanitize($data->description);
        } else $description = "null";
        $startDateTime = sanitize($data->startDateTime);
        $endDateTime = sanitize($data->endDateTime);
        if (isset($data->project)) {
            $project = sanitize($data->project);
        } else $project = "null";
        if (isset($data->tags)) {
            $tags = sanitize($data->tags);
        } else $tags = "null";
        if (isset($data->priority)) {
            $priority = sanitize($data->priority);
        } else $priority = "null";

        //check if task exists in table
        //post
        $sql = "INSERT INTO `events` (userID, title, description, startDateTime, endDateTime, projectID, tags, priority) VALUES (" . $uid . ", '" . $title .
            "', '" . $description . "', '" . $startDateTime . "', '" . $endDateTime . "',  " . $project . " , '" . $tags . "', " . $priority . ") ";
        $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($link), E_USER_ERROR);
        echo $sql;

    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    // Takes raw data from the request
    $json = file_get_contents('php://input');

    // Converts it into a PHP object
    $data = json_decode($json);

    //patch request
    $id = sanitize($data->id);

    //check if task exists in table
    $sql = "SELECT 1 FROM `events` WHERE id = ". $id ;
    $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
    if($result != "") {
        //update
        $sql = "UPDATE `events` SET";
        if (isset($data->title)) {
            $title = sanitize($data->title);
            $sql .= " title = '" . $title . "',";
        }
        if (isset($data->description)) {
            $description = sanitize($data->description);
            $sql .= " description = '" . $description . "',";
        }
        if (isset($data->startDateTime)) {
            $startDateTime = sanitize($data->startDateTime);
            $sql .= " startDateTime = '" . $startDateTime . "',";
        }
        if (isset($data->endDateTime)) {
            $endDateTime = sanitize($data->endDateTime);
            $sql .= " endDateTime = '" . $endDateTime . "',";
        }
        if (isset($data->project)) {
            $project = sanitize($data->project);
            $sql .= " projectID = " . $project . ",";
        }
        if (isset($data->tags)) {
            $tags = sanitize($data->tags);
            $sql .= " tags = '" . $tags . "',";
        }
        if (isset($data->priority)) {
            $priority = sanitize($data->priority);
            $sql .= " priority = " . $priority ;
        }

        // remove last comma if needed
        if(substr($sql, -1) === ",") {
            $sql = substr($sql, 0, strlen($sql)-1);
        }

        $sql .= " WHERE id = ". $id;
        $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
        echo $sql;
    } else {
        echo("Error: Task does not exist");
    }
} else {
    echo "Error";
}

?>
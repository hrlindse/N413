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

    //check if task exists in table
    $sql = "SELECT * FROM `tasks` WHERE id = ". $_GET['id'] ;
    $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
    if($result != "") {
        //get task
        $sql = "SELECT tasks.id , tasks.userID, tasks.title, tasks.date, tasks.completed, 
            tasks.description, tasks.priority, tasks.tags, tasks.priority, 
            projects.title AS projectTitle, tasks.projectID AS projectID
            FROM tasks
            LEFT JOIN projects ON tasks.projectID = projects.id
            WHERE tasks.id=". $_GET['id'];
        $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
        $records = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
            $records[] = $row;
        }
        if(count($records) == 0){
            echo "error: no record returned: ".$sql ;
        } else {
            echo json_encode($records); //convert php data to json data
        }
    } else {
        echo("Error: Task doesn't exist");
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $day = $_GET['day'];
    $uid = $_GET['uid'];


    // get request - get all tasks
    $sql = "SELECT id, userID, title, date, completed, description, priority, projectID, tags FROM `tasks` WHERE userID=". $uid ." AND date = '". substr($day, 0, 10) ."'";
    $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
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

    // update with post
    if(isset($data->id)) {
        //patch request
        $id = sanitize($data->id);

        //check if task exists in table
        $sql = "SELECT 1 FROM `tasks` WHERE id = ". $id ;
        $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
        if($result != "") {
            //update
            $sql = "UPDATE `tasks` SET";
            if (isset($data->title)) {
                $title = sanitize($data->title);
                $sql .= " title = '" . $title . "',";
            }
            if (isset($data->description)) {
                $description = sanitize($data->description);
                $sql .= " description = '" . $description . "',";
            }
            if (isset($data->date)) {
                $date = sanitize($data->date);
                $sql .= " date = '" . $date . "',";
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
                $sql .= " priority = '" . $priority . "',";
            }
            if (isset($data->completed)) {
                $completed = sanitize($data->completed);
                $sql .= " completed = " . $completed ;
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
//    $id = sanitize($data->id);
        $title = sanitize($data->title);
        $uid = sanitize($data->uid);
        if (isset($data->description)) {
            $description = sanitize($data->description);
        } else $description = "null";
        $date = sanitize($data->date);
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
//    $sql = "SELECT 1 FROM `tasks` WHERE id = ". $id ;
//    $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
//    if($result = "") {
        //post
        $sql = "INSERT INTO `tasks` (userID, title, description, date, projectID, tags, priority) VALUES ( " . $uid . ", '" . $title .
            "', '" . $description . "', '" . $date . "',  " . $project . " , '" . $tags . "', " . $priority . ") ";
        $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($link), E_USER_ERROR);
        echo $sql;
//    } else {
//        echo("Error: Task already exists");
//    }
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    // Takes raw data from the request
    $json = file_get_contents('php://input');

    // Converts it into a PHP object
    $data = json_decode($json);

    //patch request
    $id = sanitize($data->id);

    //check if task exists in table
    $sql = "SELECT 1 FROM `tasks` WHERE id = ". $id ;
    $result = mysqli_query($link, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
    if($result != "") {
        //update
        $sql = "UPDATE `tasks` SET";
        if (isset($data->title)) {
            $title = sanitize($data->title);
            $sql .= " title = '" . $title . "',";
        }
        if (isset($data->description)) {
            $description = sanitize($data->description);
            $sql .= " description = '" . $description . "',";
        }
        if (isset($data->date)) {
            $date = sanitize($data->date);
            $sql .= " date = '" . $date . "',";
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
            $sql .= " priority = '" . $priority . "',";
        }
        if (isset($data->completed)) {
            $completed = sanitize($data->completed);
            $sql .= " completed = " . $completed ;
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
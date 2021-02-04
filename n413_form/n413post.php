<?php
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
        
        $name = "";
        $email = "";
        $question = "";
        
        if(isset($_POST["name"])) { $name = sanitize($_POST["name"]); }
    	if(isset($_POST["email"])) { $email = sanitize($_POST["email"]); }
        if(isset($_POST["question"])) { $question = sanitize($_POST["question"]); }
        
        $sql = "INSERT INTO `form_responses` (`id`, `name`, `email`, `question`, `timestamp`) 
        	VALUES (NULL, '".$name."', '".$email."', '".$question."', CURRENT_TIMESTAMP)";
        $result = mysqli_query($link, $sql);
        
    ?>
    
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
		<title>Form Project</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/jquery-3.4.1.min.js" type="application/javascript"></script>
	</head>       
	<body>
        <div id="content">
            <h2>Ask a question!</h2>
            <div id="container">
            <?php
                if($result){
                    echo '<p>Your question has been submitted! we will get back to you soon with a response!<br/> </p><p>Your question:</p> <div class="question">' . $question . '</div>';
                }else{
                    echo '<p>Sorry, but there was an error submitting your question.  <br/></p>';
                }
            ?>
                <br><a href="form_1.html">Back to form</a>
            </div>
        </div>
	</body>
</html>
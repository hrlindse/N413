<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
            <title>Bread Site</title>
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/styles.css" rel="stylesheet" />
    
            <script src="js/jquery-3.4.1.min.js" type="application/javascript"></script>
            <script src="js/bootstrap.min.js" type="application/javascript"></script>
            <!--<script src="js/bootstrap.min.js.map" type="application/javascript"></script>-->
            

            <script>
				function navbar_update(this_page){
					$("#"+this_page+"_item").addClass('active');
					$("#"+this_page+"_link").append(' <span class="sr-only">(current)</span>');
				}
			</script>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-info">
               <a class="navbar-brand" href="index.php">Bread Site</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                     <li id="home_item" class="nav-item">
                        <a id="home_link" class="nav-link" href="index.php">Home</a>
                     </li>
                    <li id="list_item" class="nav-item">
                        <a id="list_link" class="nav-link" href="list.php">The List</a>
                     </li>
                     <li id="contact_item" class="nav-item">
                        <a id="contact_link" class="nav-link" href="form.php">Contact</a>
                     </li>
                  </ul>
                  <ul id="right_navbar" class="navbar-nav ml-auto mr-5">
                   <?php 
					session_start();
                    if(isset($_SESSION["user_id"])){
						if($_SESSION["role"] > 0){
							echo '
                            <li id="messages_item" class="nav-item">
								<a id="messages_link" class="nav-link" href="messages.php">Questions</a>
							</li>';
						}
                        echo '
                            <li id="logout_item" class="nav-item">
                                <a id="logout_link" class="nav-link" href="logout.php">Log-Out</a>
                            </li>';
                    }else{
                    	echo '
							<li id="register_item" class="nav-item">
								<a id="register_link" class="nav-link" href="register.php">Register</a>
							</li>        
                            <li id="login_item" class="nav-item">
                                <a id="login_link" class="nav-link" href="login.php">Log-In</a>
                            </li>';
                    }
                    ?>
                    </ul>
               </div>
            </nav>
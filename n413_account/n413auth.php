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
        
        $username = "";
        $password = "";
        
        if(isset($_POST["username"])) { $username = sanitize($_POST["username"]); }
    	if(isset($_POST["password"])) { $password = sanitize($_POST["password"]); }
		
		$sql= "SELECT * FROM `users` 
               WHERE username = '".$username."'
               AND password = '".$password."'
               LIMIT 1";
			   
        $result = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
		if($row){
			session_start();
			$_SESSION["user_id"] = $row["id"];
			$_SESSION["role"] = $row["role"];
		}
		
		include("head.php");
?>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>Bread Site Log-in</h2>
        </div> <!-- /col-12 -->
    </div> <!-- /row -->
    <div class="row mt-5">
        <div class="col-4"></div>  <!-- spacer -->
        <div class="col-4 text-center">
        <?php
            if(isset($_SESSION["user_id"])){
                echo '<h3>You are now Logged In.</h3>';
            }else{
                echo '<h3>The Log-In was not sucessful.</h3>
                      <a href="login.php"><button class="btn btn-info mt-5">Try Again</button></a>';
            }
			
        ?>
        </div> <!-- /.col-4 -->
    </div> <!-- /.row --> 
</div>  <!-- /.container-fluid -->
</body>

</body>
<script>
    var this_page = "login";
    var page_title = 'Bread Site | Login';
		
    $(document).ready(function(){ 
            document.title = page_title;
            navbar_update(this_page);
        }); //document.ready
</script>
</html>
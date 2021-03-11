<?php
    include("n413connect.php");

    $user_id = 0;
    $user_message = "";
	
	$token = "";
	if(isset($_GET["token"])){
		$token = html_entity_decode($_GET["token"]);
		$token = trim($token);
		$token = stripslashes($token);
		$token = strip_tags($token);
		$token = mysqli_real_escape_string( $link, $token );
		
		$sql = "SELECT user_id, timestamp FROM password_reset_log 
			WHERE reset_token = '".$token."' ";
		$result = mysqli_query($link, $sql); 
		if (mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);
			$user_id = $row["user_id"];
			$link_time = $row["timestamp"];
			
			$sql = "SELECT TIMESTAMPDIFF(SECOND, '".$link_time."', NOW()) as time_elapsed";
			$result = mysqli_query($link, $sql);
			
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);
			if ($row["time_elapsed"] < 3600){  //1 hour
				$link_status = "valid";
			}else{  //if ($row["time_elapsed"] > 3600)
				$link_status = "expired";
			}  //  -end else- if ($row["time_elapsed"] > 3600)
		}else{ // if (mysqli_num_rows() == 1)
			$link_status = "no_record";
		} // -end else- if (mysqli_num_rows() == 1)
	}else{ // if(isset($_GET["token"]))
		$link_status = "no_token";
	}// -end else- if(isset($_GET["token"]))
	
	switch ($link_status){
		case "valid":
			$user_message .='
			<div id="user_message" class="success">
				<p>Please enter a new password to use with your account.<br/>It must have at least 8 characters.</p>
				<form id="password_form" name="password_form" class="form-horizontal" method="" action="" >
				    <div class="row">
				        <div class="col-3"></div>
				        <div class="col-6">			
				            <div class="form-group"> 
				                <label for="password" class="control-label">Password </label>
				                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
				                <div id="password_error" style="display:none;color:#990000;"></div>
				            </div> <!--  /.form-group  -->
				            <button type="submit" class="btn btn-info float-right">Submit</button>
				        </div>  <!--  /.col-6  -->
				    </div>  <!--  /.row  -->					
				</form>
			</div>  <!--  /.success  -->	';
		break;
		case "expired":
			$user_message .='
				<div class="error">
					<p>The password reset link has expired.</p>
					<p>Your password cannot be reset using this link.</p>
				</div>';
		break;
		case "no_record":
		case "no_token":
		default:
			$user_message .='
				<div class="error">
					<p>The password reset token is not valid.</p>
					<p>Your password cannot be reset using this link.</p>
				</div>';
		break;
	}//switch
?>	
	
<?php 
    include("head.php"); 
?>
	<style>
	.error  { padding:30px;text-align:center;font-size:18px;font-weight:700;background-color:#ffffff;border:4px solid #990000; }
	.success{ text-align:left;font-size:18px;font-weight:400; }
	.success > p { text-align:center;margin-bottom:30px; }
	</style>
	<div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <h2>Bread Site Password Reset</h2>
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <div class="row">
            <div class="col-3"></div>  <!-- spacer -->
            <div class="col-6 text-center mt-5">
            <?= $user_message ?>
            </div>  <!-- /col-6 -->
        </div>  <!-- /row -->
    </div>  <!-- /container-fluid -->
</body>
<script type="text/javascript">
$(document).ready(function(){ 
    // Attach a submit handler to the form
    $( "#password_form" ).submit(function( event ) {
        event.preventDefault();
        $.post("update_password.php",
            {id:<?php echo $user_id; ?>, password:$("#password").val(), token:'<?=$token?>'},
            function(data){
                //reset any previous error messages
                $("#password_error").html("");
                $("#password_error").css("display","none");
										
                if(data.status == "success"){
                    if(data.user_message > ' ' ){
                        $("#user_message").html(data.user_message);
                        $("#user_message").css("display","block");
                    }
                }else{
                    if(data.password_error > ' '){
                        $("#password_error").html(data.password_error);
                        $("#password_error").css("display","block");
                    }
                }
            },
            "json"
        ); //post
    }); //submit
}); //ready
</script>
                    
</html>

<?php
    include("head.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>Bread Site Log-in</h2>
        </div> <!-- /col-12 -->
    </div> <!-- /row -->

    <form id="login_form" method="POST" action="">
        <div class="row mt-5">
            <div class="col-4"></div>  <!-- spacer -->
            <div id="form-container" class="col-4">
                <label for="username">User Name: </label><input type="text" id="username" name="username" class="form-control" value="" placeholder="Enter User Name" required/><br/>
                <label for="password">Password: </label><input type="password" id="password" name="password" class="form-control" value="" placeholder="Enter Password" required/><br/>
                <button type="submit" id="submit" class="btn btn-info float-right">Submit</button>
                <a data-toggle="modal" class="text-info" href="#forgotModal">Forgot Password?</a>
            </div>  <!-- /#form-container -->
        </div>  <!-- /.row -->
    </form>
</div>
<script>
    var this_page = "login";
    var page_title = 'Bread Site | Login';
		
    $(document).ready(function(){ 
        document.title = page_title;
        navbar_update(this_page);
            
        $("#login_form").submit(function(event){
            event.preventDefault();
            $.post("n413auth.php",
                   $("#login_form").serialize(),
                   function(data){
                       //handle messages here
                       if(data.status){
                           $("#form-container").html(data.success);
                           right_navbar_update(data.role);
                       }else{
                           $("#form-container").html(data.failed);
                       }
                   },
                   "json"
            ); //post
        }); //submit 
    }); //document.ready
		
    function right_navbar_update(role){
        var html = "";
        if (role > 0) {
            html =  '<li id="messages_item" class="nav-item">'+
                    '<a id="messages_link" class="nav-link" href="messages.php">Messages</a>'+
                    '</li>';
        }
			
        html +=     '<li id="logout_item" class="nav-item">'+
                    '<a id="logout_link" class="nav-link" href="logout.php">Log-Out</a>'+
                    '</li>';		
        $("#right_navbar").html(html);
    }
</script>

<!-- --------------------------  AMP JAM RESET Reset Password Modal  ------------------------- -->
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bread Site Reset Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> 
            </div> <!-- /.modal-header -->
            <div class="modal-body">

                <form id="reset_form" name="reset_form" class="form-horizontal" method="" action="" >
                    <div class="row">
                        <div class="col-12">
                            <div class="row" style="padding:2em;">
                                <div class="form-group">
                                    <label for="email" class="control-label">Enter your E-mail:</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="E-mail address">
                                    <div id="email_error" style="display:none;color:#990000;"></div>
                                </div> <!--  /.form-group  -->
                            </div> <!-- /.row -->   
                            <div class="row row-gap">
                                <div class="col-11">
                                    <button type="submit" class="btn btn-info float-right">Reset Password</button>
                                    <div id="user_message" style="display:none;color:#990000;"></div>
                                </div>  <!-- /.col-11 -->
                            </div> <!-- /.row row-gap  -->
                        </div> <!-- /col-12 -->
                    </div> <!-- /.row --> 
                </form>

            </div>  <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>  <!-- /.modal-footer -->
         </div>  <!-- /.modal-content -->
    </div>  <!-- /.modal-dialog -->
</div>  <!-- /.modal --> 
<!--  --------------------------  end Reset Password Modal  ------------------------------  --> 

<script type="text/javascript"> 
    // Attach a submit handler to the form
    $( "#reset_form" ).submit(function( event ) {
        event.preventDefault();
        $.post("send_reset_link.php",
            {email:$("#email").val()},
            function(data){
                //reset the error messages
                $("#user_message").html("");
                $("#user_message").css("display","none");
                $("#email_error").html("");
                $("#email_error").css("display","none");
                if(data.status == "success"){
                    if(data.user_message != null){
                        $("#user_message").html(data.user_message);
                        $("#user_message").css("display","block");
                    }
                }else{
                    if(data.email_error != null){
                        $("#email_error").html(data.email_error);
                        $("#email_error").css("display","block");
                    }
                }
            },
            "json"
        ); //post
    });//submit
</script> 
</body> 
</html> 
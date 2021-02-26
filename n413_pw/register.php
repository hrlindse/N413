<?php
    include("head.php");
?>

<style>
    .error_msg { display:none;color:#C00; }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>Bread Site Registration</h2>
        </div> <!-- /col-12 -->
    </div> <!-- /row -->
    <form id="register_form" method="POST" action="">
    <div class="row mt-5">
        <div class="col-4"></div>  <!-- spacer -->
        <div id="form-container" class="col-4">
            <div>User Name: <input type="text" id="username" name="username" class="form-control" value="" placeholder="Enter User Name" required/></div>
            <div id="username_length" class="error_msg"></div>
            <div id="username_exists" class="error_msg"></div>
            <div class="mt-3">E-mail: <input type="email" id="email" name="email" class="form-control" value="" placeholder="Enter E-mail" required/></div>
            <div id="email_exists" class="error_msg"></div>
            <div id="email_validate" class="error_msg"></div>
            <div class="mt-3">Password: <input type="password" id="password" name="password" class="form-control" value="" placeholder="Enter Password" required/></div>
            <div id="password_length" class="error_msg"></div>
            <div class="mt-5"><button type="submit" id="submit" class="btn btn-info float-right">Submit</button></div>
        </div>  <!-- /#form-container -->
    </div>  <!-- /.row -->
</form>
</div>
</body>
<script>
    var this_page = "register";
    var page_title = 'Bread Site | Register';
		
    $(document).ready(function(){ 
            document.title = page_title;
            navbar_update(this_page);
            
            $("#register_form").submit(function(event){
                event.preventDefault();
                $.post( "n413register.php",
                        $("#register_form").serialize(),
                        function(data){
                            if(data.status){
                                $("#form-container").html(data.success);
                                right_navbar_update();
                            }else{
                                if(data.errors){
                                    // handle error messages here
                                    for (var key in data){
                                        switch(key){
                                            case "status":
                                            case "errors":
                                            case "success":
                                            case "failed":
                                                break;
                                            default: $("#"+key).html(data[key]);
                                                     $("#"+key).css("display","block");
                                                break;
                                        } //switch
                                    } //for-in
                                }else{
                                    $("#form-container").html(data.failed);  //registration failed, but without errors
                                } //if data.errors
                            } //if data.status
                        },  //callback function
                        "json"
                    ); //post
            }); //submit
        }); //document.ready
        
        function right_navbar_update(){
            var html = '<li id="logout_item" class="nav-item">'+
                       '<a id="logout_link" class="nav-link" href="logout.php">Log-Out</a>'+
                       '</li>';
							
            $("#right_navbar").html(html);
        }
</script>
</html>

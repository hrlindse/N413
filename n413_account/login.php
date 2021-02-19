<?php
    include("head.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>Bread Site Log-in</h2>
        </div> <!-- /col-12 -->
    </div> <!-- /row -->
    <form method="POST" action="n413auth.php">
    <div class="row mt-5">
        <div class="col-4"></div>  <!-- spacer -->
        <div id="form-container" class="col-4">
            <label for="username">User Name: </label><input type="text" id="username" name="username" class="form-control" value="" placeholder="Enter User Name" required/><br/>
            <label for="password">Password: </label><input type="password" id="password" name="password" class="form-control" value="" placeholder="Enter Password" required/><br/>
            <button type="submit" id="submit" class="btn btn-info float-right">Submit</button>
        </div>  <!-- /#form-container -->
    </div>  <!-- /.row -->
    </form>
</div>
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
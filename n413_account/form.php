<?php
	 include("head.php");
?>
    <div class="container-fluid">
    	<div class="row">
        	<div class="col-12 text-center mt-5">
            	<h2>Contact Form</h2>
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <form method="POST" action="n413post.php">   
        <div class="row mt-5">	
        	<div class="col-4"></div>  <!-- spacer -->
        	<div id="form-container" class="col-4">
                <label for="name">Name: </label><input type="text" id="name" name="name" class="form-control" value="" placeholder="Enter Name" required/><br/>
                <label for="email">E-mail: </label> <input type="email" id="email" name="email" class="form-control" value="" placeholder="Enter E-mail" required/><br/>
                <label for="question">Question: </label><br><textarea id="question" name="question" class="form-control" value="" placeholder="Add your question here:"></textarea><br/>
            	<button type="submit" id="submit" class="btn btn-info float-right">Submit</button>
        	</div> <!-- /#form-container" -->

        </div>  <!-- /row -->
        </form>
    </div>  <!-- /container-fluid -->
</body>
<script>
			var this_page = "contact";
			var page_title = 'Bread Site | Contact Form';
		
			$(document).ready(function(){ 
				document.title = page_title;
				navbar_update(this_page);
			}); //document.ready
</script>
</html>
        
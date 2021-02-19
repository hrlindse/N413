<?php
    include("n413connect.php");            
    include("head.php");
    $id = intval($_GET["id"]);
    $sql = "SELECT * FROM `list` WHERE id = '".$id."'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
?>
<div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12 text-center">
            <?php
               if($row){
                   echo '<h1>'.$row["item"].'</h1>';
               }else{
                   echo '<h2>There has been a database error.</h2>';
               }
            ?>
            </div> <!-- /.col-12 -->
        </div> <!-- /.row --> 
        <?php
            if($row){
                echo '      
                <div class="row mt-3">
                    <div class="col-1"></div>  <!-- spacer -->
                    <div class="col-5"><img src="images/'.$row["image"].'" width="100%"/></div>
                    <div class="col-5 h3 text-muted">'.$row["description"].'</div>
                </div>  <!-- /.row -->';
            }  
        ?>
		<div class="row mt-4">
            <div class="col-12 text-center">
            	<a href="list.php"><button class="btn btn-info">Back to The List</button>
            </div> <!-- /.col-12 -->
        </div> <!-- /.row --> 
    </div>  <!-- /.container-fluid -->       
</body>
	<script>
			var this_page = "detail";
			var page_title = 'AMP JAM Site | <?=$row["item"]?>';
		
			$(document).ready(function(){ 
				document.title = page_title;
				navbar_update(this_page);
			}); //document.ready
	</script>
</html>
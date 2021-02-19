<?php
    include("n413connect.php");            
    include("head.php");
    
    $messages = array();
    $sql = "SELECT * FROM `form_responses`
            ORDER BY timestamp DESC";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $messages[] = $row;
    }
?>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-12 text-center">
        <?php
            if(count($messages) > 0){
                echo '<h1>Contact Form Questions</h1>';
            }else{
                echo '<h2>There are no questions at this time.</h2>';
            }
        ?>
        </div> <!-- /.col-12 -->
    </div> <!-- /.row --> 
    <?php 
		if(isset($_SESSION["role"]) && $_SESSION["role"] > 0 ){
			foreach($messages as $message){
				echo'
			<div class="row mt-3">
				<div class="col-2"></div>  <!-- spacer -->
				<div class="col-2">'.$message["name"].'<br/>
					<a href="mailto:'.$message["email"].'">'.$message["email"].'</a><br/>
					['.$message["timestamp"].']
				</div>
				<div class="col-6 p-2 bg-light border rounded">'.$message["question"].'</div>
			</div> <!-- /.row -->';
			}
		}else{
			echo'
			<div class="row mt-3">
				<div class="col-12 text-center"><h3>You are not authorized to view the questions.</h3></div> 
			</div> <!-- /.row -->';
		}
		?>
</div>  <!-- /.container-fluid -->
</body>
<script>
    var this_page = "questions";
    var page_title = 'Bread Site | Questions';
		
    $(document).ready(function(){ 
            document.title = page_title;
			navbar_update(this_page);
        }); //document.ready
</script>
</html>

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
                    <div class="col-4"><img src="'.base_url().'assets/images/'.$row["image"].'" width="100%"/></div>
                    <div class="col-6">'.$row["description"].'</div>
                </div>  <!-- /.row -->';
            }  
        ?>
        <div class="row mt-4 mb-5">
            <div class="col-12 text-center">
            	<a href="<?=site_url()?>/litjams/litlist"><button class="btn btn-primary">Back to The List</button></a>
            </div> <!-- /.col-12 -->
        </div> <!-- /.row --> 
    </div> <!-- /.container-fluid -->   
</body>
</html> 
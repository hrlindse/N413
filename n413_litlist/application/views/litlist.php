
<style>
        .cursor-pointer {cursor:pointer;}
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <h2>LIT Top 10 List</h2>            
            </div> <!-- /.col-12 -->
        </div> <!-- /.row -->
        <?php
            foreach ($records as $record){
                echo '
                <div class="row record-item mt-5 cursor-pointer" data-id="'.$record["id"].'" data-item="'.$record["item"].'">
                    <div class="col-1"></div>  <!-- spacer -->
                    <div class="col-3"><img src="'.base_url().'assets/images/'.$record["image"].'" width="100%"/></div>
                    <div class="col-7"><b>'.$record["item"].'</b> '.$record["description"].'</div>
                </div>  <!-- /.row -->';
            } //foreach
        ?>            
    </div> <!-- /.container-fluid -->
</body>
<script>
	
    $(document).ready(function(){ 
        document.title = page_title;
		navbar_update(this_page);
				
        $(".record-item").on("click", function(){
				var id = $(this).data('id');
				var item = $(this).data('item');
				//show_alert(id,item);
				show_detail(id);
			}); //on()
	}); //document.ready
			
	function show_detail(id){
		window.location.assign("<?=site_url()?>/litjams/detail/"+id);
	}
			
    function show_alert(id,item){
        alert("You have clicked Item "+id+", "+item+".");
    }
</script>    
</html>
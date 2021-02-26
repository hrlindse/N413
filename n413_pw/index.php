 <?php
	 include("n413connect.php");
	 include("head.php");
	 $sql = "SELECT * FROM `list`
	 		 ORDER BY RAND() LIMIT 1";
	 $result = mysqli_query($link, $sql);
     $row = mysqli_fetch_array($result, MYSQLI_BOTH);
	 ?>

     <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <h1>Bread Site</h1>
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <div class="row">
            <div class="col-12 text-center">
                <h3>Learn About Bread</h3>
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <div class="row mt-4"><!-- navigation -->   
            <div class="col-1"></div><!-- spacer -->
            <div class="col-2 mt-5">
                <a href="list.php"  class="text-info"><h4>Types of Bread</h4></a> <br/>
                <a href="form.php"  class="text-info"><h4>Contact Us</h4></a>
            </div>
            <div class="col-6 text-center">
                <div class="random-item cursor-pointer" onclick="show_modal(<?=$row["id"];?>, '<?=$row["item"];?>', '<?=$row["description"];?>', '<?=$row["image"];?>')" ><img src="images/<?php echo $row["image"]; ?>" width="100%"; /><br/><h2><?php echo $row["item"]; ?></h2></div>
            </div><!-- image placeholder -->    
        </div> <!-- /row -->
    </div> <!-- /container-fluid --> 

	<script>
	var this_page = "home";
    var page_title = 'Bread Site | Learn About Bread';
	
	$(document).ready(function(){ 
			document.title = page_title;
			$("#"+this_page+"_item").addClass('active'); 
			$("#"+this_page+"_link").append(' <span class="sr-only">(current)</span>');
		}
	); //document.ready

    function show_modal(id,item, description, image){
        $(".modal").html("");
        $(".modal").addClass("active");
        $(".modal").append(`<div class="row mt-3 innermodal"></div>`);
        $(".innermodal").append(`<div class="close col-1  order-3" onclick="hide_modal()" ><img src="images/close.png" /></div>`);
        $(".innermodal").append(`<div class="col left "></div>`);
        $(".left").append(`<div class="name">`+item+`</div>`);
        $(".left").append(`<div class="description">`+description+`</div>`);
        $(".description").append(`<br><br><a href="list.php"><button class="btn btn-info">View more bread</button></a>`);
        $(".innermodal").append(`<div class="col-6 image"><img src="images/`+image+`" /></div>`);
    }

    function hide_modal() {
        $(".modal").removeClass("active");
        $(".modal").html("");
    }

	</script>
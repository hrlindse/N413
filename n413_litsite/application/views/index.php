<div class="container-fluid">
        <div id="headline" class="row mt-3">
            <div class="col-12 text-center">
                <h1>Lit JAM Site</h1>
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <div id="subtitle" class="row">
            <div class="col-12 text-center">
                <h3>The Top-Ten List</h3>
            </div> <!-- /col-12 -->
        </div> <!-- /row -->
        <div id="content" class="row">
            <div class="col-2"></div><!-- spacer -->
            <div class="col-2 mt-5"> <!-- navigation -->  
                <a href="<?=site_url()?>/litjams/litlist" ><h4>Top Ten List</h4></a>
                <a href="<?=site_url()?>/litjams/litform" ><h4>Contact Us</h4></a>   
            </div>
            
            <div class="col-3 text-center"> <!-- image --> 
            	<a href="<?=site_url()?>/litjams/detail/<?=$row["id"]?>"> 
                    <img src="<?=base_url()?>assets/images/<?php echo $row["image"]; ?>" width="100%"; />
                </a>
            </div><!-- image placeholder -->
            <div class="col-5">
            	<a href="<?=site_url()?>/litjams/detail/<?=$row["id"]?>"> 
                	<h2 style="margin-top:200px;"><?php echo $row["item"]; ?></h2>
            	</a>
            </div> <!-- /col-4 -->
        </div> <!-- /row -->
    </div> <!-- /container-fluid --> 
    </body>
    <script>
        $(document).ready(function(){
                document.title = page_title;
                navbar_update(this_page);
            }); //ready   
    </script>
</html>

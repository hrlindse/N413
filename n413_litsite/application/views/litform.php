<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>Lit JAMS Contact Form</h2>
        </div> <!-- /col-12 -->
    </div> <!-- /row -->
           
<form id="contact_form" method="POST" action="">
    <div class="row mt-5">
        <div class="col-4"></div>  <!-- spacer -->
        <div id="form-container" class="col-4">
            Name: <input type="text" id="name" name="name" class="form-control" value="" placeholder="Enter Name" required/><br/>
            E-mail: <input type="email" id="email" name="email" class="form-control" value="" placeholder="Enter E-mail" required/><br/>
            Comment: <textarea id="comment" name="comment" class="form-control" value="" placeholder="Add your comment here:"></textarea><br/>
            <button type="submit" id="submit" class="btn btn-primary float-right">Submit</button>
        </div>  <!-- /#form-container -->
    </div>  <!-- /.row -->
</form> 
</body>
<script>
     $(document).ready(function(){ 
            document.title = page_title;
            navbar_update(this_page);
			
			$("#contact_form").submit(function(event){
                event.preventDefault();
                $.post("<?=site_url()?>/litjams/contact_post",
                        $("#contact_form").serialize(),
                        function(data){
                            //handle messages here
                            if(data.status){
                                $("#form-container").html(data.success);
                            }else{
                                $("#form-container").html(data.failed);
                            }
                        },
                        "json"
                    ); //post
                }); //submit  
			
        }); //document.ready
</script>
</html>
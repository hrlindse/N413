<div class="container-fluid">
    <div id="headline" class="row">
        <div class="col-12 text-center mt-5">
            <h2>Account Settings</h2>
        </div> <!-- /col-12 -->
    </div> <!-- /row -->
</div>
    </body>
    <script>

        $(document).ready(function(){
            document.title = page_title;
            navbar_update(this_page);

            $("#login_form").submit(function(event){
                event.preventDefault();
                $.post("<?=site_url()?>/auth/authenticate",
                    $("#login_form").serialize(),
                    function(data){
                        //handle messages here
                        if(data.status){
                            $("#form-container").html(data.success);
                            right_navbar_update(data.role);
                        }else{
                            $("#form-container").html(data.failed);
                        }
                    },
                    "json"
                ); //post
            }); //submit
        }); //document.ready

        function right_navbar_update(role){
            var html = "";
            if (role > 0) {
                html =  '<li id="messages_item" class="nav-item">'+
                    '<a id="messages_link" class="nav-link" href="<?=site_url()?>/litjams/messages">Messages</a>'+
                    '</li>';
            }

            html += '<li id="logout_item" class="nav-item">'+
                '<a id="logout_link" class="nav-link" href="<?=site_url()?>/auth/logout">Log-Out</a>'+
                '</li>';
            $("#right_navbar").html(html);
        }
    </script>
    </html>

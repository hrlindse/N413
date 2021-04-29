<div id="app">
App
</div>
<div class="container-fluid">
        <div id="content" class="row">
            <div class="col-2"></div><!-- spacer -->
            <div id="leftbar" class="col-2 mt-5"> <!-- Left task bar -->
                Left task bar
            </div>
            
            <div id="mainview" class="col-5"> <!-- main view -->
            	main view
            </div>
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

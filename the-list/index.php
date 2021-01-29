<?php
include("n413connect.php");
$sql = "SELECT id, item, description, image FROM `list`";
$result = mysqli_query($link, $sql);
$records = array();
while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
    $records[] = $row;
}
?>
<DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <title>The List | Holly Lindsey</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/jquery-3.4.1.min.js" type="application/javascript"></script>
        <script>
            function show_modal(id,item, description, image){
                $(".modal").html("");
                $(".modal").addClass("active");
                $(".modal").append(`<div class="innermodal"></div>`);
                $(".innermodal").append(`<div class="close" onclick="hide_modal()" ><img src="images/close.png" /></div>`);
                $(".innermodal").append(`<div class="image"><img src="images/`+image+`" /></div>`);
                $(".innermodal").append(`<div class="name">`+item+`</div>`);
                $(".innermodal").append(`<div class="description">`+description+`</div>`);
            }

            function hide_modal() {
                $(".modal").removeClass("active");
                $(".modal").html("");
            }
        </script>
    </head>
    <body>
    <h2>Types of Bread</h2>
    <?php
    foreach ($records as $record){
        echo '
                    <div class="item">
                        <div class="image"><img src="images/'.$record["image"].'" /></div>
                        <div class="desc" onclick="show_modal('.$record["id"].', \''.$record["item"].'\', \''.$record["description"].'\', \''.$record["image"].'\');"> <b>'.$record["item"].'</b> '.$record["description"].'</div>
                    </div>';
    }
    ?>
    <div class="modal"></div>
    </body>
    </html>
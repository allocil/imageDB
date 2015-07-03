<?php
global $base_url;
$path = drupal_get_path("module", "db_image");
$options = array('absolute' => FALSE);
?>
<div id="all" class="container" style="margin-top:-70px;">
    <h3><?php print ucfirst($type); ?> Upload</h3>
    <form role="form" enctype='multipart/form-data' action='#' method='POST'>    
        <input type='hidden' name='projectName' value='calendar'>
        <input type='hidden' name='agreedTsandCs' value='true'>                
        <input type='hidden' name='swid' value='{9949510E-70C2-4654-A1CD-8277D2C50245}'>
        <input type='hidden' name='title' value='Image uploaded'>
        <div class="row">            
            <div class="form-group">
                <input id="imageLoader" class="form-control" name='data' type='file'>
                <canvas id="bigCanvas" style="display:none"></canvas>
            </div>             
        </div>
        <div class="row" style="height:250px;">
            <img id="imgpreview" style="margin:0 auto;max-height:200px;" class="img-responsive" src="<?php print "$base_url/$path/img/default.jpg"; ?>">
        </div>
        <div class="row">
            <div class="col-xs-2 pull-right form-group">
                <a href="#" input id="btncancel" type="button" class="btn btn-default form-control">Cancel</a>
            </div>
            <div class="col-xs-2 pull-right form-group">                
                <a href="#" input id="btnok" type="button" class="btn btn-default form-control">OK</a>
            </div>
        </div>
    </form>
    <link href="<?php print $base_url; ?>/<?php print $path; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">    
    <script>
        var id = '<?php print $_REQUEST["id"]; ?>';

        jQuery(document).ready(function () {
            var copy;
            var image = jQuery('input[data-id=' + id + ']', window.parent.document).val();
            if (image != "") {                
                    jQuery("#imgpreview").attr("src", image);
            }
            copy = jQuery("#all").clone();
            jQuery("body").empty();
            jQuery("body").append(copy);

            var imageLoader = document.getElementById('imageLoader');
            if (imageLoader != null) {
                imageLoader.addEventListener('change', handleImage, false);
                var bigcanvas = document.getElementById('bigCanvas');
                var bigctx = bigcanvas.getContext('2d');
            }

            function handleImage(e) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var img = new Image();
                    img.onload = function () {
                        bigcanvas.width = img.width;
                        bigcanvas.height = img.height;
                        bigctx.drawImage(img, 0, 0);
                    }
                    if (event.target.result.indexOf("data:image") > -1) {
                        jQuery(".alert").remove();
                        img.src = event.target.result;
                        jQuery("#imgpreview").attr("src", event.target.result);                    
                    } else {
                        jQuery(".alert").remove();
                        jQuery("#all h3").after("<div class='alert alert-danger' role='alert'>The asset is not an image.</div>")
                    }
                    //jQuery('input[data-id=' + id + ']', window.parent.document).parent().parent().find("img").attr("src", event.target.result);
                    //jQuery('input[data-id=' + id + ']', window.parent.document).val(event.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
            
            jQuery("#btnok").click(function(){
                var img = jQuery("#imgpreview").attr("src");
                if (img.indexOf("data:image") > -1) {
                    jQuery('input[data-id=' + id + ']', window.parent.document).parent().parent().find("img").attr("src", img);
                    jQuery('input[data-id=' + id + ']', window.parent.document).val(img);
                }
                parent.jQuery.fancybox.close();
            });
            
            jQuery("#btncancel").click(function(){                
                parent.jQuery.fancybox.close();
            });

        });

    </script>
</div>


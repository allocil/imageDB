<?php
global $base_url;
$path = drupal_get_path("module", "db_image");
$options = array('absolute' => FALSE);
?>
<div id="all" class="container" style="margin-top:-70px;">
    <h3><?php print ucfirst($type); ?> Upload ...</h3>
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
            <a href="#" target="_blank" id="filepreview" style="display:none">File</a>            
        </div>
        <div class="row">
            <div class="col-xs-2 pull-right form-group">
                <a href="#" id="btncancel" type="button" class="btn btn-default form-control">Cancel</a>
            </div>
            <div class="col-xs-2 pull-right form-group">                
                <a href="#" id="btnok" type="button" class="btn btn-default form-control">OK</a>
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
                jQuery("#filepreview").attr("href", image);
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
                var blob = new Blob();
                reader.onload = function (event) {
                    var img = new Image();
                    img.onload = function () {
                        //bigcanvas.width = img.width;
                        //bigcanvas.height = img.height;
                        bigctx.drawImage(img, 0, 0);
                    }
                    jQuery(".alert").remove();
                    img.src = event.target.result;
                    
                    //console.log( img.src );
                    
                    jQuery("#filepreview").show().attr("href", event.target.result);
                }
                
                reader.readAsDataURL(e.target.files[0]);
                var dataURL = bigcanvas.toDataURL('application/pdf', 0.5);
                var blob = dataURItoBlob(dataURL);

            }

            function dataURItoBlob(dataURI) {
                // convert base64/URLEncoded data component to raw binary data held in a string
                var byteString;
                if (dataURI.split(',')[0].indexOf('base64') >= 0)
                    byteString = atob(dataURI.split(',')[1]);
                else
                    byteString = unescape(dataURI.split(',')[1]);

                // separate out the mime component
                var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                // write the bytes of the string to a typed array
                var ia = new Uint8Array(byteString.length);
                for (var i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }

                return new Blob([ia], {type: mimeString});
            }

            jQuery("#btnok").click(function () {
                var img = jQuery("#filepreview").attr("href");
                jQuery('input[data-id=' + id + ']', window.parent.document).parent().parent().find("a").attr("href", img).show();
                jQuery('input[data-id=' + id + ']', window.parent.document).val(img);
                parent.jQuery.fancybox.close();
            });

            jQuery("#btncancel").click(function () {
                parent.jQuery.fancybox.close();
            });

        });

    </script>
</div>


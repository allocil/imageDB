window.getNumber = function () {
    return 1;
};
window.setImage = function (i) {
    var box = jQuery("#edit-field-day-remus-image-und-0-value");
    box.val(i);
};
window.getImages = function (i) {
    return jQuery("#edit-field-day-remus-image-und-0-value").val();
};
jQuery(document).ready(function () {    
   
    jQuery(".remus-add").fancybox({
        maxWidth: 750,
        maxHeight: 650,
        fitToView: false,
        width: "70%",
        height: "80%",
        autoSize: false,
        closeClick: false,
        openEffect: "none",
        closeEffect: "none"
    });
    
    jQuery.each( jQuery(".dbimage"), function(){        
        if (jQuery(this).find("input[type=hidden]").val() != "" && jQuery(this).find("input[type=hidden]").val() != "noload") 
            jQuery(this).find("img").attr("src",jQuery(this).find("input[type=hidden]").val());
    });
    
    jQuery.each( jQuery(".dbimagefile"), function(){        
        if (jQuery(this).find("input[type=hidden]").val() != "" && jQuery(this).find("input[type=hidden]").val() != "noload") 
            jQuery(this).find(".afile").attr("href",jQuery(this).find("input[type=hidden]").val());
    });
    
    jQuery(".remove-it").click(function(){
       var path = Drupal.settings.db_image.basepath;
       var id = jQuery(this).attr("data-id");       
       jQuery(this).parents(".dbimage").find("input[type=hidden]").val("");
       jQuery(this).parent().parent().find("img").attr("src", path + "/img/default.jpg");
       return false; 
    });
    
    jQuery(".remove-it-file").click(function(){
       var path = Drupal.settings.db_image.basepath;
       var id = jQuery(this).attr("data-id");       
       jQuery(this).parents(".dbimagefile").find("input[type=hidden]").val("");       
       jQuery(this).parent().parent().find(".afile").hide();
       return false; 
    });
});



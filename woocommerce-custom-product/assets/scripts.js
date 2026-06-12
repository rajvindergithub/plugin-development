jQuery(document).ready(function(){
    
    
    jQuery('#btn_upload_product_image').click(function(){
        
        var fileInfo = wp.media({
            title: "Select Product Image", 
            multiple: false
        }).open().on("select", function(){
            
            var uploadFile = fileInfo.state().get("selection").first(); 
            
            var fileObject = uploadFile.toJSON();
            
//            console.log(fileObject);
            
            var productImageUrl = fileObject.url; 
            
            jQuery('#product_image_upload_wc').attr('src', productImageUrl);
            jQuery('#product_media_id').val(productImageUrl);
            
        });
        
        
    });
    
    
});
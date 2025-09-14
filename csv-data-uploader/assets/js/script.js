jQuery('#frm-csv-upload').on("submit", function(event){
        
        event.preventDefault(); 
        
        console.log('Hello');
 
        var formData = new FormData(this);
        
        jQuery.ajax({
            url: cdu_object.ajax_url, 
            data: formData, 
            dataType: "json",
            method: 'POST',
            processData: false,
            contentType: false,
            success: function(response){
                console.log(response);
                
                jQuery('#result_upload_csv').html(response.message);
            }
        }); 
        
    });
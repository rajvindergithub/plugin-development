jQuery('#create-tb-name').on('keyup', function(){
    
    let getCurrentValue = jQuery(this).val();
    
//    console.log(getCurrentValue);
   
   getCurrentValue =  getCurrentValue.replaceAll(" ","_"); 
    
    if(getCurrentValue.length >= 64){
        alert('Table name should not exceed more then 64 Character');
         jQuery(this).val('');
        return false; 
    }else{
        
        jQuery(this).val(getCurrentValue.toLowerCase());
        
    }
    
    
});

setTimeout(function(){
    jQuery('#table_created_message').hide();
}, 3000);
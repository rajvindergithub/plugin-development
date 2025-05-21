jQuery(document).ready( function () {
    jQuery('#commentTable').DataTable();
} );


function formClick(getFormId){
//    alert(getFormId);
    
    if(confirm("Are You Want to Delete this Post?")){
        jQuery('#'+getFormId).submit();
    }
    
    
}

setTimeout(function(){
    
    jQuery('#comment-message').hide();
    
}, 2000);
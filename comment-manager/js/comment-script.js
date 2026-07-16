jQuery(document).ready( function () {
    jQuery('#commentTable').DataTable({
    stateSave: true
  });
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

function approveComment(formId, statusComment){
    
    var approveVal = 1; 
    
    if(statusComment == 'not-approve'){
        approveVal = 0; 
    }else{
        approveVal = 1;
    }
    
     jQuery('#'+formId+' #approve_status').val(approveVal);
    
    
     jQuery('#'+formId).submit();
    
}
jQuery('#submit-btn').click(function (e) {

    e.preventDefault();

    let data = {
        full_name: jQuery('#full_name').val(),
        payment_email: jQuery('#payment_email').val(),
        payment_mobile: jQuery('#payment_mobile').val() ,
        payment_amount: jQuery('#payment_amount').val() ,
        action: 'myplugin_handle_ajax',
        nonce: myplugin_ajax_obj.nonce,
    };


    jQuery.ajax({
        url: myplugin_ajax_obj.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (res) {
            if (res.success) {
                $('#response').html('<p style="color:green;">' + res.data.message + '</p>');
            } else {
                $('#response').html('<p style="color:red;">Error: ' + res.data + '</p>');
            }
        }
    });

});

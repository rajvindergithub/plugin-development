 const constraints = {
    full_name: {
      presence: { allowEmpty: false, message: "is required" },
      format: {
        pattern: "[a-zA-Z ]+",
        message: "can only contain letters and spaces"
      }
    },
    email: {
      presence: { allowEmpty: false, message: "is required" },
      email: { message: "is not valid" }
    },
    mobile: {
      presence: { allowEmpty: false, message: "is required" },
      format: {
        pattern: "^[6-9]\\d{9}$",
        message: "must be a valid 10-digit Indian mobile number"
      }
    },
    amount: {
      presence: { allowEmpty: false, message: "is required" },
      numericality: {
        greaterThan: 0,
        message: "must be a valid amount"
      }
    }
  };



jQuery('#submit-btn').click(function (e) {
    
    e.preventDefault();
   
     
  const errorDiv = document.getElementById("errors");


    let data = {
        full_name: jQuery('#full_name').val(),
        payment_email: jQuery('#payment_email').val(),
        payment_mobile: jQuery('#payment_mobile').val() ,
        payment_amount: jQuery('#payment_amount').val() ,
        action: 'myplugin_handle_ajax',
        nonce: myplugin_ajax_obj.nonce,
    };

     const formValues = {
      full_name: document.getElementById("full_name").value.trim(),
      email: document.getElementById("payment_email").value.trim(),
      mobile: document.getElementById("payment_mobile").value.trim(),
      amount: document.getElementById("payment_amount").value.trim()
    };
    
    const errors = validate(formValues, constraints);

     errorDiv.innerHTML = "";
    
        if (errors) {
      Object.keys(errors).forEach(function (field) {
        const p = document.createElement("p");
        p.style.color = "red";
        p.innerText = `${field.replace('_', ' ')}: ${errors[field].join(', ')}`;
        errorDiv.appendChild(p);
      });
    } else {
      // All validations passed
//      alert("Form is valid and ready to submit!");
//      form.submit(); // or handle via AJAX
    }

    jQuery.ajax({
        url: myplugin_ajax_obj.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (res) {
           
            var order_id = res.data.id;
            var order_amount = res.data.amount;
            var key = res.data.key;
            
            startPayment(order_id, order_amount, key, full_name, payment_email , payment_mobile);
            
        }
    });

});

 function startPayment(order_id, order_amount, key, full_name, payment_email) {
        var options = {
            key: key,  
            amount: order_amount*100, 
            currency: 'INR',
            name: "MyFreeOnlineTools",
            description: "yFreeOnlineTools",
            image: "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
            order_id: order_id, // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            prefill: {
                name: full_name,
                email:payment_email,
                contact: payment_mobile
            },
            notes: {
                address: "Razorpay Corporate Office"
            },
            theme: {
                "color": "#3399cc"
            },
            callback_url: "' . $callback_url . '"
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }

 
  const form = document.getElementById("payment_gate_form");
  const errorContainer = document.getElementById("errors");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formValues = {
      email: form.elements.email.value,
      password: form.elements.password.value
    };

    const errors = validate(formValues, constraints);

    errorContainer.innerHTML = "";

    if (errors) {
      // Display errors
      Object.keys(errors).forEach((field) => {
        const message = errors[field].join(", ");
        const p = document.createElement("p");
        p.innerText = `${field}: ${message}`;
        errorContainer.appendChild(p);
      });
    } else {
      // All good — proceed with form submission or AJAX
      alert("Form submitted successfully!");
    }
  });

jQuery(function(){
    
    jQuery('#tbl-employee').DataTable();
    
    
    jQuery('#ems-frm-add-employee').validate();
    
    
     const constraints = {
    phone: {
      presence: { allowEmpty: false, message: "^Phone number is required" },
      format: {
        pattern: "^[0-9]{10}$",
        message: "^Phone number must be exactly 10 digits"
      }
    }
  };

  // Event listener on input blur or form submission
  document.getElementById("phone").addEventListener("blur", function () {
    const formValues = {
      phone: this.value
    };

    const errors = validate(formValues, constraints);
    
    document.getElementById("phone-error").textContent = 
      errors && errors.phone ? errors.phone[0] : "";
  });
    
    
});

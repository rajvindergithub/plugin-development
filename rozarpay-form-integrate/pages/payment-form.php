<h2>Rozarpay Payment Integration</h2>
<form id="payment_gate_form" method="post" action="">
    <div class="payment_gateway_field">
            <label for="payment_full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" placeholder="Enter Your Full Name"/>
        </div>

         <div class="payment_gateway_field">
            <label for="payment_email">Email</label>
            <input type="email" name="email" id="payment_email" placeholder="Enter Your Email Address"/>
        </div>

        <div class="payment_gateway_field">
            <label for="payment_mobile">Mobile</label>
            <input type="text" name="mobile" id="payment_mobile" placeholder="Enter Your Mobile Number"/>
        </div>

        <div class="payment_gateway_field">
            <label for="payment_mobile">Amount </label>
            <input type="text" name="amount" id="payment_amount" placeholder="Enter Amount"/>
        </div>
    <div id="errors"></div>
    
        <input type="submit" value="Pay Now"  id="submit-btn" name="payment_button" />

</form>
 
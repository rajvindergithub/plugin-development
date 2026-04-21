<style type="text/css">
    #user_form {
        width: 60%;
        max-width: 100%;
        margin: 50px auto;
    }
    
    #user_form div label{ font-size: 16px;    }
    #user_form div{ margin-top: 10px;     }

    #user_form div input {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
        border-radius: 5px; height: 50px;
    }

    #user_form div select {
        border-radius: 10px;
        width: 100%;
        padding: 5px;
        margin-top: 10px;
        margin-bottom: 10px;
        height: 50px; 
    }

    #user_form div button {
        width: 100%;
        padding: 15px;
        background-color: #000;
        color: #FFF;
        margin-top: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        font-size: 18px;
    }
    
    .heading_custom_form{ text-align: center; background-color: #efefef; padding: 10px 0px;  }
    
    #user_form{ border: 1px solid #efefef; border-radius: 10px; padding: 20px 20px 0px 20px; }

</style>


<section id="user_form">
    
    <h2 class="heading_custom_form">Add Custom User Information</h2>

    <form method="post" id="user_submit_form">

        <div>
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Age</label>
            <input type="number" name="age" required>
        </div>

        <div>
            <label>Country</label>
            <select name="country" id="country" onchange="selectedCountry(this.value)" required>
                <option value="">Select Country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
            </select>
        </div>

        <div>
            <label>State</label>
            <select name="state" id="state" required onchange="selectStateCity(this.value)">
                <option value="">Select State</option>
            </select>

        </div>

        <div>
            <label>City</label>
            <select name="city" id="city" required>
                <option value="">Select City</option>
            </select>

        </div>
        
        


        <div>
            <input type="submit" value="Submit" id="submit_form_button">
        </div>

    </form>
    <div id="form-message"></div>

</section>


<script type="text/javascript" src="https://code.jquery.com/jquery-4.0.0.js"></script>

<script type="text/javascript">
    
    jQuery('#user_submit_form').submit(function(e){
        
        e.preventDefault(); 
        
        var formData = jQuery(this).serialize();
        jQuery('#submit_form_button').val('Please Wait...').prop("disabled", true);

        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php')?>",
            type: "POST",
            data: formData + '&action=handle_custom_form_data',
            success: function(response){
                  jQuery('#form-message').html(response);
                jQuery('#user_submit_form')[0].reset();
                jQuery('#submit_form_button').val('Submit').prop("disabled", false);;
            }
            
        });
        
    });
    
    
    
    getAllCountry();



    function getAllCountry() {

        jQuery('#state').prop('disabled', true);
        jQuery('#city').prop('disabled', true);

        const allCountry = 'https://raw.githubusercontent.com/mustafasolak/country_state_city/refs/heads/main/countries.json';

        var countryOption = '<option selected disabled>Please Select Country</option>';

        fetch(allCountry)
            .then(response => response.json())
            .then(data => {
                //                    console.log(data[2].data); 

                let allCountryData = data[2].data;

                allCountryData.forEach((country) => {
                    countryOption += `<option value="${country.name}" data-country="${country.id}">${country.name}</option>`;

                    //                    console.log(country.name);
                });

                //             console.log('country name', countryOption);
                jQuery('#country').html(countryOption);
            });
    }

    function userCountryState(countryId) {

        jQuery('#state').prop('disabled', false);

        const allCountryStates = 'https://raw.githubusercontent.com/mustafasolak/country_state_city/refs/heads/main/states.json';

        var countryStateOption = '<option selected disabled>Please Select State</option>';

        fetch(allCountryStates)
            .then(response => response.json())
            .then(data => {
                console.log(data[2].data);
                let allCountryStateData = data[2].data;
                allCountryStateData.forEach((state) => {
                    if (state.countryId == countryId) {
                        countryStateOption += `<option value="${state.name}" data-state="${state.id}">${state.name}</option>`;
                    }
                    //                    console.log(country.name);
                });

                //             console.log('country name', countryOption);

                jQuery('#state').html(countryStateOption);
            });
    }

    function selectedCountry(changeValue) {

        var getSelectedCountry = changeValue;
        var getSelectedCountryID = jQuery('#country option:selected').data("country");
//        alert(getSelectedCountryID);
        userCountryState(getSelectedCountryID);
    }

    function userStateCity(stateId) {

//        console.log(stateId, 'stateId');
        jQuery('#city').prop('disabled', false);

        const allStatesCities = 'https://raw.githubusercontent.com/mustafasolak/country_state_city/refs/heads/main/cities.json';

        var stateCityOption = '<option selected disabled>Please Select City</option>';
        fetch(allStatesCities)
            .then(response => response.json())
            .then(data => {
                console.log(data[2].data, 'All City Data');
                let allStateCitiesData = data[2].data;
                allStateCitiesData.forEach((city) => {
                    if (city.stateId == stateId) {
                        stateCityOption += `<option value="${city.name}" data-city="${city.id}">${city.name}</option>`;
                    }
                    //                    console.log(country.name);
                });
                //             console.log('country name', countryOption);
                jQuery('#city').html(stateCityOption);
            });
    }

    function selectStateCity(selectedState) {

        var getSelectedStateID = jQuery('#state option:selected').data("state");
        userStateCity(getSelectedStateID);
        console.log(getSelectedStateID, 'city data');

    }

</script>

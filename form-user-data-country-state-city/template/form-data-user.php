<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>Example Title</title>
    <meta name="author" content="Your Name">
    <meta name="description" content="Example description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="icon" type="image/x-icon" href="" />
</head>
    
<style type="text/css">
    #user_form{ width: 60%; max-width: 100%; margin: 50px auto; }
  
    #user_form div input{ width: 100%; padding: 10px; margin-top: 10px; margin-bottom: 10px; border-radius: 5px;   }
  
    #user_form div select{ border-radius: 10px; width: 100%; padding: 10px; margin-top: 10px; margin-bottom: 10px;  }
    #user_form div button{ width: 100%; padding: 15px; background-color: #000; color: #FFF; margin-top: 10px; margin-bottom: 10px; border-radius: 5px; font-size: 18px;   }
    </style>    

<body>

    <section id="user_form">
        <form>

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
                <select name="state" id="state" required>
                    <option value="">Select State</option>
                </select>

            </div>

            <div>
                <button type="submit">Submit</button>
            </div>

        </form>


    </section>


</body>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-4.0.0.js"></script>

    <script type="text/javascript">
        
        const allCountry = 'https://raw.githubusercontent.com/mustafasolak/country_state_city/refs/heads/main/countries.json'; 
        
        var countryOption = '<option selected disabled>Please Select Country</option>'; 
        
        fetch(allCountry)
            .then( response => response.json())
            .then( data => {
//                    console.log(data[2].data); 
            
            let allCountryData = data[2].data;  
                    
                allCountryData.forEach((country) => {
                    
                   
                    countryOption += `<option value="${country.name}" data-country="${country.id}">${country.name}</option>`; 
                    
//                    console.log(country.name);
                });  
            
//             console.log('country name', countryOption);
            
              jQuery('#country').html(countryOption);
            
            });   
        
        
      
        
           
        
//          
        
        function selectedCountry(changeValue, countryID){
            
            var getSelectedCountry =  changeValue; 
            var getSelectedCountryID = jQuery('#country option:selected').data("country") ; 
            
            alert(getSelectedCountryID);
           
        }
    </script>
    
</html>



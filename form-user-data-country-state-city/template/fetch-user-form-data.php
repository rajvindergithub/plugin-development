<style type="text/css">
    #fetch_user_form_data{ width: 90%; margin-top: 20px;  }
    .row_main{ display: flex; align-items: center; }
    .row_main div{ flex: 1; font-size: 18px; margin-bottom: 10px;  border-bottom: 1px solid #efefef; overflow: hidden; padding: 15px 10px 25px 10px;  margin-top: 5px; border-bottom: 1px solid #000;    }
    
    .row_main:first-child div{   background-color: #000; color: #FFF; padding: 10px 10px;   }
    
    .user_form_heading{ text-align: center;  }
    
    .user_form_heading h1{ font-size: 36px; margin: 40px 0px;  }
    .top_heading{ background-color: #000; color: #FFF; border-radius: 5px; padding-bottom: 10px !important;   }
    .button_div { height: 18px; }
    .button_div .button_all{ position: relative; top: -5px; }
</style>

<section id="fetch_user_form_data">
    
    <div class="user_form_heading">
        <h1>User Form Data</h1>
    </div>

    <div class="row_main top_heading">
        <div style="flex: 0.25;">ID</div>
        <div>Name</div>
        <div style='flex: 2'>Email</div>
        <div >Age</div>
        <div>Country</div>
        <div>State</div>
        <div>City</div>
        <div>Action</div>
    </div>
    
    <?php 
    
        if($get_user_form_data) {
            
            foreach($get_user_form_data as $row){
                
                echo "<div class='row_main'>";
                echo "<div style='flex: 0.25;'>{$row->id}</div>";    
                echo "<div>{$row->name}</div>";    
                echo "<div style='flex: 2;'>{$row->email}</div>";    
                echo "<div>{$row->age}</div>";    
                echo "<div>{$row->country}</div>";    
                echo "<div>{$row->state}</div>";    
                echo "<div>{$row->city}</div>"; 
                echo "<div class='button_div'><form method='post'><input type='hidden' value='{$row->id}' name='delete_record'><input type='submit' name='delete_record_submit' class='button_all' type='button' value='Delete'></form></div>";  
                echo "</div>";
                
            }
            
        }else{
            echo "<div class='no_record_found_error'>No Record Found</div>";
        }
    
    ?>

</section>
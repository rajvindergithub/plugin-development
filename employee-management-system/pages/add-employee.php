
<?php 
   error_reporting(1);
        $message = "";
        $action = ""; 
        $empId = ""; 
        $employee = "";
    
    if(isset($_GET['action']) && isset($_GET['empID'])){
         
        global $wpdb;
        
        $table_prefix = $wpdb->prefix; 
    

        $empId = $_GET['empID']; 
        
        if($_GET['action'] == 'edit'){
            $action = 'edit'; 
        }
        
         if($_GET['action'] == 'view'){
            $action = 'view'; 
        }
        
        // single employee information
        
        $employee = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$table_prefix}ems_form_data WHERE id = %d",  $empId), ARRAY_A
        );
        
//        echo 'eh'; 
//        echo '<pre>';
//        print_r($employee);
//        echo '</pre>';
        
    }

    

    if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_submit'])){
        
//        print_r($_POST);
        
        global $wpdb; 
        $table_prefiex = $wpdb->prefix; 
        $empId = $_GET['empID']; 
        
        $name =  sanitize_text_field($_POST['name']);     
        $email = sanitize_text_field($_POST['email']);     
        $phone = sanitize_text_field($_POST['phone']);     
        $gender = sanitize_text_field($_POST['gender']);     
        $designation = sanitize_text_field($_POST['designation']);  
        
        
        //Action Type 
        
        if(isset($_GET['action']) == 'edit'){
            
              $table_prefiex = $wpdb->prefix; 
                $wpdb->update("{$table_prefiex}ems_form_data", array(
                    "name" => $name,
                    "email" => $email,
                    "phoneNo" => $phone,
                    "gender" => $gender,
                    "designation" => $designation,
                ), array(
                        "id" => $empId
                    ));
             $message = "Employee Saved Successful"; 
            
            
        }else{
            
               $wpdb->insert("{$table_prefiex}ems_form_data", array(
            "name" => $name,
            "email" => $email,
            "phoneNo" => $phone,
            "gender" => $gender,
            "designation" => $designation,
        ));
            
            $message = "Failed to save an Employee Data"; 
        }
 
        //insert into employee table 
    
    }

?>
 

    <div class="container">
        <div class="row">
            <div class="col-md-8">
             <div class="form-main">
                  <?php if($action == 'view'){ ?>
            
                 <h2>View Employee</h2>
            
            <?php }elseif($action = 'edit'){ ?>
    
                 <h2>Update Employee</h2>

            <?php }else{ ?>
    
                 <h2>Add Employee</h2>
    
            <?php } ?>
        
                 
       
        <div class="panel panel-default">
            
             <?php if($action == 'view'){ ?>
            
                <div class="panel-heading">View Employee</div>
            
            <?php }elseif($action = 'edit'){ ?>
    
                <div class="panel-heading">Update Employee</div>

            <?php }else{ ?>
    
                <div class="panel-heading">Add Employee</div>
    
            <?php } ?>
            
           
            
            <div class="panel-body">
                
                <div class="success_message">
                   <?php
                    
                    if(!empty($message)){
                            echo $message; 
                        }
                    
                    ?>
                </div>
                
                
                
                
                <form action='<?php 
                
                    if($action == "edit"){
                        echo "admin.php?page=employee-system&action=edit&empID={$empId}";
                    }else{
                        echo "admin.php?page=employee-system"; 
                    }
                ?>' 
                      method="post" id="ems-frm-add-employee">
                      
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input 
                               type="text" ]
                               value="<?php if($action == 'view' || $action == 'edit'){ echo $employee['name']; }?>" 
                               required 
                               class="form-control" 
                                <?php if($action == 'view'){
                                    echo "readonly = 'readonly'"; 
                                }?>
                               name="name" 
                               id="name">
                    </div>
                       <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" 
                                value="<?php if($action == 'view' || $action == 'edit'){ echo $employee['email']; }?>" 
                               
                               <?php if($action == 'view'){
                                    echo "readonly = 'readonly'"; 
                                }?>
                               
                               required 
                               class="form-control" 
                               name="email" 
                               id="email">
                    </div>
                       <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" 
                               required 
                               class="form-control" 
                                value="<?php if($action == 'view' || $action == 'edit'){ echo $employee['phoneNo']; }?>" 
                               name="phone" 
                                <?php if($action == 'view'){
                                    echo "readonly = 'readonly'"; 
                                }?>
                               id="phone">
                    </div>
                       <div class="form-group">
                        <label for="gender">Gender:</label>
                           <select id="gender"  <?php if($action == 'view'){
                                    echo "disabled"; 
                                }?> 
                                   name="gender" 
                                   class="form-control">
                                <option value="">Select Gender</option>
                                <option 
                                    value="male" <?php if(($action == "view"  || $action == 'edit') && $employee['gender'] == "male"){ echo 'selected' ; }?>>
                                    Male
                                    
                               </option>
                                <option 
                                    value="female"
                                    <?php if(($action == "view"  || $action == 'edit')  && $employee['gender'] == "female"){ echo 'selected' ; }?>    
                                        >
                                    Female
                               </option>
                                <option 
                                    value="other"
                                    <?php if(($action == "view"  || $action == 'edit') && $employee['gender'] == "other"){ echo 'selected' ; }?> >
                                    Other
                               </option>
                           </select>
                    </div>
                       <div class="form-group">
                        <label for="designation">Designation:</label>
                        <input type="text" 
                                value="<?php if($action == 'view'  || $action == 'edit'){ echo $employee['designation']; }?>" 
                               name="designation" 
                                <?php if($action == 'view' ){
                                    echo "readonly = 'readonly'"; 
                                }?>
                               class="form-control" 
                               id="designation">
                    </div>                    
<!--
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                    </div>
-->
                    
                     <?php if($action != 'view'){ ?>
                                 
                    <button type="submit" class="btn btn-default" name="btn_submit">Submit</button>
                    
                      <?php } ?>
                    
                    
                   
                    
                    
                </form>

            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
    
   
 
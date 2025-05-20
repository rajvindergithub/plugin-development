<?php 
    global $wpdb; 

    $table_prefix = $wpdb->prefix; 
    
    $employees = $wpdb->get_results("SELECT * FROM {$table_prefix}ems_form_data", ARRAY_A);
    

?>

<div class="container">

    <div class="row">
        <div class="col-md-11">
            <h2>List of Employees</h2>

            <table class="table" id="tbl-employee">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>#Name</th>
                        <th>#Email</th>
                        <th>#Phone</th>
                        <th>#Gender</th>
                        <th>#Designation</th>
                        <th>#Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    $index =1;    
            if(count($employees) > 0){ ?>

                    <?php 
                        foreach($employees as $employee){
                            ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td><?php echo $employee['name'];?></td>
                        <td><?php echo $employee['email'];?></td>
                        <td><?php echo $employee['phoneNo'];?></td>
                        <td><?php echo ucfirst($employee['gender']);?></td>
                        <td><?php echo $employee['designation'];?></td>
                        <td>
                            <a href="admin.php?page=employee-system&action=edit&empID=<?php echo $employee['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="admin.php?page=ems-list-employee&action=del&empID=<?php echo $employee['id']; ?>" class="btn btn-danger">Delete</a>
                            <a href="admin.php?page=employee-system&action=view&empID=<?php echo $employee['id']; ?>" class="btn btn-info">View</a>
                        </td>
                    </tr>
                    <?php  }  ?>

                        <?php }else{ ?>

                    <div>
                        No Employee Found.
                    </div>

                <?php  } ?>




                </tbody>
            </table>
        </div>
    </div>


</div>

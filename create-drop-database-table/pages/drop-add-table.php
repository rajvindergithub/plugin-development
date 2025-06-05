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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
    
 

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="h-drop-add-table">
                        <h1>Drop and Add WordPress Table</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">


            <form id="create-table-wb" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=wp-table-add-remover">
                <div class="row">

                    <div class="col-md-3">
                        <div class="create-tb-label">
                            Create Table Name
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="create-tb-input flex-create-tb-input">
                           <div>
                             <?php echo $wpdb->prefix ; ?>
                            </div>
                            <div>
                            <input type="text" name="create-tb-name" id="create-tb-name" placeholder="Table Name" />
                            </div>
                            
                        </div>
                        <div class="mt-10" >
                            <span id="error_table_excced"  class="error_table_excced">Table name should not exceed more then 64 Character</span>
                            <span id="table_created_message">
                                <?php
                                    if(isset($successMessage)){
                                        echo $successMessage; 
                                    }
                                ?>
                            </span>
                            
                            </div>
                        
                    </div>
                    <div class="col-md-2">
                        <div class="create-tb-submit">
                            <input type="submit" name="create-table-submit" id="create-table-submit" value="Crate Table">

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div> 
                
            </form>


        </div>

    </header>
    <main>

    </main>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>

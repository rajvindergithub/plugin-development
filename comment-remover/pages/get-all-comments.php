<?php

$message = ""; 


 if(isset($_POST) && isset($_POST['post-remove'])){
     
    global $wpdb;
     
    $table_name = $wpdb->prefix.'comments';

    $get_post_id = sanitize_text_field($_POST['post-remove']); 
     
    $wpdb->delete(
        $table_name,
        array( 'comment_ID' => intval($get_post_id)),
        array( '%d' )
    );  
     
     $message = "Comment Delete Successfully.";
     
 }

    if(isset($_POST) && isset($_POST['approve-comment'])){
        
            $comment_id = sanitize_text_field($_POST['approve-comment']); 
            $approve_status = sanitize_text_field($_POST['approve-status']); 
             
            global $wpdb;

            $table_name = $wpdb->prefix .'comments'; // custom table with prefix

            $wpdb->update(
                $table_name,                     // Table name
                array(                           // Data to update (column => value)
                    'comment_approved' => $approve_status
                ),
                array(                           // WHERE clause (column => value)
                    'comment_ID' => $comment_id
                ),
                array('%s'),                     // Data format (e.g., %s for string, %d for integer)
                array('%d')                      // WHERE format
            );
    }


    global $wpdb;

    $table_prefix = $wpdb->prefix;

    $comments = $wpdb->get_results( "SELECT * FROM {$table_prefix}comments order by comment_ID desc ", ARRAY_A );
 

?>

<div class="container-fluid">
    
    <?php if(!empty($message)):?>
      <div class="row" id="comment-message">
        <div class="col-d-12">
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
                </div>
        </div>
    </div>
    
    <?php endif; ?>
    
   
    
    <div class="row">
        <div class="col-md-12">

            <table class="table" id="commentTable">
                <thead>
                    <tr>
                        <th style="width: 2%">S.No</th>
                        <th style="width: 10%">P. ID</th>
                        <th style="width: 22%">P. URL</th>
                        <th style="width: 10%">C. Date</th>
                        <th style="width: 40%">Content</th>
                        <th style="width: 25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                    
                    $index = 1; 
                    
                    foreach ( $comments as $comment ) {
                        ?>
                    <tr>
                        <td scope="row" style="text-align: center; "><?php echo $index++;?></td>
                        <td>Post - <?php echo $comment['comment_post_ID'];?></td>
                        <td style="font-weight: bold;">
                           <a style="color: #000; " href="<?php echo get_permalink($comment['comment_post_ID']);?>" target="_blank">
                                <?php echo get_the_title($comment['comment_post_ID']);?>
                            </a>
                        
                        </td>
                        <td><?php echo $comment['comment_date'];?></td>
                        <td>
                            <?php if(strlen($comment['comment_content']) > 50): ?>
                            <?php echo substr($comment['comment_content'], 0, 50);?> ...
                            <?php else:?>
                            <?php echo $comment['comment_content'];?>
                            
                            <?php endif ;?>
                        
                        </td>
                        <td>
                            
                            <form method="post" action="<?php echo $_SERVER["PHP_SELF"].'?page=comment-remover';?>" id="approve-comment-form-<?php echo $comment['comment_ID'];?>">
                                <input type="hidden" name="approve-comment" value="<?php echo $comment['comment_ID'];?>"  />
                                 <input type="hidden" name="approve-status" value="" id="approve_status"  />
                            </form>
                            
                            <div style="display: flex; column-gap : 5px;  ">
                                <?php if($comment['comment_approved'] == 0):?>
                                    <button type="button" class="btn btn-primary" onclick="approveComment('approve-comment-form-<?php echo $comment['comment_ID'];?>','approve');">Approve</button>
                                <?php else:?>
                                 <button type="button" onclick="approveComment('approve-comment-form-<?php echo $comment['comment_ID'];?>','not-approve');" class="btn btn-warning"  >
                                        Not Approve
                                    </button>
                                <?php endif; ?>

                                <form id="remove-comment-form-<?php echo $comment['comment_ID'];?>" method="post" action="<?php echo $_SERVER["PHP_SELF"].'?page=comment-remover';?>" name="comment-remover">
                                    <input type="hidden" name="post-remove" value="<?php echo $comment['comment_ID'];?>" />
                                </form>

                                <button type="button" class="btn btn-danger" onclick="formClick('remove-comment-form-<?php echo $comment['comment_ID'];?>');" >Delete</button>

                            </div>
                        </td>
                    </tr>

                        <?php  }
    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

 

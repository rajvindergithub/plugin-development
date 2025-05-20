<?php
global $wpdb;

$table_prefix = $wpdb->prefix;

$comments = $wpdb->get_results( "SELECT * FROM {$table_prefix}comments order by comment_ID desc ", ARRAY_A );

//echo '<pre>';
//print_r( $comments );
//echo '</pre>';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 2%">S.No</th>
                        <th style="width: 5%">P. ID</th>
                        <th style="width: 22%">P. URL</th>
                        <th style="width: 15%">C. Date</th>
                        <th style="width: 38%">Content</th>
                        <th style="width: 27%">Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                    
                    $index = 1; 
                    
                    foreach ( $comments as $comment ) {
                        ?>
                    <tr>
                        <th scope="row"><?php echo $index++;?></th>
                        <td><?php echo $comment['comment_post_ID'];?></td>
                        <td>
                           <a href="<?php echo get_permalink($comment['comment_post_ID']);?>" target="_blank">
                                <?php echo get_the_title($comment['comment_post_ID']);?>
                            </a>
                        
                        </td>
                        <td><?php echo $comment['comment_date'];?></td>
                        <td><?php echo $comment['comment_content'];?></td>
                        <td>
                            
                            <?php if($comment['comment_approved'] == 0):?>
                                <button type="button" class="btn btn-warning">
                                    Not Approve
                                </button>
                            <?php else:?>
                                <button type="button" class="btn btn-primary">Approve</button>
                            <?php endif; ?>
                            
                            <button type="button" class="btn btn-danger">Delete</button>
                        
                        </td>
                    </tr>

                        <?php  }
    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

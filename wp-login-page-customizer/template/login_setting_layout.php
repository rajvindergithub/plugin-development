<form action="options.php" method="post">

    <?php 
    
        settings_fields("wlc_login_page_settings_field_group");
        do_settings_sections("wp-login-page-customier");
        submit_button("Save Setting");
    ?>

</form>
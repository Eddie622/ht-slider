<div class="wrap">
    <h1><?php echo esc_html__( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
        <?php 
            settings_fields( 'ht_slider_group' );
            do_settings_sections( 'ht_slider_page1' );
            do_settings_sections( 'ht_slider_page2' );
            submit_button( 'Save Settings' );
        ?>
    </form>
</div>
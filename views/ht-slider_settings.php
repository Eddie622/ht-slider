<div class="wrap">
    <h1><?php echo esc_html__( get_admin_page_title() ); ?></h1>
    <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'main_options'; ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=ht_slider_admin&tab=main_options" class="nav-tab" <?php echo esc_attr__( $active_tab == 'main_options' ? 'nav-tab-active' : ''); ?>>
            <?php esc_html_e( 'Main Options', 'ht-slider' ) ?>
        </a>
        <a href="?page=ht_slider_admin&tab=additional_options" class="nav-tab" <?php echo esc_attr__( $active_tab == 'additional_options' ? 'nav-tab-active' : ''); ?>>
            <?php esc_html_e( 'Additional Options', 'ht-slider' ) ?>
        </a>
    </h2>
    <form action="options.php" method="post">
        <?php
            settings_fields( 'ht_slider_group' );
            if( $active_tab == 'main_options' ) {
                do_settings_sections( 'ht_slider_page1' );
            } else {
                do_settings_sections( 'ht_slider_page2' );
            }
            submit_button( esc_html__( 'Save Settings', 'ht-slider' ) );
        ?>
    </form>
</div>
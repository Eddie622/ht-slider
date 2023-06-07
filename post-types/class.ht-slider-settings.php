<?php

if( !class_exists( 'HT_Slider_Settings' ) ) {
    class HT_Slider_Settings {
        public static $options;

        public function __construct() {
            self::$options = get_option( 'ht_slider_options' );
            add_action( 'admin_init', array( $this, 'admin_init' ) );
        }

        public function admin_init() {
            register_setting(
                'ht_slider_group',
                'ht_slider_options',
                array( $this, 'ht_slider_options_validate' )
            );
            add_settings_section(
                'ht_slider_main_section',
                'How Does it Work?',
                null,
                'ht_slider_page1'
            );
            
            add_settings_field(
                'ht_slider_shortcode',
                'Shortcode',
                array( $this, 'ht_slider_shortcode_callback' ),
                'ht_slider_page1',
                'ht_slider_main_section'
            );
        }

        public function ht_slider_shortcode_callback() {
            echo _e( '<span>Use the shortcode [ht_slider] to display the slider in any post/page/widget</span>' );
        }

        public function ht_slider_options_validate( $input ) {
            // $valid = array();
            // $valid['ht_slider_shortcode'] = sanitize_text_field( $input['ht_slider_shortcode'] );
            // return $valid;
        }
    }
}

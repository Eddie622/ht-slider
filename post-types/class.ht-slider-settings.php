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
                // array( $this, 'ht_slider_options_validate' )
            );

            add_settings_section(
                'ht_slider_main_section',
                'How Does it Work?',
                null,
                'ht_slider_page1'
            );

            add_settings_section(
                'ht_slider_second_section',
                'Other Plugin Options',
                null,
                'ht_slider_page2'
            );
            
            add_settings_field(
                'ht_slider_shortcode',
                'Shortcode',
                array( $this, 'ht_slider_shortcode_callback' ),
                'ht_slider_page1',
                'ht_slider_main_section'
            );

            add_settings_field(
                'ht_slider_title',
                'Slider Title',
                array( $this, 'ht_slider_title_callback' ),
                'ht_slider_page2',
                'ht_slider_second_section'
            );

            add_settings_field(
                'ht_slider_bullets',
                'Slider Bullets',
                array( $this, 'ht_slider_bullets_callback' ),
                'ht_slider_page2',
                'ht_slider_second_section'
            );

            add_settings_field(
                'ht_slider_style',
                'Slider Style',
                array( $this, 'ht_slider_style_callback' ),
                'ht_slider_page2',
                'ht_slider_second_section'
            );
        }

        public function ht_slider_shortcode_callback() {
            echo _e( '<span>Use the shortcode [ht_slider] to display the slider in any post/page/widget</span>' );
        }

        public function ht_slider_title_callback() {
            printf(
                '<input type="text" id="ht_slider_title" name="ht_slider_options[ht_slider_title]" value="%s" />',
                isset( self::$options['ht_slider_title'] ) ? esc_attr( self::$options['ht_slider_title'] ) : ''
            );
        }

        public function ht_slider_bullets_callback() {
            printf(
                '<input type="checkbox" id="ht_slider_bullets" name="ht_slider_options[ht_slider_bullets]" value="1" %s />',
                isset( self::$options['ht_slider_bullets'] ) ? 'checked' : ''
            );
        }

        public function ht_slider_style_callback() {
            printf(
                '<select id="ht_slider_style" name="ht_slider_options[ht_slider_style]">
                    <option value="style1" %s>Style 1</option>
                    <option value="style2" %s>Style 2</option>
                    <option value="style3" %s>Style 3</option>
                </select>',
                isset( self::$options['ht_slider_style'] ) && self::$options['ht_slider_style'] == 'style1' ? 'selected' : '',
                isset( self::$options['ht_slider_style'] ) && self::$options['ht_slider_style'] == 'style2' ? 'selected' : '',
                isset( self::$options['ht_slider_style'] ) && self::$options['ht_slider_style'] == 'style3' ? 'selected' : ''
            );
        }

        public function ht_slider_options_validate( $input ) {
            // $valid = array();
            // $valid['ht_slider_shortcode'] = sanitize_text_field( $input['ht_slider_shortcode'] );
            // return $valid;
        }
    }
}

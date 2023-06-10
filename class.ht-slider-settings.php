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
                esc_html__( 'How Does it Work?', 'ht-slider' ),
                null,
                'ht_slider_page1'
            );

            add_settings_section(
                'ht_slider_second_section',
                esc_html__( 'Other PLugin Options', 'ht-slider' ),
                null,
                'ht_slider_page2'
            );
            
            add_settings_field(
                'ht_slider_shortcode',
                esc_html__( 'Shortcode', 'ht-slider' ),
                array( $this, 'ht_slider_shortcode_callback' ),
                'ht_slider_page1',
                'ht_slider_main_section'
            );

            add_settings_field(
                'ht_slider_title',
                esc_html__( 'Slider Title', 'ht-slider' ),
                array( $this, 'ht_slider_title_callback' ),
                'ht_slider_page2',
                'ht_slider_second_section',
                array(
                    'label_for' => 'ht_slider_title'
                )
            );

            add_settings_field(
                'ht_slider_bullets',
                esc_html__( 'Slider Bullets', 'ht-slider' ),
                array( $this, 'ht_slider_bullets_callback' ),
                'ht_slider_page2',
                'ht_slider_second_section',
                array(
                    'label_for' => 'ht_slider_bullets'
                )
            );

            add_settings_field(
                'ht_slider_style',
                esc_html__( 'Slider Style', 'ht-slider' ),
                array( $this, 'ht_slider_style_callback' ),
                'ht_slider_page2',
                'ht_slider_second_section',
                array(
                    'items' => array(
                        'style-1',
                        'style-2',
                    ),
                    'label_for' => 'ht_slider_style'
                )
            );
        }

        public function ht_slider_shortcode_callback() {
            printf('<span>%s</span>', esc_html_e( 'Use the shortcode [ht_slider] to display the slider in any post/page/widget', 'ht-slider' ) );
        }

        public function ht_slider_title_callback( $args ) {
            printf(
                '<input type="text" id="ht_slider_title" name="ht_slider_options[ht_slider_title]" value="%s" />',
                isset( self::$options['ht_slider_title'] ) ? esc_attr( self::$options['ht_slider_title'] ) : ''
            );
        }

        public function ht_slider_bullets_callback( $args ) {
            printf(
                '<input type="checkbox" id="ht_slider_bullets" name="ht_slider_options[ht_slider_bullets]" value="1" %s />',
                isset( self::$options['ht_slider_bullets'] ) ? 'checked' : ''
            );
        }

        public function ht_slider_style_callback( $args ) {
            printf( '<select id="ht_slider_style" name="ht_slider_options[ht_slider_style]">' );
            foreach( $args['items'] as $item ) {
                printf(
                    '<option value="%s" %s>%s</option>',
                    esc_attr__( $item ), isset( self::$options['ht_slider_style'] ) && self::$options['ht_slider_style'] === $item ? 'selected' : '', esc_html__( ucfirst( $item ) )
                );
            }
            printf( '</select>' );
        }

        public function ht_slider_options_validate( $input ) {
            $valid = array();
            foreach( $input as $key => $value ) {
                $valid[$key] = sanitize_text_field( $value );
                switch( $key ) {
                    case 'ht_slider_title':
                        if( empty( $input[$key] ) ) {
                            add_settings_error(
                                'ht_slider_options',
                                'ht_slider_message',
                                esc_html__( 'Please enter a title for the slider', 'ht-slider' ),
                                'error'
                            );
                        }
                        $valid[$key] = sanitize_text_field( $value );
                        break;
                    case 'ht_slider_url':
                        $valid[$key] = esc_url_raw( $value );
                        break;
                    case 'ht_slider_bullets':
                        $valid[$key] = absint( $value );
                        break;
                    default:
                        $valid[$key] = sanitize_text_field( $input[$key] );
                        break;
                }
            }
            return $valid;
        }
    }
}

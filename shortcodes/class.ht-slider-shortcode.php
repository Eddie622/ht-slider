<?php

if( !class_exists( 'HT_Slider_Shortcode' ) ) {
    class HT_Slider_Shortcode {
        public function __construct() {
            add_shortcode( 'ht_slider', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){
            $atts = array_change_key_case( (array)$atts, CASE_LOWER );

            extract( shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'date'
                    // 'class' => '',
                    // 'width' => '',
                    // 'height' => '',
                    // 'autoplay' => '',
                    // 'autoplay_speed' => '',
                    // 'arrows' => '',
                    // 'bullets' => '',
                    // 'effect' => '',
                    // 'pause_on_hover' => '',
                    // 'pause_on_focus' => '',
                    // 'rtl' => '',
                    // 'fade' => '',
                    // 'speed' => '',
                    // 'infinite' => '',
                    // 'slides_to_show' => '',
                    // 'slides_to_scroll' => '',
                    // 'adaptive_height' => '',
                    // 'center_mode' => '',
                    // 'center_padding' => '',
                    // 'variable_width' => '',
                    // 'vertical' => '',
                    // 'vertical_swiping' => '',
                    // 'fade' => '',
                    // 'as_nav_for' => '',
                    // 'focus_on_select' => '',
                    // 'lazy_load' => '',
                    // 'prev_arrow' => '',
                    // 'next_arrow' => '',
                    // 'responsive' => '',
                    // 'responsive_breakpoint' => '',
                    // 'responsive_breakpoint_2' => '',
                    // 'responsive_breakpoint_3' => '',
                ),
                $atts,
                $tag
            ));

            if( !empty ( $id ) ) {
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            ob_start();
            require( HT_SLIDER_PATH . 'views/ht-slider_shortcode.php');
            wp_enqueue_script( 'ht-slider-main-jq' );
            wp_enqueue_style( 'ht-slider-main-css' );
            wp_enqueue_style( 'ht-slider-style-css' );
            ht_slider_options();
            return ob_get_clean();
        }
    }
}
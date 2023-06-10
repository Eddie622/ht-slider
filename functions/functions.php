<?php

if ( !function_exists( 'ht_slider_get_placeholder_image' ) ) {
    function ht_slider_get_placeholder_image() {
        return '<img src="' . HT_SLIDER_URL . 'assets/images/default.jpg" alt="placeholder" class="img-fluid wp-post-image" />';
    }
}

if ( !function_exists( 'ht_slider_options' ) ) {
    function ht_slider_options() {
        $show_bullets = isset( HT_Slider_Settings::$options['ht_slider_bullets'] ) && HT_Slider_Settings::$options['ht_slider_bullets'] == 1 ? true : false;

        wp_enqueue_script( 'ht-slider-options-js', HT_SLIDER_URL . 'vendor/flexslider/flexslider.js', array( 'jquery' ), HT_SLIDER_VERSION, true );
        wp_localize_script( 'ht-slider-options-js', 'SLIDER_OPTIONS', array(
            'controlNav' => $show_bullets
        ) );
        // wp_add_inline_script( 'ht-slider-options-js', 'const SLIDER_OPTIONS = ' . json_encode( array(
        //     'controlNav' => $show_bullets,
        // ) ), 'before' );
    }
}
<?php

/**
 * Plugin Name: HT Slider
 * Plugin URI: https://www.wordpress.org/ht-slider
 * Description: Image Slider
 * Version: 1.0
 * Requires at least: 5.6
 * Author: Heriberto Torres
 * Author URI: https://heribertotorres.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ht-slider
 * Domain Path: /languages
 */

 /*
HT Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
HT Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with HT Slider. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if( !defined( 'ABSPATH') ){
    exit;
}

if ( !class_exists( 'HT_Slider' ) ){
    class HT_Slider {
        function __construct(){
            $this->define_constants();

            require_once( HT_SLIDER_PATH . 'post-types/class.ht-slider-cpt.php' );
            $HT_Slider_Post_Type = new HT_Slider_Post_Type();
        }

        public function define_constants(){
            define( 'HT_SLIDER_VERSION', '1.0.0' );
            define( 'HT_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
            define( 'HT_SLIDER_URL', plugin_dir_url( __FILE__ ) );
        }

        public static function activate(){
            update_option( 'rewrite_rules', '' );
        }
        public static function deactivate(){
            flush_rewrite_rules();
        }
        public static function uninstall(){

        }
    }
}

if( class_exists( 'HT_Slider' ) ){
    register_activation_hook( __FILE__, array( 'HT_Slider', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'HT_Slider', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'HT_Slider', 'uninstall' ) );
    $ht_slider = new HT_Slider();
}
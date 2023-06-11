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
        private static $instance = null;

        public static function get_instance() {
            if( null === self::$instance ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        function __construct(){
            $this->define_constants();

            $this->load_textdomain();

            require_once( HT_SLIDER_PATH . 'functions/functions.php' );

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( HT_SLIDER_PATH . 'post-types/class.ht-slider-cpt.php' );
            $HT_Slider_Post_Type = new HT_Slider_Post_Type();

            require_once( HT_SLIDER_PATH . 'class.ht-slider-settings.php' );
            $HT_Slider_Settings = new HT_Slider_Settings();

            require_once( HT_SLIDER_PATH . 'shortcodes/class.ht-slider-shortcode.php' );
            $HT_Slider_Shortcode = new HT_Slider_Shortcode();

            add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 999 );
            add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
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
            unregister_post_type( 'ht-slider' );
        }

        public static function uninstall(){
            delete_option( 'ht_slider_options' );

            $posts = get_posts( 
                array(
                    'post_type' => 'ht-slider',
                    'numberposts' => -1,
                    'post_status' => 'any'
                ) 
            );

            foreach( $posts as $post ){
                wp_delete_post( $post->ID, true );
            }
        }

        public function load_textdomain(){
            load_plugin_textdomain( 'ht-slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        public function add_menu(){
            add_menu_page(
                esc_html__( 'HT Slider Options', 'ht-slider' ),
                esc_html__( 'HT Slider', 'ht-slider' ),
                'manage_options',
                'ht_slider_admin',
                array( $this, 'ht_slider_settings_page' ),
                'dashicons-images-alt2'
            );

            add_submenu_page(
                'ht_slider_admin',
                esc_html__( 'Manage Slides', 'ht-slider' ),
                esc_html__( 'Manage Slides', 'ht-slider' ),
                'manage_options',
                'edit.php?post_type=ht-slider',
                null
            );

            add_submenu_page(
                'ht_slider_admin',
                esc_html__( 'Add New Slide', 'ht-slider' ),
                esc_html__( 'Add New Slide', 'ht-slider' ),
                'manage_options',
                'post-new.php?post_type=ht-slider',
                null
            );
        }

        public function ht_slider_settings_page(){
            if( !current_user_can( 'manage_options' ) ){
                return;
            }
            if( isset( $_GET['settings-updated'] ) ){
                add_settings_error( 'ht_slider_options', 'ht_slider_message', esc_html__( 'Settings Saved', 'ht-slider' ), 'success' );
            }
            settings_errors( 'ht_slider_options' );
            require_once( HT_SLIDER_PATH . 'views/ht-slider_settings.php' );
        }

        public function register_scripts(){
            wp_register_script( 'ht-slider-main-jq', HT_SLIDER_URL . 'vendor/flexslider/jquery.flexslider-min.js', array( 'jquery' ), HT_SLIDER_VERSION, true );
            wp_register_style( 'ht-slider-main-css', HT_SLIDER_URL . 'vendor/flexslider/flexslider.css', array(), HT_SLIDER_VERSION, 'all' );
            wp_register_style( 'ht-slider-style-css', HT_SLIDER_URL . 'assets/css/frontend.css', array(), HT_SLIDER_VERSION, 'all' );
        }

        public function register_admin_scripts(){
            // global $pagenow;
            // if( $pagenow == 'post.php' || $pagenow == 'post-new.php' ){
            //     wp_enqueue_script( 'ht-slider-admin-js', HT_SLIDER_URL . 'assets/js/admin.js', array( 'jquery' ), HT_SLIDER_VERSION, true );
            // }
            global $typenow;
            if( $typenow == 'ht-slider' ) {
                wp_enqueue_style( 'ht-slider-admin-css', HT_SLIDER_URL . 'assets/css/admin.css', array(), HT_SLIDER_VERSION, 'all' );
            }
        }
    }
}

if( class_exists( 'HT_Slider' ) ){
    register_activation_hook( __FILE__, array( 'HT_Slider', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'HT_Slider', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'HT_Slider', 'uninstall' ) );
    HT_Slider::get_instance();
}
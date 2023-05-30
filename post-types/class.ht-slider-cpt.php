<?php

if( !class_exists( 'HT_Slider_Post_Type' ) ){
    class HT_Slider_Post_Type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
        }

        public function create_post_type(){
            register_post_type(
                'ht-slider',
                array(
                    'label' => __( 'HT Slider', 'ht-slider' ),
                    'description' => __( 'Sliders', 'ht-slider' ),
                    'labels' => array(
                        'name' => __( 'Sliders', 'ht-slider' ),
                        'singular_name' => __( 'Slider', 'ht-slider' ),
                        'menu_name' => __( 'Slider', 'ht-slider' ),
                        'name_admin_bar' => __( 'Slider', 'ht-slider' ),
                        'add_new' => __( 'Add New', 'ht-slider' ),
                        'add_new_item' => __( 'Add New Slider', 'ht-slider' ),
                        'new_item' => __( 'New Slider', 'ht-slider' ),
                        'edit_item' => __( 'Edit Slider', 'ht-slider' ),
                        'view_item' => __( 'View Slider', 'ht-slider' ),
                        'all_items' => __( 'All Sliders', 'ht-slider' ),
                        'search_items' => __( 'Search Sliders', 'ht-slider' ),
                        'parent_item_colon' => __( 'Parent Sliders:', 'ht-slider' ),
                        'not_found' => __( 'No Sliders found.', 'ht-slider' ),
                        'not_found_in_trash' => __( 'No Sliders found in Trash.', 'ht-slider' ),
                        'featured_image' => __( 'Slider Cover Image', 'ht-slider' ),
                        'set_featured_image' => __( 'Set cover image', 'ht-slider' ),
                        'remove_featured_image' => __( 'Remove cover image', 'ht-slider' ),
                        'use_featured_image' => __( 'Use as cover image', 'ht-slider' ),
                        'archives' => __( 'Slider archives', 'ht-slider' ),
                        'insert_into_item' => __( 'Insert into Slider', 'ht-slider' ),
                        'uploaded_to_this_item' => __( 'Uploaded to this Slider', 'ht-slider' ),
                        'filter_items_list' => __( 'Filter Sliders list', 'ht-slider' ),
                        'items_list_navigation' => __( 'Sliders list navigation', 'ht-slider' ),
                        'items_list' => __( 'Sliders list', 'ht-slider' ),
                    ),
                    'public' => true,
                    'supports' => array( 'title', 'editor', 'thumbnail' ),
                    'heirarchical' => false,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export' => true,
                    'has_archive' => false,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-images-alt2'
                )
            );
        }
    }
}
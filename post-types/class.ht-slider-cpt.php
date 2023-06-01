<?php

if( !class_exists( 'HT_Slider_Post_Type' ) ){
    class HT_Slider_Post_Type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
            add_filter( 'manage_ht-slider_posts_columns', array( $this, 'ht_slider_cpt_columns' ) );
            add_action( 'manage_ht-slider_posts_custom_column', array( $this, 'ht_slider_custom_columns'), 10, 2 );
            add_filter( 'manage_edit-ht-slider_sortable_columns', array( $this, 'ht_slider_sortable_columns' ) );
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
                    'show_in_menu' => false,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export' => true,
                    'has_archive' => false,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-images-alt2',
                )
            );
        }

        public function ht_slider_cpt_columns( $columns ){
            $columns['ht_slider_link_text'] = esc_html__( 'Link Text', 'ht-slider' );
            $columns['ht_slider_link_url'] = esc_html__( 'Link URL', 'ht-slider' );
            return $columns;
        }

        public function ht_slider_custom_columns( $column, $post_id ){
            switch( $column ){
                case 'ht_slider_link_text':
                    echo esc_html( get_post_meta( $post_id, 'ht_slider_link_text', true ) );
                break;
                case 'ht_slider_link_url':
                    echo esc_url( get_post_meta( $post_id, 'ht_slider_link_url', true ) );
                break;                
            }
        }

        public function ht_slider_sortable_columns( $columns ){
            $columns['ht_slider_link_text'] = 'ht_slider_link_text';
            return $columns;
        }

        public function add_meta_boxes(){
            add_meta_box(
                'ht_slider_meta_box',
                __( 'Link options', 'ht-slider' ),
                array( $this, 'add_inner_meta_boxes' ),
                'ht-slider',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes( $post ) {
            require_once( HT_SLIDER_PATH . 'views/ht-slider_metabox.php' );
        }

        public function save_meta_boxes( $post_id ){
            if( isset( $_POST['ht_slider_nonce'] ) && !wp_verify_nonce( $_POST['ht_slider_nonce'], 'ht_slider_nonce' ) ){
                return;
            }

            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            if( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'ht-slider' ){
                if( ! current_user_can( 'edit_page', $post_id ) || ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }
            }

            if( isset( $_POST['action'] ) && $_POST['action'] == 'editpost' ){
                $old_link_text = get_post_meta( $post_id, 'ht_slider_link_text', true );
                $new_link_text = $_POST['ht_slider_link_text'];
                $old_link_url = get_post_meta( $post_id, 'ht_slider_link_url', true );
                $new_link_url = $_POST['ht_slider_link_url'];

                if( empty( $new_link_text )){
                    update_post_meta( $post_id, 'ht_slider_link_text', 'Add some text' );
                } else {
                    update_post_meta( $post_id, 'ht_slider_link_text', sanitize_text_field( $new_link_text ), $old_link_text );
                }

                if( empty( $new_link_url )){
                    update_post_meta( $post_id, 'ht_slider_link_url', '#' );
                } else {
                    update_post_meta( $post_id, 'ht_slider_link_url', sanitize_text_field( $new_link_url ), $old_link_url );
                }
            }
        }
    }
}
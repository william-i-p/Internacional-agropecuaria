<?php

/*=======================================================
*    Register Post type
* =======================================================*/

if ( ! function_exists('htslider_register_custom_post') ) {
    
    function htslider_register_custom_post() {
    
        // Register Header Post type
        $labels = array(
            'name'                  => _x( 'Slider', 'Post Type General Name', 'htslider-pro' ),
            'singular_name'         => _x( 'Slider', 'Post Type Singular Name', 'htslider-pro' ),
            'menu_name'             => esc_html__( 'Slider', 'htslider-pro' ),
            'name_admin_bar'        => esc_html__( 'Slider', 'htslider-pro' ),
            'archives'              => esc_html__( 'Item Archives', 'htslider-pro' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'htslider-pro' ),
            'all_items'             => esc_html__( 'All Sliders', 'htslider-pro' ),
            'add_new_item'          => esc_html__( 'Add New Slider', 'htslider-pro' ),
            'add_new'               => esc_html__( 'Add New Slider', 'htslider-pro' ),
            'new_item'              => esc_html__( 'New Item', 'htslider-pro' ),
            'edit_item'             => esc_html__( 'Edit Item', 'htslider-pro' ),
            'update_item'           => esc_html__( 'Update Item', 'htslider-pro' ),
            'view_item'             => esc_html__( 'View Item', 'htslider-pro' ),
            'search_items'          => esc_html__( 'Search Item', 'htslider-pro' ),
            'not_found'             => esc_html__( 'Not found', 'htslider-pro' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'htslider-pro' ),
            'featured_image'        => esc_html__( 'Featured Image', 'htslider-pro' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'htslider-pro' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'htslider-pro' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'htslider-pro' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'htslider-pro' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'htslider-pro' ),
            'items_list'            => esc_html__( 'Items list', 'htslider-pro' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'htslider-pro' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'htslider-pro' ),
        );

        $args = array(
            'label'                 => esc_html__( 'Slider', 'htslider-pro' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor' ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => 'htslider_page',
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-welcome-view-site',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,       
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => false,
            'capability_type'       => 'page',
        );

        register_post_type( 'htslider_slider', $args );    

    }
    add_action( 'init', 'htslider_register_custom_post', 0 );

}

/*=======================================================
*    Register Custom Taxonomy
* =======================================================*/

if(! function_exists('htslider_custom_taxonomy')){

    function htslider_custom_taxonomy(){
        $labels = array(
            'name'                       => _x( 'Slider Categories', 'Taxonomy General Name', 'htslider-pro' ),
            'singular_name'              => _x( 'Slider Category', 'Taxonomy Singular Name', 'htslider-pro' ),
            'menu_name'                  => esc_html__( 'Slider Category', 'htslider-pro' ),
            'all_items'                  => esc_html__( 'All Item Categories', 'htslider-pro' ),
            'parent_item'                => esc_html__( 'Parent Item', 'htslider-pro' ),
            'parent_item_colon'          => esc_html__( 'Parent Item:', 'htslider-pro' ),
            'new_item_name'              => esc_html__( 'New Item Category', 'htslider-pro' ),
            'add_new_item'               => esc_html__( 'Add New Item', 'htslider-pro' ),
            'edit_item'                  => esc_html__( 'Edit Item', 'htslider-pro' ),
            'update_item'                => esc_html__( 'Update Item', 'htslider-pro' ),
            'view_item'                  => esc_html__( 'View Item', 'htslider-pro' ),
            'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'htslider-pro' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove items', 'htslider-pro' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'htslider-pro' ),
            'popular_items'              => esc_html__( 'Popular Items', 'htslider-pro' ),
            'search_items'               => esc_html__( 'Search Items', 'htslider-pro' ),
            'not_found'                  => esc_html__( 'Not Found', 'htslider-pro' ),
            'no_terms'                   => esc_html__( 'No items', 'htslider-pro' ),
            'items_list'                 => esc_html__( 'Items list', 'htslider-pro' ),
            'items_list_navigation'      => esc_html__( 'Items list navigation', 'htslider-pro' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'htslider_category', array( 'htslider_slider' ), $args );

    }

    add_action( 'init', 'htslider_custom_taxonomy', 0 );

}
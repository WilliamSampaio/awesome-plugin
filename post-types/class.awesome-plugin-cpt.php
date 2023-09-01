<?php

if (!class_exists('AwesomePlugin_Post_Type')) {

    // classe do Post Type
    class AwesomePlugin_Post_Type
    {
        function __construct()
        {
            add_action('init', [$this, 'create_post_type']);
        }

        public function create_post_type()
        {
            register_post_type('ap-slider', [
                'label' => 'AwesomePlugin - Slider',
                'description' => 'Sliders',
                'labels' => [
                    'name' => 'Sliders',
                    'singular_name' => 'Slider',
                ],
                'public' => true,
                'supports' => [
                    'title',
                    'editor',
                    'thumbnail'
                ],
                'hierarchical' => false,
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
            ]);
        }
    }
}

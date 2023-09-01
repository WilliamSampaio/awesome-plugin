<?php

// Nunca confie nos dados fornecidos pelo usuário!

if (!class_exists('AwesomePlugin_Post_Type')) {

    // classe do Post Type
    class AwesomePlugin_Post_Type
    {
        function __construct()
        {
            add_action('init', [$this, 'create_post_type']);
            add_action('add_meta_boxes', [
                $this, 'add_meta_boxes'
            ]);
            add_action('save_post', [$this, 'save_post'], accepted_args: 2);
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
                'show_in_rest' => false,
                'menu_icon' => 'dashicons-images-alt2',
                //'register_meta_box_cb' => [$this, 'add_meta_boxes']
            ]);
        }

        public function add_meta_boxes()
        {
            add_meta_box(
                'ap_slider_meta_box',
                'Link Options',
                [$this, 'add_inner_meta_boxes'],
                'ap-slider',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes($post)
        {
            require_once(AWESOME_PLUGIN_PATH . 'views/ap-slider_metabox.php');
        }

        public function save_post($post_id)
        {
            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {
                $old_link_text = get_post_meta($post_id, 'ap_slider_link_text');
                $new_link_text = $_POST['ap_slider_link_text'];
                $old_link_url = get_post_meta($post_id, 'ap_slider_link_url');
                $new_link_url = $_POST['ap_slider_link_url'];

                $new_link_text = sanitize_text_field($new_link_text);
                $new_link_url = sanitize_text_field($new_link_url);

                if (empty($new_link_text)) {
                    update_post_meta($post_id, 'ap_slider_link_text', 'Add a valid text');
                } else {
                    update_post_meta($post_id, 'ap_slider_link_text', $new_link_text, $old_link_text);
                }

                if (empty($new_link_url)) {
                    update_post_meta($post_id, 'ap_slider_link_url', '#');
                } else {
                    update_post_meta($post_id, 'ap_slider_link_url', $new_link_url, $old_link_url);
                }
            }
        }
    }
}

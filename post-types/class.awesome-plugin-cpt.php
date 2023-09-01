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
            add_action('manage_ap-slider_posts_columns', [
                $this, 'ap_slider_cpt_columns'
            ]);
            add_action('manage_ap-slider_posts_custom_column', [
                $this, 'ap_slider_custom_columns'
            ], accepted_args: 2);
            add_action('manage_edit-ap-slider_sortable_columns', [$this, 'ap_slider_sortable_columns']);
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
                'show_in_menu' => false, // oculta post type no menu
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

        // metodo que torna as colunas ordenaveis no painel do postype
        public function ap_slider_sortable_columns($columns)
        {
            $columns['ap_slider_link_text'] = 'ap_slider_link_text';
            $columns['ap_slider_link_url'] = 'ap_slider_link_url';
            return $columns;
        }

        // metodo que adciona os dados nas devidas colunas no painel do postype
        public function ap_slider_custom_columns($column, $post_id)
        {
            switch ($column) {
                case 'ap_slider_link_text':
                    echo esc_html(get_post_meta($post_id, 'ap_slider_link_text', true));
                    break;
                case 'ap_slider_link_url':
                    echo esc_url(get_post_meta($post_id, 'ap_slider_link_url', true));
                    break;
            }
        }

        // metodo que adciona as colunas no painel do postyupe
        public function ap_slider_cpt_columns($columns)
        {
            $columns['ap_slider_link_text'] = esc_html__('Link Text', 'ap-slider');
            $columns['ap_slider_link_url'] = esc_html__('Link URL', 'ap-slider');
            return $columns;
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
            // valida nonce code
            if (isset($_POST['ap_slider_nonce'])) {
                if (!wp_verify_nonce($_POST['ap_slider_nonce'], 'ap_slider_nonce')) return;
            }

            // se o auto save estiver ativo retorna da funcao
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

            // verifica se o post é referente ao nosso plugin
            if (isset($_POST['post_type']) && $_POST['post_type'] === 'ap-slider') {

                // verifica se o usuario logado tem permissão de edicao
                if (!current_user_can('edit_page', $post_id)) {
                    return;
                } elseif (!current_user_can('edit_post', $post_id)) {
                    return;
                }
            }

            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {
                $old_link_text = get_post_meta($post_id, 'ap_slider_link_text', true);
                $new_link_text = $_POST['ap_slider_link_text'];
                $old_link_url = get_post_meta($post_id, 'ap_slider_link_url', true);
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

<?php

namespace AP\Includes;

use AP\CustomPostTypes\Slider;
use AP\Shortcodes\SliderShortcode;

if (!class_exists('AwesomePlugin')) {

    // Classe principal do plugin
    class AwesomePlugin
    {
        protected $slider;
        protected $settings;
        protected $slider_shortcode;

        function __construct()
        {
            $this->load_textdomain();

            require_once AWESOME_PLUGIN_PATH . 'functions/functions.php';
            // Adiciona a acao que coloca o menu
            add_action('admin_menu', [$this, 'add_menu']);

            // instancia o post type
            $this->slider = new Slider();

            // instancia a classe de settings
            // require_once(AWESOME_PLUGIN_PATH . 'class.mv-slider-settings.php');
            // $AwesomePlugin_Settings = new AwesomePlugin_Settings();
            $this->settings = new Settings();

            $this->slider_shortcode = new SliderShortcode();

            // enfileira os js e css
            add_action('wp_enqueue_scripts', [$this, 'register_scripts'], 999);
        }

        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        public static function deactivate()
        {
            flush_rewrite_rules();

            // desregistra o post type
            unregister_post_type('ap-slider');
        }

        public static function uninstall()
        {
            delete_option('ap_slider_options');
            $posts = get_posts([
                'post_type' => 'ap-slider',
                'number_posts' => -1,
                'post_status' => 'any'
            ]);

            foreach ($posts as $post) {
                wp_delete_post($post->ID, true);
            }
        }

        public function load_textdomain()
        {
            load_plugin_textdomain(
                'awesome-plugin',
                false,
                plugin_basename(AWESOME_PLUGIN_PATH) . '/languages/'
            );
        }

        // metodo que que adiciona o menu
        public function add_menu()
        {
            // add_options_page(
            // add_theme_page(
            // add_plugins_page(
            add_menu_page(
                esc_html__('AP Slider Options', 'awesome-plugin'),
                esc_html__('AP Slider', 'awesome-plugin'),
                'manage_options',
                'ap_slider_admin',
                [$this, 'ap_slider_settings_page'],
                // usado somente no add_menu_page
                'dashicons-images-alt2'
            );

            add_submenu_page(
                'ap_slider_admin',
                esc_html__('Manage Slides', 'awesome-plugin'),
                esc_html__('Manage Slides', 'awesome-plugin'),
                'manage_options',
                'edit.php?post_type=ap-slider',
                null,
                null
            );

            add_submenu_page(
                'ap_slider_admin',
                esc_html__('Add New Slide', 'awesome-plugin'),
                esc_html__('Add New Slide', 'awesome-plugin'),
                'manage_options',
                'post-new.php?post_type=ap-slider',
                null,
                null
            );
        }

        public function ap_slider_settings_page()
        {
            if (!current_user_can('manage_options')) {
                return;
            }

            if (isset($_GET['settings-updated'])) {
                add_settings_error('ap_slider_options', 'ap_slider_message', esc_html__('Settings Saved!', 'awesome-plugin'), 'success');
            }
            settings_errors('ap_slider_options');

            // importa a view da pagina de settings do plugin
            require_once(AWESOME_PLUGIN_PATH . 'views/ap-settings-page.php');
        }

        // registra todos os assets js e css
        public function register_scripts()
        {
            wp_register_script(
                'ap-slider-main-jq',
                AWESOME_PLUGIN_URL . 'assets/flexslider/jquery.flexslider-min.js',
                ['jquery'],
                AWESOME_VERSION,
                true
            );
            wp_register_style(
                'ap-slider-main-css',
                AWESOME_PLUGIN_URL . 'assets/flexslider/flexslider.css',
                [],
                AWESOME_VERSION,
                'all'
            );
            wp_register_style(
                'ap-slider-style-css',
                AWESOME_PLUGIN_URL . 'assets/css/slider.css',
                [],
                AWESOME_VERSION,
                'all'
            );
        }
    }
}

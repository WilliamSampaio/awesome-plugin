<?php

namespace AP\Includes;

use AP\CustomPostTypes\Slider;

if (!class_exists('AwesomePlugin')) {

    // Classe principal do plugin
    class AwesomePlugin
    {
        protected $slider;
        protected $settings;

        function __construct()
        {
            // Adiciona a acao que coloca o menu
            add_action('admin_menu', [$this, 'add_menu']);

            // instancia o post type
            $this->slider = new Slider();

            // instancia a classe de settings
            // require_once(AWESOME_PLUGIN_PATH . 'class.mv-slider-settings.php');
            // $AwesomePlugin_Settings = new AwesomePlugin_Settings();
            $this->settings = new Settings();
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
        }

        // metodo que que adiciona o menu
        public function add_menu()
        {
            // add_options_page(
            // add_theme_page(
            // add_plugins_page(
            add_menu_page(
                'AP Slider Options',
                'AP Slider',
                'manage_options',
                'ap_slider_admin',
                [$this, 'ap_slider_settings_page'],
                // usado somente no add_menu_page
                'dashicons-images-alt2'
            );

            add_submenu_page(
                'ap_slider_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=ap-slider',
                null,
                null
            );

            add_submenu_page(
                'ap_slider_admin',
                'Add New Slide',
                'Add New Slide',
                'manage_options',
                'post-new.php?post_type=ap-slider',
                null,
                null
            );
        }

        public function ap_slider_settings_page()
        {
            // importa a view da pagina de settings do plugin
            require_once(AWESOME_PLUGIN_PATH . 'views/settings-page.php');
        }
    }
}

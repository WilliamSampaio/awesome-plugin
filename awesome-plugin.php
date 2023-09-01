<?php

/**
 * Plugin Name: Awesome Plugin
 * Plugin URI: https://wordpress.org/
 * Description: Your Awesome Plugin!
 * Version: 1.0
 * Requires at least: 6.3
 * Author: William Sampaio
 * Author URI: https://github.com/WilliamSampaio
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: awesome-plugin
 * Domain Path: /languages
 */

/*
Awesome Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Awesome Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Awesome Plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if (!defined('ABSPATH')) exit;

// Se a classe NÃO existe declara ela
if (!class_exists('AwesomePlugin')) {

    // Classe principal do plugin
    class AwesomePlugin
    {
        function __construct()
        {
            $this->define_constants();

            // Adiciona a acao que coloca o menu
            add_action('admin_menu', [$this, 'add_menu']);

            // instancia o post type
            require_once(AWESOME_PLUGIN_PATH . 'post-types/class.awesome-plugin-cpt.php');
            $AwesomePlugin_Post_Type = new AwesomePlugin_Post_Type();

            // instancia a classe de settings
            require_once(AWESOME_PLUGIN_PATH . 'class.mv-slider-settings.php');
            $AwesomePlugin_Settings = new AwesomePlugin_Settings();
        }

        // define constantes utilizadas no plugin
        public function define_constants()
        {
            define('AWESOME_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('AWESOME_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('AWESOME_VERSION', '1.0.0');
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

// Se a classe existe instancia ela
if (class_exists('AwesomePlugin')) {
    register_activation_hook(__FILE__, ['AwesomePlugin', 'activate']);
    register_deactivation_hook(__FILE__, ['AwesomePlugin', 'deactivate']);
    register_uninstall_hook(__FILE__, ['AwesomePlugin', 'uninstall']);
    $plugin = new AwesomePlugin();
}

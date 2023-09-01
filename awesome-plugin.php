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
    class AwesomePlugin
    {
        function __construct()
        {
            $this->define_constants();
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
        }

        public static function uninstall()
        {
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

<?php

namespace AP\Includes;

if (!class_exists('Settings')) {

    class Settings
    {
        public static $options;

        function __construct()
        {
            self::$options = get_option('ap_slider_options');
            add_action('admin_init', [$this, 'admin_init']);
        }

        public function admin_init()
        {
            register_setting('ap_slider_group', 'ap_slider_options');

            add_settings_section(
                'ap_slider_main_section',
                'How does it work?',
                null,
                'ap_slider_page1'
            );

            add_settings_field(
                'ap_slider_shortcode',
                'Shortcode',
                [$this, 'ap_slider_shortcode_callback'],
                'ap_slider_page1',
                'ap_slider_main_section'
            );

            add_settings_section(
                'ap_slider_second_section',
                'Other Plugin Options',
                null,
                'ap_slider_page2'
            );

            add_settings_field(
                'ap_slider_title',
                'Slider Text',
                [$this, 'ap_slider_title_callback'],
                'ap_slider_page2',
                'ap_slider_second_section',
                [
                    'label_for' => 'ap_slider_title'
                ]
            );

            add_settings_field(
                'ap_slider_bullets',
                'Display Bullets',
                [$this, 'ap_slider_bullets_callback'],
                'ap_slider_page2',
                'ap_slider_second_section',
                [
                    'label_for' => 'ap_slider_bullets'
                ]
            );

            add_settings_field(
                'ap_slider_style',
                'Slider Style',
                [$this, 'ap_slider_style_callback'],
                'ap_slider_page2',
                'ap_slider_second_section',
                [
                    'itens' => [
                        'style-1' => 'Style 1',
                        'style-2' => 'Style 2'
                    ],
                    'label_for' => 'ap_slider_style'
                ]
            );
        }

        public function ap_slider_shortcode_callback()
        {
            echo esc_html("<span>Use the Shortcode [ap_slider] to display the slider in any page/post/widget</span>");
        }

        public function ap_slider_title_callback($args)
        {
            require_once(AWESOME_PLUGIN_PATH . 'views/ap-settings-field-slider-title.php');
        }

        public function ap_slider_bullets_callback($args)
        {
            require_once(AWESOME_PLUGIN_PATH . 'views/ap-settings-field-slider-bullets.php');
        }

        public function ap_slider_style_callback($args)
        {
            require_once(AWESOME_PLUGIN_PATH . 'views/ap-settings-field-slider-style.php');
        }
    }
}

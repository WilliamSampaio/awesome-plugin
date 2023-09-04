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
            register_setting('ap_slider_group', 'ap_slider_options', [$this, 'ap_slider_validate']);

            add_settings_section(
                'ap_slider_main_section',
                esc_html__('How does it work?', 'awesome-plugin'),
                null,
                'ap_slider_page1'
            );

            add_settings_field(
                'ap_slider_shortcode',
                esc_html__('Shortcode', 'awesome-plugin'),
                [$this, 'ap_slider_shortcode_callback'],
                'ap_slider_page1',
                'ap_slider_main_section'
            );

            add_settings_section(
                'ap_slider_second_section',
                esc_html__('Other Plugin Options', 'awesome-plugin'),
                null,
                'ap_slider_page2'
            );

            add_settings_field(
                'ap_slider_title',
                esc_html__('Slider Text', 'awesome-plugin'),
                [$this, 'ap_slider_title_callback'],
                'ap_slider_page2',
                'ap_slider_second_section',
                [
                    'label_for' => 'ap_slider_title'
                ]
            );

            add_settings_field(
                'ap_slider_bullets',
                esc_html__('Display Bullets', 'awesome-plugin'),
                [$this, 'ap_slider_bullets_callback'],
                'ap_slider_page2',
                'ap_slider_second_section',
                [
                    'label_for' => 'ap_slider_bullets'
                ]
            );

            add_settings_field(
                'ap_slider_style',
                esc_html__('Slider Style', 'awesome-plugin'),
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

        public function ap_slider_validate($input)
        {
            $new_input = [];
            foreach ($input as $key => $value) {
                $new_input[$key] = sanitize_text_field($value);
            }
            return $new_input;
        }
    }
}

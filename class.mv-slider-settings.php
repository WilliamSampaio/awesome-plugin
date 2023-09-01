<?php

if (!class_exists('AwesomePlugin_Settings')) {

    class AwesomePlugin_Settings
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
        }

        public function ap_slider_shortcode_callback()
        {
            echo esc_html("<span>Use the Shortcode [ap_slider] to display the slider in any page/post/widget</span>");
        }
    }
}

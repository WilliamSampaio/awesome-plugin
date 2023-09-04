<?php

namespace AP\Shortcodes;

if (!class_exists('SliderShortcode')) {

    class SliderShortcode
    {
        function __construct()
        {
            add_shortcode('ap_slider', [$this, 'ap_slider_shortcode']);
        }

        public function ap_slider_shortcode($atts = [], $content = null, $tag = '')
        {
            $atts = array_change_key_case((array) $atts, CASE_LOWER);
            extract(shortcode_atts(
                [
                    'id' => '',
                    'orderby' => 'date'
                ],
                $atts,
                $tag
            ));

            if (!empty($id)) {
                $id = array_map('absint', explode(',', $id));
            }

            // chama a view
            ob_start();
            require AWESOME_PLUGIN_PATH . 'views/ap-slider-shortcode.php';
            wp_enqueue_script('ap-slider-main-jq');
            wp_enqueue_style('ap-slider-main-css');
            wp_enqueue_style('ap-slider-style-css');
            ap_slider_options();
            return ob_get_clean();
        }
    }
}

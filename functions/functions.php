<?php

use AP\Includes\Settings;

if (!function_exists('ap_slider_get_placeholder_image')) {

    function ap_slider_get_placeholder_image()
    {
        return "<img src='" . AWESOME_PLUGIN_URL . 'assets/images/default.jpg' . "' class='img-fluid wp-post-image' />";
    }
}

if (!function_exists('ap_slider_options')) {

    function ap_slider_options()
    {
        $show_bullets = isset(Settings::$options['ap_slider_bullets']) && Settings::$options['ap_slider_bullets'] == 1 ? true : false;

        wp_enqueue_script(
            'ap-slider-options-js',
            AWESOME_PLUGIN_URL . 'assets/flexslider/flexslider.js',
            ['jquery'],
            AWESOME_VERSION,
            true
        );

        wp_localize_script('ap-slider-options-js', 'SLIDER_OPTIONS', ['controlNav' => $show_bullets]);
    }
}

<?php

// pega os dados salvos no banco de dados e escapa no atributo value dos inputs
$link_text = get_post_meta($post->ID, 'ap_slider_link_text', true);
$link_url = get_post_meta($post->ID, 'ap_slider_link_url', true);

?>

<table class="form-table ap-slider-metabox">
    <!-- Input hidden com o nonce code -->
    <input type="hidden" name="ap_slider_nonce" value="<?= wp_create_nonce('ap_slider_nonce') ?>">
    <tr>
        <th>
            <label for="ap_slider_link_text"><?php esc_html_e('Link Text', 'awesome-plugin') ?></label>
        </th>
        <td>
            <input type="text" name="ap_slider_link_text" id="ap_slider_link_text" class="regular-text link-text" value="<?= isset($link_text) ? esc_attr($link_text) : '' ?>" required>
        </td>
    </tr>
    <tr>
        <th>
            <label for="ap_slider_link_url"><?php esc_html_e('Link Url', 'awesome-plugin') ?></label>
        </th>
        <td>
            <input type="url" name="ap_slider_link_url" id="ap_slider_link_url" class="regular-text link-url" value="<?= isset($link_url) ? esc_url($link_url) : '' ?>" required>
        </td>
    </tr>
</table>
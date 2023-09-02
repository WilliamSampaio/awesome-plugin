<select id="ap_slider_style" name="ap_slider_options[ap_slider_style]">
    <?php foreach ($args['itens'] as $value => $text) : ?>
        <option value="<?= esc_attr($value) ?>" <?php isset(self::$options['ap_slider_style']) ? selected($value, self::$options['ap_slider_style'], true) : '' ?>>
            <?= esc_html($text) ?>
        </option>
    <?php endforeach ?>
</select>
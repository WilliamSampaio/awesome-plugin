<select id="ap_slider_style" name="ap_slider_options[ap_slider_style]">
    <?php foreach ($args['itens'] as $item) : ?>
        <option value="<?= esc_attr($item) ?>" <?php isset(self::$options['ap_slider_style']) ? selected($item, self::$options['ap_slider_style'], true) : '' ?>>
            <?= esc_html(ucfirst(str_replace('-', ' ', $item))) ?>
        </option>
    <?php endforeach ?>
</select>
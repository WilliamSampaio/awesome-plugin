<select id="ap_slider_style" name="ap_slider_options[ap_slider_style]">
    <option value="style-1" <?php isset(self::$options['ap_slider_style']) ? selected('style-1', self::$options['ap_slider_style'], true) : '' ?>>Style 1</option>
    <option value="style-2" <?php isset(self::$options['ap_slider_style']) ? selected('style-2', self::$options['ap_slider_style'], true) : '' ?>>Style 2</option>
</select>
<input 
type="checkbox" 
name="ap_slider_options[ap_slider_bullets]" 
id="ap_slider_bullets"
value="1"
<?php
    if (isset(self::$options['ap_slider_bullets'])) {
        checked('1', self::$options['ap_slider_bullets'], true);
    }
?>
>
<label for="ap_slider_bullets">Whether to display bullets or not</label>
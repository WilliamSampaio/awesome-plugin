<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()) ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('ap_slider_group');
        do_settings_sections('ap_slider_page1');
        submit_button('Save Settings');
        ?>
    </form>
</div>
<?php

use AP\Includes\Settings;

?>
<h3><?= !empty($content) ? esc_html($content) : esc_html(Settings::$options['ap_slider_title']) ?></h3>
<div class="ap-slider flexslider">
    <ul class="slides">
        <?php

        $args = [
            'post_type' => 'ap-slider',
            'post_status' => 'publish',
            'post__in' => $id,
            'orderby' => $orderby
        ];

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) :

            while ($my_query->have_posts()) :

                $my_query->the_post();
                $button_text = get_post_meta(get_the_ID(), 'ap_slider_link_text', true);
                $button_url = get_post_meta(get_the_ID(), 'ap_slider_link_url', true);
        ?>
                <li>
                    <?php the_post_thumbnail('full', ['class' => 'img-fluid']) ?>
                    <div class="ap-slider-container">
                        <div class="slider-details-container">
                            <div class="wrapper">
                                <div class="slider-title">
                                    <h2><?php the_title() ?></h2>
                                </div>
                                <div class="slider-description">
                                    <div class="subtitle"><?php the_content() ?></div>
                                    <a class="link" href="<?= esc_attr($button_url) ?>"><?= esc_html($button_text) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
        <?php

            endwhile;
            wp_reset_postdata();
        endif;

        ?>
    </ul>
</div>
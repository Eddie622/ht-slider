<h3><?php echo ( ! empty ( $content ) ) ? esc_html__( $content, 'ht-slider' ) : esc_html__( HT_Slider_Settings::$options['ht_slider_title'], 'ht-slider' ); ?></h3>
<div class="ht-slider flexslider <?php echo ( isset( HT_Slider_Settings::$options['ht_slider_style'] ) ? esc_attr__( HT_Slider_Settings::$options['ht_slider_style'] ) : 'style-1' ); ?>">
    <ul class="slides">
        <?php
            $args = array(
                'post_type' => 'ht-slider',
                'post_status' => 'publish',
                'post__in' => $id,
                'orderby' => $orderby,
            );

            $query = new WP_Query( $args );

            if( $query->have_posts() ):
                while( $query->have_posts() ) : $query->the_post();
        ?>
            <li>
                <?php
                if( has_post_thumbnail() ) {
                    the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); 
                } else {
                    echo ht_slider_get_placeholder_image();
                }
                ?>
                <div class="hts-container">
                    <div class="slider-details-container">
                        <div class="wrapper">
                            <div class="slider-title">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <div class="slider-description">
                                <div class="subtitle"><?php the_content(); ?></div>
                                <a class="link" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'ht_slider_link_url', true ), 'ht-slider' ) ?>">
                                    <?php echo esc_html_e( get_post_meta( get_the_ID(), 'ht_slider_link_text', true ), 'ht-slider' ) ?>
                                </a>
                            </div>
                        </div>
                    </div>              
                </div>
            </li>
        <?php
                endwhile;
            endif;
        wp_reset_postdata();
        ?>
    </ul>
</div>

<section class="container p-relative sec-space">

            <?php 
            $reviews = new WP_Query(array(
                'post_type'         	=> 'review',
                'posts_per_page'     	=> '8',
                'post_status'           => 'publish',
                'orderby'               => 'name',
                'order'                 => 'ASC',
                'hide_empty'            => 1,
                'depth'                 => 1,
            )); ?>
            
            <div class="swiper myReviews">

            <div class="swiper-wrapper">
                <?php
                while ($reviews->have_posts()) {
                $reviews->the_post();
                global $wp_query;
                ?>
                    <div class="swiper-slide">

                        <div class="reviews">
                            <div class="reviews__header">
                                <div class="initials">
                                    <?php if( get_field('name_initial') ): 
                                        the_field('name_initial'); 
                                    endif; ?>
                                </div>
                                <div class="reviews__header--right">
                                    <span class="stars">
                                        <span class="rev-box">
                                        <svg width="18" height="18"><use href="#icon-star"></use></svg>
                                        </span>
                                        <span class="rev-box">
                                        <svg width="18" height="18"><use href="#icon-star"></use></svg>
                                        </span>
                                        <span class="rev-box">
                                        <svg width="18" height="18"><use href="#icon-star"></use></svg>
                                        </span>
                                        <span class="rev-box">
                                        <svg width="18" height="18"><use href="#icon-star"></use></svg>
                                        </span>
                                        <span class="rev-box">
                                        <svg width="18" height="18"><use href="#icon-star"></use></svg>
                                        </span>
                                    </span>
                                    <h3><?php the_title(); ?></h3>
                                </div>
                            </div>
                            <div class="reviews__body">
                                <?php echo '<p>' . wp_trim_words(get_the_excerpt(), 45) . '</p>'; ?>
                            </div>
                        </div>                 
                    </div><!-- .swiper-slide -->
                <?php  }                 
                wp_reset_postdata(); ?>
                </div>
                <!-- .swiper-wrapper -->
                <div class="swiper-button-next screen-reader-text"></div>
                <div class="swiper-button-prev screen-reader-text"></div>
                <div class="swiper-pagination"></div>	
            </div><!-- .swiper -->

</section>
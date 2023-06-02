<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Saturn
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="entry-header__barner p-relative">
            <?php                 
            saturn_post_thumbnail(); 
            ?>
        </div>
        <div class="p-relative single-barner" style="    
        background-image: url(<?php 
        if ( has_post_thumbnail( $post->ID ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            echo $image[0];
        }
        ?>);
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        ">
            <div class="barner-shadow"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 p-relative">
                        <?php the_title( '<h1 class="entry-title text-center ts-2 mt-3 mb-1">', '</h1>' ); ?>
                        <p class="ts-2 mt-0 mb-4"><a href="<?php echo home_url(); ?>" class="home">Home</a> <svg width="12" height="10"><use xlink:href="#icon-double-chevron-right"></use></svg> <span><?php the_title(); ?></span></p>
                    </div>
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->

	<div class="entry-content py-6">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'saturn' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            )
        );
        ?>
	</div><!-- .entry-content -->


    <!-- Our Traveling Safari Packages -->
    <div class="clr-shade py-6">
        <section class="container p-relative">
            <div class="section-header mb-2">
                <h2 class="section-header__title"><?php esc_html_e( __( 'Our Safari Offers', 'saturn' ) ); ?></h2>
                <div class="section-header__pagination">
                    <!-- If if this button is clicked it also clicks the designated slick button -->				
                    <button onclick="jQuery('#safari-prev').click()" class="section-header__pagination--prev" aria-label="Previous slide"><svg width="16" height="12"><use xlink:href="#icon-left-arrow"></use></svg></button>				
                    <button onclick="jQuery('#safari-next').click()" class="section-header__pagination--next" aria-label="Next slide"><svg width="16" height="12"><use xlink:href="#icon-right-arrow"></use></svg></button>
                </div>
            </div>

            <div class="swiper swipesafari">
                <div class="swiper-wrapper">
                <?php
                $categories                 =   get_the_category();
                $rp_query                   =   new WP_Query([
                    'post_type'         	    => 'safaris',
                    'post_status'               => 'publish',
                    'posts_per_page'            => 6,
                    'post__not_in'              => [ $post->ID ],
                    'cat'                   =>  !empty($categories) ? $categories[0]->term_id : null,
                ]);


                if( $rp_query->have_posts() ){
                    while( $rp_query->have_posts()) {
                        $rp_query->the_post();
                        echo '<div class="swiper-slide">';
                        get_template_part( 'template-parts/components/excerpts/safari');
                        echo '</div>';
                    }

                    wp_reset_postdata();
                } ?>
                </div><!-- swiper wrapper -->
                
                <div class="slider-pagination visually-hidden">
                    <!-- If we need navigation buttons -->
                    <div id="safari-prev" class="swiper-button-prev"></div>
                    <div id="safari-next" class="swiper-button-next"></div>
                </div>
            </div>
        </section>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->

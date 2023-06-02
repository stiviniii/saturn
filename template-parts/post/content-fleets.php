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
<header class="entry-header p-relative single-barner mb-3" style="    
    background-image: url(<?php 
    if ( has_post_thumbnail( $post->ID ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
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
                    <?php the_title( '<h1 class="entry-title text-center ts-2">', '</h1>' ); ?>
                    <p class="ts-2"><a href="<?php echo home_url(); ?>" class="home">Home</a> <svg width="12" height="10"><use xlink:href="#icon-double-chevron-right"></use></svg> <span><?php the_title(); ?></span></p>
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->


	<div class="entry-content">
        <?php 
        // saturn_post_thumbnail(); 
        ?>


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

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'saturn' ),
                'after'  => '</div>',
            )
        );
        ?>

	</div><!-- .entry-content -->


    <!-- You May Also Like -->
    <div class="clr-shade py-6 mt-6 o-hidden">
        <section class="container p-relative">
            <h2 class="d-flex justify-center mb-2"><?php esc_html_e( __( 'You May Also Like', 'saturn' ) ); ?></h2>

            <div class="swiper swipefleet">
                <div class="swiper-wrapper">
                <?php
                $rp_query                   =   new WP_Query([
                    'post_type'         	    => 'fleets',
                    'post_status'               => 'publish',
                    'posts_per_page'            => 6,
                    'post__not_in'              => [ $post->ID ],
                    'meta_query' => array(
                        array(
                            'key' => 'fuel_type',
                            'value'   => array('', array(), serialize(array())),
                            'compare' => 'NOT IN'
                        )
                    )
                ]);


                if( $rp_query->have_posts() ){
                    while( $rp_query->have_posts()) {
                        $rp_query->the_post();
                        echo '<div class="swiper-slide">';
                        get_template_part( 'template-parts/components/excerpts/fleet');
                        echo '</div>';
                    }

                    wp_reset_postdata();
                } ?>
                </div><!-- swiper wrapper -->
                
                <div class="slider-pagination">
                    <!-- If we need navigation buttons -->
                    <div id="fleet-prev" class="swiper-button-prev"></div>
                    <div id="fleet-next" class="swiper-button-next"></div>
                </div>
            </div>
            <div class="after-carousel mt-4">
                <p class="d-flex justify-center mb-2"><?php esc_html_e( __( 'Still not found what you were looking for?', 'saturn' ) ); ?></p>
                <div class="d-flex justify-center"></div>
                <a class="d-flex justify-center mx-auto py-1 px-2 btn-outline" href="<?php echo get_permalink( 32 ); ?>"><?php esc_html_e( __( 'CONTINUE YOUR SEARCH', 'saturn' ) ); ?></a>
            </div>
        </section>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->

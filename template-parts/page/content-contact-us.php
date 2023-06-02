<?php
/**
 * Template part for displaying page content in page.php
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
    } else {
        echo do_shortcode( '[getmediaurl attachment_id="107" size="large"]' );
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
	</header><!-- .entry-header -->

   
	<div class="entry-content">
        <div class="row">
            <div class="col-lg-6">
                

                <h2><?php esc_html_e('Map', 'saturn'); ?></h2>


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
            </div>
            <div class="col-lg-6">
                <div class="fleet__form">
                    <?php echo apply_shortcodes( '[contact-form-7 id="85" title="Contact Us"]' ); ?>
                </div>
            </div>
        </div>
	</div><!-- .entry-content -->
    <div class="clr-shade py-6 mt-6">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-blocks">	
                        <span class="contact-blocks__img-box">
                        <?php
                        echo do_shortcode( '[getmedia attachment_id="63" size="thumbnail"]' );                        
                        ?>
                        </span>
                        <h3>Contact With Mail</h3>
                        <a href="mailto:info@royalcarrentals.co.tz">info@royalcarrentals.co.tz</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-blocks">
                        <span class="contact-blocks__img-box">
                        <?php
                        echo do_shortcode( '[getmedia attachment_id="62" size="thumbnail"]' );                        
                        ?>
                        </span>                        
                        <h3>Phone Support</h3>
                        <a href="tel:+255745113343">+255 745 113 343</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-blocks">
                        <span class="contact-blocks__img-box">
                        <?php
                        echo do_shortcode( '[getmedia attachment_id="61" size="thumbnail"]' );                        
                        ?>
                        </span>
                        <h3>Our Addresses</h3>
                        <p><span>Head Office</span> Next to Sombetini Primary School, Arusha, Tanzania</p>
                        <p><span>Zanzibar Office</span> Next to Dhow Palace Hotel</p>
                    </div></div>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->

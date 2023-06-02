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
                    <?php the_title( '<h1 class="entry-title text-center ts-2">', '</h1>' ); ?>
                    <p class="ts-2"><a href="<?php echo home_url(); ?>" class="home">Home</a> <svg width="12" height="10"><use xlink:href="#icon-double-chevron-right"></use></svg> <span><?php the_title(); ?></span></p>
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->

   
	<div class="entry-content">

        <div class="row">
            <div class="col-md-6 col-lg-7">
                <p class="mb-1">ABOUT <span class="clr-accent">OUR COMPANY</span></p>
                <h2 class="mb-2">You deserve the Very Best</h2>

                <div class="tabs">
                <div role="tablist" aria-label="Sample Tabs">
                    <?php if( get_field('tab_button_one') ): ?>
                        <button
                        role="tab"
                        aria-selected="true"
                        aria-controls="panel-1"
                        id="tab-1"
                        tabindex="0">
                        <?php the_field('tab_button_one'); ?>                  
                        </button>
                    <?php endif; ?>
                    <?php if( get_field('tab_button_two') ): ?>
                        <button
                        role="tab"
                        aria-selected="false"
                        aria-controls="panel-2"
                        id="tab-2"
                        tabindex="-1">
                        <?php the_field('tab_button_two'); ?>                  
                        </button>
                    <?php endif; ?>
                    <?php if( get_field('tab_button_three') ): ?>
                        <button
                        role="tab"
                        aria-selected="false"
                        aria-controls="panel-3"
                        id="tab-3"
                        tabindex="-1">
                        <?php the_field('tab_button_three'); ?>                  
                        </button>
                    <?php endif; ?>                    
                    <?php if( get_field('tab_button_four') ): ?>
                        <button
                        role="tab"
                        aria-selected="false"
                        aria-controls="panel-4"
                        id="tab-4"
                        tabindex="-1">
                        <?php the_field('tab_button_four'); ?>                  
                        </button>
                    <?php endif; ?>                    
                </div>
                <div id="panel-1" role="tabpanel" tabindex="0" aria-labelledby="tab-1">
                    <div><?php the_field('tab_one_content'); ?></div>
                </div>
                <div id="panel-2" role="tabpanel" tabindex="0" aria-labelledby="tab-2" hidden>
                    <div><?php the_field('tab_two_content'); ?></div>
                </div>
                <div id="panel-3" role="tabpanel" tabindex="0" aria-labelledby="tab-3" hidden>
                    <div><?php the_field('tab_three_content'); ?></div>
                </div>
                <div id="panel-4" role="tabpanel" tabindex="0" aria-labelledby="tab-4" hidden>
                    <div><?php the_field('tab_four_content'); ?></div>
                </div>
                </div>

            </div>
            <div class="col-md-6 col-lg-5">
                <div id="panel-01" role="tabpanel" tabindex="0" aria-labelledby="tab-01">
                    <?php 
                    $image = get_field('tab_one_image');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, "", ["class" => "about__image"] );
                    } else { ?>
                        <img class="about__image" src="https://via.placeholder.com/602x691" alt="<?php the_field('tab_button_one'); ?>">
                    <?php } ?>
                </div>
                <div id="panel-02" role="tabpanel" tabindex="0" aria-labelledby="tab-02" hidden>
                    <?php 
                    $image = get_field('tab_two_image');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, "", ["class" => "about__image"] );
                    } else { ?>
                        <img class="about__image" src="https://via.placeholder.com/602x691" alt="<?php the_field('tab_button_two'); ?>">
                    <?php } ?>
                </div>
                <div id="panel-03" role="tabpanel" tabindex="0" aria-labelledby="tab-03" hidden>
                    <?php 
                    $image = get_field('tab_three_image');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, "", ["class" => "about__image"] );
                    } else { ?>
                        <img class="about__image" src="https://via.placeholder.com/602x691" alt="<?php the_field('tab_button_three'); ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
	</div><!-- .entry-content -->
    <div class="clr-shade py-6 mt-6">
        <div class="container">
            <div class="row">
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
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->

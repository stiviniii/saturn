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
    <header class="entry-header p-relative single-barner" style="    
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
                    <?php
		            the_content(); ?>
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->


	<div class="entry-content clr-shade py-6">
        <?php
        get_template_part( 'template-parts/post-listing/safari-list' );
        ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

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
	<header class="entry-header">
        <div class="entry-header__barner p-relative">
            <?php                 
            // saturn_post_thumbnail(); 
            ?>
        </div>
        <div class="p-relative single-barner" style="    
        background-image: url(<?php 
        if ( has_post_thumbnail( $post->ID ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
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
                        if( get_field('supporting_descriptions') ) {
                            the_field('supporting_descriptions');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->



	<div class="entry-content clr-shade py-6">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'saturn' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'saturn' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

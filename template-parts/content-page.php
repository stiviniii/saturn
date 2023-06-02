<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Saturn
 */

 $the_post_id = get_the_ID();
 $hide_title = get_post_meta( $the_post_id, '_hide_page_title', true);
 $heading_class = ! empty( $hide_title ) && 'yes' === $hide_title ? 'hide' : '';


        //  echo '<pre>';
        // print_r($heading_class);
        // echo  '</pre>';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">		
		<?php 
		if ( is_single() || is_page() ) {
			printf(
				'<h1 class="page-title %1$s">%2$s</h1>',
				esc_attr( $heading_class ),
				wp_kses_post( get_the_title() )
			);
		} else {
			printf(
				'<h2 class="entry-title mb-3"><a href="%1$s">%2$s</a></h2>',
				esc_url( get_the_permalink() ),
				wp_kses_post( get_the_title())
			);
		}
		// the_title( '<h1 class="entry-title">', '</h1>' ); 
		?>
	</header><!-- .entry-header -->

	<?php saturn_post_thumbnail(); ?>

	<div class="entry-content">
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

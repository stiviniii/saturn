<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Saturn
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
	if ( ! is_home() ) {
		?>
		<header class="entry-header">
			<div class="container-fluid p-0 m-0">
				<?php 
				// get_template_part( 'template-parts/components/carousel/home-banner' );  
				?>
			</div>
		</header><!-- .entry-header -->
		<?php
	}
	?>

	<?php 
    // saturn_post_thumbnail();
    ?>
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

</article><!-- #post-<?php the_ID(); ?> -->

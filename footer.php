<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saturn
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="wrapper">

		<p>Some links here</p>


			
		</div>
		<div class="site-info">
			<div class="wrapper">
				<p>
					<span>
						<?php 
						/* retrive copyright information from theme customizer */
						echo get_theme_mod( 'set_copyright', 'Copyright X - All Rights Reserved' ); 
						?>
					</span>
					<span>
						<?php
						/* translators: 1: Theme author. */
						printf( esc_html__( 'Website by %1$s.', 'saturn' ), '<a href="https://www.steveayo.com/">Steve Ayo</a>' );
						?>
					</span>				
				</p>
			</div>									
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php if (is_shop() || is_product_category()) : ?>
		<aside id="secondary" class="widget-area slide-sidebar">
			<?php 	
			if (is_active_sidebar('sidebar-shop')) :
			?>
				<div class="slide-sidebar__header">
					<h2 class="filter-title">
						<svg width="24" height="24" aria-hidden="true">
							<use href="#icon-filter-vertical"></use>
						</svg>
						<?php esc_html_e( 'Filter & Sort', 'saturn' );?></h2>
					<button class="close-icon" aria-label="Close">
						<svg width="24" height="24" aria-hidden="true">
							<use href="#icon-x"></use>
						</svg>
					</button>
				</div>
				<div class="sidebar-inner shop-side-bar">
					<?php dynamic_sidebar('sidebar-shop'); ?>
				</div>
			<?php endif; ?>
		</aside><!-- #secondary -->
		<div id="allShade" role="presentation" aria-hidden="true"></div>



	<?php endif; ?>
</div><!-- #page -->
<?php
get_template_part( 'template-parts/content', 'svgs' );
wp_footer();
?>

</body>
</html>

<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Saturn
 */


?>
	
<aside id="secondary" class="widget-area">
	
	<?php 	
	if ( is_active_sidebar( 'sidebar-shop' ) ) :
	?>
		<div class="sidebar-inner shop-side-bar">
			<?php dynamic_sidebar( 'sidebar-shop' ); ?>
		</div>
	<?php
	endif;
	
	// include( get_theme_file_path( '/inc/product-tags.php' ) );
	
	?>
</aside><!-- #secondary -->

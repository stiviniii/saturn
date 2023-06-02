<?php
/**
 * Header Navigation template.
 * 
 * @package Neptune
 */


 ?>

<div class="site-branding top-bar__left">        
    <?php
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    } else {
    if ( is_front_page() && is_home() ) :
        ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php
    else :
        ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php
    endif;
    $neptune_description = get_bloginfo( 'description', 'display' );
    if ( $neptune_description || is_customize_preview() ) :
        ?>
        <p class="site-description"><?php echo $neptune_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
    <?php endif; } ?>
</div><!-- .site-branding -->

<div id="site-navigation" class="main-navigation top-bar__center">
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'saturn-header-menu',
            'menu_id'        => 'primary-menu',
            'container'            	=> '',
        )
    );
    ?>
</div><!-- #site-navigation -->

<div class="top-bar__right">
    
    <?php
    // wp_nav_menu(
    //     array(
    //         'theme_location' => 'saturn-subheader-menu',
    //         'menu_id'        => 'secondary-menu',
    //         'container'            	=> '',
    //     )
    // );
    ?>


<?php
	wp_nav_menu(
		array(
			'theme_location' => 'saturn-subheader-menu',
			'menu_id'        => 'secondary-menu',
			'container'      => '',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s<li class="menu-item header-cart"><a href="' . wc_get_cart_url() . '" class="cart-icon"><svg width="20" height="20" aria-hidden="true" focusable="false" role="img" fill="currentColor"><use href="#icon-basket"></use></svg></a><span class="items">' . WC()->cart->get_cart_contents_count() . '</span></li></ul>',
		)
	);
	?>

    <!-- <div class="header-cart">
        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon">
            <svg width="20" height="20" aria-hidden="true" focusable="false" role="img" fill="currentColor"><use href="#icon-basket"></use></svg>
        </a>
        <span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    </div> -->



</div>
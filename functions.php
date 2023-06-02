<?php
/**
 * Saturn functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Saturn
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function saturn_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Saturn, use a find and replace
		* to change 'saturn' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'saturn', get_template_directory() . '/languages' );

}
// add_action( 'after_setup_theme', 'saturn_setup' );




if ( ! defined( 'SATURN_DIR_PATH' ) ) {
	define( 'SATURN_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'SATURN_DIR_URI' )) {
	define( 'SATURN_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'SATURN_BUILD_URI' )) {
	define( 'SATURN_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );
}

if ( ! defined( 'SATURN_BUILD_PATH' )) {
	define( 'SATURN_BUILD_PATH', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );
}

if ( ! defined( 'SATURN_BUILD_JS_URI' )) {
	define( 'SATURN_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/js' );
}

if ( ! defined( 'SATURN_BUILD_JS_DIR_PATH' )) {
	define( 'SATURN_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/js' );
}

if ( ! defined( 'SATURN_BUILD_IMG_URI' )) {
	define( 'SATURN_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/src/img' );
}

if ( ! defined( 'SATURN_BUILD_LIB_URI' )) {
	define( 'SATURN_BUILD_LIB_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/library' );
}

if ( ! defined( 'SATURN_BUILD_CSS_URI' )) {
	define( 'SATURN_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/css' );
}

if ( ! defined( 'SATURN_BUILD_CSS_DIR_PATH' )) {
	define( 'SATURN_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/css' );
}


require_once SATURN_DIR_PATH. '/inc/helpers/autoloader.php';
require_once SATURN_DIR_PATH. '/inc/helpers/template-tags.php';

function saturn_get_theme_instance() {
	\SATURN_THEME\Inc\SATURN_THEME::get_instance();
}

saturn_get_theme_instance();

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}




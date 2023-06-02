<?php
/**
 * Register Menus
 *
 *
 * @package Saturn
 */

 namespace SATURN_THEME\Inc;

 use SATURN_THEME\Inc\Traits\Singleton;

 class Menus {
    use Singleton;

    protected function __construct() {

        // load class.
        $this->setup_hooks();
    }

    protected function setup_hooks() {

        /**
         * Actions.
         */
        add_action( 'init', [ $this, 'register_menus' ]);
    }

    public function register_menus() {
       	// This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'saturn-header-menu' => esc_html__( 'Header Menu', 'saturn' ),
            'saturn-subheader-menu' => esc_html__( 'Subheader Menu', 'saturn' ),
            'saturn-footer-menu' => esc_html__( 'Footer Menu', 'saturn' ),
        ] );
    }

 }
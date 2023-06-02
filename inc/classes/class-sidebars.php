<?php
/**
 * Theme Sidebars
 *
 *
 * @package Saturn
 */

 namespace SATURN_THEME\Inc;

 use SATURN_THEME\Inc\Traits\Singleton;

 class Sidebars {
    use Singleton;

    protected function __construct() {

        // load class.
        $this->setup_hooks();
    }

    protected function setup_hooks() {

        /**
         * Actions.
         */
        add_action( 'widgets_init', [$this, 'register_sidebars'] );
        add_action( 'widgets_init', [$this, 'register_clock_widget'] );
    }

    public function register_sidebars() {
        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'saturn' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Main sidebar.', 'saturn' ),
                'before_widget' => '<section id="%1$s" class="widget widget-sidebar %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Footer', 'saturn' ),
                'id'            => 'sidebar-2',
                'description'   => esc_html__( 'Footer sidebar.', 'saturn' ),
                'before_widget' => '<section id="%1$s" class="widget widget-footer  cell column %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Footer', 'saturn' ),
                'id'            => 'sidebar-2',
                'description'   => esc_html__( 'Footer sidebar.', 'saturn' ),
                'before_widget' => '<section id="%1$s" class="widget widget-footer  cell column %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
        register_sidebar(
            array(
                'name'          => esc_html__( 'Product Filtering', 'saturn' ),
                'id'            => 'sidebar-shop',
                'description'   => esc_html__( 'Add all filtering Widgets', 'saturn' ),
                'before_widget' => '<section id="%1$s" class="widget widget-filter  cell column %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
    }

    public function register_clock_widget() {
        register_widget( 'SATURN_THEME\Inc\Clock_Widget' );
    }
 }
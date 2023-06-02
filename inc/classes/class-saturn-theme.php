<?php
/**
 * Bootstraps the Theme
 * 
 * 
 * @package Saturn
 */

 namespace SATURN_THEME\Inc;

 use SATURN_THEME\Inc\Traits\Singleton;

 class SATURN_THEME {
    use Singleton;

    protected function __construct() {

        // load class.
        Assets::get_instance();
        Menus::get_instance();
        Block_Patterns::get_instance();
        Meta_Boxes::get_instance();
        Sidebars::get_instance();
        BLocks::get_instance();

        $this->setup_hooks();



    }

    protected function setup_hooks() {
        /**
         * Actions
         */
        add_action( 'after_setup_theme', [ $this, 'setup_theme'] );        
    }

    public function setup_theme() {
        
	    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	    add_theme_support( 'title-tag' );


        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'header-text' => [ 'site-title', 'site-description' ],
            'height'      => 100,
            'width'       => 450,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', [
            'default-color' => '#ffffff',
            'default-image' => '',
        ] );

        
        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support( 'post-thumbnails' );

        /**
         * Register Image Size
         */
        add_image_size( 'featured-thumbnail', 350, 233, true );
        add_image_size( 'square-thumbnail', 480, 480, true );
        
        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );


        /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
        add_theme_support(
            'html5', [           
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );

        add_theme_support( 'wp-block-styles');

        add_theme_support( 'editor-styles');
        
        // Add path to our custom editor styles editor.css
        add_editor_style( 'assets/build/css/editor.css' );

        add_theme_support( 'align-wide' );

        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @global int $content_width
         */
        global $content_width;
        if ( !isset( $content_width ) ) {
            $content_width = 1240;
        }
    }
 }
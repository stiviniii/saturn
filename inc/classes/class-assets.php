<?php
/**
 * Enqueue theme assets
 *
 *
 * @package Saturn
 */

 namespace SATURN_THEME\Inc;

 use SATURN_THEME\Inc\Traits\Singleton;

 class Assets {
    use Singleton;

    protected function __construct() {

        // load class.
        $this->setup_hooks();
    }

    protected function setup_hooks() {

        /**
         * Actions.
         */
        add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ]);
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ]);
        add_action( 'enqueue_block_assets', [ $this, 'enqueue_editor_assets' ]);
    }

    public function register_styles() {
        // Register styles.
        wp_register_style( 'main-css', SATURN_BUILD_CSS_URI . '/main.css', [], filemtime( SATURN_BUILD_CSS_DIR_PATH . '/main.css'), false );     
        wp_register_style( 'woocommerce-css', SATURN_BUILD_CSS_URI . '/woocommerce.css', [], filemtime( SATURN_BUILD_CSS_DIR_PATH . '/woocommerce.css'), false );     
		// wp_register_style( 'aos-css', SATURN_BUILD_LIB_URI . '/css/aos.css', [], false, 'all' );

        // Enqueue styles
        if ( class_exists( 'WooCommerce' ) ) {
            // wp_enqueue_style( 'woocommerce-css' );
        }
        wp_enqueue_style( 'main-css' );    
        // wp_enqueue_style( 'aos-css' );
    }

    public function register_scripts() {
        // Register Scripts.
        
		// wp_register_script( 'aos-js', SATURN_BUILD_LIB_URI . '/js/aos.js', [], false, true );
        wp_register_script( 'woocommerce-js', SATURN_BUILD_JS_URI . '/woocommerce.js', ['jquery'], filemtime( SATURN_BUILD_JS_DIR_PATH . '/woocommerce.js'), true );
        wp_register_script( 'main-js', SATURN_BUILD_JS_URI . '/main.js', ['jquery'], filemtime( SATURN_BUILD_JS_DIR_PATH . '/main.js'), true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }        

        // Enqueue Scripts

        if ( class_exists( 'WooCommerce' ) ) {            
            wp_enqueue_script( 'woocommerce-js' );
        }

        wp_enqueue_script( 'main-js' );        
    }

    /**
	 * Enqueue editor scripts and styles.
	 */
    public function enqueue_editor_assets() {
        $asset_config_file = sprintf( '%s/assets.php', SATURN_BUILD_PATH );

        // echo '<pre>';
        // print_r($asset_config_file);
        // echo  '</pre>';


        if ( ! file_exists( $asset_config_file ) ) {
			return;
		}

        $asset_config = require_once $asset_config_file;

		if ( empty( $asset_config['js/editor.js'] ) ) {
			return;
		}

        $editor_asset    = $asset_config['js/editor.js'];
		$js_dependencies = ( ! empty( $editor_asset['dependencies'] ) ) ? $editor_asset['dependencies'] : [];
		$version         = ( ! empty( $editor_asset['version'] ) ) ? $editor_asset['version'] : filemtime( $asset_config_file );

        // Theme Gutenberg blocks JS.
        if ( is_admin() ) {
            wp_enqueue_script(
                'saturn-block-js',
                SATURN_BUILD_JS_URI . '/blocks.js',
                $js_dependencies,
				$version,
				true
            );
        }

        // Theme Gutenberg blocks CSS.
        $css_dependencies = [
            'wp-block-library-theme',
			'wp-block-library',
        ];
        
        wp_enqueue_style(
            'saturn-blocks-css',
            SATURN_BUILD_CSS_URI . '/blocks.css',
            $css_dependencies,
            filemtime( SATURN_BUILD_CSS_DIR_PATH . '/blocks.css' ),
            'all'
        );
    }
 }
<?php
/**
 * Block Patterns
 *
 *
 * @package Saturn
 */

 namespace SATURN_THEME\Inc;

 use SATURN_THEME\Inc\Traits\Singleton;

 class Block_Patterns {
    use Singleton;

    protected function __construct() {

        // load class.
        $this->setup_hooks();
    }

    protected function setup_hooks() {

        /**
         * Actions.
         */
        add_action( 'init', [ $this, 'register_block_pattern' ] );
    }

    public function register_block_pattern() {
        if ( function_exists( 'register_block_pattern' ) ) {
            register_block_pattern(
                'saturn/cover', [
                    'title' => __( 'Saturn Cover', 'saturn' ),
                    'description' => __( 'Saturn Cover Block with image and text', 'saturn' ),
                    'content' => "",

                ]
            );
        }
    }

 }
<?php
/**
 * Blocks
 *
 *
 * @package Saturn
 */

 namespace SATURN_THEME\Inc;

 use SATURN_THEME\Inc\Traits\Singleton;

 class Blocks {
    use Singleton;

    protected function __construct() {

        // load class.
        $this->setup_hooks();
    }

    protected function setup_hooks() {

        /**
         * Actions.
         */
        add_action( 'block_categories', [ $this, 'add_block_categories'] );
    }

    public function add_block_categories( $categories ) {
        $category_slugs = wp_list_pluck( $categories, 'slug' );

        return in_array( 'saturn', $category_slugs, true ) ? $categories : 
            array_merge(
                $categories,
                [
                    [
                        'slug' => 'saturn',
                        'title' => __( 'Saturn Blocks', 'saturn' ),
                        'icon' => 'table-row-after'
                    ]
                ]
            );
    }
 }
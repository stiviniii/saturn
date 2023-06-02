<?php

function get_the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
    $custom_thumbnail = '';

    if ( null == $post_id ) {
        $post_id = get_the_ID();
    }

    if ( has_post_thumbnail( $post_id ) ) {
        $default_attributes = [
            'loading' => 'lazy'
        ];

        $attributes = array_merge( $additional_attributes, $default_attributes );

        $custom_thumbnail = wp_get_attachment_image(
            get_post_thumbnail_id( $post_id ),
            $size,
            false,
            $attributes
        );

    }

    return $custom_thumbnail;

}

function the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
    echo get_the_post_custom_thumbnail ( $post_id, $size, $additional_attributes );
}


function saturn_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    // post is modified
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_attr( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_attr( get_the_modified_date() ),
    );

    $posted_on = sprintf(
        esc_html_x( 'Posted on %s', 'post date', 'saturn' ),
        '<a href"' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on text-secondary">' . $posted_on .'</span>';

}

function saturn_posted_by() {
    $byline = sprintf(
        esc_html_x( ' by %s', 'post author', 'saturn' ),
        '<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline text-secondary">' . $byline . '</span>';
}

function saturn_the_excerpt( $trim_character_count = 0 ) {
    if ( ! has_excerpt() || 0 === $trim_character_count ) {
        the_excerpt('<p>', '</p>');
        return;
    }

    $excerpt = wp_strip_all_tags( get_the_excerpt() );
    $excerpt = substr( $excerpt, 0, $trim_character_count );
    $excerpt = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );

    echo '<p>' . $excerpt . '[...]' . '</p>';
}

function saturn_excerpt_more( $more = '' ) {

    if ( ! is_single() ) {
        $more = sprintf( '<button class="mt-4 btn"><a class="saturn-read-more text-white" href="%1$s">%2$s</a></button>',
            get_permalink( get_the_ID() ),
            __( 'Read more', 'saturn' )
        );
    }

    return $more;
}

// Adding Pugination
function saturn_pagination() {
    $allowed_tags = [
        'span' => [
            'class' => []
        ],
        'a' => [
            'class' => [],
            'href' => [],
        ]
    ];
    $args = [
        'before_page_number' => '<span class="btn btn-border mr-2 mb-2">',
        'after_page_number' => '</span>',
    ];
    printf('<nav class="saturn-pagination clearfix">%s</nav>', wp_kses( paginate_links( $args ), $allowed_tags ) );
}

// Remove <p> to contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');

// Display custom post type in category archive
function namespace_add_custom_types( $query ) {
    if( (is_category() || is_tag()) && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
      $query->set( 'post_type', array(
       'post', 'work'
          ));
      }
  }
  add_action( 'pre_get_posts', 'namespace_add_custom_types' );

  
/**
 * Get Media from wordpress backend
 */

function my_func($atts) {
 return wp_get_attachment_image( $atts["attachment_id"], $atts["size"]);  
}
add_shortcode( 'getmedia', 'my_func' );
// url
function my_func_url($atts) {
 return wp_get_attachment_image_url( $atts["attachment_id"], $atts["size"]);  
}
add_shortcode( 'getmediaurl', 'my_func_url' );



/**
 * ============
 * Woocommerce Hooks, modified to only run on single product page
 * ============
 */

//  add_action( 'woocommerce_before_main_content', 'saturn_open_container_row', 5 );

//  function saturn_open_container_row() {
//      echo '<div class="entry-content shop-container">';
//  }
 
//  add_action( 'woocommerce_after_main_content', 'saturn_close_container_row', 5 );
 
//  function saturn_close_container_row() {
//      echo '<div>';
//  }

add_action('woocommerce_before_main_content', 'saturn_open_container_row', 5);

function saturn_open_container_row() {
    // if (is_product()) {
        echo '<div class="entry-content shop-container">';
    // }
}

add_action('woocommerce_after_main_content', 'saturn_close_container_row', 5);

function saturn_close_container_row() {
    // if (is_product()) {
        echo '</div>';
    // }
}



 /**
 *  Remove sidebar on single product page
 * 
 */
add_action( 'wp', 'saturn_remove_sidebar_product_pages' );
 
function saturn_remove_sidebar_product_pages() {
    if ( is_product() || is_shop() ) {
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}



/**
 *  Adding single product image cart container
 */

 add_action( 'woocommerce_before_single_product_summary', 'saturn_image_cart_open_wrapper', 19 );

 function saturn_image_cart_open_wrapper() {
     echo '<div class="single-product-wrapper">';
 }



 
/**
 *  Clossing div for the entire section  
 */ 
add_action( 'woocommerce_after_single_product_summary', 'saturn_image_cart_close_wrapper', 8 );

function saturn_image_cart_close_wrapper() {
    echo '</div>';
}
 
 // grooping all product meta to one container
 add_action( 'woocommerce_single_product_summary', 'saturn_open_single_product_meta', 3 );
 
 function saturn_open_single_product_meta() {
     echo '<div class="single-product-wrapper__meta">';
 }
 /**
  * Displaying the brand name at the single page
  */
 add_action( 'woocommerce_single_product_summary', 'saturn_brand_name_and_tag', 4 );
 
 function saturn_brand_name_and_tag() {
    printf('<p class="product-vendor">%s</p>', get_bloginfo('name'));
}


 add_action( 'woocommerce_single_product_summary', 'saturn_close_single_product_meta', 70 );
 
 function saturn_close_single_product_meta() {
     echo '</div>';
 }






 /**
 * Changing position of Short description
 */

function modify_short_description_position() {
    // Removing the original position
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

    // Check if the product short description is not empty
    $product = wc_get_product(get_the_ID());
    $short_description = $product->get_short_description();

    if (!empty($short_description)) {
        // Adding title to short description
        function add_short_description_title() {
            echo '<details class="accordion last" role="tabpanel"><summary class="accordion-summary" aria-expanded="false"><h5>' . esc_html__( 'Material', 'saturn' ) . '</h5></summary>';
        }
        add_action( 'woocommerce_single_product_summary', 'add_short_description_title', 62 );

        // Wrapping the short description inside a div with class "panel"
        function wrap_short_description_with_panel() {
            echo '<div class="panel" aria-hidden="true"><div class="panel__inner">';

            woocommerce_template_single_excerpt();
            echo '</div></div>';
        }
        add_action( 'woocommerce_single_product_summary', 'wrap_short_description_with_panel', 63 );

        // Closing the details tag
        function close_accordion_tab() {
            echo '</details>';
        }
        add_action( 'woocommerce_single_product_summary', 'close_accordion_tab', 64 );
    }

}

add_action( 'woocommerce_single_product_summary', 'modify_short_description_position' );





 
/**
 *  Hide SKU Number
 */

add_filter( 'wc_product_sku_enabled', '__return_false' );


/**
 *  Remove Woocommmerce Breadcrumbs
 */
// remove_action( 'woocommerce_before_main_content' , 'woocommerce_breadcrumb' , 20, 0);

/**
 *  Add container to widget title and price
 */
add_action( 'woocommerce_shop_loop_item_title', 'saturn_open_widget_title', 8 );

function saturn_open_widget_title() {
    echo '<span>';
}
remove_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_price', 10);
add_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_price', 8);

add_action( 'woocommerce_after_shop_loop_item_title', 'saturn_close_widget_title', 10 );

function saturn_close_widget_title() {
    echo '</span>';
}

/**
 * @snippet       Add HTML Symbol to Add to Cart Button - WooComme
 */
add_filter('woocommerce_product_single_add_to_cart_text', 'add_svg_icon_to_single_product_page_button_text');

 function add_svg_icon_to_single_product_page_button_text($button_text) {
     $svg_icon = '<svg width="20" height="20" aria-hidden="true" focusable="false" role="img" fill="currentColor"><use href="#icon-basket"></use></svg>';
    //  echo $button_text . ' ' . $svg_icon;
     echo $svg_icon . ' ' . $button_text;
 }

 
 
 /**
  * Hide Categories in single product page
  */
  add_action('woocommerce_single_product_summary', 'hide_product_categories_tags', 9);
function hide_product_categories_tags() {
    // Hide categories
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
}




 




 /** 
  * Filter WooCommerce Flexslider options - Add Navigation Arrows, Slideshow and Animation Loop
  */
  
//  add_filter( 'woocommerce_single_product_carousel_options', 'afro_update_flexslider_options' );
//  function afro_update_flexslider_options( $options ) {
 
//     //  $options['directionNav'] = true;
//      $options['slideshow'] = true;
//      $options['animationLoop'] = true;
//      return $options;
//  }
 
  
 add_filter( 'woocommerce_single_product_carousel_options', 'custom_product_carousel_options' );
 function custom_product_carousel_options( $options ) {
     // Set the width of each thumbnail image
    //  $options['itemWidth'] = 100;
     
     // Set the margin between thumbnail images
    //  $options['itemMargin'] = 15;
     
     // Set the minimum and maximum number of thumbnail images to display
    //  $options['minItems'] = 3;
    //  $options['maxItems'] = 1;


    // Enable automatic slideshow
    $options['slideshow'] = true;

    // Enable looped animation between the first and last item
    $options['animationLoop'] = true;
     
     // Enable synchronization between the main image and the thumbnail images
    //  $options['sync'] = true;
     
     // Set the ID of the Flexslider instance to use as the thumbnail navigation
    //  $options['asNavFor'] = '.woocommerce-product-gallery__wrapper .flex-viewport';
     
     // Enable touch gestures on mobile devices
     $options['touch'] = true;
     
     // Enable smooth height transitions between images
     $options['smoothHeight'] = true;
     
     // Pause the slideshow when the user hovers over the carousel
     $options['pauseOnHover'] = true;

    // Pause the slideshow when the user interacts with the carousel
    // $options['pauseOnAction'] = true;
     
     
     // Enable keyboard navigation
     $options['keyboard'] = true;
     
     return $options;
 }
 





// Disable Additional Information tab on product pages
add_filter( 'woocommerce_product_tabs', 'remove_additional_information_tab', 99 );
function remove_additional_information_tab( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}




/**
 * Instock and out of stock
 */
add_action( 'woocommerce_single_product_summary', 'display_stock_status_single_product', 7 );

function display_stock_status_single_product() {
    global $product;

    echo '<div class="primary-info-container"><div class="stock-and-discount">';

    if ( $product->is_type( 'variable' ) ) {
        $stock_quantity = 0;

        foreach ( $product->get_children() as $variation_id ) {
            $variation = wc_get_product( $variation_id );
            if ( $variation->is_in_stock() ) {
                $stock_quantity += $variation->get_stock_quantity();
            }
        }

        if ( $stock_quantity > 0 ) {
            echo '<p class="stock in-stock">In Stock</p>';
        } else {
            echo '<p class="stock out-of-stock">Currently out of stock</p>';
        }
    } else {
        if ( $product->is_in_stock() ) {
            echo '<p class="stock in-stock">In Stock</p>';
        } else {
            echo '<p class="stock out-of-stock">Currently out of stock</p>';
        }
    }
}
/**
 * Hide showing number of products in stock for variable products
 */
function hide_variable_product_stock($html, $product) {
    // Make sure the $product variable is recognized as a global variable
    global $product;

    // Check if the $product is an instance of WC_Product and if it is a variable product
    if ($product instanceof WC_Product && $product->is_type('variable')) {
        // If it's a variable product, return an empty string to hide the stock information
        return '';
    }

    // If it's not a variable product, return the original $html
    return $html;
}
add_filter('woocommerce_stock_html', 'hide_variable_product_stock', 10, 2);





/**
 * This is to add clossing div after prices in single product page
 */
add_action( 'woocommerce_single_product_summary', 'add_custom_div_after_price', 11 );

function add_custom_div_after_price() {
    echo '</div>';
}


/**
 * This is to add opening div after product link in shop page
 */
add_action( 'woocommerce_before_shop_loop_item', 'saturn_add_custom_div_after_link', 11 );

function saturn_add_custom_div_after_link() {
    echo '<div class="saturn-product-widget-wrapper">';
}
/**
 * This is to add close div 
 */
add_action( 'woocommerce_shop_loop_item_title', 'saturn_add_close_div_after_link', 2 );

function saturn_add_close_div_after_link() {
    echo '</div>';
}


/**
 * Remove the "Select Options" button from the shop page.
 */
function remove_and_add_select_options_button() {
    // remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    // add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 1 );
}
add_action( 'init', 'remove_and_add_select_options_button' );




add_action( 'woocommerce_shop_loop_item_title', 'saturn_clossing_div_alert', 7 );
function saturn_clossing_div_alert() {
    echo '</div>';
}
/**
 * Show discount percentage in shop, archive and single product page.
 */
add_action( 'woocommerce_shop_loop_item_title', 'add_discount_percentage', 6 );
add_action( 'woocommerce_single_product_summary', 'add_discount_percentage', 8 );
function add_discount_percentage() {
    global $product;

    if ( $product->is_type('variable') && $product->is_on_sale() ) {
        $variation_ids = $product->get_children();
        $variable_products = array();

        foreach ( $variation_ids as $variation_id ) {
            $variation = wc_get_product($variation_id);
            if ( $variation->is_on_sale() ) {
                $variable_products[] = $variation;
            }
        }

        if ( ! empty($variable_products) ) {
            $min_regular_price = $product->get_variation_regular_price( 'min', true );
            $min_sale_price = $product->get_variation_sale_price( 'min', true );
            $discount = round( ( ($min_regular_price - $min_sale_price) / $min_regular_price ) * 100 );
            $discount_percentage = $discount . '% OFF';
            ?>
                <span class="discount-percentage">
                    <?php echo $discount_percentage; ?>
                </span>
            <?php
        }
    }

}

add_action( 'woocommerce_single_product_summary', 'add_clossing_div_discount_percentage', 9 );
function add_clossing_div_discount_percentage() {
    echo '</div>';
}
/**
 * Remove the related product section in single product page and add custom one
 */

// removing
// add_filter( 'woocommerce_product_related_posts_query', '__return_empty_array' );







/**
 * Adding variation swatches globally, when there is a woocommerce class
 */

if ( ! is_shop() && ! is_archive() && class_exists( 'WooCommerce' ) ) {
    add_filter( 'cfvsw_requires_shop_settings', '__return_true' );
    add_filter( 'cfvsw_requires_global_settings', '__return_true' );
}



// add_action( 'woocommerce_after_single_product_summary', 'variations_related_products_section', 11 );
function variations_related_products_section() {
    // Set the filters for the related product section
    add_filter( 'cfvsw_requires_shop_settings', '__return_true' );
    add_filter( 'cfvsw_requires_global_settings', '__return_true' );

    // Your related product section code here
}



/**
 * Remove the sales badge on the shop/archive page in WooCommerce
 */
add_filter( 'woocommerce_sale_flash', '__return_false' );

// Remove sale badge on single product page
// add_filter( 'woocommerce_sale_flash', 'remove_sale_badge_single_product_page', 10, 3 );
function remove_sale_badge_single_product_page( $html, $post, $product ) {
    return '';
}

/**
 * Removing the catalog sorting/ ordering
 * also result count text
 */

function remove_woocommerce_shop_features() {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
}
add_action('init', 'remove_woocommerce_shop_features');

function override_woocommerce_result_count() {
    return;
}
add_action('woocommerce_result_count', 'override_woocommerce_result_count');

/**
 * Changing the description heading in the single product page
 */
function change_product_description_heading($heading) {
    return __('Product Details', 'saturn');
}
add_filter('woocommerce_product_description_heading', 'change_product_description_heading');









/**
 * Adding a pannel that for Size and Fit
 * in any product so here is the code for the backend
 */

// Add custom meta box for Size & Fit
function add_size_fit_meta_box() {
    add_meta_box(
        'size_fit_meta_box',
        'Size & Fit',
        'render_size_fit_meta_box',
        'product',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_size_fit_meta_box');

// Render the content of the Size & Fit meta box
function render_size_fit_meta_box($post) {
    wp_nonce_field('save_size_fit_meta_box', 'size_fit_meta_box_nonce');

    $size_fit = get_post_meta($post->ID, '_size_fit', true);
    wp_editor(
        $size_fit,
        'size_fit_editor',
        array(
            'textarea_name' => '_size_fit',
            'media_buttons' => false,
            'textarea_rows' => 5,
            'teeny'         => true,
            'wpautop'       => false, // Disable automatic paragraph formatting
        )
    );
}

// Save the Size & Fit meta box content
function save_size_fit_meta_box($post_id) {
    // Verify the nonce
    if (!isset($_POST['size_fit_meta_box_nonce']) || !wp_verify_nonce($_POST['size_fit_meta_box_nonce'], 'save_size_fit_meta_box')) {
        return;
    }

    // Check if the user has permission to save the meta box
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the Size & Fit content
    if (isset($_POST['_size_fit'])) {
        $size_fit = wp_kses_post($_POST['_size_fit']); // Allow only safe HTML tags
        update_post_meta($post_id, '_size_fit', $size_fit);
    }
}
add_action('save_post', 'save_size_fit_meta_box');




function display_size_fit_section() {
    $size_fit = get_post_meta(get_the_ID(), '_size_fit', true);
    if (!empty($size_fit)) {
        echo '<details class="accordion" role="tabpanel">';
        echo '<summary class="accordion-summary" aria-expanded="false"><h5>' . esc_html__('Size & Fit', 'saturn') . '</h5></summary>';
        echo '<div class="panel" aria-hidden="true"><div class="panel__inner">' . wpautop(wp_kses_post($size_fit)) . '</div></div>';
        echo '</details>';
    }
}
add_action('woocommerce_single_product_summary', 'display_size_fit_section', 60);




// Retrieve and display the label value in the product widget
// add_action('woocommerce_shop_loop_item_title', 'display_product_label', 5);
// function display_product_label()
// {
//     global $product;

//     $label = get_post_meta($product->get_id(), 'product_label', true);
//     if ($label) {
//         echo '<span class="product-label">' . esc_html($label) . '</span>';
//     }
// }


// Retrieve and display the product tags in the product widget
function display_product_tags() {
    global $product;

    if ( ! is_a( $product, 'WC_Product' ) ) {
        return;
    }

    $tags = $product->get_tag_ids();

    if ( empty( $tags ) ) {
        return;
    }

    echo '<div class="product-tags">';

    foreach ( $tags as $tag_id ) {
        $tag = get_term_by( 'id', $tag_id, 'product_tag' );

        if ( ! is_wp_error( $tag ) && $tag ) {
            echo '<span class="product-tag">' . $tag->name . '</span>';
        }
    }

    echo '</div>';
}
add_action( 'woocommerce_shop_loop_item_title', 'display_product_tags', 5 );



add_action('woocommerce_shop_loop_item_title', 'saturn_opening_div_alert', 4);
function saturn_opening_div_alert() {
    echo '<div class="alert-info">';
}




// Add the default attribute values after the product title on shop/archive pages
function display_default_attributes_after_title() {
    global $product;

    if ($product->is_type('variable')) {
        // Get the default attribute values
        $default_attributes = $product->get_default_attributes();

        // Check if the default color attribute is set
        if (isset($default_attributes['pa_color'])) {
            $default_color = $default_attributes['pa_color'];

            // Display the default color value
            echo '<p class="default-attribute">' . $default_color . '</p>';
        }
    }
}
add_action('woocommerce_shop_loop_item_title', 'display_default_attributes_after_title', 10);
// add_action('woocommerce_after_shop_loop_item_title', 'display_default_attributes_after_title', 10);




/**
 * Product shortcode for woocommerce
 * [display-product post_type="product" category="electronics" custom_class="my-custom-class" featured_only="true" most_viewed="true"]

 */

function saturn_display_product_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'post_type'       => 'product',
            'category'        => '',
            'custom_class'    => 'custom-class', // Default value for custom class
            'featured_only'   => false, // Default value for featured products
            'most_viewed'     => false, // Default value for most viewed products
            'show_pagination' => false, // Default value for showing pagination            
            'limit'            => 4, // Default value for no limit (-1 means no limit)  
        ),
        $atts
    );

    $output = ''; // Initialize output variable

    // Sanitize and validate input values
    $post_type = sanitize_text_field( $atts['post_type'] );
    $category = sanitize_text_field( $atts['category'] );
    $custom_class = esc_attr( $atts['custom_class'] );
    $featured_only = filter_var( $atts['featured_only'], FILTER_VALIDATE_BOOLEAN );
    $most_viewed = filter_var( $atts['most_viewed'], FILTER_VALIDATE_BOOLEAN );
    $show_pagination = filter_var( $atts['show_pagination'], FILTER_VALIDATE_BOOLEAN );
    $limit = intval( $atts['limit'] );

    ob_start(); // Start output buffering

    $rp_query_args = array(
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'depth'          => 1,
        'fields'         => 'ids', // Only fetch post IDs
        'posts_per_page' => $limit, // Set the limit for the number of products to display
        'orderby'        => 'date', // Order by date (latest uploaded)
        'order'          => 'DESC', // Sort in descending order
    );

    if ( $featured_only ) {
        $rp_query_args['tax_query'] = array(
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ),
        );
    }

    if ( $most_viewed ) {
        $rp_query_args['meta_key'] = 'woocommerce_product_views'; // Replace with the correct meta key for views tracking
        $rp_query_args['orderby']  = 'meta_value_num';
        $rp_query_args['order']    = 'DESC';
    }

    if ( ! empty( $category ) ) {
        $rp_query_args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    $rp_query = new WP_Query( $rp_query_args );

    if ( $rp_query->have_posts() ) {
        ob_start(); // Start output buffering for swiper content

        while ( $rp_query->have_posts() ) {
            $rp_query->the_post(); ?>
            <div class="swiper-slide">
            <?php wc_get_template_part( 'content', 'product' ); ?>
            </div>
        <?php }

        $swiper_content = ob_get_clean(); // Get the swiper content

        if ( ! empty( $swiper_content ) ) {
            $output = sprintf(
                '<div class="swiper %s">
                    <div class="swiper-wrapper products">%s</div><!-- swiper-wrapper -->
                    %s
                </div><!-- .swiper -->',
                $custom_class,
                $swiper_content,
                $show_pagination ? '
                    <div class="slider-pagination">
                        <div id="safariPrev" class="swiper-button-prev"></div>
                        <div id="safariNext" class="swiper-button-next"></div>
                    </div>' : ''
            );

            wp_reset_postdata();
        }
    }

    return $output;
}

add_shortcode( 'display-product', 'saturn_display_product_shortcode' );

// Add button to WooCommerce shop header using woocommerce_before_shop_loop hook




/**
 * Remove the shop page title
 * Modify shop title in WooCommerce shop page
 * Make it return both the title and the filter button
 */

// Remove shop title from WooCommerce shop page
function remove_shop_title($title) {
    if (is_shop()) {
        $title = '';
    }
    return $title;
}
add_filter('woocommerce_show_page_title', 'remove_shop_title');



// Modify shop title and add button in WooCommerce shop page
function saturn_modify_shop_header() {
    if (is_shop()) {
        $title = get_the_title(get_option('woocommerce_shop_page_id'));
        echo '<header class="shop-woocommerce-products-header">';
        echo '<h1 class="shop-title">' . $title . '</h1>';
        echo '<button id="filterToggle">';
        echo '<svg width="24" height="24"><use href="#icon-filter"></use></svg>';
        echo '<span>' . esc_html__('filter & sort', 'saturn') . '</span>';
        echo '</button>';
        echo '</header>';
    }
}
add_action('woocommerce_before_main_content', 'saturn_modify_shop_header', 22);

<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Saturn
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function saturn_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			// 'thumbnail_image_width' => 150,
			// 'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'saturn_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function saturn_woocommerce_scripts() {
	wp_enqueue_style( 'saturn-woocommerce-style', get_template_directory_uri() . '/assets/build/css/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'saturn-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'saturn_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function saturn_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'saturn_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function saturn_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 8,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'saturn_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'saturn_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function saturn_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'saturn_woocommerce_wrapper_before' );

if ( ! function_exists( 'saturn_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function saturn_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'saturn_woocommerce_wrapper_after' );







/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'saturn_woocommerce_header_cart' ) ) {
			saturn_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'saturn_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function saturn_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		saturn_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'saturn_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'saturn_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function saturn_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'saturn' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'saturn' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'saturn_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function saturn_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php saturn_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'saturn_woocommerce_header_add_to_cart_fragment' );

function saturn_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	<?php
	$fragments['span.items'] = ob_get_clean();
	return $fragments;
}






// Add custom fields to registration form
function add_custom_registration_fields() {
    ?>
    <p class="form-row form-row-first">
        <label for="reg_firstname"><?php esc_html_e( 'First Name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="first_name" id="reg_firstname" value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>" required />
    </p>

    <p class="form-row form-row-last">
        <label for="reg_lastname"><?php esc_html_e( 'Last Name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="last_name" id="reg_lastname" value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>" required />
    </p>

    <div class="clear"></div>
    
    <p class="form-row form-row-wide">
        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="email" class="input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required />
    </p>

    <p class="form-row form-row-wide">
        <label for="reg_phone"><?php esc_html_e( 'Phone', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="tel" class="input-text" name="phone" id="reg_phone" value="<?php echo ( ! empty( $_POST['phone'] ) ) ? esc_attr( wp_unslash( $_POST['phone'] ) ) : ''; ?>" required />
    </p>

    <p class="form-row form-row-wide">
        <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="password" class="input-text" name="password" id="reg_password" required />
    </p>
    <?php
}
remove_action( 'woocommerce_register_form', 'woocommerce_register_form' );
add_action( 'woocommerce_register_form', 'add_custom_registration_fields' );

// Remove default email field
function remove_default_email_field( $fields ) {
    if ( isset( $fields['email'] ) ) {
        unset( $fields['email'] );
    }
    return $fields;
}
add_filter( 'woocommerce_register_form_fields', 'remove_default_email_field', 10, 1 );

// Replace custom email field with default email field
function replace_custom_email_field_with_default( $fields ) {
    $fields['email']['label'] = __( 'Email address', 'woocommerce' );
    $fields['email']['required'] = true;
    $fields['email']['class'] = array( 'form-row-wide' );
    $fields['email']['validate'] = array( 'email' );
    $fields['email']['autocomplete'] = 'email';
    return $fields;
}
// add_filter( 'woocommerce_register_form_fields', 'replace_custom_email_field_with_default', 10, 1 );

// Validate custom fields
function validate_custom_registration_fields( $errors, $username, $email ) {
    if ( isset( $_POST['first_name'] ) && empty( $_POST['first_name'] ) ) {
        $errors->add( 'first_name_error', __( 'Please enter your first name.', 'woocommerce' ) );
    }

    if ( isset( $_POST['last_name'] ) && empty( $_POST['last_name'] ) ) {
        $errors->add( 'last_name_error', __( 'Please enter your last name.', 'woocommerce' ) );
    }

    if ( isset( $_POST['phone'] ) && empty( $_POST['phone'] ) ) {
        $errors->add( 'phone_error', __( 'Please enter your phone number.', 'woocommerce' ) );
    }

    if ( isset( $_POST['password'] ) && strlen( $_POST['password'] ) < 6 ) {
        $errors->add( 'password_error', __( 'Password should be at least 6 characters long.', 'woocommerce' ) );
    }

    if ( isset( $_POST['email'] ) && empty( $_POST['email'] ) ) {
        $errors->add( 'email_error', __( 'Please enter your email address.', 'woocommerce' ) );
    }

    return $errors;
}
add_filter( 'woocommerce_registration_errors', 'validate_custom_registration_fields', 10, 3 );

// Save custom fields
function save_custom_registration_fields( $customer_id ) {
    if ( isset( $_POST['first_name'] ) ) {
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) );
    }

    if ( isset( $_POST['last_name'] ) ) {
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) );
    }

    if ( isset( $_POST['phone'] ) ) {
        update_user_meta( $customer_id, 'phone', sanitize_text_field( wp_unslash( $_POST['phone'] ) ) );
    }

    if ( isset( $_POST['email'] ) ) {
        update_user_meta( $customer_id, 'billing_email', sanitize_email( wp_unslash( $_POST['email'] ) ) );
    }
}
add_action( 'woocommerce_created_customer', 'save_custom_registration_fields' );



// Remove default email field
// function remove_default_email_field( $fields ) {
//     if ( isset( $fields['email'] ) ) {
//         unset( $fields['email'] );
//     }
//     return $fields;
// }
// add_filter( 'woocommerce_register_form_fields', 'remove_default_email_field', 10, 1 );

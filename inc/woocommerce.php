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




/*

// Add custom fields to registration form
function add_custom_registration_fields() {
    ?>
    <p class="form-row form-row-first">
        <label for="reg_firstname"><?php esc_html_e( 'First Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="input-text" name="first_name" id="reg_firstname" autocomplete="given-name" value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>" required />
    </p>

    <p class="form-row form-row-last">
        <label for="reg_lastname"><?php esc_html_e( 'Last Name', 'woocommerce' ); ?>&nbsp;</label>
        <input type="text" class="input-text" name="last_name" id="reg_lastname" autocomplete="family-name" value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>" />
    </p>

    <p class="form-row form-row-wide">
        <label for="reg_phone"><?php esc_html_e( 'Phone', 'woocommerce' ); ?></label>
        <input type="tel" class="input-text" name="phone" id="reg_phone" autocomplete="tel" value="<?php echo ( ! empty( $_POST['phone'] ) ) ? esc_attr( wp_unslash( $_POST['phone'] ) ) : ''; ?>" />
    </p>

    <?php
}
add_action( 'woocommerce_register_form_start', 'add_custom_registration_fields' );


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



    return $errors;
}
add_filter( 'woocommerce_registration_errors', 'validate_custom_registration_fields', 10, 3 );





// Save custom fields
function save_custom_registration_fields( $customer_id ) {
    if ( isset( $_POST['first_name'] ) ) {
		$first_name = sanitize_text_field( wp_unslash( $_POST['first_name'] ) );

		
        update_user_meta( $customer_id, 'first_name', $first_name );
        
        // Update billing and shipping data
        update_user_meta( $customer_id, 'billing_first_name', $first_name );
        update_user_meta( $customer_id, 'shipping_first_name', $first_name );
    }

    if ( isset( $_POST['last_name'] ) ) {
        $last_name = sanitize_text_field( wp_unslash( $_POST['last_name'] ) );

        update_user_meta( $customer_id, 'last_name', $last_name );

        // Update billing and shipping data
        update_user_meta( $customer_id, 'billing_last_name', $last_name );
        update_user_meta( $customer_id, 'shipping_last_name', $last_name );
    }

    if ( isset( $_POST['phone'] ) ) {
        $phone = sanitize_text_field( wp_unslash( $_POST['phone'] ) );

        update_user_meta( $customer_id, 'phone', $phone );

        // Update billing and shipping data
        update_user_meta( $customer_id, 'billing_phone', $phone );
        update_user_meta( $customer_id, 'shipping_phone', $phone );
    }


}
add_action( 'woocommerce_created_customer', 'save_custom_registration_fields' );

*/

// Add custom fields to registration form
function add_custom_registration_fields() {
    wp_nonce_field( 'custom-registration-fields', 'custom_registration_nonce' );

    ?>
    <p class="form-row form-row-first">
        <label for="reg_firstname"><?php esc_html_e( 'First Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="input-text" name="first_name" id="reg_firstname" autocomplete="given-name" value="<?php echo esc_attr( wp_unslash( $_POST['first_name'] ?? '' ) ); ?>" required />
    </p>

    <p class="form-row form-row-last">
        <label for="reg_lastname"><?php esc_html_e( 'Last Name', 'woocommerce' ); ?>&nbsp;</label>
        <input type="text" class="input-text" name="last_name" id="reg_lastname" autocomplete="family-name" value="<?php echo esc_attr( wp_unslash( $_POST['last_name'] ?? '' ) ); ?>" />
    </p>

    <p class="form-row form-row-wide">
        <label for="reg_phone"><?php esc_html_e( 'Phone', 'woocommerce' ); ?></label>
        <input type="tel" class="input-text" name="phone" id="reg_phone" autocomplete="tel" value="<?php echo esc_attr( wp_unslash( $_POST['phone'] ?? '' ) ); ?>" />
    </p>

    <?php
}
add_action( 'woocommerce_register_form_start', 'add_custom_registration_fields' );

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

    return $errors;
}
add_filter( 'woocommerce_registration_errors', 'validate_custom_registration_fields', 10, 3 );

// Save custom fields
function save_custom_registration_fields( $customer_id ) {
    if ( isset( $_POST['first_name'], $_POST['custom_registration_nonce'] ) && wp_verify_nonce( $_POST['custom_registration_nonce'], 'custom-registration-fields' ) ) {
        $first_name = sanitize_text_field( wp_unslash( $_POST['first_name'] ) );

        update_user_meta( $customer_id, 'first_name', $first_name );

        // Update billing and shipping data
        update_user_meta( $customer_id, 'billing_first_name', $first_name );
        update_user_meta( $customer_id, 'shipping_first_name', $first_name );
    }

    if ( isset( $_POST['last_name'], $_POST['custom_registration_nonce'] ) && wp_verify_nonce( $_POST['custom_registration_nonce'], 'custom-registration-fields' ) ) {
        $last_name = sanitize_text_field( wp_unslash( $_POST['last_name'] ) );

        update_user_meta( $customer_id, 'last_name', $last_name );

        // Update billing and shipping data
        update_user_meta( $customer_id, 'billing_last_name', $last_name );
        update_user_meta( $customer_id, 'shipping_last_name', $last_name );
    }

    if ( isset( $_POST['phone'], $_POST['custom_registration_nonce'] ) && wp_verify_nonce( $_POST['custom_registration_nonce'], 'custom-registration-fields' ) ) {
        $phone = sanitize_text_field( wp_unslash( $_POST['phone'] ) );

        update_user_meta( $customer_id, 'phone', $phone );

        // Update billing and shipping data
        update_user_meta( $customer_id, 'billing_phone', $phone );
        update_user_meta( $customer_id, 'shipping_phone', $phone );
    }
}
add_action( 'woocommerce_created_customer', 'save_custom_registration_fields' );



/**
 * 	Add phone fields to my account page
 * 	woocommerce
 */

// Add phone number field to account details tab
function add_account_phone_field() {
    $user_id = get_current_user_id();
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_phone"><?php esc_html_e( 'Phone', 'woocommerce' ); ?></label>
        <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" name="account_phone" id="account_phone" value="<?php echo esc_attr( get_user_meta( $user_id, 'phone', true ) ); ?>" />
    </p>
    <?php
}
add_action( 'woocommerce_edit_account_form', 'add_account_phone_field' );

// Save account phone number
function save_account_phone_number( $user_id ) {
	if ( isset( $_POST['account_phone'] ) ) {
        update_user_meta( $user_id, 'phone', sanitize_text_field( wp_unslash( $_POST['account_phone'] ) ) );
		
		// Update billing and shipping phone
        update_user_meta( $user_id, 'billing_phone',  sanitize_text_field( wp_unslash( $_POST['account_phone'] ) ) );
        update_user_meta( $user_id, 'shipping_phone',  sanitize_text_field( wp_unslash( $_POST['account_phone'] ) ) );
    }
}
add_action( 'woocommerce_save_account_details', 'save_account_phone_number' );



/**
 * 	Add username and disable email field 
 * 	in the Account details tab
 */
// Disable email address change for non-admin users
add_action( 'woocommerce_after_edit_account_form', 'disable_edit_email_address' );

function disable_edit_email_address( ) {
    $script = '<script type="text/javascript">'.
              'var account_email = document.getElementById("account_email");'.
              'if(account_email) { '.
              '     account_email.readOnly = true; '.
              '     account_email.className += " disable-input";'.
              '}'.
              '</script>';
    echo $script;
}

function add_disabled_username_field_to_account_form() {
    $user = wp_get_current_user();

    echo '<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">';
    echo '<label for="account_username">' . esc_html__( 'Username', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label>';
    echo '<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_username" id="account_username" value="' . esc_attr( $user->user_login ) . '" autocomplete="username" readonly />';
    echo '</p>';
}
add_action( 'woocommerce_edit_account_form_start', 'add_disabled_username_field_to_account_form' );


/**
 * 	Adding phone column 
 * 	field in the wordpress admin user list
 * 	for administrators
 */

// Add phone number column to user list in admin
function add_phone_column( $columns ) {
    $new_columns = array();
    foreach ( $columns as $column_key => $column_value ) {
        $new_columns[ $column_key ] = $column_value;
        if ( 'email' === $column_key ) {
            $new_columns['phone'] = __( 'Phone', 'saturn' );
        }
    }
    return $new_columns;
}
add_filter( 'manage_users_columns', 'add_phone_column' );

// Populate phone number column with data
function display_phone_column( $value, $column_name, $user_id ) {
    if ( 'phone' === $column_name ) {
        return get_user_meta( $user_id, 'phone', true );
    }
    return $value;
}
add_action( 'manage_users_custom_column', 'display_phone_column', 10, 3 );


/**
 * 	Add phone when open single user
 */
// Add phone field to user profile

function add_phone_field( $user ) {
    ?>
    <h3><?php _e( 'Phone Number', 'saturn' ); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="phone"><?php _e( 'Phone', 'saturn' ); ?></label></th>
            <td>
                <input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_user_meta( $user->ID, 'phone', true ) ); ?>" class="regular-text" />
                <p class="description"><?php _e( 'The user phone number.', 'saturn' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'show_user_profile', 'add_phone_field' );
add_action( 'edit_user_profile', 'add_phone_field' );


// Save phone field data
function save_phone_field( $user_id ) {
    if ( current_user_can( 'edit_user', $user_id ) ) {
        update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST['phone'] ) );
    }
}
add_action( 'personal_options_update', 'save_phone_field' );
add_action( 'edit_user_profile_update', 'save_phone_field' );



/**
 *  Add phone field to the "Add New User" page
 */

function add_phone_field_to_new_user() {
    ?>
    <table class="form-table">
        <tr>
            <th><label for="phone"><?php _e( 'Phone', 'saturn' ); ?></label></th>
            <td>
                <input type="text" name="phone" id="phone" class="regular-text" />
                <p class="description"><?php _e( 'Please add the user\'s phone number.', 'saturn' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'user_new_form', 'add_phone_field_to_new_user' );


// Save phone field data when creating a new user
function save_phone_field_for_new_user( $user_id ) {
    if ( isset( $_POST['phone'] ) ) {
        $phone = sanitize_text_field( $_POST['phone'] );
        update_user_meta( $user_id, 'phone', $phone );

        // Update billing and shipping phone
        update_user_meta( $user_id, 'billing_phone', $phone );
        update_user_meta( $user_id, 'shipping_phone', $phone );
    }
}
add_action( 'user_register', 'save_phone_field_for_new_user' );




/**
 *  Modification to the login page
 */

 function add_custom_content_before_customer_login_form() {
    ?>
	<div class="woocommerce-info-wrapper">
		<div class="woocommerce-info-wrapper__content">
			<div id="my-account-header">
				<div class="site-logo">
					<?php 
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
					?>
				</div>
				<h3 class="welcome-title text-center"><?php esc_html_e('Welcome Back!', 'saturn') ?></h3>

				<div class="form-switch mb-2 text-center signup-link-container"><?php esc_html_e('Don\'t have an Account? ', 'saturn'); ?><a class="signup-link" href="#" rel="nofollow"><?php esc_html_e('Register Now', 'saturn') ?></a></div>

				<div class="form-switch mb-2 text-center back-login-link-container" style="display: none"><?php esc_html_e('Already a member? ', 'saturn') ?><a class="back-login-link" href="#" rel="nofollow"><?php esc_html_e('Login', 'saturn') ?></a></div>
			</div>


    <?php
}

add_action('woocommerce_before_customer_login_form', 'add_custom_content_before_customer_login_form');


function add_custom_content_after_customer_login_form() {
    ?>
	
		</div>
		<div class="woocommerce-info-wrapper__features">
			<div class="woocommerce-info-wrapper__features--wrapper" style="background-image: url('<?php ?>');">
				<div class="slide-sec"></div>
			</div>
		</div>
	</div>

    <?php
}

add_action('woocommerce_after_customer_login_form', 'add_custom_content_after_customer_login_form');




/***
 * Make by default the display name
 *  to be the first name
 */

add_filter( 'pre_user_display_name', 'set_display_name_to_forename' );

function set_display_name_to_forename( $display_name ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        $display_name = sanitize_text_field( $_POST['billing_first_name'] );
    } elseif ( isset( $_POST['first_name'] ) ) {
        $display_name = sanitize_text_field( $_POST['first_name'] );
    }
    return $display_name;
}



<?php
/**
 * Saturn Theme Customizer
 *
 * @package Saturn
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function saturn_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'saturn_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'saturn_customize_partial_blogdescription',
			)
		);
	}
	

	// Copyright Section
	$wp_customize->add_section( 
		'sec_copyright', array(
			'title'			=> 'Copyright Settings',
			'description'	=> 'Copyright Section'
		)
	);
	// Custom product customization
	$wp_customize->add_section( 
		'sec_product_customize', array(
			'title'			=> 'Cusom Product Customization',
			'description'	=> 'Settings for home page etc'
		)
	);
	
		// Field 1 - Copyright Text Box
		$wp_customize->add_setting(
			'set_copyright', array(
				'type'					=> 'theme_mod',
				'default'				=> '',
				'sanitize_callback'		=> 'sanitize_text_field'
			)
		);

		
		$wp_customize->add_control(
			'set_copyright', array(
				'label'					=> 'Copyright',
				'description'			=> 'Please, add your copyright information here',
				'section'				=> 'sec_copyright',
				'type'					=> 'text'
			)
		);



		// Deal of the week Checkbox
		$wp_customize->add_setting(
			'set_deal_show', array(
				'type'					=> 'theme_mod',
				'default'				=> '',
				'sanitize_callback'		=> 'saturn_sanitize_checkbox'
			)
		);


		$wp_customize->add_control(
			'set_deal_show', array(
				'label'					=> 'Show Deal of the week?',
				'section'				=> 'sec_product_customize',
				'type'					=> 'checkbox'
			)
		);

		// Deal Section title
		$wp_customize->add_setting(
			'set_deal_title', array(
				'type'					=> 'theme_mod',
				'default'				=> '',
				'sanitize_callback'		=> 'sanitize_text_field'
			)
		);

		
		$wp_customize->add_control(
			'set_deal_title', array(
				'label'					=> 'Deal Section Title',
				'description'			=> 'Please, add the text that you want to display as a title in the front end',
				'section'				=> 'sec_product_customize',
				'type'					=> 'text'
			)
		);
		
		// Deal of the Week Product ID
		$wp_customize->add_setting(
			'set_deal', array(
				'type'					=> 'theme_mod',
				'default'				=> '',
				'sanitize_callback'		=> 'sanitize_text_field'
			)
		);

		
		$wp_customize->add_control(
			'set_deal', array(
				'label'					=> 'Deal of the week Product ID',
				'description'			=> 'Product ID to Display',
				'section'				=> 'sec_product_customize',
				'type'					=> 'number'
			)
		);



	// // Add Footer Links section
	// $wp_customize->add_section('footer_links_section', array(
	// 	'title' => 'Footer Links',
	// 	'priority' => 120,
	// ));

	// $num_columns = 4;
	// $num_links_per_column = 6;

	// // Loop through columns
	// for ($col = 1; $col <= $num_columns; $col++) {
	// 	// Loop through links within each column
	// 	for ($link = 1; $link <= $num_links_per_column; $link++) {
	// 		$setting_id = 'footer_link_column' . $col . '_' . $link;

	// 		$wp_customize->add_setting($setting_id, array(
	// 			'default' => '',
	// 			'sanitize_callback' => 'esc_url_raw',
	// 		));

	// 		$wp_customize->add_control($setting_id, array(
	// 			'label' => 'Column ' . $col . ' Link ' . $link . ' URL',
	// 			'section' => 'footer_links_section',
	// 			'type' => 'url',
	// 		));
	// 	}
	// }

	// $num_columns = 4;

    // // Add Footer Links section
    // $wp_customize->add_section('footer_links_section', array(
    //     'title' => 'Footer Links',
    //     'priority' => 120,
    // ));

    // Loop through columns
    // for ($col = 1; $col <= $num_columns; $col++) {
    //     // Column Title setting
    //     $title_setting_id = 'footer_column_title_' . $col;
    //     $wp_customize->add_setting($title_setting_id, array(
    //         'default' => 'Column ' . $col . ' Title',
    //         'sanitize_callback' => 'sanitize_text_field',
    //     ));
    //     $wp_customize->add_control($title_setting_id, array(
    //         'label' => 'Column ' . $col . ' Title',
    //         'section' => 'footer_links_section',
    //         'type' => 'text',
    //     ));

    //     // Column Text setting
    //     $text_setting_id = 'footer_column_text_' . $col;
    //     $wp_customize->add_setting($text_setting_id, array(
    //         'default' => '',
    //         'sanitize_callback' => 'sanitize_textarea_field',
    //     ));
    //     $wp_customize->add_control($text_setting_id, array(
    //         'label' => 'Column ' . $col . ' Text',
    //         'section' => 'footer_links_section',
    //         'type' => 'textarea',
    //     ));
    // }
}
add_action( 'customize_register', 'saturn_customize_register' );


/**
 * Custom sanitization for checkbox
 *
 * @return void
 */
function saturn_sanitize_checkbox( $checked ) {
	return ( ( isset ( $checked ) && true == $checked ) ? true : false );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function saturn_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function saturn_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function saturn_customize_preview_js() {
	wp_enqueue_script( 'saturn-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'saturn_customize_preview_js' );

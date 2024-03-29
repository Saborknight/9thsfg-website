<?php
/**
* Google Fonts Implementation
*
* @package Bold
* @since Bold 4.0
*
*/

/**
* Register Google Fonts
*
* @since Bold 4.0
*/
function organic_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'bold_open_sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,800italic,700italic,600italic,400italic,300italic" );
	wp_register_style( 'bold_merriweather', "$protocol://fonts.googleapis.com/css?family=Merriweather:400,700,300,900" );
	wp_register_style( 'bold_montserrat', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700" );
}
add_action( 'init', 'organic_register_fonts' );

/**
* Enqueue Google Fonts on Front End
*
* @since Bold 4.0
*/

function organic_fonts() {
	wp_enqueue_style( 'bold_open_sans' );
	wp_enqueue_style( 'bold_merriweather' );
	wp_enqueue_style( 'bold_montserrat' );
}
add_action( 'wp_enqueue_scripts', 'organic_fonts' );

/**
* Enqueue Google Fonts on Custom Header Page
*
* @since Bold 4.0
*/
function organic_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
	return;
	
	wp_enqueue_style( 'bold_open_sans' );
	wp_enqueue_style( 'bold_merriweather' );
	wp_enqueue_style( 'bold_montserrat' );
}
add_action( 'admin_enqueue_scripts', 'organic_admin_fonts' );
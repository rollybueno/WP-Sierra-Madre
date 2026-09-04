<?php
/**
 * Sierra Madre theme setup.
 *
 * @package Sierra_Madre
 */

add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'style.css', 'assets/css/prototype.css' ) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$theme = wp_get_theme();
	wp_enqueue_style(
		'sierra-madre-prototype',
		get_theme_file_uri( 'assets/css/prototype.css' ),
		array(),
		$theme->get( 'Version' )
	);
	wp_enqueue_style(
		'sierra-madre',
		get_stylesheet_uri(),
		array( 'sierra-madre-prototype' ),
		$theme->get( 'Version' )
	);
	wp_enqueue_script(
		'sierra-madre-interactions',
		get_theme_file_uri( 'assets/js/main.js' ),
		array(),
		$theme->get( 'Version' ),
		true
	);
} );

<?php
/**
 * Sierra Madre theme setup.
 *
 * @package Sierra_Madre
 */

add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'style.css', 'assets/css/theme.css' ) );
} );

add_action( 'init', function () {
	register_block_pattern_category(
		'sierra-madre',
		array( 'label' => __( 'Sierra Madre', 'sierra-madre' ) )
	);
} );

/* Local's development runtime does not auto-register theme patterns reliably. */
add_action( 'init', function () {
	$patterns = array(
		'home-hero' => __( 'Homepage hero', 'sierra-madre' ),
		'home-body' => __( 'Homepage editorial sections', 'sierra-madre' ),
	);

	foreach ( $patterns as $slug => $title ) {
		$name = 'sierra-madre/' . $slug;
		if ( WP_Block_Patterns_Registry::get_instance()->is_registered( $name ) ) {
			continue;
		}
		ob_start();
		include get_theme_file_path( 'patterns/' . $slug . '.php' );
		register_block_pattern( $name, array(
			'title' => $title, 'categories' => array( 'sierra-madre' ),
			'content' => ob_get_clean(), 'inserter' => false,
		) );
	}
}, 20 );

add_filter( 'query_loop_block_query_vars', function ( $query, $block ) {
	$query_id = (int) ( $block->context['queryId'] ?? 0 );
	if ( 21 === $query_id ) {
		$query['category_name'] = 'field-notes';
		$query['ignore_sticky_posts'] = true;
	}
	return $query;
}, 10, 2 );

add_action( 'wp_enqueue_scripts', function () {
	$theme = wp_get_theme();
	wp_enqueue_style(
		'sierra-madre-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array(),
		$theme->get( 'Version' )
	);
	wp_enqueue_style(
		'sierra-madre',
		get_stylesheet_uri(),
		array( 'sierra-madre-theme' ),
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

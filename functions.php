<?php
/**
 * Sierra Madre theme setup.
 *
 * @package Sierra_Madre
 */

add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/theme.css', 'style.css' ) );
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
		'story-article-section' => __( 'Story article section with field note', 'sierra-madre' ),
		'story-article-continuation' => __( 'Story article continuation with field note', 'sierra-madre' ),
		'story-full-image' => __( 'Story full-width image', 'sierra-madre' ),
		'story-diptych' => __( 'Story image diptych', 'sierra-madre' ),
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

/* Preserve a dynamic post title while applying the prototype's editorial line treatment. */
add_filter( 'render_block_core/post-title', function ( $content, $block, $instance ) {
	$class_name = $block['attrs']['className'] ?? '';
	if ( ! in_array( 'story-title', preg_split( '/\s+/', $class_name ), true ) || ! is_singular( 'post' ) ) {
		return $content;
	}

	$plain_title = trim( wp_strip_all_tags( get_the_title( $instance->context['postId'] ?? get_the_ID() ) ) );
	$words = preg_split( '/\s+/u', $plain_title );
	$is_long = mb_strlen( $plain_title ) > 40;
	if ( $is_long ) {
		$processor = new WP_HTML_Tag_Processor( $content );
		if ( $processor->next_tag( 'H1' ) ) {
			$processor->add_class( 'story-title-long' );
			$content = $processor->get_updated_html();
		}
	}
	if ( count( $words ) < 3 ) {
		return $content;
	}

	$accent = array_pop( $words );
	$second_line = array_pop( $words );
	$title = esc_html( implode( ' ', $words ) ) . ( $is_long ? ' ' : '<br>' ) . esc_html( $second_line ) . ' <em>' . esc_html( $accent ) . '</em>';

	return preg_replace_callback( '/(<h1\b[^>]*>).*?(<\/h1>)/s', static function ( $matches ) use ( $title ) {
		return $matches[1] . $title . $matches[2];
	}, $content, 1 );
}, 10, 3 );

add_filter( 'render_block_core/post-date', function ( $content, $block ) {
	$class_name = $block['attrs']['className'] ?? '';
	if ( ! str_contains( $class_name, 'story-date' ) || ! is_singular( 'post' ) ) {
		return $content;
	}

	$minutes = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) );
	return preg_replace( '/(<\/time>)/', '$1<span aria-label="Estimated reading time"> / ' . $minutes . ' MIN</span>', $content, 1 );
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

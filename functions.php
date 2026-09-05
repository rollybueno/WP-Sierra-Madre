<?php
/**
 * Sierra Madre theme setup.
 *
 * @package Sierra_Madre
 */

require_once get_theme_file_path( 'inc/helpers.php' );

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'sierra-madre', get_template_directory() . '/languages' );
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
		'home-hero'                    => __( 'Homepage hero', 'sierra-madre' ),
		'home-opening'                 => __( 'Homepage opening', 'sierra-madre' ),
		'home-journal'                 => __( 'Homepage journal', 'sierra-madre' ),
		'home-places'                  => __( 'Homepage places', 'sierra-madre' ),
		'home-photography'             => __( 'Homepage photography', 'sierra-madre' ),
		'home-dispatches'              => __( 'Homepage dispatches', 'sierra-madre' ),
		'home-postscript'              => __( 'Homepage postscript', 'sierra-madre' ),
		'footer-colophon'              => __( 'Footer colophon', 'sierra-madre' ),
		'story-intro-meta'             => __( 'Story field metadata', 'sierra-madre' ),
		'story-byline'                 => __( 'Story byline', 'sierra-madre' ),
		'story-article-section'        => __( 'Story article section with field note', 'sierra-madre' ),
		'story-article-continuation'   => __( 'Story article continuation with field note', 'sierra-madre' ),
		'story-full-image'             => __( 'Story full-width image', 'sierra-madre' ),
		'story-diptych'                => __( 'Story image diptych', 'sierra-madre' ),
		'archive-hero'                 => __( 'Archive hero', 'sierra-madre' ),
		'archive-query'                => __( 'Archive query grid', 'sierra-madre' ),
		'search-hero'                  => __( 'Search hero', 'sierra-madre' ),
		'search-query'                 => __( 'Search results list', 'sierra-madre' ),
		'error-stage'                  => __( '404 error stage', 'sierra-madre' ),
		'page-intro'                   => __( 'Editorial page introduction', 'sierra-madre' ),
		'page-panorama'                => __( 'Editorial panoramic image', 'sierra-madre' ),
		'page-manifesto'               => __( 'Editorial manifesto', 'sierra-madre' ),
		'page-principles'              => __( 'Numbered editorial principles', 'sierra-madre' ),
		'page-contributors'            => __( 'Contributors and contact', 'sierra-madre' ),
		'page-editorial'               => __( 'Complete editorial page', 'sierra-madre' ),
	);

	foreach ( $patterns as $slug => $title ) {
		$name = 'sierra-madre/' . $slug;
		if ( WP_Block_Patterns_Registry::get_instance()->is_registered( $name ) ) {
			continue;
		}
		ob_start();
		include get_theme_file_path( 'patterns/' . $slug . '.php' );
		$properties = array(
			'title'      => $title,
			'categories' => array( 'sierra-madre' ),
			'content'    => ob_get_clean(),
			'inserter'   => str_starts_with( $slug, 'page-' ),
		);
		if ( 'page-editorial' === $slug ) {
			$properties['postTypes']  = array( 'page' );
			$properties['blockTypes'] = array( 'core/post-content' );
		}
		register_block_pattern( $name, $properties );
	}
}, 20 );

/*
 * Pattern content is captured at registration. Re-render request-aware patterns
 * so archive/search/404/story meta resolve in the current query context.
 */
add_filter( 'render_block_core/pattern', function ( $block_content, $block ) {
	$slug = $block['attrs']['slug'] ?? '';
	$dynamic = array(
		'sierra-madre/home-hero',
		'sierra-madre/home-opening',
		'sierra-madre/home-journal',
		'sierra-madre/home-places',
		'sierra-madre/home-photography',
		'sierra-madre/home-dispatches',
		'sierra-madre/home-postscript',
		'sierra-madre/footer-colophon',
		'sierra-madre/story-intro-meta',
		'sierra-madre/story-byline',
		'sierra-madre/archive-hero',
		'sierra-madre/search-hero',
		'sierra-madre/error-stage',
	);
	if ( ! in_array( $slug, $dynamic, true ) ) {
		return $block_content;
	}
	$file = get_theme_file_path( 'patterns/' . str_replace( 'sierra-madre/', '', $slug ) . '.php' );
	if ( ! file_exists( $file ) ) {
		return $block_content;
	}
	ob_start();
	include $file;
	return do_blocks( ob_get_clean() );
}, 10, 2 );

/* Preserve a dynamic post title while applying the prototype's editorial line treatment. */
add_filter( 'render_block_core/post-title', function ( $content, $block, $instance ) {
	$class_name = $block['attrs']['className'] ?? '';
	if ( ! in_array( 'story-title', preg_split( '/\s+/', $class_name ), true ) || ! is_singular( 'post' ) ) {
		return $content;
	}

	$plain_title = trim( wp_strip_all_tags( get_the_title( $instance->context['postId'] ?? get_the_ID() ) ) );
	$words       = preg_split( '/\s+/u', $plain_title );
	$is_long     = mb_strlen( $plain_title ) > 40;
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

	$accent      = array_pop( $words );
	$second_line = array_pop( $words );
	$title       = esc_html( implode( ' ', $words ) ) . ( $is_long ? ' ' : '<br>' ) . esc_html( $second_line ) . ' <em>' . esc_html( $accent ) . '</em>';

	return preg_replace_callback(
		'/(<h1\b[^>]*>).*?(<\/h1>)/s',
		static function ( $matches ) use ( $title ) {
			return $matches[1] . $title . $matches[2];
		},
		$content,
		1
	);
}, 10, 3 );

/*
 * Story/page decks use post-excerpt. WordPress auto-generates one from content
 * when empty, which duplicates the opening of the article. Only render when an
 * editor has set an explicit excerpt.
 */
add_filter( 'render_block_core/post-excerpt', function ( $content ) {
	if ( is_admin() || wp_is_serving_rest_request() || ! is_singular() ) {
		return $content;
	}
	if ( ! has_excerpt() ) {
		return '';
	}
	return $content;
} );

add_filter( 'render_block_core/post-date', function ( $content, $block ) {
	$class_name = $block['attrs']['className'] ?? '';
	if ( ! str_contains( $class_name, 'story-date' ) || ! is_singular( 'post' ) ) {
		return $content;
	}

	$minutes = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) );
	$label   = sprintf(
		/* translators: %d: estimated reading time in minutes */
		__( ' / %d MIN', 'sierra-madre' ),
		$minutes
	);
	$aria = esc_attr__( 'Estimated reading time', 'sierra-madre' );
	return preg_replace(
		'/(<\/time>)/',
		'$1<span aria-label="' . $aria . '">' . esc_html( $label ) . '</span>',
		$content,
		1
	);
}, 10, 2 );

/* Keep journal search focused on stories, not utility pages. */
add_action( 'pre_get_posts', function ( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}
	$query->set( 'post_type', 'post' );
} );

add_action( 'wp_enqueue_scripts', function () {
	$theme = wp_get_theme();
	wp_enqueue_style(
		'sierra-madre-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array( 'global-styles' ),
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

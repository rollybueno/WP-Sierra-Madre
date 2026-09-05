<?php
/**
 * Shared helpers for Sierra Madre patterns.
 *
 * @package Sierra_Madre
 */

/**
 * Pick the latest published post in a category, with static fallbacks.
 *
 * @param string $category Category slug.
 * @param array  $fallback Keys: title, excerpt, url, image, meta.
 * @return array
 */
function sierra_madre_pick_post( $category, $fallback = array() ) {
	$posts = get_posts(
		array(
			'category_name'       => $category,
			'numberposts'         => 1,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => false,
		)
	);
	$post = $posts[0] ?? null;
	if ( ! $post ) {
		return $fallback;
	}
	$image = get_the_post_thumbnail_url( $post, 'full' );
	$minutes = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( $post->post_content ) ) / 220 ) );
	return array(
		'title'   => get_the_title( $post ),
		'excerpt' => get_the_excerpt( $post ),
		'url'     => get_permalink( $post ),
		'image'   => $image ?: ( $fallback['image'] ?? '' ),
		'meta'    => $fallback['meta'] ?? '',
		'minutes' => $minutes,
		'id'      => $post->ID,
	);
}

/**
 * Format a title with the last word italicized (editorial habit).
 *
 * @param string $title Plain title.
 * @return string Safe HTML.
 */
function sierra_madre_accent_title( $title ) {
	$words = preg_split( '/\s+/u', trim( wp_strip_all_tags( $title ) ) );
	if ( ! $words || count( $words ) < 2 ) {
		return esc_html( $title );
	}
	$accent = array_pop( $words );
	return esc_html( implode( ' ', $words ) ) . ' <em>' . esc_html( $accent ) . '</em>';
}

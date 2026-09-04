<?php
/**
 * Title: Complete editorial page
 * Slug: sierra-madre/page-editorial
 * Categories: sierra-madre
 * Post Types: page
 * Block Types: core/post-content
 */

foreach ( array( 'page-intro', 'page-panorama', 'page-manifesto', 'page-principles', 'page-contributors' ) as $section ) {
	include get_theme_file_path( 'patterns/' . $section . '.php' );
}

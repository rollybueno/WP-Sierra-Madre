<?php
/**
 * Title: Search hero
 * Slug: sierra-madre/search-hero
 * Categories: sierra-madre
 * Inserter: no
 */
global $wp_query;
$query = get_search_query();
$count = isset( $wp_query->found_posts ) ? (int) $wp_query->found_posts : 0;
$label = sprintf(
	/* translators: %02d: result count */
	__( 'SEARCH / %02d RESULTS', 'sierra-madre' ),
	$count
);
?>
<!-- wp:html -->
<header class="listing-hero wrap">
  <span><?php echo esc_html( $label ); ?></span>
  <h1><?php esc_html_e( 'Results for', 'sierra-madre' ); ?><br><em>“<?php echo esc_html( $query ); ?>”</em></h1>
</header>
<!-- /wp:html -->
<!-- wp:search {"label":"Search again","showLabel":false,"placeholder":"Search the journal…","buttonText":"Search ↗","buttonUseIcon":false,"className":"listing-search wrap"} /-->

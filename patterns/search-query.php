<?php
/**
 * Title: Search results list
 * Slug: sierra-madre/search-query
 * Categories: sierra-madre
 * Inserter: no
 */
?>
<!-- wp:query {"queryId":19,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"search-query"} -->
<div class="wp-block-query search-query"><!-- wp:post-template {"className":"result-list wrap"} -->
<!-- wp:group {"tagName":"article","className":"result-card","layout":{"type":"default"}} -->
<article class="wp-block-group result-card"><!-- wp:post-terms {"term":"category","className":"result-index"} /--><!-- wp:group {"className":"result-link","layout":{"type":"default"}} --><div class="wp-block-group result-link"><!-- wp:post-featured-image {"isLink":true,"className":"result-thumb"} /--><!-- wp:group {"className":"result-copy","layout":{"type":"default"}} --><div class="wp-block-group result-copy"><!-- wp:post-date {"format":"j M Y","className":"result-meta"} /--><!-- wp:post-title {"isLink":true,"level":2} /--><!-- wp:post-excerpt {"showMoreOnNewLine":false} /--></div><!-- /wp:group --><!-- wp:paragraph {"className":"result-arrow"} --><p class="result-arrow" aria-hidden="true">↗</p><!-- /wp:paragraph --></div><!-- /wp:group --></article>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:group {"className":"wrap result-empty","layout":{"type":"default"}} -->
<div class="wp-block-group wrap result-empty"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Nothing matched that trail. Try another word, or return to the journal.', 'sierra-madre' ); ?></p>
<!-- /wp:paragraph --><!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return to the journal ↗', 'sierra-madre' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->

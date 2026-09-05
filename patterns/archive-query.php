<?php
/**
 * Title: Archive query grid
 * Slug: sierra-madre/archive-query
 * Categories: sierra-madre
 * Inserter: no
 */
?>
<!-- wp:query {"queryId":18,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"archive-query"} -->
<div class="wp-block-query archive-query"><!-- wp:post-template {"className":"archive-grid"} -->
<!-- wp:group {"tagName":"article","className":"archive-card","layout":{"type":"default"}} -->
<article class="wp-block-group archive-card"><!-- wp:post-featured-image {"isLink":true,"className":"archive-card-media"} /--><!-- wp:group {"className":"archive-card-copy","layout":{"type":"default"}} --><div class="wp-block-group archive-card-copy"><!-- wp:post-terms {"term":"category","className":"archive-card-meta"} /--><!-- wp:post-title {"isLink":true,"level":2} /--><!-- wp:post-excerpt {"showMoreOnNewLine":false} /--><!-- wp:post-date {"format":"j M Y","className":"archive-card-date"} /--></div><!-- /wp:group --></article>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","className":"pagination wrap","layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous {"label":"Newer stories"} /-->
<!-- wp:query-pagination-next {"label":"Older stories"} /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:group {"className":"wrap","layout":{"type":"default"}} -->
<div class="wp-block-group wrap"><!-- wp:paragraph -->
<p>No stories filed in this part of the journal yet.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->

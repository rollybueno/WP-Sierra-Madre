<?php
/**
 * Title: Homepage hero
 * Slug: sierra-madre/home-hero
 * Categories: sierra-madre
 * Inserter: no
 */
$image = esc_url( get_theme_file_uri( 'assets/images/hero-01.jpg' ) );
?>
<!-- wp:cover {"url":"<?php echo $image; ?>","dimRatio":0,"minHeight":100,"minHeightUnit":"svh","align":"full","anchor":"top","className":"hero"} -->
<div class="wp-block-cover alignfull hero" id="top" style="min-height:100svh"><img class="wp-block-cover__image-background" alt="A remote road threading through a vast mountain landscape" src="<?php echo $image; ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:html --><div class="hero-shade" aria-hidden="true"></div><!-- /wp:html --><!-- wp:group {"className":"hero-meta","layout":{"type":"flex","justifyContent":"space-between"}} --><div class="wp-block-group hero-meta"><!-- wp:paragraph --><p>LUZON / PHILIPPINES</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>28 AUG 2026</p><!-- /wp:paragraph --></div><!-- /wp:group --><!-- wp:heading {"level":1,"anchor":"hero-title"} --><h1 class="wp-block-heading" id="hero-title"><span>North of</span><em>the last road</em></h1><!-- /wp:heading --><!-- wp:group {"className":"hero-foot","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} --><div class="wp-block-group hero-foot"><!-- wp:paragraph --><p>Field Note 021<br>17.0832° N / 120.8995° E</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><a href="#intro">Enter the journal <b>↓</b></a></p><!-- /wp:paragraph --></div><!-- /wp:group --></div></div>
<!-- /wp:cover -->

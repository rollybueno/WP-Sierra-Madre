<?php
/**
 * Title: Homepage hero
 * Slug: sierra-madre/home-hero
 * Categories: sierra-madre
 * Inserter: no
 */
$fallback_image = get_theme_file_uri( 'assets/images/hero-01.jpg' );
$featured_posts = get_posts( array( 'category_name' => 'homepage-hero', 'numberposts' => 1, 'post_status' => 'publish' ) );
$featured = $featured_posts[0] ?? null;
$image = $featured ? ( get_the_post_thumbnail_url( $featured, 'full' ) ?: $fallback_image ) : $fallback_image;
$title = $featured ? get_the_title( $featured ) : __( 'North of the last road', 'sierra-madre' );
$title_words = preg_split( '/\s+/', trim( $title ), 3 );
$title_lead = implode( ' ', array_slice( $title_words, 0, 2 ) );
$title_tail = $title_words[2] ?? '';
$alt = __( 'A remote road threading through a vast mountain landscape', 'sierra-madre' );
?>
<!-- wp:cover {"url":"<?php echo esc_url( $image ); ?>","dimRatio":0,"minHeight":100,"minHeightUnit":"svh","align":"full","anchor":"top","className":"hero"} -->
<div class="wp-block-cover alignfull hero" id="top" style="min-height:100svh"><img class="wp-block-cover__image-background" alt="<?php echo esc_attr( $alt ); ?>" src="<?php echo esc_url( $image ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:html --><div class="hero-shade" aria-hidden="true"></div><!-- /wp:html --><!-- wp:group {"className":"hero-meta","layout":{"type":"flex","justifyContent":"space-between"}} --><div class="wp-block-group hero-meta"><!-- wp:paragraph --><p><?php esc_html_e( 'LUZON / PHILIPPINES', 'sierra-madre' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph --><p><?php esc_html_e( '28 AUG 2026', 'sierra-madre' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group --><!-- wp:heading {"level":1,"anchor":"hero-title"} --><h1 class="wp-block-heading" id="hero-title"><span><?php echo esc_html( $title_lead ); ?></span><em><?php echo esc_html( $title_tail ); ?></em></h1><!-- /wp:heading --><!-- wp:group {"className":"hero-foot","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} --><div class="wp-block-group hero-foot"><!-- wp:paragraph --><p><?php esc_html_e( 'Field Note 021', 'sierra-madre' ); ?><br>17.0832° N / 120.8995° E</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><a href="#intro"><?php esc_html_e( 'Enter the journal', 'sierra-madre' ); ?> <b>↓</b></a></p><!-- /wp:paragraph --></div><!-- /wp:group --></div></div>
<!-- /wp:cover -->

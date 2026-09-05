<?php
/**
 * Title: Homepage places
 * Slug: sierra-madre/home-places
 * Categories: sierra-madre
 * Inserter: no
 */
$assets = esc_url( get_theme_file_uri( 'assets' ) );
$places = get_posts(
	array(
		'category_name' => 'places',
		'numberposts'   => 5,
		'post_status'   => 'publish',
	)
);
$fallbacks = array(
	array( 'title' => 'Sierra Madre', 'excerpt' => 'A range facing the Pacific. The spine of the eastern islands, and the reason this journal has a name.', 'url' => '#', 'image' => "$assets/images/place-01.jpg", 'coord' => '14.6723° N' ),
	array( 'title' => 'Aurora', 'excerpt' => 'Where the road meets the sea', 'url' => '#', 'image' => "$assets/images/coast-01.jpg", 'coord' => '15.7600° N' ),
	array( 'title' => 'Benguet', 'excerpt' => 'Mornings above the clouds', 'url' => '#', 'image' => "$assets/images/fieldnote-01.jpg", 'coord' => '16.4023° N' ),
);
$items = array();
for ( $i = 0; $i < 3; $i++ ) {
	$post = $places[ $i ] ?? null;
	$items[] = $post
		? array(
			'title'   => get_the_title( $post ),
			'excerpt' => get_the_excerpt( $post ) ?: $fallbacks[ $i ]['excerpt'],
			'url'     => get_permalink( $post ),
			'image'   => get_the_post_thumbnail_url( $post, 'large' ) ?: $fallbacks[ $i ]['image'],
			'coord'   => $fallbacks[ $i ]['coord'],
		)
		: $fallbacks[ $i ];
}
$index_links = array_slice( $places, 3 );
$cat = get_category_by_slug( 'places' );
$archive = ( $cat instanceof WP_Term ) ? get_category_link( $cat ) : home_url( '/' );
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"places","className":"v2-places","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull v2-places" id="places"><!-- wp:html -->
<div class="v2-wrap">
  <header class="v2-section-head">
    <div><p class="v2-label">Places</p><h2 id="places-title">A place to begin.</h2></div>
    <p>Not a checklist. A few places that stay with you.</p>
  </header>
  <div class="v2-place-layout">
    <a class="v2-place-feature" href="<?php echo esc_url( $items[0]['url'] ); ?>">
      <div class="v2-place-photo"><img src="<?php echo esc_url( $items[0]['image'] ); ?>" width="960" height="640" alt="" loading="lazy"><span>01</span></div>
      <div class="v2-place-copy">
        <div class="v2-place-name"><h3><?php echo esc_html( $items[0]['title'] ); ?></h3><span aria-hidden="true">↗</span></div>
        <p><?php echo esc_html( $items[0]['excerpt'] ); ?></p>
        <span class="v2-place-coord"><?php echo esc_html( $items[0]['coord'] ); ?></span>
      </div>
    </a>
    <div class="v2-place-list">
      <?php foreach ( array( $items[1], $items[2] ) as $n => $card ) : ?>
      <a class="v2-place-card" href="<?php echo esc_url( $card['url'] ); ?>">
        <div class="v2-place-photo"><img src="<?php echo esc_url( $card['image'] ); ?>" width="960" height="640" alt="" loading="lazy"><span><?php echo esc_html( sprintf( '%02d', $n + 2 ) ); ?></span></div>
        <div class="v2-place-name"><h3><?php echo esc_html( $card['title'] ); ?></h3><span aria-hidden="true">↗</span></div>
        <p><?php echo esc_html( $card['excerpt'] ); ?> <span><?php echo esc_html( $card['coord'] ); ?></span></p>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
  <nav class="v2-place-index" id="place-index" aria-label="<?php esc_attr_e( 'Explore more places', 'sierra-madre' ); ?>">
    <span class="v2-label">Keep exploring</span>
    <?php if ( $index_links ) : ?>
      <?php foreach ( $index_links as $link ) : ?>
      <a href="<?php echo esc_url( get_permalink( $link ) ); ?>"><?php echo esc_html( get_the_title( $link ) ); ?> <span>↗</span></a>
      <?php endforeach; ?>
    <?php else : ?>
      <a href="<?php echo esc_url( $archive ); ?>">Ifugao <span>↗</span></a>
      <a href="<?php echo esc_url( $archive ); ?>">Quezon <span>↗</span></a>
      <a href="<?php echo esc_url( $archive ); ?>">Cagayan <span>↗</span></a>
    <?php endif; ?>
    <a class="v2-index-all" href="<?php echo esc_url( $archive ); ?>">The place index <span>↗</span></a>
  </nav>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

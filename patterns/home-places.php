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
	array(
		'title'   => __( 'Sierra Madre', 'sierra-madre' ),
		'excerpt' => __( 'A range facing the Pacific. The spine of the eastern islands, and the reason this journal has a name.', 'sierra-madre' ),
		'url'     => '#',
		'image'   => "$assets/images/place-01.jpg",
		'coord'   => '14.6723° N',
	),
	array(
		'title'   => __( 'Aurora', 'sierra-madre' ),
		'excerpt' => __( 'Where the road meets the sea', 'sierra-madre' ),
		'url'     => '#',
		'image'   => "$assets/images/coast-01.jpg",
		'coord'   => '15.7600° N',
	),
	array(
		'title'   => __( 'Benguet', 'sierra-madre' ),
		'excerpt' => __( 'Mornings above the clouds', 'sierra-madre' ),
		'url'     => '#',
		'image'   => "$assets/images/fieldnote-01.jpg",
		'coord'   => '16.4023° N',
	),
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
    <div><p class="v2-label"><?php esc_html_e( 'Places', 'sierra-madre' ); ?></p><h2 id="places-title"><?php esc_html_e( 'A place to begin.', 'sierra-madre' ); ?></h2></div>
    <p><?php esc_html_e( 'Not a checklist. A few places that stay with you.', 'sierra-madre' ); ?></p>
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
    <span class="v2-label"><?php esc_html_e( 'Keep exploring', 'sierra-madre' ); ?></span>
    <?php if ( $index_links ) : ?>
      <?php foreach ( $index_links as $link ) : ?>
      <a href="<?php echo esc_url( get_permalink( $link ) ); ?>"><?php echo esc_html( get_the_title( $link ) ); ?> <span>↗</span></a>
      <?php endforeach; ?>
    <?php else : ?>
      <a href="<?php echo esc_url( $archive ); ?>"><?php esc_html_e( 'Ifugao', 'sierra-madre' ); ?> <span>↗</span></a>
      <a href="<?php echo esc_url( $archive ); ?>"><?php esc_html_e( 'Quezon', 'sierra-madre' ); ?> <span>↗</span></a>
      <a href="<?php echo esc_url( $archive ); ?>"><?php esc_html_e( 'Cagayan', 'sierra-madre' ); ?> <span>↗</span></a>
    <?php endif; ?>
    <a class="v2-index-all" href="<?php echo esc_url( $archive ); ?>"><?php esc_html_e( 'The place index', 'sierra-madre' ); ?> <span>↗</span></a>
  </nav>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

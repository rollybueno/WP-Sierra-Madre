<?php
/**
 * Title: Homepage dispatches
 * Slug: sierra-madre/home-dispatches
 * Categories: sierra-madre
 * Inserter: no
 */
$assets = esc_url( get_theme_file_uri( 'assets' ) );
$cards = array(
	sierra_madre_pick_post(
		'people',
		array(
			'title'   => __( 'The people who know the mountains', 'sierra-madre' ),
			'excerpt' => __( 'A morning with Mara Villanueva, and thirty years of listening to the ridgelines.', 'sierra-madre' ),
			'url'     => '#',
			'image'   => "$assets/images/portrait-01.jpg",
			'meta'    => __( 'People / Conversations', 'sierra-madre' ),
			'minutes' => 9,
			'cta'     => __( 'Meet Mara', 'sierra-madre' ),
		)
	),
	sierra_madre_pick_post(
		'culture',
		array(
			'title'   => __( 'At the table', 'sierra-madre' ),
			'excerpt' => __( 'Mountain rice, sharp coffee, and the stories that begin with a shared breakfast.', 'sierra-madre' ),
			'url'     => '#',
			'image'   => "$assets/images/food-01.jpg",
			'meta'    => __( 'Culture / La Trinidad', 'sierra-madre' ),
			'minutes' => 6,
			'cta'     => __( 'Take a seat', 'sierra-madre' ),
		)
	),
	sierra_madre_pick_post(
		'movement',
		array(
			'title'   => __( 'In transit', 'sierra-madre' ),
			'excerpt' => __( '142 kilometres, seven hours, and everything that happens between departure and arrival.', 'sierra-madre' ),
			'url'     => '#',
			'image'   => "$assets/images/transit-01.jpg",
			'meta'    => __( 'Movement / Benguet → Ifugao', 'sierra-madre' ),
			'minutes' => 7,
			'cta'     => __( 'Follow the route', 'sierra-madre' ),
		)
	),
);
$ctas = array(
	__( 'Meet Mara', 'sierra-madre' ),
	__( 'Take a seat', 'sierra-madre' ),
	__( 'Follow the route', 'sierra-madre' ),
);
$archive = get_post_type_archive_link( 'post' ) ?: home_url( '/' );
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"people","className":"v2-dispatches","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull v2-dispatches" id="people"><!-- wp:html -->
<div class="v2-wrap">
  <header class="v2-section-head">
    <div><p class="v2-label"><?php esc_html_e( 'Along the way', 'sierra-madre' ); ?></p><h2 id="dispatches-title"><?php esc_html_e( 'More than a landscape.', 'sierra-madre' ); ?></h2></div>
    <a class="v2-text-link" href="<?php echo esc_url( $archive ); ?>"><?php esc_html_e( 'Explore the journal', 'sierra-madre' ); ?> <span aria-hidden="true">↗</span></a>
  </header>
  <div class="v2-story-grid">
    <?php foreach ( $cards as $i => $card ) : ?>
    <article class="v2-story-card">
      <a class="v2-card-image" href="<?php echo esc_url( $card['url'] ); ?>"><img src="<?php echo esc_url( $card['image'] ); ?>" width="960" height="640" alt="" loading="lazy"></a>
      <div class="v2-story-meta"><span><?php echo esc_html( $card['meta'] ?: '' ); ?></span><span><?php echo esc_html( sprintf( /* translators: %s: minutes */ __( '%s min', 'sierra-madre' ), (string) ( $card['minutes'] ?? '' ) ) ); ?></span></div>
      <h3><a href="<?php echo esc_url( $card['url'] ); ?>"><?php echo sierra_madre_accent_title( $card['title'] ); ?></a></h3>
      <p><?php echo esc_html( $card['excerpt'] ); ?></p>
      <a class="v2-text-link" href="<?php echo esc_url( $card['url'] ); ?>"><?php echo esc_html( $card['cta'] ?? $ctas[ $i ] ); ?> <span aria-hidden="true">↗</span></a>
    </article>
    <?php endforeach; ?>
  </div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

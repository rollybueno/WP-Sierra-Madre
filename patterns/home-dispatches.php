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
			'title'   => 'The people who know the mountains',
			'excerpt' => 'A morning with Mara Villanueva, and thirty years of listening to the ridgelines.',
			'url'     => '#',
			'image'   => "$assets/images/portrait-01.jpg",
			'meta'    => 'People / Conversations',
			'minutes' => 9,
			'cta'     => 'Meet Mara',
		)
	),
	sierra_madre_pick_post(
		'culture',
		array(
			'title'   => 'At the table',
			'excerpt' => 'Mountain rice, sharp coffee, and the stories that begin with a shared breakfast.',
			'url'     => '#',
			'image'   => "$assets/images/food-01.jpg",
			'meta'    => 'Culture / La Trinidad',
			'minutes' => 6,
			'cta'     => 'Take a seat',
		)
	),
	sierra_madre_pick_post(
		'movement',
		array(
			'title'   => 'In transit',
			'excerpt' => '142 kilometres, seven hours, and everything that happens between departure and arrival.',
			'url'     => '#',
			'image'   => "$assets/images/transit-01.jpg",
			'meta'    => 'Movement / Benguet → Ifugao',
			'minutes' => 7,
			'cta'     => 'Follow the route',
		)
	),
);
$ctas = array( 'Meet Mara', 'Take a seat', 'Follow the route' );
$archive = get_post_type_archive_link( 'post' ) ?: home_url( '/' );
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"people","className":"v2-dispatches","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull v2-dispatches" id="people"><!-- wp:html -->
<div class="v2-wrap">
  <header class="v2-section-head">
    <div><p class="v2-label">Along the way</p><h2 id="dispatches-title">More than a landscape.</h2></div>
    <a class="v2-text-link" href="<?php echo esc_url( $archive ); ?>">Explore the journal <span aria-hidden="true">↗</span></a>
  </header>
  <div class="v2-story-grid">
    <?php foreach ( $cards as $i => $card ) : ?>
    <article class="v2-story-card">
      <a class="v2-card-image" href="<?php echo esc_url( $card['url'] ); ?>"><img src="<?php echo esc_url( $card['image'] ); ?>" width="960" height="640" alt="" loading="lazy"></a>
      <div class="v2-story-meta"><span><?php echo esc_html( $card['meta'] ?: '' ); ?></span><span><?php echo esc_html( (string) ( $card['minutes'] ?? '' ) ); ?> min</span></div>
      <h3><a href="<?php echo esc_url( $card['url'] ); ?>"><?php echo sierra_madre_accent_title( $card['title'] ); ?></a></h3>
      <p><?php echo esc_html( $card['excerpt'] ); ?></p>
      <a class="v2-text-link" href="<?php echo esc_url( $card['url'] ); ?>"><?php echo esc_html( $card['cta'] ?? $ctas[ $i ] ); ?> <span aria-hidden="true">↗</span></a>
    </article>
    <?php endforeach; ?>
  </div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

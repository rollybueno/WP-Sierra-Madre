<?php
/**
 * Title: Homepage journal
 * Slug: sierra-madre/home-journal
 * Categories: sierra-madre
 * Inserter: no
 */
$assets = esc_url( get_theme_file_uri( 'assets' ) );
$journey = sierra_madre_pick_post(
	'journeys',
	array(
		'title'   => __( 'The long road north', 'sierra-madre' ),
		'excerpt' => __( 'Three days through rain, mountain roads and towns that disappear into cloud before noon.', 'sierra-madre' ),
		'url'     => '#',
		'image'   => "$assets/images/journey-01.jpg",
		'meta'    => __( 'Journey / Cordillera', 'sierra-madre' ),
		'minutes' => 12,
	)
);
$notes = get_posts(
	array(
		'category_name' => 'field-notes',
		'numberposts'   => 2,
		'post_status'   => 'publish',
	)
);
$archive = get_post_type_archive_link( 'post' ) ?: home_url( '/' );
$fallbacks = array(
	array(
		'title'   => __( 'Before the rain', 'sierra-madre' ),
		'excerpt' => __( 'The hour when everything holds still.', 'sierra-madre' ),
		'url'     => '#',
		'image'   => "$assets/images/fieldnote-01.jpg",
		'label'   => __( '021 / Luzon', 'sierra-madre' ),
		'minutes' => 6,
	),
	array(
		'title'   => __( 'The road to the coast', 'sierra-madre' ),
		'excerpt' => __( 'Following the river until it finds the sea.', 'sierra-madre' ),
		'url'     => '#',
		'image'   => "$assets/images/coast-01.jpg",
		'label'   => __( '020 / Aurora', 'sierra-madre' ),
		'minutes' => 8,
	),
);
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"journeys","className":"v2-journal","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull v2-journal" id="journeys"><!-- wp:html -->
<div class="v2-wrap">
  <header class="v2-section-head">
    <div><p class="v2-label"><?php esc_html_e( 'The latest', 'sierra-madre' ); ?></p><h2 id="journal-title"><?php esc_html_e( 'From the field', 'sierra-madre' ); ?></h2></div>
    <a class="v2-text-link" href="<?php echo esc_url( $archive ); ?>"><?php esc_html_e( 'All stories', 'sierra-madre' ); ?> <span aria-hidden="true">↗</span></a>
  </header>
  <div class="v2-journal-grid">
    <article class="v2-lead">
      <a class="v2-image-link" href="<?php echo esc_url( $journey['url'] ); ?>">
        <img src="<?php echo esc_url( $journey['image'] ); ?>" width="960" height="640" alt="" loading="lazy">
        <span class="v2-image-tag"><?php esc_html_e( "Editor's pick", 'sierra-madre' ); ?></span>
      </a>
      <div class="v2-story-meta"><span><?php echo esc_html( $journey['meta'] ?: __( 'Journey', 'sierra-madre' ) ); ?></span><span><?php echo esc_html( sprintf( /* translators: %s: minutes */ __( '%s min read', 'sierra-madre' ), (string) ( $journey['minutes'] ?? 12 ) ) ); ?></span></div>
      <h3><a href="<?php echo esc_url( $journey['url'] ); ?>"><?php echo sierra_madre_accent_title( $journey['title'] ); ?></a></h3>
      <p><?php echo esc_html( $journey['excerpt'] ); ?></p>
      <div class="v2-route"><span><b>46</b> <?php esc_html_e( 'km on the road', 'sierra-madre' ); ?></span><span><b>1,480</b> <?php esc_html_e( 'm above sea level', 'sierra-madre' ); ?></span><span><b>03</b> <?php esc_html_e( 'days in the rain', 'sierra-madre' ); ?></span></div>
      <a class="v2-text-link v2-lead-cta" href="<?php echo esc_url( $journey['url'] ); ?>"><?php esc_html_e( 'Read the journey', 'sierra-madre' ); ?> <span aria-hidden="true">↗</span></a>
    </article>
    <aside class="v2-notes" id="notes" aria-labelledby="notes-title">
      <header><h3 id="notes-title"><?php esc_html_e( 'Recent notes', 'sierra-madre' ); ?></h3><span class="v2-label"><?php esc_html_e( 'Wet season / 2026', 'sierra-madre' ); ?></span></header>
      <ol>
        <?php
        for ( $i = 0; $i < 2; $i++ ) :
        	$note = $notes[ $i ] ?? null;
        	if ( $note ) {
        		$item = array(
        			'title'   => get_the_title( $note ),
        			'excerpt' => get_the_excerpt( $note ),
        			'url'     => get_permalink( $note ),
        			'image'   => get_the_post_thumbnail_url( $note, 'medium_large' ) ?: $fallbacks[ $i ]['image'],
        			'label'   => sprintf( '%03d', (int) $note->ID % 1000 ),
        			'minutes' => max( 1, (int) ceil( str_word_count( wp_strip_all_tags( $note->post_content ) ) / 220 ) ),
        		);
        	} else {
        		$item = $fallbacks[ $i ];
        	}
        	?>
        <li>
          <a href="<?php echo esc_url( $item['url'] ); ?>">
            <img src="<?php echo esc_url( $item['image'] ); ?>" width="960" height="640" alt="" loading="lazy">
            <div>
              <span class="v2-label"><?php echo esc_html( $item['label'] ); ?></span>
              <h4><?php echo esc_html( $item['title'] ); ?></h4>
              <p><?php echo esc_html( $item['excerpt'] ); ?></p>
              <span class="v2-note-time"><?php echo esc_html( sprintf( /* translators: %s: minutes */ __( '%s min read', 'sierra-madre' ), (string) $item['minutes'] ) ); ?></span>
            </div>
          </a>
        </li>
        <?php endfor; ?>
      </ol>
    </aside>
  </div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

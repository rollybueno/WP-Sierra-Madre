<?php
/**
 * Title: Homepage editorial sections
 * Slug: sierra-madre/home-body
 * Categories: sierra-madre
 * Inserter: no
 */
$assets = esc_url( get_theme_file_uri( 'assets' ) );
$sm_pick = static function ( $category, $fallback ) {
	$posts = get_posts( array(
		'category_name' => $category,
		'numberposts' => 1,
		'post_status' => 'publish',
		'ignore_sticky_posts' => false,
	) );
	$post = $posts[0] ?? null;
	if ( ! $post ) return $fallback;
	$image = get_the_post_thumbnail_url( $post, 'full' );
	return array(
		'title' => get_the_title( $post ),
		'excerpt' => get_the_excerpt( $post ),
		'url' => get_permalink( $post ),
		'image' => $image ?: $fallback['image'],
	);
};
$journey = $sm_pick( 'journeys', array( 'title' => 'The long road north', 'excerpt' => 'Three days through rain, mountain roads and towns that disappear into cloud before noon.', 'url' => '#', 'image' => "$assets/images/journey-01.jpg" ) );
$place = $sm_pick( 'places', array( 'title' => 'Sierra Madre', 'excerpt' => 'A range facing the Pacific.', 'url' => '#place-index', 'image' => "$assets/images/place-01.jpg" ) );
$photo = $sm_pick( 'photography', array( 'title' => 'Weather, passing.', 'excerpt' => 'A photographic sequence from the eastern face of the range.', 'url' => '#', 'image' => "$assets/images/photoessay-01.jpg" ) );
$person = $sm_pick( 'people', array( 'title' => 'The people who know the mountains', 'excerpt' => 'A morning with Mara Villanueva.', 'url' => '#', 'image' => "$assets/images/portrait-01.jpg" ) );
$transit = $sm_pick( 'movement', array( 'title' => 'In transit', 'excerpt' => 'Benguet to Ifugao.', 'url' => '#', 'image' => "$assets/images/transit-01.jpg" ) );
$culture = $sm_pick( 'culture', array( 'title' => 'At the table', 'excerpt' => 'A breakfast assembled slowly from the landscape.', 'url' => '#', 'image' => "$assets/images/food-01.jpg" ) );
$issue = $sm_pick( 'issues', array( 'title' => 'Field Journal 01', 'excerpt' => 'Stories and photographs from journeys across the islands.', 'url' => '#', 'image' => "$assets/images/issue-01.jpg" ) );
$places = get_posts( array( 'category_name' => 'places', 'numberposts' => 5, 'post_status' => 'publish' ) );
?>
<!-- wp:html -->
    <section class="intro wrap" id="intro" aria-labelledby="intro-title">
      <span class="vertical-label">OPENING NOTES / 001</span>
      <h2 id="intro-title">The mountains<br>begin before<br><em>the trail.</em></h2>
      <div class="intro-copy"><span class="eyebrow">A journal of elsewhere</span><p>We follow roads until they become footpaths, and footpaths until they become stories. Sierra Madre documents the quiet geography of moving through a place.</p></div>
      <figure><img src="<?php echo $assets; ?>/images/intro-portrait.jpg" width="474" height="538" alt="A traveler pausing beside a quiet rural road"><figcaption>On the road to Kabayan, 06:43</figcaption></figure>
    </section>

    <article class="featured wrap" id="journeys">
      <div class="section-kicker"><span>01 / JOURNEY</span><span>READING TIME / 12 MIN</span></div>
      <figure class="featured-image reveal"><img src="<?php echo esc_url( $journey['image'] ); ?>" width="474" height="474" alt=""></figure>
      <div class="featured-copy">
        <p class="coordinates">CORDILLERA ADMINISTRATIVE REGION<br>17.0832° N / 120.8995° E</p>
        <h2><?php echo esc_html( $journey['title'] ); ?></h2>
        <p class="deck"><?php echo esc_html( $journey['excerpt'] ); ?></p>
        <a class="arrow-link" href="<?php echo esc_url( $journey['url'] ); ?>">Read the journey <span>↗</span></a>
      </div>
    </article>

<!-- /wp:html -->
<!-- wp:group {"tagName":"section","anchor":"notes","className":"field-notes","layout":{"type":"default"}} -->
<section class="wp-block-group field-notes" id="notes"><div class="wrap"><!-- wp:html --><header class="notes-header"><span>RECENT ENTRIES / WET SEASON</span><h2 id="notes-title">Field <em>notes</em></h2></header><div class="notes-layout"><div class="notes-images" aria-hidden="true"><img src="<?php echo $assets; ?>/images/fieldnote-01.jpg" width="474" height="355" alt=""><img src="<?php echo $assets; ?>/images/fieldnote-02.jpg" width="474" height="248" alt=""></div><!-- /wp:html --><!-- wp:query {"queryId":21,"namespace":"sierra-madre/field-notes","query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"className":"note-list"} --><!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} --><div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true} /--><!-- wp:post-date /--><!-- wp:post-terms {"term":"category"} /--><!-- wp:paragraph --><p>↗</p><!-- /wp:paragraph --></div><!-- /wp:group --><!-- /wp:post-template --></div><!-- /wp:query --><!-- wp:html --></div><!-- /wp:html --></div></section>
<!-- /wp:group -->
<!-- wp:html -->

    <section class="place-feature" id="places" aria-labelledby="place-title">
      <div class="place-image reveal"><img src="<?php echo esc_url( $place['image'] ); ?>" width="474" height="266" alt=""></div>
      <div class="place-number">02 / PLACES</div>
      <div class="place-copy">
        <span class="eyebrow">A RANGE FACING THE PACIFIC</span><h2 id="place-title"><?php echo esc_html( $place['title'] ); ?></h2>
        <dl><div><dt>Coordinates</dt><dd>14.6723° N<br>121.3851° E</dd></div><div><dt>Conditions</dt><dd>Rain / 22°C<br>Elevation 1,240 m</dd></div></dl>
        <a class="arrow-link" href="<?php echo esc_url( $place['url'] ); ?>">Explore the place <span>↗</span></a>
      </div>
    </section>

    <section class="photo-essay" id="photography" aria-labelledby="essay-title">
      <header class="wrap"><span>03 / PHOTOGRAPHY</span><h2 id="essay-title"><?php echo esc_html( $photo['title'] ); ?></h2><p><?php echo esc_html( $photo['excerpt'] ); ?></p></header>
      <figure class="essay-wide reveal"><a href="<?php echo esc_url( $photo['url'] ); ?>"><img src="<?php echo esc_url( $photo['image'] ); ?>" width="474" height="266" alt=""></a><figcaption>01 / THE ROAD — 05:58</figcaption></figure>
      <div class="essay-pair wrap"><figure><img src="<?php echo $assets; ?>/images/photoessay-02.jpg" width="474" height="335" alt="Highland slopes under moving cloud"><figcaption>02 / THE RIDGE</figcaption></figure><figure><img src="<?php echo $assets; ?>/images/photoessay-03.jpg" width="474" height="316" alt="Forest and river after rainfall"><figcaption>03 / AFTER THE RAIN</figcaption></figure></div>
    </section>

    <section class="field-log wrap" aria-labelledby="log-title">
      <div><span>OBSERVATION / 021</span><h2 id="log-title">Field log</h2></div>
      <dl><div><dt>Distance</dt><dd>46 <small>KM</small></dd></div><div><dt>Elevation</dt><dd>1,480 <small>M</small></dd></div><div><dt>Days</dt><dd>03</dd></div><div><dt>Weather</dt><dd>Rain / Mist</dd></div><div><dt>Region</dt><dd>Luzon</dd></div><div><dt>Season</dt><dd>Wet</dd></div></dl>
    </section>

    <article class="people" id="people">
      <div class="people-image"><img src="<?php echo esc_url( $person['image'] ); ?>" width="474" height="474" alt=""></div>
      <div class="people-copy"><span>04 / PEOPLE / CONVERSATIONS</span><h2><?php echo esc_html( $person['title'] ); ?></h2><blockquote>“You learn the weather by listening to what becomes quiet.”</blockquote><p><?php echo esc_html( $person['excerpt'] ); ?></p><a class="arrow-link" href="<?php echo esc_url( $person['url'] ); ?>">Read the conversation <span>↗</span></a></div>
    </article>

    <section class="transit" aria-labelledby="transit-title">
      <img src="<?php echo esc_url( $transit['image'] ); ?>" width="474" height="711" alt="">
      <div><span>05 / MOVEMENT</span><h2 id="transit-title"><?php echo esc_html( $transit['title'] ); ?></h2><p><?php echo esc_html( $transit['excerpt'] ); ?></p><a class="arrow-link" href="<?php echo esc_url( $transit['url'] ); ?>">Read the story <span>↗</span></a></div>
    </section>

    <article class="table-story wrap">
      <header><span>06 / CULTURE</span><h2><?php echo esc_html( $culture['title'] ); ?></h2></header>
      <figure><img src="<?php echo esc_url( $culture['image'] ); ?>" width="474" height="266" alt=""><figcaption>Market day / La Trinidad</figcaption></figure>
      <div><p class="lead"><?php echo esc_html( $culture['excerpt'] ); ?></p><p>At every stop, a table becomes a map. Ingredients trace rivers, seasons, family gardens and the distance between one town and the next.</p><a class="arrow-link" href="<?php echo esc_url( $culture['url'] ); ?>">Read at the table <span>↗</span></a></div>
    </article>

    <section class="place-index wrap" id="place-index" aria-labelledby="index-title">
      <header><span>INDEX / 06°–19° N</span><h2 id="index-title">Places</h2></header>
      <div class="index-layout">
        <ol data-place-list>
          <?php foreach ( $places as $index => $place_post ) : $place_image = get_the_post_thumbnail_url( $place_post, 'large' ) ?: "$assets/images/place-01.jpg"; ?>
          <li><a href="<?php echo esc_url( get_permalink( $place_post ) ); ?>" data-image="<?php echo esc_url( $place_image ); ?>"><small><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></small><strong><?php echo esc_html( get_the_title( $place_post ) ); ?></strong><span><?php echo esc_html( get_the_excerpt( $place_post ) ); ?></span></a></li>
          <?php endforeach; ?>
        </ol>
        <figure class="index-preview"><img src="<?php echo $assets; ?>/images/coast-01.jpg" width="474" height="316" alt="Preview of the selected place" data-place-image><figcaption>Move through the archive ↗</figcaption></figure>
      </div>
    </section>

    <article class="issue wrap">
      <div class="issue-cover"><img src="<?php echo esc_url( $issue['image'] ); ?>" width="474" height="266" alt=""><div><b>Sierra Madre</b><span>CURRENT FIELD JOURNAL</span><em><?php echo esc_html( $issue['title'] ); ?></em></div></div>
      <div class="issue-copy"><span>AN ONGOING JOURNAL / 2026</span><h2><?php echo esc_html( $issue['title'] ); ?></h2><p><?php echo esc_html( $issue['excerpt'] ); ?></p><a class="arrow-link" href="<?php echo esc_url( $issue['url'] ); ?>">Explore the issue <span>↗</span></a></div>
    </article>

    <section class="newsletter wrap" id="field-letters" aria-labelledby="letters-title">
      <div><span>FIELD LETTERS / OCCASIONAL</span><h2 id="letters-title">Notes from<br><em>the road.</em></h2></div>
      <form action="#"><label for="email">Occasional stories, photographs and notes. No noise.</label><div><input id="email" type="email" autocomplete="email" placeholder="Email address" required><button type="submit">Join ↗</button></div></form>
    </section>
<!-- /wp:html -->

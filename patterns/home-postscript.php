<?php
/**
 * Title: Homepage postscript
 * Slug: sierra-madre/home-postscript
 * Categories: sierra-madre
 * Inserter: no
 */
$assets = esc_url( get_theme_file_uri( 'assets' ) );
$issue = sierra_madre_pick_post(
	'issues',
	array(
		'title'   => 'Field Journal 01',
		'excerpt' => 'Stories and photographs from across the islands.',
		'url'     => '#',
		'image'   => "$assets/images/issue-01.jpg",
	)
);
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"field-letters","className":"v2-postscript","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull v2-postscript" id="field-letters"><!-- wp:html -->
<div class="v2-wrap v2-postscript-grid">
  <article class="v2-issue">
    <a class="v2-issue-cover" href="<?php echo esc_url( $issue['url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Explore %s', 'sierra-madre' ), $issue['title'] ) ); ?>">
      <img src="<?php echo esc_url( $issue['image'] ); ?>" width="960" height="640" alt="" loading="lazy">
      <div><b>Sierra<br>Madre</b><span><?php echo esc_html( $issue['title'] ); ?></span><small>Roads / Ridges / Rain</small></div>
    </a>
    <div>
      <p class="v2-label">The current issue</p>
      <h2><?php echo sierra_madre_accent_title( $issue['title'] ); ?></h2>
      <p><?php echo esc_html( $issue['excerpt'] ); ?></p>
      <a class="v2-text-link" href="<?php echo esc_url( $issue['url'] ); ?>">Explore the issue <span aria-hidden="true">↗</span></a>
    </div>
  </article>
  <div class="v2-letters">
    <p class="v2-label">Field letters / Occasional</p>
    <h2>A little further<br><em>from your feed.</em></h2>
    <form action="#field-letters" data-letters-form>
      <label for="v2-email">Stories, photographs and notes from the road. No noise.</label>
      <div>
        <input id="v2-email" name="email" type="email" autocomplete="email" placeholder="<?php esc_attr_e( 'Your email address', 'sierra-madre' ); ?>" required>
        <button type="submit">Join <span aria-hidden="true">↗</span></button>
      </div>
      <p class="v2-form-status" data-letters-status role="status" aria-live="polite" hidden></p>
    </form>
  </div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

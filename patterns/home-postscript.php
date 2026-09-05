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
		'title'   => __( 'Field Journal 01', 'sierra-madre' ),
		'excerpt' => __( 'Stories and photographs from across the islands.', 'sierra-madre' ),
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
      <div><b><?php
        $site_name = get_bloginfo( 'name', 'display' );
        $parts = preg_split( '/\s+/u', trim( $site_name ), 2 );
        echo esc_html( $parts[0] ?? $site_name );
        if ( ! empty( $parts[1] ) ) {
        	echo '<br>' . esc_html( $parts[1] );
        }
      ?></b><span><?php echo esc_html( $issue['title'] ); ?></span><small><?php esc_html_e( 'Roads / Ridges / Rain', 'sierra-madre' ); ?></small></div>
    </a>
    <div>
      <p class="v2-label"><?php esc_html_e( 'The current issue', 'sierra-madre' ); ?></p>
      <h2><?php echo sierra_madre_accent_title( $issue['title'] ); ?></h2>
      <p><?php echo esc_html( $issue['excerpt'] ); ?></p>
      <a class="v2-text-link" href="<?php echo esc_url( $issue['url'] ); ?>"><?php esc_html_e( 'Explore the issue', 'sierra-madre' ); ?> <span aria-hidden="true">↗</span></a>
    </div>
  </article>
  <div class="v2-letters">
    <p class="v2-label"><?php esc_html_e( 'Field letters / Occasional', 'sierra-madre' ); ?></p>
    <h2><?php esc_html_e( 'A little further', 'sierra-madre' ); ?><br><em><?php esc_html_e( 'from your feed.', 'sierra-madre' ); ?></em></h2>
    <form action="#field-letters" data-letters-form>
      <label for="v2-email"><?php esc_html_e( 'Stories, photographs and notes from the road. No noise.', 'sierra-madre' ); ?></label>
      <div>
        <input id="v2-email" name="email" type="email" autocomplete="email" placeholder="<?php esc_attr_e( 'Your email address', 'sierra-madre' ); ?>" required>
        <button type="submit"><?php esc_html_e( 'Join', 'sierra-madre' ); ?> <span aria-hidden="true">↗</span></button>
      </div>
      <p class="v2-form-status" data-letters-status role="status" aria-live="polite" hidden></p>
    </form>
  </div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

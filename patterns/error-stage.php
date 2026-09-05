<?php
/**
 * Title: 404 error stage
 * Slug: sierra-madre/error-stage
 * Categories: sierra-madre
 * Inserter: no
 */
$image = get_theme_file_uri( 'assets/images/fieldnote-01.jpg' );
?>
<!-- wp:html -->
<main class="error-stage" id="content">
  <img src="<?php echo esc_url( $image ); ?>" width="960" height="721" alt="<?php esc_attr_e( 'Mountain ridges disappearing into dense cloud', 'sierra-madre' ); ?>">
  <div class="error-shade" aria-hidden="true"></div>
  <div class="error-code">404 / OFF THE MAP</div>
  <div class="error-message">
    <h1><?php esc_html_e( 'The trail', 'sierra-madre' ); ?><br><em><?php esc_html_e( 'ends here.', 'sierra-madre' ); ?></em></h1>
    <p><?php esc_html_e( 'The page may have moved, or the road was never marked.', 'sierra-madre' ); ?></p>
    <a class="arrow-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return to the journal', 'sierra-madre' ); ?> <span>↗</span></a>
  </div>
  <div class="error-coord">16.4023° N / 120.5960° E<br>SIGNAL / NONE</div>
</main>
<!-- /wp:html -->

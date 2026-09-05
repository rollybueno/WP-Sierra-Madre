<?php
/**
 * Title: Homepage opening
 * Slug: sierra-madre/home-opening
 * Categories: sierra-madre
 * Inserter: no
 */
$about = get_page_by_path( 'about' );
$about_url = $about ? get_permalink( $about ) : home_url( '/about/' );
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"intro","className":"v2-opening","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull v2-opening" id="intro"><!-- wp:html -->
<div class="v2-wrap v2-opening-inner">
  <div>
    <p class="v2-label">An independent field journal</p>
    <h2 id="opening-title">Go further.<br><em>Look closer.</em></h2>
  </div>
  <div class="v2-opening-aside">
    <p class="v2-opening-copy">Roads, ridges, people and the places in between. Stories for those who take the long way home.</p>
    <a class="v2-text-link" href="<?php echo esc_url( $about_url ); ?>">About the journal <span aria-hidden="true">↗</span></a>
  </div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

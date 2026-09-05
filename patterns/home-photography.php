<?php
/**
 * Title: Homepage photography
 * Slug: sierra-madre/home-photography
 * Categories: sierra-madre
 * Inserter: no
 */
$assets = esc_url( get_theme_file_uri( 'assets' ) );
$photo = sierra_madre_pick_post(
	'photography',
	array(
		'title'   => 'Weather, passing.',
		'excerpt' => 'Light moves. The mountains stay. Three frames from the eastern range.',
		'url'     => '#',
		'image'   => "$assets/images/photoessay-01.jpg",
	)
);
$gallery = array(
	array( 'image' => $photo['image'], 'caption' => '01 / The road', 'time' => '05:58' ),
	array( 'image' => "$assets/images/photoessay-02.jpg", 'caption' => '02 / The ridge', 'time' => '07:16' ),
	array( 'image' => "$assets/images/photoessay-03.jpg", 'caption' => '03 / After the rain', 'time' => '09:42' ),
);
if ( ! empty( $photo['id'] ) ) {
	$attached = get_attached_media( 'image', $photo['id'] );
	$i = 0;
	foreach ( $attached as $media ) {
		if ( $i >= 3 ) {
			break;
		}
		$url = wp_get_attachment_image_url( $media->ID, 'large' );
		if ( $url ) {
			$gallery[ $i ]['image'] = $url;
		}
		++$i;
	}
}
?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"photography","className":"v2-photography","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull v2-photography" id="photography"><!-- wp:html -->
<div class="v2-wrap">
  <header class="v2-section-head">
    <div><p class="v2-label">A photo essay</p><h2 id="photography-title"><?php echo sierra_madre_accent_title( $photo['title'] ); ?></h2></div>
    <div class="v2-photo-intro">
      <p><?php echo esc_html( $photo['excerpt'] ); ?></p>
      <a class="v2-text-link" href="<?php echo esc_url( $photo['url'] ); ?>">View the essay <span aria-hidden="true">↗</span></a>
    </div>
  </header>
</div>
<a class="v2-photo-sequence" href="<?php echo esc_url( $photo['url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View %s — the photo essay', 'sierra-madre' ), $photo['title'] ) ); ?>">
  <?php foreach ( $gallery as $frame ) : ?>
  <figure>
    <img src="<?php echo esc_url( $frame['image'] ); ?>" width="960" height="640" alt="" loading="lazy">
    <figcaption><span><?php echo esc_html( $frame['caption'] ); ?></span><span><?php echo esc_html( $frame['time'] ); ?></span></figcaption>
  </figure>
  <?php endforeach; ?>
</a>
<div class="v2-wrap">
  <div class="v2-photo-footer"><span>Field sequence 003 / Eastern Luzon</span><span>Photographs by Leon Rivera</span></div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

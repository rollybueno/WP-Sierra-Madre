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
		'title'   => __( 'Weather, passing.', 'sierra-madre' ),
		'excerpt' => __( 'Light moves. The mountains stay. Three frames from the eastern range.', 'sierra-madre' ),
		'url'     => '#',
		'image'   => "$assets/images/photoessay-01.jpg",
	)
);
$gallery = array(
	array( 'image' => $photo['image'], 'caption' => __( '01 / The road', 'sierra-madre' ), 'time' => '05:58' ),
	array( 'image' => "$assets/images/photoessay-02.jpg", 'caption' => __( '02 / The ridge', 'sierra-madre' ), 'time' => '07:16' ),
	array( 'image' => "$assets/images/photoessay-03.jpg", 'caption' => __( '03 / After the rain', 'sierra-madre' ), 'time' => '09:42' ),
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
    <div><p class="v2-label"><?php esc_html_e( 'A photo essay', 'sierra-madre' ); ?></p><h2 id="photography-title"><?php echo sierra_madre_accent_title( $photo['title'] ); ?></h2></div>
    <div class="v2-photo-intro">
      <p><?php echo esc_html( $photo['excerpt'] ); ?></p>
      <a class="v2-text-link" href="<?php echo esc_url( $photo['url'] ); ?>"><?php esc_html_e( 'View the essay', 'sierra-madre' ); ?> <span aria-hidden="true">↗</span></a>
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
  <div class="v2-photo-footer"><span><?php esc_html_e( 'Field sequence 003 / Eastern Luzon', 'sierra-madre' ); ?></span><span><?php esc_html_e( 'Photographs by Leon Rivera', 'sierra-madre' ); ?></span></div>
</div>
<!-- /wp:html --></section>
<!-- /wp:group -->

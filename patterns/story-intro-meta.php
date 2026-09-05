<?php
/**
 * Title: Story field metadata
 * Slug: sierra-madre/story-intro-meta
 * Categories: sierra-madre
 * Inserter: no
 */
$post_id = get_the_ID();
$location = get_post_meta( $post_id, 'sm_location', true );
$coordinates = get_post_meta( $post_id, 'sm_coordinates', true );
$conditions = get_post_meta( $post_id, 'sm_conditions', true );

if ( ! $location ) {
	$location = __( 'Cordillera, Luzon', 'sierra-madre' );
}
if ( ! $coordinates ) {
	$coordinates = "17.0832° N\n120.8995° E";
}
if ( ! $conditions ) {
	$conditions = __( 'Rain / 18°C', 'sierra-madre' );
}
?>
<!-- wp:html -->
<dl class="story-field-meta">
  <div>
    <dt><?php esc_html_e( 'Location', 'sierra-madre' ); ?></dt>
    <dd><?php echo esc_html( $location ); ?></dd>
  </div>
  <div>
    <dt><?php esc_html_e( 'Coordinates', 'sierra-madre' ); ?></dt>
    <dd><?php echo nl2br( esc_html( $coordinates ) ); ?></dd>
  </div>
  <div>
    <dt><?php esc_html_e( 'Conditions', 'sierra-madre' ); ?></dt>
    <dd><?php echo esc_html( $conditions ); ?></dd>
  </div>
</dl>
<!-- /wp:html -->

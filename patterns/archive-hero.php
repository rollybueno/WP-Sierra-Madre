<?php
/**
 * Title: Archive hero
 * Slug: sierra-madre/archive-hero
 * Categories: sierra-madre
 * Inserter: no
 */
$year_span = '2024—2026';
$intro     = __( 'Stories from roads that climb, coastlines that disappear, and the people who read the weather.', 'sierra-madre' );

if ( is_category() ) {
	$title = single_cat_title( '', false );
	$desc  = category_description();
	$intro = $desc ? wp_strip_all_tags( $desc ) : $intro;
	$label = sprintf(
		/* translators: %s: year span */
		__( 'ARCHIVE / %s', 'sierra-madre' ),
		$year_span
	);
} elseif ( is_tag() ) {
	$title = single_tag_title( '', false );
	$desc  = tag_description();
	$intro = $desc ? wp_strip_all_tags( $desc ) : $intro;
	$label = sprintf( __( 'ARCHIVE / %s', 'sierra-madre' ), $year_span );
} elseif ( is_home() && ! is_front_page() ) {
	$posts_page = (int) get_option( 'page_for_posts' );
	$title      = $posts_page ? get_the_title( $posts_page ) : __( 'Journeys', 'sierra-madre' );
	$label      = sprintf( __( 'ARCHIVE / %s', 'sierra-madre' ), $year_span );
} else {
	$title = __( 'Journeys', 'sierra-madre' );
	$label = sprintf( __( 'ARCHIVE / %s', 'sierra-madre' ), $year_span );
}

$posts_page_id = (int) get_option( 'page_for_posts' );
$all_url       = $posts_page_id
	? get_permalink( $posts_page_id )
	: ( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) );

$filters = array(
	array(
		'label'  => __( 'All', 'sierra-madre' ),
		'url'    => $all_url,
		'active' => ( is_home() && ! is_front_page() ) || is_post_type_archive( 'post' ),
	),
);

foreach ( array(
	'field-notes'  => __( 'Field Notes', 'sierra-madre' ),
	'photography'  => __( 'Photography', 'sierra-madre' ),
	'people'       => __( 'People', 'sierra-madre' ),
	'culture'      => __( 'Culture', 'sierra-madre' ),
) as $slug => $label_text ) {
	$term = get_category_by_slug( $slug );
	if ( ! $term ) {
		continue;
	}
	$filters[] = array(
		'label'  => $label_text,
		'url'    => get_category_link( $term ),
		'active' => is_category( $slug ),
	);
}

/* When viewing a category archive, "All" is not active. */
if ( is_category() || is_tag() ) {
	$filters[0]['active'] = false;
}
?>
<!-- wp:html -->
<header class="archive-hero wrap">
  <div>
    <span><?php echo esc_html( $label ); ?></span>
    <p><?php echo esc_html( $intro ); ?></p>
  </div>
  <h1><?php echo esc_html( $title ); ?></h1>
  <nav aria-label="<?php esc_attr_e( 'Archive filters', 'sierra-madre' ); ?>">
    <?php foreach ( $filters as $filter ) : ?>
      <a class="<?php echo $filter['active'] ? 'is-active' : ''; ?>" href="<?php echo esc_url( $filter['url'] ); ?>"><?php echo esc_html( $filter['label'] ); ?></a>
    <?php endforeach; ?>
  </nav>
</header>
<!-- /wp:html -->

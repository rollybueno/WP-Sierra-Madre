<?php
/**
 * Title: Footer colophon
 * Slug: sierra-madre/footer-colophon
 * Categories: sierra-madre
 * Inserter: no
 */
$year = gmdate( 'Y' );
$name = get_bloginfo( 'name', 'display' );
?>
<!-- wp:html -->
<p class="footer-copy"><?php
echo esc_html(
	sprintf(
		/* translators: 1: current year, 2: site name */
		__( '© %1$s %2$s', 'sierra-madre' ),
		$year,
		$name
	)
);
?></p>
<!-- /wp:html -->

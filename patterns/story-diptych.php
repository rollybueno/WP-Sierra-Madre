<?php
/**
 * Title: Story image diptych
 * Slug: sierra-madre/story-diptych
 * Categories: sierra-madre
 */
$first = esc_url( get_theme_file_uri( 'assets/images/fieldnote-02.jpg' ) );
$second = esc_url( get_theme_file_uri( 'assets/images/photoessay-03.jpg' ) );
?>
<!-- wp:gallery {"linkTo":"none","align":"wide","className":"story-diptych wrap"} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-default is-cropped story-diptych wrap"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full"><img src="<?php echo $first; ?>" alt="<?php echo esc_attr__( 'A small boat on dark forest water', 'sierra-madre' ); ?>"/><figcaption class="wp-element-caption"><?php esc_html_e( '01 / STILL WATER', 'sierra-madre' ); ?></figcaption></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full"><img src="<?php echo $second; ?>" alt="<?php echo esc_attr__( 'A bridge through dense green forest', 'sierra-madre' ); ?>"/><figcaption class="wp-element-caption"><?php esc_html_e( '02 / AFTER THE RAIN', 'sierra-madre' ); ?></figcaption></figure><!-- /wp:image --></figure>
<!-- /wp:gallery -->

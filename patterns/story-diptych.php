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
<figure class="wp-block-gallery alignwide has-nested-images columns-default is-cropped story-diptych wrap"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full"><img src="<?php echo $first; ?>" alt="A small boat on dark forest water"/><figcaption class="wp-element-caption">01 / STILL WATER</figcaption></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full"><img src="<?php echo $second; ?>" alt="A bridge through dense green forest"/><figcaption class="wp-element-caption">02 / AFTER THE RAIN</figcaption></figure><!-- /wp:image --></figure>
<!-- /wp:gallery -->

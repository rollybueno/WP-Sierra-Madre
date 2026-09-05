<?php
/**
 * Title: Story byline
 * Slug: sierra-madre/story-byline
 * Categories: sierra-madre
 * Inserter: no
 */
$post_id   = get_the_ID();
$author_id = (int) get_post_field( 'post_author', $post_id );
$author    = $author_id ? get_the_author_meta( 'display_name', $author_id ) : '';
$tags      = get_the_tags( $post_id );
$photo     = ( $tags && ! is_wp_error( $tags ) ) ? $tags[0]->name : '';
$date      = get_the_date( 'j M Y', $post_id );
$minutes   = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) ) ) / 220 ) );
?>
<!-- wp:html -->
<div class="story-byline-fields">
  <?php if ( $author ) : ?>
    <span><?php echo esc_html( sprintf( /* translators: %s: author name */ __( 'WORDS / %s', 'sierra-madre' ), $author ) ); ?></span>
  <?php endif; ?>
  <?php if ( $photo ) : ?>
    <span><?php echo esc_html( sprintf( /* translators: %s: photographer or photo credit */ __( 'PHOTOGRAPHS / %s', 'sierra-madre' ), $photo ) ); ?></span>
  <?php endif; ?>
  <span><?php echo esc_html( sprintf( /* translators: 1: date, 2: minutes */ __( '%1$s / %2$d MIN', 'sierra-madre' ), $date, $minutes ) ); ?></span>
</div>
<!-- /wp:html -->

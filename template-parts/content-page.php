<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package floorball
 */
?>

<?php
  if ($post->post_name = 'gallery') {
    $post_class = 'gallery-page';
  }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<header class="entry-header">
		<?php
      $post_link = get_permalink();
      the_title( '<h1 class="entry-title"><a href="' . $post_link . '">', '</a></h1>' );
      if ($post->post_name = 'gallery') {
        $post_class = 'gallery-page';
      }
    ?>
	</header><!-- .entry-header -->

	<?php floorball_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'floorball' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Редактировать <span class="screen-reader-text">%s</span>', 'floorball' ),
						array(
							'span' => array(
							'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

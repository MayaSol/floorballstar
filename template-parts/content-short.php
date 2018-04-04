<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kindergarten
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("post-short"); ?> >

  <div class="entry-thumbnail">
      <?php the_post_thumbnail(); ?>
  </div>

  <div class="entry-container">
    <header class="entry-header">
      <?php
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
      ?>
      <?php if ( 'post' === get_post_type() ) : ?>
      <div class="entry-meta">
        <?php floorball_posted_on(); ?>
      </div><!-- .entry-meta -->
      <?php
      endif; ?>
    </header><!-- .entry-header -->


    <div class="entry-content">

      <?php
        if ( has_excerpt() or ('post' === get_post_type()) ) {
          the_excerpt( sprintf(
            wp_kses(
              /* translators: %s: Name of current post. Only visible to screen readers */
              __( 'Продолжить чтение<span class="screen-reader-text"> "%s"</span>', 'floorball' ),
              array(
                'span' => array(
                'class' => array(),
                ),
              )
            ),
            get_the_title()
          ) );
          };

        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'floorball' ),
          'after'  => '</div>',
        ) );

        $read_more_text = "Подробнее...";
      ?>

<!--      <a href="<?php echo get_permalink(); ?>" class="entry-more"> <?php echo $read_more_text ?></a>
    </div><!-- .entry-content -->
  </div>


</article><!-- #post-<?php the_ID(); ?> -->

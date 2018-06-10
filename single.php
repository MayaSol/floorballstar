<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package floorball
 */

get_header();
?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main site-single">

      <div class="single-title-wrapper">
        <?php
          error_log('$post->post_type: ' . $post->post_type);
          switch ( $post->post_type ) {
            case 'post':
              $single_title = __('Новости');
              break;
            case 'gallery_album':
              $single_title = $post->post_title;
              break;
            default:
              $single_title = '';
              break;
          }
          error_log('$single_title: ' . $single_title);
          if ($single_title) {
        ?>
        <h1 class="single-title"><?php echo $single_title; ?></h1>
        <?php
          }
        ?>
      </div>

        <?php
        while ( have_posts() ) :
          the_post();

          get_template_part( 'template-parts/content', get_post_type() );

          the_post_navigation();

          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_sidebar();
get_footer();

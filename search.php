<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package floorball
 */

get_header();
?>

  <section id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php if ( have_posts() ) : ?>

      <header class="page-header">
        <h1 class="page-title">
          <?php
          /* translators: %s: search query. */
          printf( esc_html__( 'Search Results for: %s', 'floorball' ), '<span>' . get_search_query() . '</span>' );
          ?>
        </h1>
      </header><!-- .page-header -->

      <?php
      /* Start the Loop */
      while ( have_posts() ) :
        the_post();

        /**
         * Run the loop for the search to output the results.
         * If you want to overload this in a child theme then include a file
         * called content-search.php and that will be used instead.
         */

        if ($post -> post_type == 'post') {
          get_template_part( 'template-parts/content', 'short' );
        }
        else {
          get_template_part( 'template-parts/content', 'search' );
        };

      endwhile;

      the_posts_navigation( array(
          'prev_text'          => '< Предыдущие записи',
          'next_text'          => 'Следующие записи >',
          'screen_reader_text' => 'Перемещение по записям'
        )
      );

    else :

      get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php
get_sidebar();
get_footer();

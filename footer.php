<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package floorball
 */
?>
</div><!-- #content -->

  <footer id="colophon" class="site-footer">
    <div class="container">

      <div class="site-info">
        <a href="https://http://floorball.ru/">
          <?php
          /* translators: %s: CMS name, i.e. WordPress. */
            printf( esc_html__( bloginfo('name'), 'floorball' ));
          ?>
        </a>
        <p class="tagline">
          <?php
            printf( esc_html__( bloginfo('description'), 'floorball' ));
          ?>
        </p>
      </div><!-- .site-info -->

      <?php
      wp_nav_menu( array(
        'theme_location' => 'socials-menu',
        'menu_class' => 'menu-socials',
        'link_before'    => '<span class="screen-reader-text">',
        'link_after'     => '</span>'
      ) );
      ?>

      <div class="site-contacts">
        <div class="site-contacts-inner">
          <p>Пишите нам:</p>
          <p>
            <a href="mailto:floorball-email@floorball.ru">
              <?php
              echo get_option('email');
              ?>
            </a>
          </p>
        </div>
      </div>

    </div>
  </footer><!-- #colophon -->

  <div class="site-footer-wrapper">
    <div class="site-footer-bottom">
      <a href="https://floorball.ru/" class="site-title">
        <?php
        /* translators: %s: CMS name, i.e. WordPress. */
          printf( esc_html__( bloginfo('name'), 'floorball' ));
        ?>
      </a>
    </div>
  </div>

</div><!-- #page -->
<?php wp_footer();?>
</body>
</html>
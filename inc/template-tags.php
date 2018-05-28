<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package floorball
 */

if ( ! function_exists( 'floorball_posted_on' ) ) :
  /**
   * Prints HTML with meta information for the current post-date/time.
   */
  function floorball_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_attr( get_the_modified_date( 'c' ) ),
      esc_html( get_the_modified_date() )
    );

/*
    $posted_on = sprintf(
*/

      /* translators: %s: post date. */

/*      esc_html_x( 'Posted on %s', 'post date', 'floorball' ),
      '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );
*/

    $posted_on  =  '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' .
    $time_string . '</a>';


    echo '<span class="posted-on">' . $posted_on . '</span>';

    // WPCS: XSS OK.

  }
endif;

if ( ! function_exists( 'floorball_posted_by' ) ) :
  /**
   * Prints HTML with meta information for the current author.
   */
  function floorball_posted_by() {
    $byline = sprintf(
      /* translators: %s: post author. */
      esc_html_x( 'by %s', 'post author', 'floorball' ),
      '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

  }
endif;

if ( ! function_exists( 'floorball_entry_footer' ) ) :
  /**
   * Prints HTML with meta information for the categories, tags and comments.
   */
  function floorball_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
      /* translators: used between list items, there is a space after the comma */
/*      $categories_list = get_the_category_list( esc_html__( ', ', 'floorball' ) );
      if ( $categories_list ) {
        /* translators: 1: list of categories. */
/*        printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'floorball' ) . '</span>', $categories_list ); // WPCS: XSS OK.
      }
*/
      /* translators: used between list items, there is a space after the comma */
      $tags_list = get_the_tag_list('<ul class="tag-list"><li class="tag-item">',
       '</li><li class="tag-item">', '</li></ul>' );
      if ( $tags_list ) {
        /* translators: 1: list of tags. */
//        printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'floorball' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        echo $tags_list;
      }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
      echo '<span class="comments-link">';
      comments_popup_link(
        sprintf(
          wp_kses(
            /* translators: %s: post title */
            __( 'Комментировать<span class="screen-reader-text"> on %s</span>', 'floorball' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          get_the_title()
        )
      );
      echo '</span>';
    }

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
  }
endif;

if ( ! function_exists( 'floorball_post_thumbnail' ) ) :
  /**
   * Displays an optional post thumbnail.
   *
   * Wraps the post thumbnail in an anchor element on index views, or a div
   * element when on single views.
   */
  function floorball_post_thumbnail() {



    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
      return;
    }

    if ( is_singular() ) :
      ?>

      <div class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
      </div><!-- .post-thumbnail -->

    <?php else : ?>

    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
      <?php
      the_post_thumbnail( 'post-thumbnail', array(
        'alt' => the_title_attribute( array(
          'echo' => false,
        ) ),
      ) );
      ?>
    </a>

    <?php
    endif; // End is_singular().
  }


endif;


if ( ! function_exists( 'floorball_breadcrumbs' ) ) :
  /**
   * Displays breadcrumbs
   *
   */

  function floorball_breadcrumbs() {
      echo '<ul id="crumbs">';
    if (!is_home()) {
      echo '<li><a href="';
      echo get_option('home');
      echo '">';
      echo 'Home';
      echo "</a></li>";
      if (is_category() || is_single()) {
        echo '<li>';
        the_category(' </li><li> ');
        if (is_single()) {
          echo "</li><li>";
          the_title();
          echo '</li>';
        }
      } elseif (is_page()) {
        echo '<li>';
        echo the_title();
        echo '</li>';
      }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
  }

endif;


/*
Include contacts form user fields:
*    phone_01_title
*    phone_01_number
*    phone_02_number
*    phone_02_title
*    address
*/
if ( ! function_exists( 'floorball_contacts' ) ) :

  function floorball_contacts() {

/*    $page = get_page_by_path("contacts");
    if ($page) {
      $id = $page->ID;
    }
    else {
      $id = get_the_ID();
    };
*/
    echo '<section class="contacts-container">';

    $phone_01_title = esc_html( get_option('phone_01_title') );
    $phone_01_number = esc_html( get_option('phone_01_number') );

    if ($phone_01_number) :

      if ($phone_01_title) :

        echo '<h2 class="contacts-title">' . $phone_01_title . '</h2>';

      endif;

      $svg_icon_phone = '<span class="icon-wrapper icon-wrapper-phone">'
      . floorball_get_svg( $args = array( 'icon' => 'phone', 'size' => array('1em','1em')) ) . '</span>';
      echo '<p>' . $svg_icon_phone;
      echo '<a class="contacts-phone-tel" href="tel:' . $phone_01_number . '">' . $phone_01_number . '</a> ';
      echo '<a class="contacts-phone-skype" href="skype:' . $phone_01_number . '?call">' . $phone_01_number . '</a> </p>';

    endif;

    $phone_02_title = esc_html( get_option('phone_02_title') );
    $phone_02_number = esc_html( get_option('phone_02_number') );

    if ($phone_02_number) :

      if ($phone_02_title) :

        echo '<h2 class="contacts-title">' . $phone_02_title . '</h2>';

      endif;

      echo '<p>' . $svg_icon_phone;
      echo '<a class="contacts-phone-tel" href="tel:' . $phone_02_number . '">' . $phone_02_number . '</a> ';
      echo '<a class="contacts-phone-skype" href="skype:' . $phone_02_number . '?call">' . $phone_02_number . '</a> </p>';

    endif;

    $address = esc_html( get_option('address'));

    if ($address) :

      $svg_icon_map = '<p> <span class="icon-wrapper icon-wrapper-map">'
      . floorball_get_svg( $args = array( 'icon' => 'map', 'size' => array('1em','1em')) ) . '</span>';
      $address = nl2br( $address );

      echo $svg_icon_map;
      echo $address;

    endif;

    $mailto = esc_html( get_option('email') );

    if ($mailto) :
      $svg_icon_mailto = '<p> <span class="icon-wrapper icon-wrapper-mailto">'
      . floorball_get_svg( $args = array( 'icon' => 'envelope-o', 'size' => array('1em','1em')) ) . '</span>';
      echo $svg_icon_mailto;
      echo '<a class="email-text" href="mailto:' . $mailto . '">' . $mailto  . '</a>';
    endif;

    echo '</p> </section>';

  }

endif;

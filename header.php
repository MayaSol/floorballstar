<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package floorball
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="stylesheet" href="style.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'floorball' ); ?></a>

	<header id="masthead" class="site-header">
    <div class="site-header-picture">

      <div class="site-header-top">
        <nav class="short-navigation">
          <?php
          wp_nav_menu( array(
            'theme_location' => 'short-menu',
            'menu_class' => 'menu-short'
          ) );
          ?>
        </nav>
      </div>

      <div class="site-branding">
        <div class="command-logo-wrapper">
          <img src="<?php echo THEME_IMG_PATH; ?>/logo.svg" alt="Логотип">
        </div>
        <div class="site-branding-others">
          <?php
          if ( is_front_page() && is_home() ) :
            ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
          else :
            ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php
          endif;
/*          $floorball_description = get_bloginfo( 'description', 'display' );
          if ( $floorball_description || is_customize_preview() ) :
            ?>
            <p class="site-description"><?php echo $floorball_description; /* WPCS: xss ok. */
          /*  ?>
          -</p>
          <?php endif; ?>*/
          ?>
          <a class="header-menu-toggle"></a>
        </div>
      </div><!-- .site-branding -->

    </div>


    <nav id="site-navigation" class="main-navigation">
      <div class="container">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'floorball' ); ?></button>
        <?php
        wp_nav_menu( array(
          'theme_location' => 'primary-menu',
          'menu-id' => 'primary-menu',
          'menu_class' => 'menu-primary'
        ) );
        ?>
      </div>
    </nav><!-- #site-navigation -->
  </header><!-- #masthead -->

  <div id="content" class="site-content">

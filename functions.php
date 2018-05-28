<?php
/**
 * floorball functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package floorball
 */

if ( ! function_exists( 'floorball_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function floorball_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on floorball, use a find and replace
     * to change 'floorball' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'floorball', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'primary-menu' => esc_html__( 'Primary', 'floorball' ),
      'short-menu' => esc_html__( 'Short', 'floorball' ),
      'secondary-menu' => esc_html__( 'Secondary', 'floorball'),
      'socials-menu' => esc_html__('social', 'floorball')
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'floorball_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support( 'custom-logo', array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    ) );
  }
endif;
add_action( 'after_setup_theme', 'floorball_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function floorball_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters( 'floorball_content_width', 640 );
}
add_action( 'after_setup_theme', 'floorball_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function floorball_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Главная зона виджетов', 'floorball' ),
    'id'            => 'sidebar-main',
    'description'   => esc_html__( 'Добавьте виджеты.', 'floorball' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'floorball_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function floorball_scripts() {
  wp_enqueue_style( 'floorball-style', get_stylesheet_uri() );

  wp_enqueue_script( 'floorball-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

  wp_enqueue_script( 'floorball-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

  wp_enqueue_script( 'floorball-menu-toggle', get_template_directory_uri() . '/js/menu-toggle.js', array(), '20180515', true);

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'floorball_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/*
 * Options page
 */
require get_parent_theme_file_path( '/inc/options-page.php' );


/*
* Path to img folder on localhost
*/
if( !defined('THEME_IMG_PATH')){
 define( 'THEME_IMG_PATH', get_stylesheet_directory_uri() . '/img' );
}

/* Set custom excerpt lenght */
function floorball_custom_excerpt_length() {
  return 28;
}
add_filter( 'excerpt_length', 'floorball_custom_excerpt_length');


/*
* Debug functions
*/
function floorball_debug() {
  global $wp_registered_sidebars;
  error_log('wp_registered_sidebars: ');
  error_log( print_r($wp_registered_sidebars, true) );
}
//add_action( 'wp_loaded', 'floorball_debug' );

/*
* Ф-ция для вывода инфы в логфайл:
*/
/*
if ( ! function_exists('write_log')) {
   function write_log( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}
*/


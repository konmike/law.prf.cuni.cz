
<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Root Theme
 */

function root_theme_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Twenty Twenty-One, use a find and replace
     * to change 'twentytwentyone' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'roottheme', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * This theme does not use a hard-coded <title> tag in the document head,
     * WordPress will provide it for us.
     */
    add_theme_support( 'title-tag' );

    /**
     * Add post-formats support.
     */
    add_theme_support(
        'post-formats',
        array(
            'link',
            'aside',
            'gallery',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        )
    );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1568, 9999 );

    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary menu', 'roottheme' ),
            'footer'  => __( 'Secondary menu', 'roottheme' ),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        )
    );
}
add_action( 'after_setup_theme', 'root_theme_setup' );

 /**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function roottheme_widgets_init() {

	
        register_sidebar( array(
            'name'          => __( 'Záhlaví', 'roottheme' ),
            'id'            => 'sidebar-1',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
     
        register_sidebar( array(
            'name'          => __( 'Zápatí', 'roottheme' ),
            'id'            => 'sidebar-2',
            'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li></ul>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    
}
add_action( 'widgets_init', 'roottheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function roottheme_scripts() {
	wp_enqueue_style( 'roottheme-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'roottheme-style', 'rtl', 'replace' );

	wp_enqueue_style( 'roottheme-default-style', get_template_directory_uri() . '/css/main.min.css', 'all' );
    wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );

}
add_action( 'wp_enqueue_scripts', 'roottheme_scripts' );
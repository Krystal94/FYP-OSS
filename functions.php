<?php
/**
 * first-try functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package first-try
 */

if ( ! function_exists( 'first_try_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function first_try_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on first-try, use a find and replace
	 * to change 'first-try' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'first-try', get_template_directory() . '/languages' );

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
        add_image_size('index-thumb', 180, 180, TRUE);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'first-try' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside'
	) );

	// Set up the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'first_try_custom_background_args', array(
//		'default-color' => 'ffffff',
//		'default-image' => '',
//	) ) );
}
endif; // first_try_setup
add_action( 'after_setup_theme', 'first_try_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function first_try_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'first_try_content_width', 830 );
}
add_action( 'after_setup_theme', 'first_try_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function first_try_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'first-try' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        register_sidebar( array(
                'name'          => esc_html__( 'Footer Widgets', 'first-try' ),
                'id'            => 'sidebar-2',
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );
}
add_action( 'widgets_init', 'first_try_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function first_try_scripts() {
	wp_enqueue_style( 'first-try-style', get_stylesheet_uri() );
        
        wp_enqueue_style(' first-try-google-fonts', 'https://fonts.googleapis.com/css?family=PT+Sans:400italic,400,700,700italic|Tillana:700,800,600|Volkhov:400,400italic,700,700italic');
        
        wp_enqueue_style(' first-try-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
        
        if(is_page_template('page-templates/page-beverley.php')){
            wp_enqueue_style(' first-try-layout-sidebar-content',get_template_directory_uri() .'/layouts/beverley-design.css');
        }
        else{
            wp_enqueue_style(' first-try-layout-sidebar-content',get_template_directory_uri() .'/layouts/sidebar-content.css');
        }
        
        wp_enqueue_script( 'first-try-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array('masonry'), '20150908', true );
        
        wp_enqueue_script( 'first-try-hide-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20150906', true );
        
        wp_enqueue_script('first-try-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20150903', true );
        
        wp_enqueue_script( 'first-try-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('first-try-superfish'), '20150903', true );

	wp_enqueue_script( 'first-try-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'first-try-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'first_try_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

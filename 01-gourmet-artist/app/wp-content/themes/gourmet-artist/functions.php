<?php
/**
 * GourmetArtist functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GourmetArtist
 */
 function recetas_desayunar() {
 	$args = array(
 		'post_type' => 'recetas',
 		'posts_per_page' => 3,
 		'orderby' => 'rand',
 		'tax_query' => array(
 					array(
 							'taxonomy' => 'horario-menu',
 							'field' => 'slug',
 							'terms' => 'comida',
 				),
 		),
 	);

 	$posts = get_posts($args);

 	$listado = array();

 	foreach($posts as $post) {
 		setup_postdata($post);

 		$listado[] = array(
 				'objeto' => $post,
 				'id' => $post->ID,
 				'nombre' => $post->post_title,
 				'imagen' => get_the_post_thumbnail($post->ID, 'filtrarHorario'),
 				'link' => get_permalink($post->ID),
 		);
 	}
 	header('Content-type: application/json');
 	echo json_encode( $listado );
 	die;
 }

 add_action('wp_ajax_nopriv_recetas_desayunar', 'recetas_desayunar');
 add_action('wp_ajax_recetas_desayunar', 'recetas_desayunar');


function recetas_comer() {
	$args = array(
		'post_type' => 'recetas',
		'posts_per_page' => 3,
		'orderby' => 'rand',
		'tax_query' => array(
					array(
							'taxonomy' => 'horario-menu',
							'field' => 'slug',
							'terms' => 'comida',
				),
		),
	);

	$posts = get_posts($args);

	$listado = array();

	foreach($posts as $post) {
		setup_postdata($post);

		$listado[] = array(
				'objeto' => $post,
				'id' => $post->ID,
				'nombre' => $post->post_title,
				'imagen' => get_the_post_thumbnail($post->ID, 'filtrarHorario'),
				'link' => get_permalink($post->ID),
		);
	}
	header('Content-type: application/json');
	echo json_encode( $listado );
	die;
}

add_action('wp_ajax_nopriv_recetas_comer', 'recetas_comer');
add_action('wp_ajax_recetas_comer', 'recetas_comer');


function recetas_cenar() {
	$args = array(
		'post_type' => 'recetas',
		'posts_per_page' => 3,
		'orderby' => 'rand',
		'tax_query' => array(
					array(
							'taxonomy' => 'horario-menu',
							'field' => 'slug',
							'terms' => 'comida',
				),
		),
	);

	$posts = get_posts($args);

	$listado = array();

	foreach($posts as $post) {
		setup_postdata($post);

		$listado[] = array(
				'objeto' => $post,
				'id' => $post->ID,
				'nombre' => $post->post_title,
				'imagen' => get_the_post_thumbnail($post->ID, 'filtrarHorario'),
				'link' => get_permalink($post->ID),
		);
	}
	header('Content-type: application/json');
	echo json_encode( $listado );
	die;
}

add_action('wp_ajax_nopriv_recetas_cenar', 'recetas_cenar');
add_action('wp_ajax_recetas_cenar', 'recetas_cenar');


function filtrar_platillos($busqueda) {
	$args = array(
		'posts_per_page' => 4,
		'post_type' => 'recetas',
		'orderby' => 'rand',
		'tax_query' => array(
				array(
						'taxonomy' => 'tipo-comida',
						'field'    => 'slug',
						'terms'    => $busqueda,
				)
		),
	);

	$comida = new WP_Query($args);
	echo '<div id="'.$busqueda. '" class="row">';
	while($comida->have_posts()): $comida->the_post();
		echo '<div class="small-6 medium-3 columns">';
		echo '<div class="platillo">';

		echo '<a href="' .get_the_permalink($comida->ID) . '">';
		echo get_the_post_thumbnail($comida->ID, 'platilloBuscado');
		echo '</a>';
		echo '<h2 class="text-center">' . get_the_title() . '</h2>';
		echo '</div>';
		echo '</div>';
	endwhile; wp_reset_postdata();
	echo '</div>';
}





if ( ! function_exists( 'gourmet_artist_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gourmet_artist_setup() {


	add_image_size('entrada', 619, 462, true );
	add_image_size('platilloBuscado', 560, 800, true);
	add_image_size('filtrarHorario', 385,491, true);

	add_image_size('slider', 1200, 350, true );
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on GourmetArtist, use a find and replace
	 * to change 'gourmet-artist' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gourmet-artist', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'gourmet-artist' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'gourmet-artist' ),
		'social-menu' => esc_html__( 'Social Menu', 'gourmet-artist' ),
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
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gourmet_artist_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'gourmet_artist_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gourmet_artist_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gourmet_artist_content_width', 640 );
}
add_action( 'after_setup_theme', 'gourmet_artist_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gourmet_artist_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gourmet-artist' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title text-center">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gourmet_artist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gourmet_artist_scripts() {
	wp_enqueue_style( 'gourmet-artist-style', get_stylesheet_uri() );

  wp_enqueue_style('foundation-icons', get_template_directory_uri() . '/css/foundation-icons.css');

	wp_enqueue_style('foundation-css', get_template_directory_uri() . '/css/app.css');

	wp_enqueue_script('jquery');

	wp_enqueue_script( 'gourmet-artist-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'gourmet-artist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/bower_components/foundation-sites/dist/foundation.js', array(), '6.1.1', true );

	wp_enqueue_script( 'what-input', get_template_directory_uri() . '/bower_components/what-input/what-input.js', array(), '6.1.1', true );

  wp_enqueue_script( 'appjs', get_template_directory_uri() . '/js/app.js', array(), '6.1.1', true );

	wp_localize_script( 'appjs', 'admin_url', array(
		'ajax_url' => admin_url('admin-ajax.php')
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gourmet_artist_scripts' );



function mostrar_post_type($query) {
	//que no sea la pantalla de admin y que sea el query principal
	if(!is_admin() && $query->is_main_query()) {
		//que sea el homepage
		if(is_home()) {
			$query->set('post_type',  array('post', 'recetas') );
		}
	}
}
add_action('pre_get_posts', 'mostrar_post_type');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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


/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

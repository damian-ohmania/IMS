<?php
/**
 * IMS theme main setup process
 *
 * @package WordPress
 * @subpackage IMS  
 */

function butcher_setup_theme(){
	// Add options page
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'IMS Settings',
			'menu_title'	=> 'IMS<br>Theme Settings',
			'menu_slug' 	=> 'theme-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}

	// Adding theme supported features
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'yoast-seo-breadcrumbs' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array(
		'gallery', 'caption'
	));

	add_theme_support( 'post-formats', array(
		'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'
	));

	// Image Sizes
	add_image_size( 'pagetitle', 1920, 535, true );
	add_image_size( 'custom_product', 317, 309, true );
	add_image_size( 'product_image', 545, 545, true );
	add_image_size( 'product_category_image', 590, 405, true );

	// Custom excerpt length, by words limit
	function butcher_excerpt( $limit, $post_id = "" ) {
		return wp_trim_words( get_post_field( 'post_content', $post_id ), $limit );
	}

	// Define and register starter content to showcase the theme on new sites.
	$starter_content                =   array(
		// Default to a static front page and assign the front and posts pages.
		'options'                   =>  array(
			'show_on_front'         => 'page',
			'page_on_front'         => '{{home}}',
			'page_for_posts'        => '{{blog}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'                 =>  array(
			// Assign a menu to the "header" & "footer" location.
			'primary'               =>  array(
				'name'              =>  __( 'Main Nav', 'butcher' )
			),
			'secondary'             =>  array(
				'name'              =>  __( 'Shop Nav', 'butcher' )
			)
		),
	);
	add_theme_support( 'starter-content', $starter_content );

	register_nav_menu( 'primary', __( 'Main Nav', 'butcher' ) );
	register_nav_menu( 'secondary', __( 'Shop', 'butcher' ) );

	// Register sidebar(s)
	add_action( 'widgets_init', 'butcher_widgets_init' );
	function butcher_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Main Widget', 'butcher' ),
			'id' => 'main-widget',
			'description' => __( 'Default widget area', 'butcher' ),
			'before_widget' => '<div id="%1$s" class="widget footer-nav %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );
	}

	// Register custom post types
	include( get_template_directory() . '/includes/cpt.php' );
	
	/**
	 * Add HTML5 theme support.
	 */
	function wpdocs_after_setup_theme() {
		add_theme_support( 'html5', array( 'search-form' ) );
	}
	add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );
	
}



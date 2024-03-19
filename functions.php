<?php
/**
 * IMS functions and definitions
 *
 * @package WordPress
 * @subpackage IMS

 */

// Setup

// Includes
include( get_template_directory() . '/includes/front/enqueue.php' );
include( get_template_directory() . '/includes/setup.php' );
include( get_template_directory() . '/includes/uikit-nav.php' );
include( get_template_directory() . '/includes/functions.php' );
include( get_template_directory() . '/includes/woocomerce-setup.php' );

// Hooks
add_action( 'wp_enqueue_scripts', 'butcher_enqueue', 99 );
add_action( 'after_setup_theme', 'butcher_setup_theme' );
add_filter( 'excerpt_more', '__return_false' );
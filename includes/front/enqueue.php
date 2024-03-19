<?php
/**
 * IMS theme main equeue
 *
 * @package WordPress
 * @subpackage IMS
 */

function butcher_enqueue(){
	// Register theme styles
	wp_register_style( 'butcher_google_fonts', '//fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap' );
	wp_register_style( 'butcher_uikit_stylesheet', get_template_directory_uri() . '/assets/css/butcher-uikit.css' );
	wp_register_style( 'butcher_justselect_stylesheet', get_template_directory_uri() . '/assets/css/select2.min.css' );
	wp_register_style( 'butcher_air_calendar_stylesheet', get_template_directory_uri() . '/assets/css/datepicker.min.css' );
	wp_register_style( 'butcher_main_theme_stylesheet', get_template_directory_uri() . '/assets/css/main.css' );

	// Enqueue theme styles
	wp_enqueue_style( 'butcher_google_fonts' );
	wp_enqueue_style( 'butcher_uikit_stylesheet' );
	wp_enqueue_style( 'butcher_justselect_stylesheet' );
	wp_enqueue_style( 'butcher_air_calendar_stylesheet' );
	wp_enqueue_style( 'butcher_main_theme_stylesheet' );

	// Smart jQuery inclusion
	if (!is_admin()) {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true );
		wp_enqueue_script( 'jquery' );
	}

	// Register theme script
	wp_register_script( 'butcher_scripts_scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), false, true );
	wp_register_script( 'butcher_justselect_scripts', get_template_directory_uri() . '/assets/js/select2.min.js', array(), false, true );
	wp_register_script( 'butcher_matchHeight_scripts', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', array(), false, true );
	wp_register_script( 'butcher_air_calendar_scripts', get_template_directory_uri() . '/assets/js/datepicker.min.js', array(), false, true );
	wp_register_script( 'butcher_air_calendar_scripts_english', get_template_directory_uri() . '/assets/js/datepicker.en.js', array(), false, true );
	wp_register_script( 'butcher_main_theme_script', get_template_directory_uri() . '/assets/js/main.js', array(), false, true );
	//wp_register_script( 'dropdown_script', 'dropdown_script_url' );

	// Enqueue theme scripts
	wp_enqueue_script( 'butcher_scripts_scripts' );
	wp_enqueue_script( 'butcher_justselect_scripts' );
	wp_enqueue_script( 'butcher_matchHeight_scripts' );
	wp_enqueue_script( 'butcher_air_calendar_scripts' );
	wp_enqueue_script( 'butcher_air_calendar_scripts_english' );
	wp_enqueue_script( 'butcher_main_theme_script' );
    //wp_enqueue_script( 'dropdown_script' );
    
	// after wp_enqueue_script
	$translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
    wp_localize_script( 'butcher_main_theme_script', 'object_name', $translation_array );
    
    // Mini Cart
    //Pass the parameters
    wp_localize_script( 'butcher_main_theme_script', 'loadmore_params', array(
         'ajaxurl'=> site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
    ) );
}
<?php

/*
ENQUEUE STYLESHEETS AND SCRIPTS FOR BACKEND ADMIN
___________________________________________________
*/

function ninety_nine_admin_enqueue_style_scripts( $hook ){

  if( 'toplevel_page_ninety_nine' == $hook ){
    wp_enqueue_style( 'ninety-nine-admin', get_template_directory_uri() . '/css/ninety.nine.admin.css', array(), '1.0', 'all' );

    wp_enqueue_media();
    wp_enqueue_script( 'ninety-nine-admin-js', get_template_directory_uri() . '/js/ninety.nine.admin.js', array('jquery'), '1.0', true );
  }

}

add_action( 'admin_enqueue_scripts', 'ninety_nine_admin_enqueue_style_scripts' );

/*
ENQUEUE STYLESHEETS AND SCRIPTS FOR FRONTEND
___________________________________________________
*/

function ninety_nine_enqueue_style_scripts(){

wp_enqueue_style( 'dashicons' );
wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all');
wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.css', array(), '3.5.1', 'all' );
wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all' );

wp_register_script( 'ajax-pagination', get_template_directory_uri() . '/js/ninety.nine.ajax.js', array( 'jquery' ), '1.0', true );
global $wp_query;
wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' ),
  'query_vars' => json_encode( $wp_query->query )
));

wp_enqueue_script( 'ajax-pagination' );

wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true);
wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0', true );

}

add_action( 'wp_enqueue_scripts', 'ninety_nine_enqueue_style_scripts' );

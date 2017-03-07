<?php

  /*
  Messages Custom Post Type for Contact Form
  _________________________________________________
  */

  $contact = get_option( 'activate_contact' );

  if( @$contact == 1 ){

    add_action( 'init', 'ninety_nine_custom_post_type' );
    add_action( 'manage_ninety-nine-contact_posts_columns', 'ninety_nine_contact_columns' );
    add_action( 'manage_ninety-nine-contact_posts_custom_column', 'ninety_nine_contact_custom_columns', 10, 2 );
    add_action( 'add_meta_boxes', 'ninety_nine_email_meta_box' );
    add_action( 'save_post', 'ninety_nine_save_contact_email_data' );

  }

  function ninety_nine_custom_post_type(){

    $labels = array(
    'name'            => 'Messages',
    'singular_name'   => 'Message',
    'menu_name'       => 'Messages',
    'name_admin_bar'  => 'Message'
  );

  $args = array(
    'labels'          => $labels,
    'show_ui'         => true,
    'show_in_menu'    => true,
    'capability_type' => 'post',
    'hierarchical'    => false,
    'menu_position'   => 26,
    'menu_icon'       => 'dashicons-email',
    'supports'        => array( 'title', 'editor', 'author' )
  );

  register_post_type( 'ninety-nine-contact', $args );
}




function ninety_nine_contact_columns( $columns ){

  $newColumns = array();
  $newColumns[ 'title' ] = 'Full Name';
  $newColumns[ 'message' ] = 'Message';
  $newColumns[ 'email' ] = 'Email';
  $newColumns[ 'date' ] = 'Date';
  return $newColumns;

}

function ninety_nine_contact_custom_columns( $column, $post_id ){

  switch ( $column ){

    case 'message':
      echo get_the_excerpt();
      break;

    case 'email':
    $email = get_post_meta( $post_id, '_contact_email_value_key', true );
    echo '<a href="'.$email.'">'.$email.'</a>';
      break;

  }

}

function ninety_nine_email_meta_box(){

  add_meta_box( 'contact_email', 'User Email', 'ninety_nine_user_email_callback', $screen = 'ninety-nine-contact', $context = 'side' );

}

function ninety_nine_user_email_callback( $post ){

  wp_nonce_field( 'ninety_nine_save_contact_email_data', 'ninety_nine_contact_email_meta_box_nonce' );

  $value = get_post_meta( $post->ID, '_contact_email_value_key', true );

  echo '<label for="ninety_nine_contact_email_field">User Email Address: </label>';
  echo '<input type="email" id="ninety_nine_contact_email_field" name="ninety_nine_contact_email_field" value="'. esc_attr( $value ) .'" size="25" />';

}

function ninety_nine_save_contact_email_data( $post_id ){

  if( !isset( $_POST[ 'ninety_nine_contact_email_meta_box_nonce' ] ) ){
    return;
  }

  if( !wp_verify_nonce( $_POST[ 'ninety_nine_contact_email_meta_box_nonce' ], 'ninety_nine_save_contact_email_data' ) ){
    return;
  }

  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  if( !current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  if( !isset ( $_POST[ 'ninety_nine_contact_email_field' ] ) ){
    return;
  }

  $my_data = sanitize_text_field( $_POST[ 'ninety_nine_contact_email_field' ] );

  update_post_meta( $post_id, '_contact_email_value_key', $my_data );

}

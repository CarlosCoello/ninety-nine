<?php

/*
ADMIN PAGE
___________________________________________
*/

function ninety_nine_add_admin_page(){

  //Generate Admin Page
  add_menu_page( 'ninety nine Options', 'ninety', 'manage_options', 'ninety_nine', 'ninety_nine_website_menu_page', 'dashicons-analytics', 101);

  //Generat Admin Subpages
  add_submenu_page( 'ninety_nine', 'Sidebar Options', 'Sidebar', 'manage_options', 'ninety_nine', 'ninety_nine_website_menu_page' );
  add_submenu_page( 'ninety_nine', 'Theme Options', 'Theme Options', 'manage_options', 'ninety_nine_theme', 'ninety_nine_theme_sub_page' );
  add_submenu_page( 'ninety_nine', 'Contact Form', 'Contact Form', 'manage_options', 'ninety_nine_contact', 'ninety_nine_contact_sub_page' );

  //Activate Custom script_concat_settings
  add_action( 'admin_init', 'ninety_nine_custom_Settings' );
}

add_action( 'admin_menu', 'ninety_nine_add_admin_page' );

function ninety_nine_custom_Settings(){

  //Sidebar Options Regiter Setting
  register_setting( 'ninety-nine-settings-group', 'profile_picture' );
  register_setting( 'ninety-nine-settings-group', 'first_name' );
  register_setting( 'ninety-nine-settings-group', 'last_name' );
  register_setting( 'ninety-nine-settings-group', 'user_description' );
  register_setting( 'ninety-nine-settings-group', 'twitter_handler', 'ninety_nine_sanitize_twitter_handler' );
  register_setting( 'ninety-nine-settings-group', 'facebook_handler' );

  //Sidebar Options Section and Field
  add_settings_section( 'ninety-nine-sidebar-option', 'Sidebar Options', 'ninety_nine_sidebar_options', 'ninety_nine' );
  add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'ninety_nine_profile_picture', 'ninety_nine', 'ninety-nine-sidebar-option' );
  add_settings_field( 'sidebar-name', 'Full Name', 'ninety_sidebar_name', 'ninety_nine', 'ninety-nine-sidebar-option' );
  add_settings_field( 'sidebar-description', 'Description', 'ninety_nine_sidebar_description', 'ninety_nine', 'ninety-nine-sidebar-option' );
  add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'ninety_nine_sidebar_twitter', 'ninety_nine', 'ninety-nine-sidebar-option' );
  add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'ninety_nine_sidebar_facebook', 'ninety_nine', 'ninety-nine-sidebar-option' );

  //Theme Support Options Register Settings
  register_setting( 'ninety-nine-theme-support', 'post_formats' );
  register_setting( 'ninety-nine-theme-support', 'custom_logo' );
  register_setting( 'ninety-nine-theme-support', 'custom_header' );
  register_setting( 'ninety-nine-theme-support', 'custom_background' );

  //Theme Support Options Section and Field
  add_settings_section( 'ninety-nine-theme', 'Theme Support Options', 'ninety_nine_theme_support_options', 'ninety_nine_theme' );
  add_settings_field( 'post-formats', 'Post Formats', 'ninety_nine_post_formats', 'ninety_nine_theme', 'ninety-nine-theme' );
  add_settings_field( 'custom-logo', 'Custom Logo', 'ninety_nine_custom_logo', 'ninety_nine_theme', 'ninety-nine-theme' );
  add_settings_field( 'custom-header', 'Custom Header', 'ninety_nine_custom_header', 'ninety_nine_theme', 'ninety-nine-theme' );
  add_settings_field( 'custom-background', 'Custom Background', 'ninety_nine_cutom_background', 'ninety_nine_theme', 'ninety-nine-theme' );

  //Contact Form Register Settings
  register_setting( 'ninety-nine-contact-options', 'activate_contact' );

  //Contact Form Section and Field
  add_settings_section( 'ninety-nine-contact-section', 'Contact Form', 'ninety_nine_contact_section', 'ninety_nine_contact' );
  add_settings_field( 'activate-form', 'Activate Contact Form', 'ninety_nine_activate_contact', 'ninety_nine_contact', 'ninety-nine-contact-section' );

}

/* Add Admin Page Functions */

function ninety_nine_website_menu_page(){

  require_once( get_template_directory() . '/inc/templates/ninety-nine-admin.php' );

}

function ninety_nine_theme_sub_page(){

  require_once( get_template_directory() . '/inc/templates/ninety-nine-theme-support.php' );

}

function ninety_nine_contact_sub_page(){

  require_once( get_template_directory() . '/inc/templates/ninety-nine-contact-form.php' );

}

/* Custom Settings Functions */

function ninety_nine_sidebar_options(){

  echo 'Customize your sidebar!';

}

function ninety_nine_profile_picture(){

  $picture = esc_attr( get_option( 'profile_picture' ) );

  if( empty( $picture ) ){
    echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" /> <input type="hidden" id="profile-picture" name="profile_picture" value="" />';
  } else {
    echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button" /> <input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
  }

}

function ninety_sidebar_name(){

  $firstName = esc_attr( get_option( 'first_name' ) );
  $lastName = esc_attr( get_option( 'last_name' ) );
  echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';

}

function ninety_nine_sidebar_description(){

  $description = esc_attr( get_option( 'user_description' ) );
  echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /> <p class="description">Type a brief description of yourself</p>';

}

function ninety_nine_sidebar_twitter(){

  $twitter = esc_attr( get_option( 'twitter_handler' ) );
  echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" /> <p class="description">Type your Twitter Handler without the @ character</p>';

}

function ninety_nine_sidebar_facebook(){

  $facebook = esc_attr( get_option( 'facebook_handler' ) );
  echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler" />';

}

function ninety_nine_theme_support_options(){

  echo 'Activate and Deactivate specific Theme Support Options';

}

function ninety_nine_post_formats(){

  $options = get_option( 'post_formats' );
  $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
  $output = '';
  foreach ( $formats as $format ) {
    $checked = ( @$options[ $format ] == 1 ? 'checked' : '' );
    $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />'.$format.'</label><br>';
  }

  echo $output;

}

function ninety_nine_custom_logo(){

  $options = get_option( 'custom_logo' );
  $checked =( @$options == 1 ? 'checked' : '' );
  echo '<label><input type="checkbox" id="custom_logo" name="custom_logo" value="1" '.$checked.'/> Activate the custom logo</label>';

}

function ninety_nine_custom_header(){

  $options = get_option( 'custom_header' );
  $checked =( @$options == 1 ? 'checked' : '' );
  echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.'/> Activate the custom header</label>';

}

function ninety_nine_cutom_background(){

  $options = get_option( 'custom_background' );
  $checked = ( @$options == 1 ? 'checked' : '' );
  echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.'/> Activate the custom background</label>';

}

/* Sanitize Settings */

function ninety_nine_sanitize_twitter_handler( $input ){

  $output = sanitize_text_field( $input );
  $output = str_replace( '@', '', $output );
  return $output;

}

function ninety_nine_contact_section(){

  echo '<p>By clicking the input field and saving the the page you will activate a contact form custom post type</p>';

}

function ninety_nine_activate_contact(){

  $options = get_option( 'activate_contact' );
  $checked = ( @$options == 1 ? 'checked' : '' );
  echo '<input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.'/>';

}

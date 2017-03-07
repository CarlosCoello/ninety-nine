<?php

/*
Contact Form Ajax Submission and Saving Input Data for Custom Post Type called Messages
_____________________________________________________________________________________________
*/

add_action( 'wp_ajax_ninety_nine_save_user_contact_form', 'ninety_nine_save_user_contact_form' );
add_action( 'wp_ajax_nopriv_ninety_nine_save_user_contact_form', 'ninety_nine_save_user_contact_form' );

function ninety_nine_save_user_contact_form(){

if (
    ! isset( $_POST['ninety_nine_nonce_field'] )
    || ! wp_verify_nonce( $_POST['ninety_nine_nonce_field'], 'ninety_nine_my_action' )
) {

   print 'Sorry, your nonce did not verify.';
   exit;

} else {



$name = wp_strip_all_tags( $_POST["name"] );
$email = wp_strip_all_tags( $_POST["email"] );
$message = wp_strip_all_tags( $_POST["message"] );

    $args = array(
      'post_title'    => $name,
      'post_content'  => $message,
      'post_author'   => 1,
      'post_status'   => 'publish',
      'post_type'     => 'ninety-nine-contact',
      'meta_input'    => array(
          '_contact_email_value_key' => $email
      )
    );

  $postID =  wp_insert_post( $args );

  if($postID !== 0){
    $to = get_bloginfo( 'admin_email' );
    $subject = 'Email from '. $name;
    $headers[] = 'From: '. get_bloginfo('name') . '<'.$to.'>';
    $headers[] = 'Reply-To: '.$name.'<'.$email.'>';
    $headers[] = 'Content-Type: text/html: charset=UTF-8';
    //$message = file_get_contents(TEMPLATEPATH . '/inc/hero.php');
    $message = $message;
    wp_mail( $to, $subject, $message, $headers );

  } else {
    echo 0;
  }


  echo $postID;

die();
  }
}

/*
Ajax Blog Post Loads
_______________________________________________
*/

add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );

function my_ajax_pagination() {
  $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

      $query_vars['paged'] = $_POST['page'];


      $posts = new WP_Query( $query_vars );
      $GLOBALS['wp_query'] = $posts;

  if ( $posts->have_posts() ) :

        /* Start the Loop */
        while ( $posts->have_posts() ) : $posts->the_post() ;?>

        <div class="container index-posts">

          <?php get_template_part( 'template-parts/content', get_post_format() ) ;?>

        </div><!-- .index-posts -->

      <?php endwhile; ?>
      <div class="container ninety-nine-pagination">
        <?php the_posts_pagination( array(
    'mid_size'  => 2,
    'prev_text' => __( 'Back', 'textdomain' ),
    'next_text' => __( 'Onward', 'textdomain' ),
  ) ); ?>
      </div>
    <?php else : ?>

        <p><?php esc_html_e( 'Sorry, no posts matche your criteria.', 'default' ) ;?></p>

        <?php  wp_reset_postdata();

      endif;

    die();
}

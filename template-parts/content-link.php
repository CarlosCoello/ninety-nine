<?php

/*
Link Post Format
___________________________________________
*/

$class = get_query_var( 'posts-class' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array( 'ninety-nine-format-link', $class) ); ?>>

   <header class="entry-header text-center">

     <?php

    $link = ninety_nine_grab_url();

     the_title( '<h1 class="entry-title"><a href="'.$link.'" target="_blank">', '<div class="link-icon"><span class="dashicons dashicons-admin-links"></span></div></a></h1>' );

      ?>

   </header><!-- .entry-header -->

 </article><!-- article -->

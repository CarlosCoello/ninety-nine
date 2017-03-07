<?php

/*
Audio Post Format
_____________________________________________
*/

$class = get_query_var( 'posts-class' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'ninety-nine-format-audio', $class ) ); ?>>

   <header class="entry-header text-center">
     <?php the_title( '<h1 class="entry-title"><a href="'.esc_url( get_permalink() ).'" rel="bookmark">', '</a></h1>' ); ?>
     <div class="entry-meta">
       <?php echo ninety_nine_posted_meta(); ?>
     </div>
   </header><!-- .entry-header -->
   
   <div class="entry-content">
     <?php echo ninety_nine_get_embedded_media( array( 'audio', 'iframe') ); ?>
     <div class="entry-tags">
       <?php the_tags( 'Tags: ',' > ' ); ?>
     </div><!-- .entry-tags -->
   </div><!-- .entry-content -->

 </article><!-- article -->

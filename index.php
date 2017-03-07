<?php get_header() ;?>

<div class="container ajax-response">

<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'posts_per_page' => 2,
  'paged'          => $paged
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :

      /* Start the Loop */
      while ( $the_query->have_posts() ) : $the_query->the_post() ;?>

      <div class="container index-posts">

        <?php get_template_part( 'template-parts/content', get_post_format() ) ;?>

      </div><!-- .index-posts -->

    <?php endwhile; ?>

    <div class="container ninety-nine-pagination">
      <?php the_posts_pagination( array(
        	'mid_size'  => 2,
        	'prev_text' => __( 'Back', 'ninetynine' ),
        	'next_text' => __( 'Onward', 'ninetynine' ),
        ) ); ?>
    </div><!-- .ninety-nine-pagination -->

    <?php else : ?>

      <p><?php esc_html_e( 'Sorry, no posts matche your criteria.', 'ninetynine' ) ;?></p>

      <?php  wp_reset_postdata();

    endif;

      ?>

      <div class="container text-center ajax-animation">
          <span class="loading-pages hide" style="display: block;">
            <h1 style="color: white; margin: 0;">Loading Page.....</h1>
          </span><!-- .loading-pages -->
      </div><!-- .ajax-animation -->

</div><!-- .ajax-response -->

<?php get_footer() ;?>

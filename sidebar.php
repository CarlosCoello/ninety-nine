<?php

  /*
  ==================================
  Sidebar
  ==================================
  */

  if ( !is_active_sidebar( 'ninety-nine-sidebar' ) ){

      return;

  }

  ?>

  <aside id="secondary" class="widget-area" role="complementary">

    <?php dynamic_sidebar( 'ninety-nine-sidebar' );?>

  </aside><!-- #secondary -->

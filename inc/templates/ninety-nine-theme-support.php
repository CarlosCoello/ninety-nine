<?php settings_errors(); ?>

<form class="ninety-nine-general-form" action="options.php" method="post">
  <?php settings_fields( 'ninety-nine-theme-support' ); ?>
  <?php do_settings_sections( 'ninety_nine_theme' ); ?>
  <?php submit_button(); ?>
</form>

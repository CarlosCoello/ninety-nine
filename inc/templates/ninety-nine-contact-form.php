<?php settings_errors(); ?>

<form class="ninety-nine-general-form" action="options.php" method="post">
  <?php settings_fields( 'ninety-nine-contact-options' ); ?>
  <?php do_settings_sections( 'ninety_nine_contact' ); ?>
  <?php submit_button(); ?>
</form>

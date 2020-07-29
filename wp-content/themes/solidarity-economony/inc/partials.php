<?php 

function sea_add_brand_image() {
  $image_url = get_theme_mod( 'nav_brand_image' );
  if( $image_url ):
    $blog_name = get_bloginfo('name'); ?>

    <img class="nav-brand-image" src="<?= esc_url( $image_url ) ?>" alt="<?= $blog_name ?>">

  <?php endif;
}

function sea_add_footer_text_block() {
  echo wpautop( get_theme_mod( 'footer_text_block' ) );
}

function sea_add_footer_phone_line() {
  echo get_theme_mod( 'footer_phone_line' );
}

function sea_add_footer_email_line() {
  $email = get_theme_mod( 'footer_email_line' );
  if( $email ) {
    echo "<a href='$email'>$email</a>";
  }
}

function sea_add_footer_address_line() {
  echo get_theme_mod( 'footer_address_line' );
}
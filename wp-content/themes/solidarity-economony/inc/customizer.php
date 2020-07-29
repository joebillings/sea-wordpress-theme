<?php

add_action('customize_register', 'sea_customizer_settings');
function sea_customizer_settings($wp_customize)
{

  $black = '#414141';
  $white = '#FFF';
  $grey = '#989898';
  $lightgrey = '#e9e9e9';
  $teal = '#0bb696';
  $pink = '#d90368';

  $font_choices = array(
    'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
    'Open Sans:400italic,700italic,400,700' => 'Open Sans',
    'Oswald:400,700' => 'Oswald',
    'Playfair Display:400,700,400italic' => 'Playfair Display',
    'Montserrat:400,700' => 'Montserrat',
    'Raleway:400,700' => 'Raleway',
    'Droid Sans:400,700' => 'Droid Sans',
    'Lato:400,700,400italic,700italic' => 'Lato',
    'Arvo:400,700,400italic,700italic' => 'Arvo',
    'Lora:400,700,400italic,700italic' => 'Lora',
    'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
    'Oxygen:400,300,700' => 'Oxygen',
    'PT Serif:400,700' => 'PT Serif',
    'PT Sans:400,700,400italic,700italic' => 'PT Sans',
    'PT Sans Narrow:400,700' => 'PT Sans Narrow',
    'Cabin:400,700,400italic' => 'Cabin',
    'Fjalla One:400' => 'Fjalla One',
    'Francois One:400' => 'Francois One',
    'Josefin Sans:400,300,600,700' => 'Josefin Sans',
    'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
    'Arimo:400,700,400italic,700italic' => 'Arimo',
    'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
    'Bitter:400,700,400italic' => 'Bitter',
    'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
    'Roboto:400,400italic,700,700italic' => 'Roboto',
    'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
    'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
    'Roboto Slab:400,700' => 'Roboto Slab',
    'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
    'Rokkitt:400' => 'Rokkitt',
  );

  // Sections
  // --------------------------------------

  $wp_customize->add_section('sea_general', array(
    'title'      => 'General Settings',
    'priority'   => 20,
  ));

  $wp_customize->add_section('sea_header', array(
    'title'      => 'Header',
    'priority'   => 20,
  ));

  $wp_customize->add_section('sea_footer', array(
    'title'      => 'Footer',
    'priority'   => 20,
  ));

  // Settings
  // --------------------------------------

  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

  $wp_customize->add_setting('linje_headings_fonts', array(
    'sanitize_callback' => 'linje_sanitize_fonts',
    'default' => 'Lato'
  ));

  $wp_customize->add_setting('linje_body_fonts', array(
    'sanitize_callback' => 'linje_sanitize_fonts',
    'default' => 'Merriweather'
  ));

  $wp_customize->add_setting('background_color', array(
    'default' => $white,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('footer_color', array(
    'default' => $teal,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('footer_content_color', array(
    'default' => $white,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('footer_text_block', array(
    'default'           => 'Footer text goes here.',
    'sanitize_callback' => 'sanitize_text',
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('footer_phone_line', array(
    'default'           => '01234 567890',
    'sanitize_callback' => 'sanitize_text',
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('footer_email_line', array(
    'default'           => 'hello@email.com',
    'sanitize_callback' => 'sanitize_text',
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('footer_address_line', array(
    'default'           => 'Makespace, Oxford, OX2',
    'sanitize_callback' => 'sanitize_text',
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('accent_color', array(
    'default' => $teal,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('heading_color', array(
    'default' => $black,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('text_color', array(
    'default' => $black,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('link_color', array(
    'default' => $teal,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('nav_brand_image', array(
    'transport' => 'postMessage',
    'height' => 325,
  ));

  $wp_customize->add_setting('display_brand_image_only', array(
    'default' => false,
    'transport' => 'postMessage',
  ));

  $wp_customize->add_setting('brand_height', array(
    'default' => 60,
    'transport' => 'postMessage',
  ));

  // Controls
  // --------------------------------------

  $wp_customize->add_control('linje_headings_fonts', array(
    'type' => 'select',
    'description' => __('Select your heading font', 'linje'),
    'section' => 'sea_general',
    'choices' => $font_choices
  ));

  $wp_customize->add_control('linje_body_fonts', array(
    'type' => 'select',
    'description' => __('Select your body font', 'linje'),
    'section' => 'sea_general',
    'choices' => $font_choices
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
    'label' => 'Background Color',
    'section' => 'sea_general',
    'settings' => 'background_color',
  )));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color', array(
    'label' => 'Footer Color',
    'section' => 'sea_footer',
    'settings' => 'footer_color',
  )));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_content_color', array(
    'label' => 'Footer Content Color',
    'description' => 'Changes the color of text, links and icons',
    'section' => 'sea_footer',
    'settings' => 'footer_content_color',
  )));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_text_block', array(
    'label'    => 'Footer Text',
    'section'  => 'sea_footer',
    'settings' => 'footer_text_block',
    'type'     => 'textarea'
  )));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_phone_line', array(
    'label'    => 'Footer Phone',
    'section'  => 'sea_footer',
    'settings' => 'footer_phone_line',
    'type'     => 'text'
  )));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_email_line', array(
    'label'    => 'Footer Email',
    'section'  => 'sea_footer',
    'settings' => 'footer_email_line',
    'type'     => 'text'
  )));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_address_line', array(
    'label'    => 'Footer Address',
    'section'  => 'sea_footer',
    'settings' => 'footer_address_line',
    'type'     => 'text'
  )));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
    'label' => 'Accent Color',
    'section' => 'sea_general',
    'settings' => 'accent_color',
  )));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'heading_color', array(
    'label' => 'Heading Color',
    'section' => 'sea_general',
    'settings' => 'heading_color',
  )));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', array(
    'label' => 'Text Color',
    'section' => 'sea_general',
    'settings' => 'text_color',
  )));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
    'label' => 'Link Color',
    'section' => 'sea_general',
    'settings' => 'link_color',
  )));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'nav_brand_image', array(
    'label' => 'Site brand',
    'section' => 'sea_header',
    'settings' => 'nav_brand_image',
  )));

  $wp_customize->add_control('brand_height', array(
    'label' => 'Brand Image Height',
    'section' => 'sea_header',
    'settings' => 'brand_height',
    'type' => 'number',
    'input_attrs' => array(
      'min'   => 10,
      'max'   => 200
    ),
  ));

  $wp_customize->add_control('display_brand_image_only', array(
    'label' => 'Display the Image Only',
    'description' => 'This will be ignored if no image has been selected.',
    'section' => 'sea_header',
    'settings' => 'display_brand_image_only',
    'type' => 'checkbox'
  ));
  
  $wp_customize->selective_refresh->add_partial('nav_brand_image', array(
    'selector' => '#nav-brand-image-wrap',
    'render_callback' => 'sea_add_brand_image',
  ));

  $wp_customize->selective_refresh->add_partial('footer_text_block', array(
    'selector' => '#footer-text-block',
    'render_callback' => 'sea_add_footer_text_block',
  ));

  $wp_customize->selective_refresh->add_partial('footer_phone_line', array(
    'selector' => '#footer-phone-line',
    'render_callback' => 'sea_add_footer_phone_line',
  ));

  $wp_customize->selective_refresh->add_partial('footer_email_line', array(
    'selector' => '#footer-email-line',
    'render_callback' => 'sea_add_footer_email_line',
  ));

  $wp_customize->selective_refresh->add_partial('footer_address_line', array(
    'selector' => '#footer-address-line',
    'render_callback' => 'sea_add_footer_address_line',
  ));
}

// Sanitize text
function sanitize_text( $text ) {
  return addslashes( $text );
}

function sea_custom_styles($custom)
{
  //Fonts
  $headings_font = esc_html(get_theme_mod('linje_headings_fonts'));
  $body_font = esc_html(get_theme_mod('linje_body_fonts'));

  $background_color = get_theme_mod('background_color');
  $footer_color = get_theme_mod('footer_color');
  $footer_content_color = get_theme_mod('footer_content_color');
  $accent_color = get_theme_mod('accent_color');
  $brand_height = get_theme_mod('brand_height');
  $heading_color = get_theme_mod('heading_color');
  $text_color = get_theme_mod('text_color');
  $link_color = get_theme_mod('link_color');

  get_theme_mod('background_color');

  wp_enqueue_style(
    'custom-styles',
    get_template_directory_uri() . '/css/custom_styles.css'
  );

  if ($headings_font) {
    $font_pieces = explode(":", $headings_font);
    $custom .= "h1, h2, h3, h4, h5, h6 { font-family: {$font_pieces[0]}; }" . "\n";
  }

  if ($body_font) {
    $font_pieces = explode(":", $body_font);
    $custom .= "body, button, input, select, textarea { font-family: {$font_pieces[0]}; }" . "\n";
  }

  if ($background_color) {
    $custom .= "body { background: #$background_color; }\n";
  }

  if ($footer_color) {
    $custom .= "footer.site-footer { background: $footer_color; }\n";
  }

  if ($footer_content_color) {
    $custom .= "a, .site-footer-inner, .socials i { color: $footer_content_color; }\n";
  }

  if ($accent_color) {
    $custom .= ".accent-color { background: $accent_color; }\n";
  }

  if ($brand_height) {
    $custom .= ".nav-brand-image { height: {$brand_height}px; }\n";
  }

  if ($heading_color) {
    $custom .= "h1, h2, h3, h4, h5, h6 {
      color: $heading_color;
    }\n";
  }

  if ($text_color) {
    $custom .= "body {
      color: $text_color;
    }\n";
  }

  if ($link_color) {
    $custom .= "a:link {
      color: $link_color;
    }\n";
  }

  //Output all the styles
  wp_add_inline_style('custom-styles', $custom);
}

add_action('oneltd_enqueue_styles', 'sea_custom_styles');

add_action('customize_preview_init', 'sea_customizer');
function sea_customizer()
{
  wp_enqueue_script(
    'sea_customizer',
    get_stylesheet_directory_uri() . '/assets/js/customizer.js',
    array('jquery', 'customize-preview'),
    '',
    true
  );
}

/**
 * Google Fonts
 */
include('gfonts.php');

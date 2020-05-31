<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title><?php wp_title('&mdash;', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
  </head>
    <body <?php body_class(); ?>>
      <header class="site-header">
        <div class="site-header-inner">
          <?php if( get_bloginfo('description') ): ?>
          <div class="logo-container">
          <?php endif; ?>
            <h1 class="title">
              <a href="<?php bloginfo('url'); ?>">
              <?php 
                $logo = get_field('logo', 'options');
                $blog_name = get_bloginfo('name');
                if( $logo ): ?>
                  <img class="logo" src="<?= $logo['url'] ?>" alt="<?= $blog_name ?>">
                <?php else:
                  echo $blog_name;
                endif; ?>
              </a>
            </h1>
            <?php if( get_bloginfo('description') ): ?>
              <p class="tagline"><?php bloginfo('description') ?></p>
          </div>
            <?php endif; ?>
          <nav class="main-nav">
            <?php wp_nav_menu(array(
              'theme_location' => 'main-navigation',
              'container' => ''
            )) ?>
          </nav>

          <nav class="hamburger">
            <span class="hamburger-icon">
              <i class="hamburger-lines" aria-label="Toggle Navigation Menu">×</i>
            </a>
          </nav>
        </div>
      </header>

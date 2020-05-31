<?php get_header(); ?>

<?php if (have_posts()): ?>
  <h1>Viewing archives for <?php single_cat_title(); ?></h1>
  <?php while(have_posts()): the_post(); ?>
    <?php get_template_part('content', 'single'); ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>

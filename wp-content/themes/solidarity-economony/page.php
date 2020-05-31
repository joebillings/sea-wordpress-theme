<?php get_header(); ?>

<div class="page-outer container">
  <div class="page-inner">
  <?php if (have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
      <?php get_template_part('content', 'single'); ?>
    <?php endwhile; ?>
  <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>

<?php get_header(); ?>

<div class="page-outer container">
  <div class="page-inner case-study">
  <?php if (have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
      <div class="section heading">
        <h1><?php get_field('case_studies_name', 'options') ? the_field('case_studies_name', 'options') : 'Case Studies'; ?></h1>
        <h2><strong><?php the_title() ?></strong></h2>
      </div>
      <div class="section content">
      <?php if( get_the_post_thumbnail() ): ?>
        <figure>
          <?php the_post_thumbnail('full', ['class' => 'img-responsive responsive--full']); 
          if(get_post(get_post_thumbnail_id())->post_excerpt): ?>
            <figcaption><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></figcaption>    
          <?php endif; ?>
        </figure>
      <?php endif; ?>      
      <?php get_template_part('content', 'single'); ?>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>

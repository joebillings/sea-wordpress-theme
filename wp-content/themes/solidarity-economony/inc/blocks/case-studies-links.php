<?php 
$args = array(
  'post_type'   => 'case_study',
  'posts_per_page' => 3
);
 
$case_studies = new WP_Query( $args ); 

?>

<?php if ($case_studies->have_posts()): ?>
  <div class="case-studies-listing">
  <?php while($case_studies->have_posts()): $case_studies->the_post(); ?>
    <?php $args = array(
      'title' => get_the_title(),
      'quote' => get_field('quote', get_the_ID()),
      'image' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
      'url' => get_permalink()
    ) ?>
    <?php one_get_content('content-parts', 'case-study-teaser', $args) ?>
  <?php endwhile; ?>
  </div>
  <?php if (function_exists("pagination")) {
      pagination($custom_query->max_num_pages);
  } ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>
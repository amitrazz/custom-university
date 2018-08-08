<?php get_header();  ?>
  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large"><?php the_title(); ?></h1>
      <h2 class="headline headline--medium">Keep up with our latest news</h2>
    </div>
  </div>

   <div class="container container--narrow page-section">
   <?php
  while(have_posts()) {
    the_post(); ?>
        <div class="post-item">
          <div class="metabox metabox--position-up metabox--with-home-link">
              <p><a class="metabox__blog-home-link" href="<?php echo site_url( '/blog')?>">
              <i class="fa fa-home" aria-hidden="true"></i> Blog Home</a> <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> On <?php echo get_the_date(); ?> in <?php echo get_the_category_list( ', '); ?></span></p>
            </div>
          </div>
          <div class="genric-content">
          <?php the_content(); ?>
          </div>
    
  <?php }

  get_footer();

?>
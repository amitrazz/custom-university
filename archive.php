<?php get_header(); ?>

  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large"><?php the_archive_title(); ?></h1>
      <h2 class="headline headline--medium"><?php the_archive_description(); ?></h2>
    </div>
  </div>

   <div class="container container--narrow page-section">
      <?php
      while(have_posts()){
        the_post(); ?>
          <div class="post-item">
          <h2 class="headline headline--medium headline--post-title" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
        <p class="metabox">Posted by <?php the_author_posts_link(); ?> On <?php echo get_the_date(); ?> in <?php echo get_the_category_list( ', '); ?></p>
         
          </div>
          <div class="genric-content">
          <?php the_excerpt(50); ?>
         <p> <a  class="btn btn--blue" href="<?php the_permalink(); ?>">Continue Reading &raquo;</a> </p>

          </div>
      <?php } 
      echo paginate_links();
      ?>

   </div>

  <?php get_footer();?>
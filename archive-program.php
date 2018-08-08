<?php get_header(); ?>

  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Find all Programs</h1>
      <h2 class="headline headline--medium">There is somethings for every one look around</h2>
    </div>
  </div>

   <div class="container container--narrow page-section">
      <ul class="link-list min-list">
      <?php
      while(have_posts()){
        the_post(); ?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php } 
      echo paginate_links();
      ?>

      </ul>
   </div>

  <?php get_footer();?>
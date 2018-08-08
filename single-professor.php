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
        <div class="genric-content">
          <div class="row group">
            <div class="one-third">
            <?php the_post_thumbnail(); ?>
            </div>
            <div class="two-third">
            <?php the_content(); ?>
            </div>
          </div>
          </div>
          <?php  
          $relatedPrograms  = get_field('related_programs');
          if($relatedPrograms){
            echo "<hr class='section-break'>";
            echo "<h2 class='headline headline-medium'>Reltaed Programs</h2>";
            echo "<ul class='link-list min-list'>";
            foreach($relatedPrograms as $program){  ?>
                <li><a href="<?php echo get_the_permalink( $program); ?>"><?php echo get_the_title( $program ); ?></a> </li>
  
        <?php  } 
        echo "</ul>";
          }
        
      ?> 
      
  <?php }

  get_footer();

?>
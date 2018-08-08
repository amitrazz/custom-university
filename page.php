<?php

  get_header();

  while(have_posts()) {
    the_post(); ?>
     <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>Have to set custom sub title field.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <?php 
    $parent_post_id = wp_get_post_parent_id( get_the_ID());
    if(wp_get_post_parent_id( get_the_ID())){
    ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php the_permalink($parent_post_id); ?>">
      <i class="fa fa-home" aria-hidden="true"></i> <?php echo get_the_title($parent_post_id); ?>  </a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
    <?php
    }
    ?>
    
    <?php 
    $pagesArray = get_pages(array(
      'child_of' => get_the_ID()
    ));
    if($parent_post_id || $pagesArray ){  ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php the_permalink( $parent_post_id );  ?> "><?php echo get_the_title( $parent_post_id ); ?></a></h2>
      <ul class="min-list">
        <?php  
        if($parent_post_id){
          $childOf  = $parent_post_id;
        }else{
          $childOf  =  get_the_ID();
        }
        wp_list_pages(array(
          'title_li'  => NULL,
          'child_of'  => $childOf,
          'sort_column' => 'menu_order'

        ));
        ?>
      </ul>
    </div>
    <?php } ?>

    <div class="generic-content">
     <?php the_content();  ?>
    </div>

  </div>
    
  <?php }

  get_footer();

?>
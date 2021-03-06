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
              <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'program' ); ?>">
              <i class="fa fa-home" aria-hidden="true"></i> All Program</a> <span class="metabox__main"><?php the_title(); ?></span></p>
            </div>
          </div>
          <div class="genric-content">
          <?php the_content(); ?>
          <?php

            $relatedProfessor = new WP_Query(array(
              'posts_per_page' => -1,
              'post_type'      => 'professor',
              'oederBy'       =>  'title',
              'ordder'        => 'ASC',
              'meta_query'    =>  array(
                array(
                  'key'     => 'related_programs',
                  'compare' =>  'LIKE',
                  'value'   => '"'. get_the_ID().'"'
                )
              )
            ));
            if($relatedProfessor->have_posts()){
            echo '<hr class="section-break"';
            echo '<h2 class="headline headline--medium"> ' . get_the_title() . ' professor(s). <h2>';
            while($relatedProfessor->have_posts()){
              $relatedProfessor->the_post(); 
              ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>
            <?php } 
            }

            wp_reset_postdata();
        $today = date('Ymd');
        $homePageEvent = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type'      => 'event',
            'meta_key'      =>  'event_date',
            'oederBy'       =>  'meta_value_num',
            'ordder'        => 'ASC',
            'meta_query'    =>  array(
              array(
                'key'     =>  'event_date',
                'compare' =>  '>=',
                'value'   => $today,
                'type'    => 'numeric'
              ),
              array(
                'key'     => 'related_programs',
                'compare' =>  'LIKE',
                'value'   => '"'. get_the_ID().'"'
              )
            )
        ));
        if($homePageEvent->have_posts()){
          echo '<hr class="section-break"';
        echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' events. <h2>';
        while($homePageEvent->have_posts()){
            $homePageEvent->the_post(); 
            ?>
            <div class="event-summary">
          <a class="event-summary__date t-center" href="#">
            <span class="event-summary__month"><?php 
            $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('M');
            ?></span>
            <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php if(has_excerpt()){
              the_excerpt();
            }else{
              echo wp_trim_words( get_the_content(), 10);
            } ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
        <?php } 
        }
        ?>
        
          </div>
    
  <?php }

  get_footer();

?>
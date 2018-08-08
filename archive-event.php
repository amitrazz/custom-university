<?php get_header(); ?>

  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Find all Events</h1>
      <h2 class="headline headline--medium">Enjoy events based on your choise.</h2>
    </div>
  </div>

   <div class="container container--narrow page-section">
      <?php
      while(have_posts()){
        the_post(); ?>
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
            <p><?php echo wp_trim_words( get_the_content(), 10); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
      <?php } 
      echo paginate_links();
      ?>
      <div class="section-break">
      <p>Looking for recap past events. <a href="<?php echo site_url( '/past-events'); ?>">Check out our past events Archive</a> </p>      
      </div>
   </div>

  <?php get_footer();?>
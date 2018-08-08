<?php get_header(); ?>

  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Paast Events</h1>
      <h2 class="headline headline--medium">Recap our past events</h2>
    </div>
  </div>

   <div class="container container--narrow page-section">
      <?php
      $today = date('Ymd');
      $pastEvent = new WP_Query(array(
          'paged'           =>  get_query_var( 'paged', 1 ),
          'post_type'      => 'event',
          'meta_key'      =>  'event_date',
          'oederBy'       =>  'meta_value_num',
          'ordder'        => 'ASC',
          'meta_query'    =>  array(
            array(
              'key'     =>  'event_date',
              'compare' =>  '<',
              'value'   => $today,
              'type'    => 'numeric'
            )
          )
      ));
      while($pastEvent->have_posts()){
        $pastEvent->the_post(); ?>
          <div class="event-summary">
          <a class="event-summary__date t-center" href="#">
            <span class="event-summary__month"><?php 
            $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('M');
            ?></span>
            <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php get_post_type_archive_link('event'); ?>"><?php the_title(); ?></a></h5>
            <p><?php echo wp_trim_words( get_the_content(), 10); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
      <?php } 
      echo paginate_links(array(
          'total'   =>  $pastEvent->max_num_pages
      ));
      ?>

   </div>

  <?php get_footer();?>
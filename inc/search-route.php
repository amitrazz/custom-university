<?php

add_action( 'rest_api_init','university_register_search');
function university_register_search(){
    register_rest_route( 'university/v1', 'search', array(
        'methods'   => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResult'
    ) );
}
function universitySearchResult($data){
    $mainQuery = new WP_Query( array(
        'post_type' => array(
            'post','page','professor','event','program'
        ),
        's'         => sanitize_text_field( $data['term'] )
    ));
    $results = array(
        'genral_info'   => array() ,
        'professor'     => array(),
        'event'         =>  array(),
        'program'       => array() 
    );
    while($mainQuery->have_posts()){
        $mainQuery->the_post();
        if(get_post_type() == 'post' OR get_post_type() == 'page'){
            array_push($results['genral_info'],array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'post_type' =>  get_post_type(),
                'author'    =>  get_the_author()
            ));
        }
        if(get_post_type() == 'professor' ){
            array_push($results['professor'],array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'image'     => get_the_post_thumbnail_url( 0, 'professorLandscape')
            ));
        }
        if(get_post_type() == 'event'){
            $eventDate = new DateTime(get_field('event_date'));  
            $discription = null;
            if(has_excerpt()){
              $discription =  get_the_excerpt();
              }else{
                $discription = wp_trim_words( get_the_content(), 10);
              }          
            array_push($results['event'],array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'month'     =>  $eventDate->format('M'),
                'day'       =>  $eventDate->format('d'),
                'discription'=> $discription
            ));
        }
        if(get_post_type() == 'program'){
            array_push($results['program'],array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
        
       
    }
    return $results;
}
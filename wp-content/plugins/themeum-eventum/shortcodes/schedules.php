<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_schedules_listing', function($atts, $content = null){
  	extract(shortcode_atts(array(
    	'schedules' 	=>	'',
    	'class' 		=>	''
    	), $atts));

  	$output = ''; 
  	global $post;

  	$args = array(
      'post_type' => 'schedule',
      'name' => $schedules,
      'order' => 'ASC',
      'posts_per_page' => -1
    );

  	$schedule = new WP_Query($args);


  		if ( $schedule->have_posts() ){ 
			while($schedule->have_posts()) {
				$schedule->the_post();


				$date_of_event = get_post_meta(get_the_ID(),'themeum_date_of_event',true);
				$event_info_group = get_post_meta(get_the_ID(),'event_info_group',true);


				   $output .= '<div class="eventum-schedules layout-addon schedules-list ' . esc_attr($class) .'">';
					   $output .= '<div class="eventum-schedule">';
					      $output .= '<div class="row">';
					         $output .= '<div class="col-xs-3 col-sm-2">';
					            $output .= '<div class="scedule-date">'.$date_of_event.'</div>';
					         $output .= '</div>';
					         $output .= '<div class="col-xs-9 col-sm-10">';
					            $output .= '<div class="table-responsive">';
					               $output .= '<table class="table table-hover">';
					                  $output .= '<thead>';
					                     $output .= '<tr>';
					                        $output .= '<th>#</th>';
					                        $output .= '<th>'.esc_html__("Session","themeum-eventum").'</th>';
					                        $output .= '<th>'.esc_html__("Speaker(s)","themeum-eventum").'</th>';
					                        $output .= '<th>'.esc_html__("Time","themeum-eventum").'</th>';
					                        $output .= '<th>'.esc_html__("Venue","themeum-eventum").'</th>';
					                     $output .= '</tr>';
					                  $output .= '</thead>';
					                  $output .= '<tbody>';

					                  		$i = 1;
							                foreach( $event_info_group as $value ){
							                	$output .= '<tr>';
							                        $output .= '<td>'.esc_attr( $i ).'</td>';



							                        $output .= '<td width="40%">';
							                        if(isset( $value["themeum_session_link"] )){ 
														if( $value["themeum_session_link"] != '' ){
															$output .= '<a href="'.$value["themeum_session_link"].'">';
														}
													}
							                        $output .= esc_attr( $value["themeum_session"] );
							                        if(isset( $value["themeum_session_link"] )){ 
														if( $value["themeum_session_link"] != '' ){
															$output .= '</a>';
														}
													}
							                        $output .= '</td>';

							                        $output .= '<td width="25%">';
								                                if(is_array($value["themeum__speaker"])){
								                                		if(!empty($value["themeum__speaker"])){
								                                      	$xi = 1;
								                                    		foreach($value["themeum__speaker"] as $osm){
								                                          if($xi>1){ $output .= ' , '; }
								                                        		$output .= '<a class="speaker" href="'.get_permalink( esc_attr( $osm ) ).'">'.get_the_title( esc_attr( $osm ) ).'</a> ';
								                                          $xi++;
								                                        }
								                                    }
								                                }
      							            		$output .= '</td>';
							                        $output .= '<td width="20%">'.esc_attr( $value["themeum__time"] ).'</td>';
							                        $output .= '<td>'.esc_attr( $value["themeum_venue"] ).'</td>';
							                    $output .= '</tr>';
							                    $i++;
							                }
					                     
					                  $output .= '</tbody>';
					               $output .= '</table>';
					            $output .= '</div>';
					        $output .= '</div>';
					      $output .= '</div>';
					   $output .= '</div>';//eventum-schedule
				   $output .= '</div>';//eventum-schedules

			}
        
      wp_reset_query();
			
		}


	return $output;
}); 



function themeum_list_schedules(){

	$projects = get_posts( array(
	    'posts_per_page'   => -1,
	    'orderby'          => 'post_date',
	    'order'            => 'DESC',
	    'post_type'        => 'schedule',
	    'post_status'      => 'publish',
	    'suppress_filters' => true 
	) );
	$list_schedules = array();

	foreach ($projects as $post) {
	    $list_schedules[$post->post_name] = $post->post_title;
	}
	$list_schedules = array_flip( $list_schedules );

	return $list_schedules;
}


//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => esc_html__("Schedules Listing", "themeum-eventum"),
    "base" => "themeum_schedules_listing",
    'icon' => 'icon-thm-schedules-listing',
    "class" => "",
    "description" => esc_html__("Schedules Listing", "themeum-eventum"),
    "category" => esc_html__('Themeum', "themeum-eventum"),
    "params" => array(        


	array(
        "type" => "dropdown",
        "heading" => esc_html__("Select Schedules","themeum-eventum"),
        "param_name" => "schedules",
        "value" => themeum_list_schedules(), 
    ),


    array(
        "type" => "textfield",
        "heading" => esc_html__("Custom Class", "themeum-eventum"),
        "param_name" => "class",
        "value" => "",
    ),

    )

    ));
}






<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_schedules_tab_listing', function($atts, $content = null){
  	extract(shortcode_atts(array(
    	'schedules' 	=>	'',
    	'class' 		=>	'',
    	'types'			=>	'1'
    	), $atts));

  	$output = ''; 
  	global $post;



  	// Find Out Total ID List
  	$id_list = array();

  	$list = explode(',', $schedules);

	if(is_array( $list )){
	  	foreach ($list as $value) {
	  		$args = array(
	              'post_type' => 'schedule',
	              'name' => $value,
	              'order' => 'ASC',
		        );
		    $ids = new WP_Query($args);

		    if ( $ids->have_posts() ) { 
		        while($ids->have_posts()) {
		            $ids->the_post();
		            $id_list[] = get_the_ID();
		        }
		    }
	  	}
	}	

  	
  	// Include ID get all Post Data
  	$args = array(
              'post_type' => 'schedule',
              'post__in' => $id_list,
              'order' => 'ASC',
        );
    $schedule = new WP_Query($args);




	$control = array();
	$data = array();

			
	$i = 0;
		if ( $schedule->have_posts() ){ 
		while($schedule->have_posts()) {
			$schedule->the_post();
			$date_of_event = get_post_meta(get_the_ID(),'themeum_date_of_event',true);
			
			$arr = $arr2 = '';
			if( $i == 0 ){
				$arr = '<li role="presentation" class="active">';
			}else{
				$arr = '<li role="presentation">';
			}

			preg_match("'<span>(.*?)</span>'si", $date_of_event , $match);
			$title1 = '';
			if( isset( $match[1] ) ){
				$title1 = $match[1];
			}else{
				$title1 = '';
			}
			$title2 = preg_replace( '/<[^>]*>[^<]*<[^>]*>/' , '', $date_of_event );

		         $arr .= '<a href="#event-scehdule-'.esc_attr($i).'" aria-controls="event-scehdule-'.esc_attr($i).'" role="tab" data-toggle="tab" aria-expanded="true">';
		         $arr .= '<span class="scedule-date">';
		         $arr .= '<span class="scedule-date-day">'.esc_attr($title2).'</span>';
		         $arr .= esc_attr($title1).'</span>';
		         $arr .= '</a>';
		    $arr .= '</li>';




		    
		    if( $i == 0 ){
				$arr2 .= '<div role="tabpanel" class="tab-pane fade active in" id="event-scehdule-'.esc_attr($i).'">';
			}else{
				$arr2 .= '<div role="tabpanel" class="tab-pane fade" id="event-scehdule-'.esc_attr($i).'">';
			}
		        $arr2 .= '<div class="eventum-schedules layout-addon schedules-list">';
			        $arr2 .= '<div class="eventum-schedule">';
				        $arr2 .= '<div class="table-responsive">';
				            $arr2 .= '<table class="table table-hover">';
				               $arr2 .= '<thead>';
				                     $arr2 .= '<tr>';
				                        $arr2 .= '<th>#</th>';
				                        $arr2 .= '<th>'.esc_html__("Session","themeum-eventum").'</th>';
				                        $arr2 .= '<th>'.esc_html__("Speaker(s)","themeum-eventum").'</th>';
				                        $arr2 .= '<th>'.esc_html__("Time","themeum-eventum").'</th>';
				                        $arr2 .= '<th>'.esc_html__("Venue","themeum-eventum").'</th>';
				                     $arr2 .= '</tr>';
				               $arr2 .= '</thead>';
				               $arr2 .= '<tbody>';
				                  
				                  	$ix = 1;
				                  	$event_info_group = get_post_meta(get_the_ID(),'event_info_group',true);

					                foreach( $event_info_group as $value ){
					                	$arr2 .= '<tr>';
					                        $arr2 .= '<td>'.esc_attr($ix).'</td>';
					                        

					                        $arr2 .= '<td width="40%">';
					                        if(isset( $value["themeum_session_link"] )){ 
												if( $value["themeum_session_link"] != '' ){
													$arr2 .= '<a href="'.$value["themeum_session_link"].'">';
												}
											}
					                        $arr2 .= esc_attr( $value["themeum_session"] );
					                        if(isset( $value["themeum_session_link"] )){ 
												if( $value["themeum_session_link"] != '' ){
													$arr2 .= '</a>';
												}
											}
					                        $arr2 .= '</td>';

					                        if(isset($value["themeum__speaker"])){
					                        $arr2 .= '<td>';
						                                if(is_array($value["themeum__speaker"])){
						                                		if(!empty($value["themeum__speaker"])){
						                                      	$xi = 1;
						                                    		foreach($value["themeum__speaker"] as $osm){
						                                          if($xi>1){ $arr2 .= ' , '; }
						                                        		$arr2 .= '<a class="speaker" href="'.get_permalink( esc_attr( $osm ) ).'">'.get_the_title( esc_attr( $osm ) ).'</a> ';
						                                          $xi++;
						                                        }
						                                    }
						                                }
      							            $arr2 .= '</td>';
      							        	}
					                        $arr2 .= '<td>'.esc_attr( $value["themeum__time"] ).'</td>';
					                        $arr2 .= '<td class="venue">'.esc_attr( $value["themeum_venue"] ).'</td>';
					                    $arr2 .= '</tr>';
					                    $ix++;
					                }
				                  
				               $arr2 .= '</tbody>';
				            $arr2 .= '</table>'; 
				        $arr2 .= '</div>';
			        $arr2 .= '</div>';
		        $arr2 .= '</div>';
		    $arr2 .= '</div>';



			$control[] = $arr;
			$data[] = $arr2;
			$i++;
		}
    
    wp_reset_query();
	}


	if( $types == 1  || $types == 3 ){
		// Master Template
    $output .= '<div class="schedules-layout-tabbed">';
	    if ( $types == 1 ) {
	    	$output .= '<div class="eventum-schedules layout-tabbed">';
	    } else {
	    	$output .= '<div class="eventum-schedules layout-tabbed layout-tabbed2">';
	    }
		   $output .= '<ul class="events-nav" role="tablist">';
		   		foreach ( $control as $value ) {
		   		 	$output .= $value;
		   		}		
		   $output .= '</ul>';
		$output .= '</div>';
	}


	$output .= '<div class="tab-content">';
		foreach ( $data as $value ) {
	   		$output .= $value;
	   	}
	$output .= '</div>';
  
  if( $types == 1 || $types == 3 ) {
		$output .= '</div>';
	}

	return $output;
}); 




//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => esc_html__("Schedules Listing 2", "themeum-eventum"),
    "base" => "themeum_schedules_tab_listing",
    'icon' => 'icon-thm-schedules-tab-listing',
    "class" => "",
    "description" => esc_html__("Schedules Listing", "themeum-eventum"),
    "category" => esc_html__('Themeum', "themeum-eventum"),
    "params" => array(        

	    array(
	        "type" => "dropdown",
	        "heading" => esc_html__("Type", "themeum-eventum"),
	        "param_name" => "types",
	        "value" => array('Select'=>'','Single View'=>'2','Tab View'=>'1','Tab View 2'=>'3'),
	        ),
		
		array(
	        "type" => "textfield",
	        "heading" => esc_html__("Put Here Schedule Slug", "themeum-eventum"),
	        "param_name" => "schedules",
	        "description" => esc_html__("Schedules specify by comma, eg: schedule1,schedule2,schedule3", "themeum-eventum"),
	        "value" => "",
	    ),    

    )

    ));
}






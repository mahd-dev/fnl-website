<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_speaker_page_listing', function($atts, $content = null){
  	extract(shortcode_atts(array(
    	'count_post' 	=>	6,
    	'column'		=>	4,
    	'class' 		=>	'',
    	'speaker_cat'	=>  'themeumall',
    	), $atts));


  	global $post;
  	$args = array();


  	if( $speaker_cat == 'themeumall' ){
  		$args = array(
			      'post_type' => 'speaker',
			      'order' => 'DESC',
			      'posts_per_page' => esc_attr($count_post)
			    );
  	}else{
	  		$args = array(
			      'post_type' => 'speaker',
			      'order' => 'DESC',
			      'tax_query' => array(
			            array(
			                'taxonomy' => 'speaker_cat',
			                'field'    => 'slug',
			                'terms'    => esc_attr($speaker_cat),
			                ),
			            ),
			      'posts_per_page' => esc_attr($count_post)
			    );
  	}

  	

  	$speakers = new WP_Query($args);


  	$output = '<div class="themeum-speaker-listing ' . esc_attr($class) .'">';

  		if ( $speakers->have_posts() ){
			$x = 1;
			while($speakers->have_posts()) {
				$speakers->the_post();
				if( $x == 1 ){
			    	$output .= '<div class="row">';	
			    }
				$designation = get_post_meta(get_the_ID(),'themeum_designation',true);
				$facebook = get_post_meta(get_the_ID(),'themeum_facebook_url',true);
				$soundcloud = get_post_meta(get_the_ID(),'themeum_soundcloud_url',true);
				$twitter = get_post_meta(get_the_ID(),'themeum_twitter_url',true);
				$dribbble = get_post_meta(get_the_ID(),'themeum_dribbble_url',true);
				$flickr = get_post_meta(get_the_ID(),'themeum_flickr_url',true);
				$google = get_post_meta(get_the_ID(),'themeum_google_url',true);
				$pinterest = get_post_meta(get_the_ID(),'themeum_pinterest_url',true);
				$youtube = get_post_meta(get_the_ID(),'themeum_youtube_url',true);
				$linkedin = get_post_meta(get_the_ID(),'themeum_linkedin_url',true);
				$behance = get_post_meta(get_the_ID(),'themeum_behance_url',true);
				$vk = get_post_meta(get_the_ID(),'themeum_vk_url',true);
				$skype = get_post_meta(get_the_ID(),'themeum_skype_url',true);
				$instagram = get_post_meta(get_the_ID(),'themeum_instagram_url',true);

				$output .= '<div class="col-xs-12 col-sm-6 col-md-'.esc_attr( $column ).'">';

				$output .= '<div class="sp-speaker">';
					$output .= '<div class="speaker-image">';
						$output .= '<div class="speaker-image-wrapper">';
							if (has_post_thumbnail( $post->ID ) ): 
							  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'speaker-thumb' );
							  $output .= '<img class="img-responsive" src="'.esc_url( $image[0] ).'" alt="'.get_the_title().'">';
							endif;

							$output .= '<div class="social-icons">';
								$output .= '<ul class="social-links-4">';
									$count = 1;
									
									if( ( $facebook != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-facebook" href="'.esc_url( $facebook ).'"><i class="fa fa-facebook"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $soundcloud != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr($count).'">';
											$output .= '<a target="_blank" class="social-soundcloud" href="'.esc_url( $soundcloud ).'"><i class="fa fa-soundcloud"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $twitter != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-twitter" href="'.esc_url( $twitter ).'"><i class="fa fa-twitter"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $dribbble != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-dribbble" href="'.esc_url( $dribbble ).'"><i class="fa fa-dribbble"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $flickr != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-flickr" href="'.esc_url( $flickr ).'"><i class="fa fa-flickr"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $google != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-google-plus" href="'.esc_url( $google ).'"><i class="fa fa-google-plus"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $pinterest != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-pinterest" href="'.esc_url( $pinterest ).'"><i class="fa fa-pinterest"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $youtube != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-youtube" href="'.esc_url( $youtube ).'"><i class="fa fa-youtube"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $linkedin != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-linkedin" href="'.esc_url( $linkedin ).'"><i class="fa fa-linkedin"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $behance != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-behance" href="'.esc_url( $behance ).'"><i class="fa fa-behance"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $vk != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-vk" href="'.esc_url( $vk ).'"><i class="fa fa-vk"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $skype != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-skype" href="'.esc_url( $skype ).'"><i class="fa fa-skype"></i></a>';
										$output .= '</li>';
									$count++;
									}
									if( ( $instagram != '' )&&( $count <= 4 ) ){
										$output .= '<li class="social-'.esc_attr( $count ).'">';
											$output .= '<a target="_blank" class="social-instagram" href="'.esc_url( $instagram ).'"><i class="fa fa-instagram"></i></a>';
										$output .= '</li>';
									$count++;
									}
								$output .= '</ul>';
							$output .= '</div>';
						$output .= '</div>';

					$output .= '</div>';
					$output .= '<h4 class="speaker-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
					$output .= '<p class="speaker-designation">'.esc_attr( $designation ).'</p>';
				$output .= '</div>';

				$output .= '</div>';

				if( $x == (12/$column) ){
					$output .= '</div>'; //row	
					$x = 1;	
				}else{
					$x++;	
				}
			}

			wp_reset_query();

			if($x !=  1 ){
				$output .= '</div>'; //row	
			}	
		}
		$output .= '</div>'; //themeum-speaker-listing 	

	return $output;
     
}); 

//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => esc_html__("Speaker Listing", "themeum-eventum"),
    "base" => "themeum_speaker_page_listing",
    'icon' => 'icon-thm-speaker-listing',
    "class" => "",
    "description" => esc_html__("Speaker Listing", "themeum-eventum"),
    "category" => esc_html__('Themeum', "themeum-eventum"),
    "params" => array(        


	array(
		"type" => "dropdown",
		"heading" => esc_html__("Category Filter", 'themeum-eventum'),
		"param_name" => "speaker_cat",
		"value" => themeum_cat_list('speaker_cat'),
	),	

    array(
        "type" => "textfield",
        "heading" => esc_html__("Number Of Post Show", "themeum-eventum"),
        "param_name" => "count_post",
        "value" => "6",
    ),        

	array(
		"type" => "dropdown",
		"heading" => esc_html__("Number Of Column", "themeum-eventum"),
		"param_name" => "column",
		"value" => array('column 2'=>'6','column 3'=>'4','column 4'=>'3'),
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






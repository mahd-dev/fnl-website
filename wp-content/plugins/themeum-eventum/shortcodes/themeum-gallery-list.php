<?php
add_shortcode( 'themeum_gallery_list', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'number_of_gallery' 	=> '',
        'column'                => 6,
        'limit'                 => 4,
        'empty_space'           => '',
        'class'                 => ''
		), $atts));

	$output = '';
    $empty_line ='';

    global $post;

    $post_ids = array();

    if($empty_space) 
        $empty_line .= 'margin:' . (int) esc_attr( $empty_space )  . 'px;'; 

    $posts = get_posts(
        array(
            'p' => esc_attr($number_of_gallery),
            'post_type'         => 'gallery', 
            'posts_per_page'    => 1
            )
        );

    $output  = '<div class="themeum-gallery-list">';

    if ( count($posts) ) {
        

        foreach ($posts as $post) {
            setup_postdata( $post );

            $photos = get_post_meta(get_the_ID(), 'themeum_event_gallery');

            $slices = (count($photos) > $limit) ? array_slice($photos, 0, $limit , true ) : $photos;
            
            $x = 1;
            $i = 1;
            $count = count($slices);
            if($count >= 2){
                foreach ($slices as $key=>$photo) {
                        $photo_thumb = wp_get_attachment_image_src( $photo, 'gallery-medium' );
                        $photo_thumb_full = wp_get_attachment_image_src( $photo, 'full_url' );
                    if($i <= 2){
                        if( $i == 1 ){
                            $output .= '<div class="row">'; 
                        }
                        $output .= '<div class="col-xs-12 col-sm-6 col-md-6 no-padding">';
                            $output .= '<div class="gallary-list-img">';
                                $output .= '<div class="photo ' . $class .'" style="'.$empty_line.'">';
                                    $output     .= '<a href="' . $photo_thumb_full[0] . '" class="plus-icon"><img src="' . $photo_thumb[0] . '" class="img-responsive" alt="" /></a>';
                                $output .= '</div>';//photo
                            $output .= '</div>';//conference-img
                        $output .= '</div>'; //col-xs-12 

                        if( $i == 2 ){
                            $output .= '</div>'; //row  
                        }
                    } else {
                        if( $x == 1 ){
                            $output .= '<div class="row">'; 
                        }
                        $output .= '<div class="col-xs-12 col-sm-6 col-md-'.esc_attr( $column ).' no-padding">';
                            $output .= '<div class="gallary-list-img">';
                                $output .= '<div class="photo ' . $class .'" style="'.$empty_line.'">';
                                    $output     .= '<a href="' . $photo_thumb_full[0] . '" class="plus-icon"><img src="' . $photo_thumb[0] . '" class="img-responsive" alt="" /></a>';
                                $output .= '</div>';//photo
                            $output .= '</div>';//conference-img
                        $output .= '</div>'; //col-xs-12 
                        if( $x == (12/$column) ){
                            $output .= '</div>'; //row  
                            $x = 1; 
                        }else{
                            $x++;   
                        }
                    }
                    $i++;
                }

            }
        }

        wp_reset_postdata();        
    }

    $output .= '</div>';

 
	return $output;

});


    add_action( 'init', function(){

    $projects = get_posts( array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_type'        => 'gallery',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    ) );

    $gallery_list = array();

    foreach ($projects as $post) 
    {
        $gallery_list[$post->ID] = $post->post_title;
    }

    $gallery_list = array_flip( $gallery_list );


#Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
    vc_map(array(
    	"name" => __("Gallery List", "themeum-eventum"),
    	"base" => "themeum_gallery_list",
    	'icon' => 'icon-thm-title',
    	"class" => "",
    	"description" => __("Widget Project", "themeum-eventum"),
    	"category"     => __('Themeum', "themeum"),
    	"params" => array(

            	array(
                    "type"          => "dropdown",
                    "heading"       => __("Project Name","themeum-eventum"),
                    "param_name"    => "number_of_gallery",
                    "description"   => __("Select your Gallery List", "themeum-eventum"),
                    "value"         => $gallery_list, 
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Number Of Column", "themeum-eventum"),
                    "param_name"    => "column",
                    "value"         => array('Select'=>'','column 2'=>'6','column 3'=>'4','column 4'=>'3'),
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => __("Limit"),
                    "param_name"    => "limit",
                    "value"         => "",
                    "description"   => "Please enter the maximum number of audio files. eg. 12"
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Image Margin", 'themeum-eventum'),
                    "param_name"    => "empty_space",
                    "value"         => array('Select'=>'','5'=>'5px','10'=>'10px','15'=>'15px','20'=>'20px','30'=>'30px'),
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => __("Custom Class ", "themeum-eventum"),
                    "param_name"    => "class",
                    "value"         => "",
                )   

    		)
    	));
    }
});
<?php

if ( ! function_exists( 'themeum_cat_list' ) ) {

        // List of Group
        function themeum_cat_list( $category ){
            global $wpdb;
            $sql = "SELECT * FROM `".$wpdb->prefix."term_taxonomy` INNER JOIN `".$wpdb->prefix."terms` ON `".$wpdb->prefix."term_taxonomy`.`term_taxonomy_id`=`".$wpdb->prefix."terms`.`term_id` AND `".$wpdb->prefix."term_taxonomy`.`taxonomy`='".$category."'";
            $results = $wpdb->get_results( $sql );

            $cat_list = array();
            $cat_list['All'] = 'themeumall';  
            if(is_array($results)){
                foreach ($results as $value) {
                    $cat_list[$value->name] = $value->slug;
                }
            }
            return $cat_list;
        }

}
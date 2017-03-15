<?php

/**
  * This function outputs the SEO for an image.
  * Works with ACF
 **/
function image_seo($img){

	if($img['alt'] !== ''){

		$alt = $img['alt'];
	
	}else{

		$alt = get_the_title() . ' | ' . get_bloginfo('name');
	}

	if($img['title'] !== ''){

		$title = $img['title'];
	
	}else{

		$title = get_the_title() . ' | ' . get_bloginfo('name');
	}

	echo 'title="'.$title.'" alt="'.$alt.'"';
}

/*
 * Add Post view count functionality to Theme
 * Source code can be found here:
 * http://wpsnipp.com/index.php/functions-php/track-post-views-without-a-plugin-using-post-meta/#
 *
 * To use this function use: setPostViews(get_the_ID());
 * within a single wordpress loop to store the count
 *
 * To Display, use: echo getPostViews(get_the_ID());
 */
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

?>
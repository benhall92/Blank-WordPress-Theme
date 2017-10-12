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

    return 'title="'.$title.'" alt="'.$alt.'"';
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


/*
 * Output text to an html element.
 * This function will check if any text exists before outputting.
 * This prevents the need to use messy if codes.
 *
 * @param   $copy   string   This is the copy to be output
 * @param   $tag    string   This is the HTML element
 */

function output_text($copy, $tag = false, $classes = false) {

    // if( $tag == "" || $tag == false || $tag == null ){

    //     return;
    // }

    if( $copy == "" || $copy == false || $copy == null ){

        return;
    }

    if ( $classes != "" || $classes != false ) {

        $class = ' class="'.$classes.'" ';
    
    }else{

        $class = "";
    }

    if( !$tag ){

        echo $copy;

    }else{

        echo '<'.$tag. $class.'>'.$copy.'</'.$tag.'>';

    }
}

/*
 * Output text to an html element.
 * This function will check if any text exists before outputting.
 * This prevents the need to use messy if codes.
 *
 * @param   $copy   string   This is the copy to be output
 * @param   $tag    string   This is the HTML element
 */

function output_link($copy, $link = "#", $target = false, $title = false, $wrap = false) {

    $title_text = "";
    $target_text = "";

    if( $link == "" || $link == false || $link == null ){

        return;
    }

    if( $copy == "" || $copy == false || $copy == null ){

        return;
    }

    if( $title != false ){

        $title_text = 'title="'.$title.'"';
    }

    if( $target != false ){

        $target_text = 'target="'.$target.'"';
    }

    if ( $wrap != false ) {
        
        echo '<'.$wrap.'>';
    }

    echo '<a href="'.$link.'" '.$target_text.' '.$title_text.' >'.$copy.'</a>';

    if ( $wrap != false ) {
        
        echo '</'.$wrap.'>';
    }
}

/*
 * Output img as an html element.
 * This function will check if an img url exists
 * then it will output the image.
 * This prevents the need to use messy if codes.
 *
 * @param   $img    string   An ACF (or equivalent) img object
 */

function output_img($img) {

    $url = $img['url'];

    if( $url == "" || $url == false || $url == null ){

        return;
    
    }else{

        echo '<img src="'.$url.'" '.image_seo($img).' />';
    }

}

?>
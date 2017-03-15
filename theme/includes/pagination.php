<?php

/* CUSTOM PAGINATION FUNCTION
 *
 * This function will output pagination for any post type.
 * This can be used outside the loop as it uses the get_pagenum_link()
 * function that's built in to WordPress to generate links
 *
 * @param $posts - 			This is the number of posts that you are currently displaying.
 * 							This is used to calculate how many pages should be visisble
 *
 * @ param $displayed - 	This is the number of posts that you want to display per page
 *
 * @ param $links_total - 	This is the number of links to show either side of the current
 *							page.
 *
 */
function display_pagination($posts, $displayed, $links_total='4') {

	// Retrieves the current page.
	// By default page one equals 0, therefore this check will
	// make it equal to 1 if the page number retrieved is 0
	$current_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	// If there is a remainder we need to add an
	// extra page to the pagination to reflect this
	if( $posts % $displayed !== 0 ):

		$remainder = $posts % $displayed;
		$pages = (($posts - $remainder) / $displayed) + 1;

	else:
	// If there is not a remainder just do a simple divide
		$pages = $posts / $displayed;

	endif;

	// Define previous and next pages
	$previous = 	$current_page - 1;
	$next = 		$current_page + 1;

	// If the number of pages to show before the
	// current page goes below 1, $count_min should equal 1
	$count_min = 	(($current_page - $links_total) < 1) ? 1 : $current_page - $links_total;

	// If the number of pages to show after the
	// current page goes above the number of pages in total,
	// $count_max should equal the total
	$count_max = 	(($current_page + $links_total) > $pages) ? $pages : $current_page + $links_total;

	// This is where we start building the pagination
	// Add an optional paramter to the function to insert custom classes
	$pagination = 	'<ul class="pagination">';

	// If we are not on the first page, add a back to beginning link
	if( $current_page != 1 ){
		$pagination .= 	'<li><a href="'.get_pagenum_link(1).'">&laquo;</a><li>';
	}

	// Only show a previous button if we can still go back one page
	if( $previous >= 1 ){

		$pagination .= '<li><a href="'.get_pagenum_link($previous).'">&lsaquo;</a><li>';
	}	

	// Loop through the number of pages and create a 
	// list item with the link to the page
	//
	// Start from the number that you determine before the 
	// current page
	// E.g. User specifies 3 pages should be specified before
	// and after the current page. Lets say the current page 
	// is page 5 and the number of pages equals 10. 
	// Our pagination would look like:
	// < 2 3 4 5 6 7 8 >
	for( $i = $count_min; $i <= $count_max; $i++):

		// Check if on the current page.
		// If we are, do not make it clickable
		if($i == $current_page):

			$pagination .= '<li class="current-page">
					<a href="javascript:void(0)">'.$i.'</a>
				</li>';

		else:

			$pagination .= '<li>
					<a href="'.get_pagenum_link($i).'">'.$i.'</a>
				</li>';
		endif;

	endfor;

	// Only show a next button if we can still progress one page
	if( $next <= $pages ){

		$pagination .= '<li><a href="'.get_pagenum_link($next).'">&rsaquo;</a><li>';
	}

	// If we are not on the last page add a go to end button
	if( $current_page != $pages ){

		$pagination .= '<li><a href="'.get_pagenum_link($pages).'">&raquo;</a><li>';
	}

	// Return the pagination
	return $pagination;
}

?>
<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Oakworld
 * @since Oakworld 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="grid">

	<div id="comments" class="comment grid__item float-left">

		<?php if ( have_comments() ) : ?>

			<h5 class="comments-title">Comments</h5>
			
			<div class="grid">
			
			<?php $comments = wp_list_comments( array('echo' => false) );

				for ($x = 0; $x <= $comments.length; $x++) {?>

					<div class="[ grid__item float-left ] comment__avatar" data-desk="desk-2-12">
						
						<?php 
							
							$authorEmail = comment_author();
							
							echo get_avatar( $comment, 60 );
						?>

					</div>

					<div class="grid__item float-left" data-desk="desk-10-12">
						
						<?php comment_text(); ?>

					</div>
	
				<?php } ?>

			</div>

		<?php endif; // have_comments() ?>

		
		<!-- If comments are closed and there are comments, let's leave a little note, shall we? -->
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			
			<p class="no-comments"><?php _e( 'Comments are closed.', 'oakworld' ); ?></p>

		<?php endif; ?>

		<?php

			$comments_args = array(
	        // change the title of send button 
	        'label_submit'=>'<button class="button button--primary">Leave Comment</button>',
	        // change the title of the reply section
	        'title_reply'=>'<h5>Leave a reply</h5>',
	        // remove "Text or HTML to be displayed after the set of comment fields"
	        'comment_notes_after' => '<button class="[ button button--primary ]" type="submit" id="submit-new">'.__('Leave Comment').'</button>',
	        // redefine your own textarea (the comment body)
	        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
			
			'fields'
			);

			$fields_args = array (

			);

			comment_form($comments_args);

		?>

	</div>

</div>
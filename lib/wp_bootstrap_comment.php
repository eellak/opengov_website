<?php

function bootstrapBasicComment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

	if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) { 
		echo '<li id="comment-';
			comment_ID();
			echo '" ';
			comment_class('comment-type-pt');
		echo '>';
		echo '<div class="comment-body media">';
			echo '<div class="media-body">';
				_e('Pingback:', 'bootstrap-basic');
				comment_author_link(); 
				edit_comment_link(__('Edit', 'bootstrap-basic'), '<span class="edit-link">', '</span>');
			echo '</div>';
		echo '</div>';
	} else {
		echo '<li id="comment-';
			comment_ID();
			echo '" ';
			comment_class(empty($args['has_children']) ? '' : 'parent media');
		echo '>';
		
		echo '<article id="div-comment-';
			comment_ID();
		echo '" class="comment-body media">';
		
			// footer
			echo '<footer class="comment-meta pull-left">';
				if (0 != $args['avatar_size']) {
					echo get_avatar($comment, $args['avatar_size']);
				}
			echo '</footer><!-- .comment-meta -->';
			// end footer
			
			// comment content
			echo '<div class="comment-content media-body">';
				echo '<div class="comment-author vcard">';
					echo '<div class="comment-metadata">';
					
					// date-time
					echo '<a href="';
						echo esc_url(get_comment_link($comment->comment_ID));
					echo '">';
					echo '<time datetime="';
						comment_time('c');
					echo '">';
					printf(_x('%1$s at %2$s', '1: date, 2: time', 'bootstrap-basic'), get_comment_date(), get_comment_time());
					echo '</time>';
					echo '</a>';
					// end date-time
					
					echo ' ';
					
					edit_comment_link('<span class="fa fa-pencil-square-o "></span>' . __('Edit', 'bootstrap-basic'), '<span class="edit-link">', '</span>');
					
					echo '</div><!-- .comment-metadata -->';

					// if comment was not approved
					if ('0' == $comment->comment_approved) {
						echo '<div class="comment-awaiting-moderation text-warning"> <span class="glyphicon glyphicon-info-sign"></span> ';
							_e('Your comment is awaiting moderation.', 'bootstrap-basic');
						echo '</div>';
					} //endif;
					
					// comment author says
					printf(__('%s <span class="says">says:</span>', 'bootstrap-basic'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link()));
				echo '</div><!-- .comment-author -->';
				
				// comment content body
				comment_text();
				// end comment content body
				
				// reply link
				comment_reply_link(array_merge($args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'reply_text' => '<span class="fa fa-reply"></span> ' . __('Reply', 'bootstrap-basic'),
					'login_text' => '<span class="fa fa-reply"></span> ' . __('Log in to Reply', 'bootstrap-basic')
				)));
				// end reply link
			echo '</div><!-- .comment-content -->';
			// end comment content
			
		
		
		echo '</article><!-- .comment-body -->';
	} //endif;
}// bootstrapBasicComment

?>
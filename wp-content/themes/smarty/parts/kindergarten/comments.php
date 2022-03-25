<?php
	if ( post_password_required() ) {
		return;
	}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h4 class="comments-title">
			<?php printf( _n( '%1$s comment', '%1$s comments', get_comments_number(), 'smarty' ), get_comments_number() ); ?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'smarty' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'smarty' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'smarty' ) ); ?></div>
			</nav><!-- /comment-nav-above -->
		<?php endif; ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'type' => 'comment',
					'callback' => 'smarty_comment',
					'avatar_size' => 87
				) );
			?>
		</ul><!-- /comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'smarty' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'smarty' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'smarty' ) ); ?></div>
			</nav><!-- /comment-nav-below -->
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'smarty' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(
			'author' =>
				'<div class="col-sm-6 col-xs-12 comment-form__info_box"><div class="row">' .
				'<div class="comment-form__author col-xs-12">' .
				'<input id="comment-author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Name', 'smarty' ) . '' . ( $req ? ' *' : '' ) . '" /></div>',

			'email' =>
				'<div class="comment-form__email col-xs-12">' .
				'<input id="comment-email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Email', 'smarty' ) . '' . ( $req ? ' *' : '' ) . '" /></div>',

			'url' =>
				'<div class="comment-form__url col-xs-12">' .
				'<input id="comment-url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" placeholder="' . esc_attr__( 'Website', 'smarty' ) . '" /></div>'.
				'</div></div>',
		);

		$args = array(
			'id_form'             => 'comment-form',
			'class_form'          => 'comment-form',
			'id_submit'           => 'comment-submit',
			'class_submit'        => 'comment-form__submit-button',
			'title_reply'         => esc_html__( 'Leave a comment', 'smarty' ),
			'title_reply_to'      => esc_html__( 'Leave a comment to %s', 'smarty' ),
			'title_reply_before'  => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'   => '</h4>',
			'cancel_reply_before' => ' <small class="comment-respond__cancel-replay">',
			'cancel_reply_after'  => '</small>',
			'cancel_reply_link'   => esc_html__( 'Cancel Reply to Brandon', 'smarty' ),
			'label_submit'        => esc_html__( 'Submit a Comment', 'smarty' ),
			'must_log_in' 		  => '<p class="must-log-in">' .
									 sprintf(
										 wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'smarty' ), array( 'a' => array( 'href' => array() ) ) ),
										 wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
									 ) . '</p>',
			'logged_in_as' 		  => '<p class="logged-in-as">' .
									  sprintf(
										  wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'smarty' ), array( 'a' => array( 'href' => array() ) ) ),
										  admin_url( 'profile.php' ),
										  $user_identity,
										  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
									  ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields' 			   => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field' 	   => '<div class="comment-form__comment col-sm-6 col-xs-12">' .
									  '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'. esc_attr__( 'Message', 'smarty' ) .'' . ( $req ? ' *' : '' ) . '">' .
				                      '</textarea></div>',
			'submit_button' 	   => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
			'submit_field' 		   => '<div class="col-sm-12 col-xs-12"><div class="comment-form__submit">%1$s %2$s</div></div>',
		);

		comment_form( $args );
	?>

</div><!-- #comments -->
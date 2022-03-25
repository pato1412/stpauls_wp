<?php
	$post_view = '';

	if( is_single() && 'post' === get_post_type() ){
		$post_view = 'post_view_single';
	} elseif( 'post' === get_post_type() || is_search() ) {
		$post_view = 'post_view_list';
	}

    // Thumbnail size
    $thumb_size = '700x426';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_view ); ?>>
	<?php if( is_single() ): ?>
		<header class="entry-header">
			<div class="entry-header__heading">
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<ul class="entry-meta">
                    <li>
                        <span class="stm-icon stm-icon-calendar"></span> <?php echo get_the_date(' F j, Y', get_the_ID()); ?>
                    </li>
					<?php
					if ( ! is_multi_author() ) {
						printf( '<li><span class="byline"><span class="author vcard"><span class="stm-icon stm-icon-user"></span>%1$s <span class="screen-reader-text">%2$s </span><a class="url fn n" href="%3$s">%4$s</a></span></span></li>',
							_x( 'Posted by:', 'smarty', 'smarty' ),
							_x( 'Author', 'Used before post author name.', 'smarty' ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							get_the_author()
						);
					}
					?>
                    <li><span class="stm-icon stm-icon-folder"></span><?php echo esc_html__( 'Category:', 'smarty' ); ?> <span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'smarty' ) ); ?></span></li>
					<li class="stm_posts_comment__link"><span class="stm-icon stm-icon-chat"></span><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'Leave a comment', 'smarty' ) . '</span>', esc_html__( '1 comment', 'smarty' ), esc_html__( '% comments', 'smarty' ) ); ?></li>
				</ul>
			</div>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'smarty' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div>
		<footer class="entry-footer">
			<?php
				$tags_list = get_the_tag_list();
				if ( $tags_list ) {
					printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
						_x( 'Tags', 'Used before tag names.', 'smarty' ),
						$tags_list
					);
				}
			?>
            <?php if(!get_theme_mod('post_soc_show_hide', false)): ?>
			<div class="share entry-share">
				<span class="share__title"><?php esc_html_e('Share', 'smarty'); ?></span>
				<script type="text/javascript">var switchTo5x=true;</script>
				<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
				<script type="text/javascript">stLight.options({publisher: "07305ded-c299-419b-bbfc-2f15806f61b2", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

				<span class="share__item st_facebook_large" displayText='Facebook'></span>
				<span class="share__item st_twitter_large" displayText='Tweet'></span>
				<span class="share__item st_googleplus_large" displayText='Google +'></span>
				<span class="share__item st_sharethis_large" displayText='ShareThis'></span>
			</div>
            <?php endif; ?>
		</footer>

		<?php
			// Author bio.
			if ( get_the_author_meta( 'description' ) ) {
                smarty_get_layout_file('/parts', '/author-bio');
			}
		?>
	<?php else: ?>
		<div class="entry-body">
			<?php if( has_post_thumbnail() ) : ?>
				<div class="entry-thumbnail-container">
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php
                        $thumb = wpb_getImageBySize( array(
                            'attach_id'  => get_post_thumbnail_id(),
                            'thumb_size' => $thumb_size
                        ) );
                        ?>
                        <div class="entry-thumbnail-container">
                            <div class="entry-thumbnail">
                                <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="entry-thumbnail-container">
                            <div class="entry-thumbnail">
                                <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url( SMARTY_TEMPLATE_URI . '/assets/img/tmp/placeholder.jpg' ); ?>" alt="<?php echo esc_attr__('Logo', 'smarty'); ?>"></a>
                            </div>
                        </div>
                    <?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="entry-details-container">
				<div class="entry-details">
                    <?php echo get_the_category_list(); ?>
					<?php if( get_the_title() ): ?>
						<h5 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h5>
					<?php endif; ?>
					<?php if( get_the_excerpt() ) : ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>
					<ul class="entry-meta">
						<li><a href="<?php the_permalink(); ?>"><?php echo get_the_date(' F j, Y', get_the_ID()); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
</article>
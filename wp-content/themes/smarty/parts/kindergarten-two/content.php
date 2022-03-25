<?php
	$post_view = '';

	if( is_single() && 'post' === get_post_type() ){
		$post_view = 'post_view_single';
	} elseif( 'post' === get_post_type() || is_search() ) {
        if( has_post_thumbnail()) {
            $post_view = 'post_view_list posts_has__thumb';
        }else {
		    $post_view = 'post_view_list';
        }
	}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_view ); ?>>
	<?php if( is_single() ): ?>
        <?php $page_id = smarty_page_id(); ?>
		<header class="entry-header <?php if ( ! get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>hidden<?php endif; ?>">
			<div class="entry-date">
				<div class="entry-date__day"><?php echo get_the_date('j', get_the_ID()); ?></div>
				<div class="entry-date__month"><?php echo get_the_date('F', get_the_ID()); ?></div>
			</div>
			<div class="entry-header__heading">
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<ul class="entry-meta">
					<?php
					if ( ! is_multi_author() ) {
						printf( '<li><span class="byline"><span class="author vcard"><span class="stm-icon stm-icon-pencil"></span> <span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span></li>',
							_x( 'Author', 'Used before post author name.', 'smarty' ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							get_the_author()
						);
					}
					?>
                    <li><span class="cat-links"><span class="stm-icon stm-icon-tag_flag"></span> <?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'smarty' ) ); ?></span></li>
					<li><span class="stm-icon stm-icon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'Leave a comment', 'smarty' ) . '</span>', esc_html__( '1 comment', 'smarty' ), esc_html__( '% comments', 'smarty' ) ); ?></li>
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
					<div class="entry-thumbnail">
                        <?php
                        // Thumbnail size
                        if( empty ($thumb_size) ) {
                            $thumb_size = '350x220';
                        }

                        $thumb = wpb_getImageBySize( array(
                            'attach_id'  => get_post_thumbnail_id(),
                            'thumb_size' => $thumb_size
                        ) );
                        ?>
						<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                        <div class="posts_post__date">
                            <a href="<?php the_permalink(); ?>">
                                <span><?php echo get_the_date('j'); ?></span>
                                <?php echo get_the_date('M'); ?>
                            </a>
                        </div>
					</div>
				</div>
			<?php endif; ?>
            <div class="entry-details-container">
                <div class="entry-details">
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
                    <div class="entry-meta">
                        <div class="entry-meta-auhtor">
                            <?php
                            if ( ! is_multi_author() ) {
                                printf( '<span class="stm-icon stm-icon-pencil"></span> <a class="url fn n" href="%1$s">%2$s</a>',
                                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                    get_the_author()
                                );
                            }
                            ?>
                        </div>
                        <div class="entry-meta-category">
                            <span class="stm-icon stm-icon-tag_flag"></span> <?php echo get_the_category_list(', '); ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	<?php endif; ?>
</article>
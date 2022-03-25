<?php
	$event_view = '';

	if( is_single() && 'stm_event' === get_post_type() ){
		$event_view = 'post_view_single';
	}
?>
<article id="event-<?php the_ID(); ?>" <?php post_class( $event_view ); ?>>
    <?php $page_id = smarty_page_id(); ?>
	<header class="entry-header <?php if ( ! get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>hidden<?php endif; ?>">
		<div class="entry-header__heading">
			<h1 class="entry-title"><?php the_title(); ?></h1>
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
				<?php $event_categories_list = get_the_term_list( get_the_ID(), 'stm_event_category', '', ', ', '' ); ?>
				<?php if( !empty( $event_categories_list ) ) : ?>
					<li><span class="cat-links"><span class="stm-icon stm-icon-tag_flag"></span> <?php echo wp_kses_post( $event_categories_list ); ?></span></li>
				<?php endif; ?>
                <?php
                    $event_member = get_post_meta( $page_id, 'event_attended', true );
                ?>
                <?php if( !empty( $event_member ) ) : ?>
                    <li>
                        <span class="stm-icon stm-icon-attended"></span> <?php echo get_post_meta( $page_id, 'event_attended', true ); ?> <?php esc_html_e( 'attended', 'smarty' ); ?>
                    </li>
                <?php endif; ?>
			</ul>
		</div>
	</header>
    <?php if( get_the_excerpt() ) : ?>
        <div class="event-entry-summary">
            <?php the_excerpt(); ?>
        </div>
    <?php endif; ?>
	<div class="event-info event-info_table">
		<ul>
			<?php
				// Date
				$stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true );
				$stm_event_date_end = get_post_meta( get_the_ID(), 'stm_event_date_end', true );

				// Time - Number
				$stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
				$stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );

				// Time - Text
				$stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true )
			?>
			<?php if( !empty( $stm_event_date_start ) || !empty( $stm_event_time_start ) || !empty( $stm_event_time_text ) ) : ?>
			<li>
				<div class="event-info__title"><?php esc_html_e('Date & Time', 'smarty'); ?></div>
				<ul class="event-info__datetime">
					<?php
						$stm_event_month_start = date_i18n('F', $stm_event_date_start);
						$stm_event_month_end = date_i18n('F', $stm_event_date_end);
						$stm_event_day_start = date_i18n('j', $stm_event_date_start);
						$stm_event_day_end = date_i18n('j', $stm_event_date_end);
						$stm_event_year_start = date_i18n('Y', $stm_event_date_end);
						$stm_event_year_end = date_i18n('Y', $stm_event_date_end);
						$stm_event_date = '';

						if( $stm_event_month_start === $stm_event_month_end ) {
							$stm_event_date .= $stm_event_month_start;
							if( $stm_event_day_start < $stm_event_day_end ) {
								$stm_event_date .= ' ' . $stm_event_day_start . ' - ' . $stm_event_day_end;
							} else {
								$stm_event_date .= ' ' .$stm_event_day_start;
							}
							$stm_event_date .= ', ' . $stm_event_year_start;
						} else {
							$stm_event_date .= $stm_event_month_start . ' ' . $stm_event_day_start;
							$stm_event_date .= ' - ' . $stm_event_month_end . ' ' . $stm_event_day_end;
							$stm_event_date .= ', ' . $stm_event_year_start;

						}
					?>
					<?php if( !empty( $stm_event_date ) ) : ?>
						<li><span class="stm-icon stm-icon-calendar"></span> <?php echo esc_html( $stm_event_date ); ?></li>
					<?php endif; ?>
					<?php if( !empty( $stm_event_time_text ) ) : ?>
						<li><span class="stm-icon stm-icon-time"></span> <?php echo esc_html( $stm_event_time_text ); ?></li>
					<?php else: ?>
						<?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
							<li><span class="stm-icon stm-icon-time"></span> <?php echo (( $stm_event_time_end ) ? esc_html( $stm_event_time_start . ' ' . esc_html__('to', 'smarty') . ' ' . $stm_event_time_end ) : esc_html( $stm_event_time_start ) ); ?></li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
				<li>
					<div class="event-info__title"><?php esc_html_e('Venue', 'smarty'); ?></div>
					<p class="event-info__venue"><?php echo esc_html( $stm_event_venue ); ?></p>
				</li>
			<?php endif; ?>
			<?php
				$stm_event_tel = get_post_meta( get_the_ID(), 'stm_event_tel', true );
				$stm_event_email = get_post_meta( get_the_ID(), 'stm_event_email', true );
			?>
			<?php if( !empty( $stm_event_tel ) || !empty( $stm_event_email ) ) : ?>
				<li>
					<div class="event-info__title"><?php esc_html_e('Contact details', 'smarty'); ?></div>
					<?php if( !empty( $stm_event_tel ) ) : $stm_event_tel = explode( ';', $stm_event_tel ); ?>
						<ul class="event-info__tel">
							<?php foreach( $stm_event_tel as $stm_event_tel_val ) : ?>
								<li><?php echo esc_attr( $stm_event_tel_val ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if( !empty( $stm_event_email ) ) : $stm_event_email = explode( ';', $stm_event_email ); ?>
					<ul class="event-info__email">
						<?php foreach( $stm_event_email as $stm_event_email_val ) : ?>
						<li><a href="mailto:<?php echo esc_attr( $stm_event_email_val ); ?>"><?php echo esc_attr( $stm_event_email_val ); ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="entry-content"><?php the_content(); ?></div>
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
        <?php if(!get_theme_mod('event_soc_show_hide', false)): ?>
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
</article>
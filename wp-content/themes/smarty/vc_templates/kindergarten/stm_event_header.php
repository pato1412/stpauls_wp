<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<header class="entry-header">
	<div class="entry-header__heading">
		<h2 class="entry-title"><?php the_title(); ?></h2>
		<ul class="entry-meta">
			<?php if( get_the_term_list( get_the_ID(), 'stm_event_category' ) ) : ?>
				<li><span class="cat-links"><?php echo get_the_term_list( get_the_ID(), 'stm_event_category', '', ', ', '' ); ?></span></li>
			<?php endif; ?>
			<?php
			if ( ! is_multi_author() ) {
				printf( '<li><span class="byline"><span class="author vcard"><i class="fa fa-user"></i><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span></li>',
					_x( 'Author', 'Used before post author name.', 'smarty' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			}
			?>
			<?php
				$event_attended = get_post_meta( get_the_ID(), 'event_attended', true );
				if( $event_attended == '' ) {
					$event_attended = 0;
				}
			?>
			<li><i class="fa fa-users"></i><span class="event-attended-count"><?php echo esc_html( $event_attended ); ?></span><?php esc_html_e(' attended', 'smarty'); ?></li>
		</ul>
	</div>
</header>
<div class="event-info event-info_table<?php echo esc_attr( $css_class ); ?>">
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
				<div class="event-info__title"><?php esc_html_e('Date & Time:', 'smarty'); ?></div>
				<ul class="event-info__datetime">
					<?php
					$stm_event_month_start = date('F', $stm_event_date_start);
					$stm_event_month_end = date('F', $stm_event_date_end);
					$stm_event_day_start = date('j', $stm_event_date_start);
					$stm_event_day_end = date('j', $stm_event_date_end);
					$stm_event_year_start = date('Y', $stm_event_date_end);
					$stm_event_year_end = date('Y', $stm_event_date_end);
					$stm_event_date = '';

					if( $stm_event_month_start === $stm_event_month_end ) {
						$stm_event_date .= $stm_event_month_start;
						if( $stm_event_day_start < $stm_event_day_end ) {
							$stm_event_date .= ' ' . $stm_event_day_start . ' - ' . $stm_event_day_end;
						} else {
							$stm_event_date .= $stm_event_day_start;
						}
						$stm_event_date .= ', ' . $stm_event_year_start;
					} else {
						$stm_event_date .= $stm_event_month_start . ' ' . $stm_event_day_start;
						$stm_event_date .= ' - ' . $stm_event_month_end . ' ' . $stm_event_day_end;
						$stm_event_date .= ', ' . $stm_event_year_start;

					}
					?>
					<?php if( !empty( $stm_event_date ) ) : ?>
						<li><i class="fa fa-calendar-check-o"></i><?php echo esc_html( $stm_event_date ); ?></li>
					<?php endif; ?>
					<?php if( !empty( $stm_event_time_text ) ) : ?>
						<li><i class="fa fa-clock-o"></i><?php echo esc_html( $stm_event_time_text ); ?></li>
					<?php else: ?>
						<?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
							<li>
								<i class="fa fa-clock-o"></i>
								<?php
								if( !empty( $stm_event_time_start ) &&  !empty( $stm_event_time_end ) ) {
									echo esc_html( $stm_event_time_start ) . ' ' . esc_html__('to', 'smarty') . ' ' . esc_html($stm_event_time_end );
								} elseif( $stm_event_time_start == '' ) {
									echo esc_html( $stm_event_time_end );
								} elseif( $stm_event_time_end == '' ) {
									echo esc_html( $stm_event_time_start );
								}
								?>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</li>
		<?php endif; ?>
		<?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
			<li>
				<div class="event-info__title"><?php esc_html_e('Venue:', 'smarty'); ?></div>
				<p class="event-info__venue"><?php echo esc_html( $stm_event_venue ); ?></p>
			</li>
		<?php endif; ?>
		<?php
		$stm_event_tel = get_post_meta( get_the_ID(), 'stm_event_tel', true );
		$stm_event_email = get_post_meta( get_the_ID(), 'stm_event_email', true );
		?>
		<?php if( !empty( $stm_event_tel ) || !empty( $stm_event_email ) ) : ?>
			<li>
				<div class="event-info__title"><?php esc_html_e('Contact details:', 'smarty'); ?></div>
				<?php if( !empty( $stm_event_tel ) ) : $stm_event_tel = explode( ';', $stm_event_tel ); ?>
					<ul class="event-info__tel">
						<?php foreach( $stm_event_tel as $stm_event_tel_val ) : ?>
							<li><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $stm_event_tel_val ) ); ?>"><?php echo esc_attr( $stm_event_tel_val ); ?></a></li>
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

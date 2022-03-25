<?php
$items_count = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

wp_enqueue_style( 'animate' );

if( empty( $items_count ) ) {
	$items_count = -1;
}
$meal_weekdays = get_terms('stm_meal_weekdays');
?>

<div class="stm-tab stm-tab_meal<?php echo esc_attr( $css_class ); ?>">

	<!-- Nav tabs -->
	<?php if( !empty( $meal_weekdays ) && ! is_wp_error( $meal_weekdays ) ) : ?>
		<?php $tab_order = 1; ?>
		<ul class="stm-menu stm-menu_antonio stm-menu_tab" role="tablist">
			<?php foreach( $meal_weekdays as $meal_weekday ) : ?>
				<?php if( $meal_weekday->count > 0 ) : ?>
					<li class="stm-menu__item<?php echo (( $tab_order == 1 ) ? ' active' : ''); ?>" role="presentation"><a class="stm-menu__item-link" href="#stm-meal-weekdayId-<?php echo esc_attr( $meal_weekday->term_id ); ?>" aria-controls="stm-meal-weekdayId-<?php echo esc_attr( $meal_weekday->term_id ); ?>" role="tab" data-toggle="tab"><?php echo esc_html( $meal_weekday->name ); ?></a></li>
					<?php $tab_order = 0; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<?php $pane_order = 1; ?>
		<?php foreach( $meal_weekdays as $meal_weekday ) : ?>
			<?php if( $meal_weekday->count > 0 ) : ?>
				<?php
					$weekdays_data = array();
					$meal_time = get_terms('stm_meal_time');
					$weekday_items_showed = 0;

					$weekdays_items_all = get_posts( array(
						'posts_per_page' => -1,
						'post_type' => 'stm_meal',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'stm_meal_weekdays',
								'field'    => 'term_id',
								'terms'    => array( $meal_weekday->term_id ),
							)
						),
					));

					if( !empty( $meal_time ) && ! is_wp_error( $meal_time ) ) {
						foreach ( $meal_time as $data_meal_time_val ) {
							if( $data_meal_time_val->count > 0 ) {
								$data_weekdays_items = get_posts( array(
									'posts_per_page' => $items_count,
									'post_type' => 'stm_meal',
									'tax_query' => array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'stm_meal_weekdays',
											'field'    => 'term_id',
											'terms'    => array( $meal_weekday->term_id ),
										),
										array(
											'taxonomy' => 'stm_meal_time',
											'field'    => 'term_id',
											'terms'    => array( $data_meal_time_val->term_id ),
										)
									),
								));

								if( $data_weekdays_items ) {
										$weekday_items_showed = $weekday_items_showed + count( $data_weekdays_items );
								}
							}
						}
					}

					$weekdays_data[$meal_weekday->term_id] = array(
						'all' => count( $weekdays_items_all ),
						'showed' => $weekday_items_showed
					);
				?>
				<div role="tabpanel" class="tab-pane<?php echo (( $pane_order == 1 ) ? ' active' : '' ); ?>" id="stm-meal-weekdayId-<?php echo esc_attr( $meal_weekday->term_id ) ?>">
					<div class="stm-tab__pane-body row">
					<?php
						if( !empty( $meal_time ) && ! is_wp_error( $meal_time ) ) :
							foreach ( $meal_time as $meal_time_val ) :
								if( $meal_time_val->count > 0 ) :

									$weekdays_items = get_posts( array(
										'posts_per_page' => $items_count,
										'post_type' => 'stm_meal',
										'tax_query' => array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'stm_meal_weekdays',
												'field'    => 'term_id',
												'terms'    => array( $meal_weekday->term_id ),
											),
											array(
												'taxonomy' => 'stm_meal_time',
												'field'    => 'term_id',
												'terms'    => array( $meal_time_val->term_id ),
											)
										),
									));
								?>
								<?php if( !empty( $weekdays_items ) ) : ?>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="stm-meal-list">
											<div class="stm-meal-list__heading"><h4><?php echo esc_html( $meal_time_val->name ); ?></h4></div>
											<ul class="stm-meal-list__list" data-meal-time="<?php echo esc_attr( $meal_time_val->term_id ); ?>">
												<?php foreach ( $weekdays_items as $weekdays_item ) : ?>
													<li <?php post_class( array('stm-meal'), $weekdays_item->ID ); ?>>
														<div class="stm-meal__content">
															<?php if( has_post_thumbnail( $weekdays_item->ID ) ) : ?>
																<?php $item_image = wpb_getImageBySize(array('attach_id' => get_post_thumbnail_id( $weekdays_item->ID ), 'thumb_size' => '105x105')); ?>
																<div class="stm-meal__thumbnail"><?php echo wp_kses( $item_image['thumbnail'], array('img'=> array('src' => array(), 'width' => array(), 'height' => array())) ); ?></div>
															<?php endif; ?>
															<div class="stm-meal__body">
																<div class="stm-meal__title"><?php echo get_the_title( $weekdays_item->ID ); ?></div>
																<?php $weekdays_item_summary = apply_filters( 'get_the_excerpt', get_post_field('post_excerpt', $weekdays_item->ID, 'raw')); ?>
																<?php if( !empty( $weekdays_item_summary ) ) : ?>
																<div class="stm-metal__summary"><?php echo esc_html( $weekdays_item_summary ); ?></div>
																<?php endif; ?>
															</div>
														</div>
													</li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					</div>
					<?php if( $weekdays_data[$meal_weekday->term_id]['showed'] < $weekdays_data[$meal_weekday->term_id]['all'] ): ?>
						<footer class="stm-tab__pane-footer">
							<div class="stm-tab__pane-action stm-tab__pane-action_deal stm-tab__pane-action_separated">
								<a href="#" data-meal-weekday="<?php echo esc_attr( $meal_weekday->term_id ); ?>" data-meal-all="<?php echo esc_attr( $weekdays_data[$meal_weekday->term_id]['all'] ); ?>" data-meal-showed="<?php echo esc_attr( $weekdays_data[$meal_weekday->term_id]['showed'] ); ?>" class="stm-btn stm-btn_outline stm-btn_blue stm-btn_md stm-btn_icon-right stm-load-more-deal"><?php esc_attr_e('Load more', 'smarty'); ?><i class="stm-icon stm-icon-arrow-right"></i></a>
							</div>
						</footer>
					<?php endif; ?>
				</div>
				<?php $pane_order = 0; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<?php endif; ?>
</div>
<script>
	(function($) {
		"use strict";

		$(document).on("click", ".stm-load-more-deal", function() {
			var $this = $(this),
					mealWeekday = $(this).data("meal-weekday"),
					mealShowed = $(this).data("meal-showed"),
					mealAll = $(this).data("meal-all"),
					mealOffset = '<?php echo esc_js( $items_count ); ?>';

			$.ajax({
				type: "POST",
				dataType : "json",
				url: window.wp_data.ajax_url,
				data: {
					action : 'smarty_load_meal',
					weekday_id : mealWeekday,
					offset : mealOffset,
                    security: window.wp_data.load_meal
				},
				success: function ( response ) {
					var addDelay = 200;
					$($this).closest(".tab-pane").find(".stm-meal-list__list").each(function() {
						var $mealList = $(this),
								mealTime = $mealList.data("meal-time");

						if( response[mealTime] ) {
							setTimeout(function() {
								$mealList.append( response[mealTime] );
							}, addDelay);

							addDelay = addDelay + 250;
							mealShowed = mealShowed + 3;

							if( mealShowed >= mealAll ) $($this).closest(".stm-tab__pane-footer").fadeOut();
						}
					});
				}
			});

			return false;
		});
	})(jQuery);
</script>


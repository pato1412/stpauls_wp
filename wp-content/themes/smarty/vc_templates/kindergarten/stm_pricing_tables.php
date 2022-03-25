<?php
/* Variables */
$pricing_tables_count = '';
// Pricing Tables - 1

for( $i = 1; $i <= 3; $i++ ) {
	${'pt_' . $i . '_color_scheme'} = '';
	${'pt_' . $i . '_title'}        = '';
	${'pt_' . $i . '_periods'}      = '';
	${'pt_' . $i . '_features'}     = '';
	${'pt_' . $i . '_link_text'}    = '';
	${'pt_' . $i . '_link'}         = '';
	${'pt_' . $i . '_featured'}     = '';
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/*  === CSS CLASS === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/*  === Table ===
 *
 * 1. Style
 * 2. Class
 *
 * */

// 1. Style
for( $i = 1; $i <= 3; $i++ ) {
    ${'pt_' . $i . '_table_styles'} = array(
        'border-color:' . esc_attr( ${'pt_' . $i . '_color_scheme'} )
    );
    ${'pt_' . $i . '_table_style'}  = smarty_element_style( ${'pt_' . $i . '_table_styles'} );
}

for( $i = 1; $i <= 3; $i++ ) {
    ${'pt_' . $i . '_buttons_styles'} = array(
        'border-color:' . esc_attr( ${'pt_' . $i . '_color_scheme'} )
    );
    ${'pt_' . $i . '_button_styles'}  = smarty_element_style( ${'pt_' . $i . '_buttons_styles'} );
}

// 2. Class

/*  === PRICE ===
 *
 * 1. Style
 *
 * */

// 1. Style
for( $i = 1; $i <= 3; $i++ ) {
	${'pt_' . $i . '_price_styles'} = array(
		'color:' . esc_attr( ${'pt_' . $i . '_color_scheme'} )
	);
	${'pt_' . $i . '_price_style'}  = smarty_element_style( ${'pt_' . $i . '_price_styles'} );
}

/*  === FEATURES === */
for( $i = 1; $i <= 3; $i++ ) {
	if ( isset( $atts['pt_'. $i .'_features'] ) && strlen( $atts['pt_' . $i . '_features'] ) > 0 ) {
		${'pt_' . $i . '_features'} = vc_param_group_parse_atts( $atts['pt_' . $i . '_features'] );
		if ( ! is_array( ${'pt_' . $i . '_features'} ) ) {
			$temp        = explode( ',', $atts['pt_' . $i . '_features'] );
			$paramValues = array();
			foreach ( $temp as $value ) {
				$data                          = explode( '|', $value );
				$newLine                       = array();
				$newLine['pt_' . $i . '_feature_title'] = isset( $data[0] ) ? $data[0] : 0;
				$newLine['pt_' . $i . '_feature_text']  = isset( $data[0] ) ? $data[0] : 0;
				if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
					$newLine['pt_' . $i . '_feature_title'] = (float) str_replace( '%', '', $data[1] );
					$newLine['pt_' . $i . '_feature_text']  = (float) str_replace( '%', '', $data[1] );
				}
				$paramValues[] = $newLine;
			}
			$atts['pt_' . $i . '_features'] = urlencode( json_encode( $paramValues ) );
		}
	}
}

/*  === PERIODS === */
for( $i = 1; $i <= 3; $i++ ) {
	if ( isset( $atts['pt_'. $i .'_periods'] ) && strlen( $atts['pt_' . $i . '_periods'] ) > 0 ) {
		${'pt_' . $i . '_periods'} = vc_param_group_parse_atts( $atts['pt_' . $i . '_periods'] );
		if ( ! is_array( ${'pt_' . $i . '_periods'} ) ) {
			$temp        = explode( ',', $atts['pt_' . $i . '_periods'] );
			$paramValues = array();
			foreach ( $temp as $value ) {
				$data                          = explode( '|', $value );
				$newLine                       = array();
				$newLine['pt_' . $i . '_periods_price'] = isset( $data[0] ) ? $data[0] : 0;
				$newLine['pt_' . $i . '_periods_text']  = isset( $data[0] ) ? $data[0] : 0;
				$newLine['pt_' . $i . '_periods_period']  = isset( $data[0] ) ? $data[0] : 0;
				if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
					$newLine['pt_' . $i . '_periods_price'] = (float) str_replace( '%', '', $data[1] );
					$newLine['pt_' . $i . '_periods_text']  = (float) str_replace( '%', '', $data[1] );
					$newLine['pt_' . $i . '_periods_period']  = (float) str_replace( '%', '', $data[1] );
				}
				$paramValues[] = $newLine;
			}
			$atts['pt_' . $i . '_periods'] = urlencode( json_encode( $paramValues ) );
		}
	}
}

/* === LINK === */
for( $i = 1; $i <= 3; $i++ ) {
	if( !empty( ${'pt_' . $i . '_link'} ) ) {
		${'pt_' . $i . '_link'} = vc_build_link( ${'pt_' . $i . '_link'} );

		if( empty( ${'pt_' . $i . '_link'}['target'] ) ) {
			${'pt_' . $i . '_link'}['target'] = '_self';
		}
	}
}

/* === ID === */
$stm_pricing_id = uniqid( 'stm-pricing-' );
?>
<div class="stm-pricing stm-pricing_<?php echo esc_attr( $pricing_tables_count ); ?>" id="<?php echo esc_attr( $stm_pricing_id ); ?>">
	<div class="stm-pricing__content">
		<div class="stm-pricing__side-panel">
			<div class="stm-pricing__filters">
				<ul>
					<?php $pricing_periods = array(); ?>
						<?php for( $i = 1; $i <= 3; $i++ ) : ?>
						<?php foreach( ${'pt_' . $i . '_periods'} as ${'pt_' . $i . '_periods_item'} ) : ?>
							<?php if( ! in_array( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_period'], $pricing_periods ) ) : ?>
								<?php $pricing_periods[] = ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_period']; ?>
								<li class="stm-pricing__filter <?php echo ( ( $pricing_periods[0] == ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_period'] ) ? 'stm-pricing__filter_active' : '' ); ?>"><a data-period-filter="<?php echo esc_attr( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_period'] ); ?>" href="#"><?php echo esc_html( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_period'] ); ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endfor; ?>
					<li class="stm-pricing__filter_fluid-hover"></li>
				</ul>
			</div>
			<ul class="stm-pricing__features">
				<?php foreach( $pt_1_features as $pt_1_features_item ) : ?>
					<?php if( !empty($pt_1_features_item['pt_1_feature_title'] ) ) : ?>
						<li class="stm-pricing__feature"><?php echo esc_html( $pt_1_features_item['pt_1_feature_title'] ); ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="stm-pricing__tables">
			<div class="stm-pricing__tables-row">
				<?php for( $i = 1; $i <= 3; $i++ ) : ?>
					<?php if( !empty( ${'pt_' . $i . '_periods'} ) ) : ?>
						<div class="stm-pricing__tables-col">
							<div class="stm-pricing-table <?php echo ( ( esc_attr( ${'pt_' . $i . '_featured'} ) ) ? 'stm-pricing-table_featured' : '' ); ?>" <?php echo sanitize_text_field( ${'pt_' . $i . '_table_style'} ); ?>>
								<?php if( !empty( ${'pt_' . $i . '_title'} ) ) : ?>
									<div class="stm-pricing-table__title"><?php echo esc_html( ${'pt_' . $i . '_title'} ); ?></div>
								<?php endif; ?>
								<ul class="stm-pricing-table__periods">
									<?php foreach( ${'pt_' . $i . '_periods'} as ${'pt_' . $i . '_periods_item'} ) : ?>
										<li class="stm-pricing-table__periods-item" data-period="<?php echo esc_attr( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_period'] ); ?>">
											<?php if( !empty( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_price'] ) ) : ?>
												<div class="stm-pricing-table__price" <?php echo sanitize_text_field( ${'pt_' . $i . '_price_style'} ); ?>>
													<?php echo esc_html( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_price'] ); ?>
												</div>
											<?php endif; ?>
											<?php if( !empty( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_text'] ) ) : ?>
												<div class="stm-pricing-table__period">
													<?php echo esc_html( ${'pt_' . $i . '_periods_item'}['pt_'. $i .'_periods_text'] ); ?>
												</div>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
								<?php if( is_array( ${'pt_' . $i . '_features'} ) && !empty( ${'pt_' . $i . '_features'} ) ) : ?>
									<ul class="stm-pricing-table__features">
										<?php foreach( ${'pt_' . $i . '_features'} as ${'pt_' . $i . '_features_item'} ) : ?>
											<li class="stm-pricing-table__feature">
												<?php if( !empty( ${'pt_' . $i . '_features_item'}['pt_' . $i . '_feature_title'] ) ) : ?>
													<div class="stm-pricing-table__feature-label"><?php echo esc_html( ${'pt_' . $i . '_features_item'}['pt_' . $i . '_feature_title'] ); ?></div>
												<?php endif; ?>
												<div class="stm-pricing-table__feature-value">
													<?php if( isset( ${'pt_' . $i . '_features_item'}['pt_' . $i . '_feature_text'] ) ) : ?>
														<?php echo esc_html( ${'pt_' . $i . '_features_item'}['pt_' . $i . '_feature_text'] ); ?>
													<?php elseif( isset( ${'pt_' . $i . '_features_item'}['pt_' . $i . '_feature_check'] ) ): ?>
														<i class="stm-icon stm-icon-check"></i>
													<?php else: ?>
														<i class="stm-icon stm-icon-times"></i>
													<?php endif; ?>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<?php if( isset( ${'pt_' . $i . '_link'}['url'] ) && !empty( ${'pt_' . $i . '_link_text'} ) ) : ?>
									<div class="stm-pricing-table__action">
										<a href="<?php echo esc_url( ${'pt_' . $i . '_link'}['url'] ); ?>" <?php echo sanitize_text_field( ${'pt_' . $i . '_button_styles'} ); ?> target="<?php echo esc_attr( ${'pt_' . $i . '_link'}['target'] ); ?>" class="stm-btn stm-btn_outline stm-btn_md stm-btn_icon-left"><i class="stm-icon stm-icon-duck" style="margin-top:-4px;margin-right:19px"></i> <?php echo esc_html( ${'pt_' . $i . '_link_text'} ); ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>
<script>
	(function($) {
		"use strict";
		var pricingId = '<?php echo esc_js( $stm_pricing_id ); ?>';

		$(document).on('ready', function() {
			var activePeriod = $( "#" + pricingId + ' .stm-pricing__filter_active > a').data("period-filter");

			$( "#" + pricingId + ' .stm-pricing-table__periods-item' ).each(function() {
				if( $(this).data("period") == activePeriod ) {
					$(this).addClass("stm-pricing-table__periods-item_active");
				}
			});

			// Filter fluid hover
			var activeFilterWidth = $( "#" + pricingId + ' .stm-pricing__filter_active').width();
			$( "#" + pricingId + ' .stm-pricing__filter_fluid-hover').width( activeFilterWidth );

			$( "#" + pricingId + ' .stm-pricing__filter > a').on("click", function() {
				activePeriod = $(this).data('period-filter');

				$(this).parent().addClass('stm-pricing__filter_active').siblings().removeClass('stm-pricing__filter_active');

				$(this).closest('.stm-pricing__filters').find(".stm-pricing__filter_fluid-hover").css('left', $(this).position().left + 'px');

				$( $(this).closest('.stm-pricing').find(".stm-pricing-table__periods-item") ).each(function() {
					if( $(this).data("period") == activePeriod ) {
						$(this).addClass("stm-pricing-table__periods-item_active").siblings().removeClass("stm-pricing-table__periods-item_active");
					}
				});

				return false;
			});

		});

	})(jQuery);
</script>


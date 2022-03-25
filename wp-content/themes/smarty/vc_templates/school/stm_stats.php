<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( ! wp_script_is( 'count-up' ) ) {
	wp_enqueue_script( 'count-up' );
}

if( ! wp_script_is( 'vivus' ) ) {
	wp_enqueue_script( 'vivus' );
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Icon styles
$icon_class = '';

if( !empty( $icon_color ) && $icon_color === 'custom' ) {
    $icons_css_styles[] = 'color:' . $icon_color;
} elseif ( !empty( $icon_color ) && $icon_color !== 'custom' ) {
    $icon_class .= ' stm-font_color_' . esc_attr( $icon_color );
}

$icons_css_styles = array(
  'padding-top:' . esc_attr( $icon_padd_top ),
  'font-size:' . esc_attr( $icon_size ),
);
$icon_css_style = smarty_element_style( $icons_css_styles );

// Value styles
$value_styles = array(
    'font-size:' . esc_attr( $value_font_size ),
    'color:' . esc_attr( $value_color )

);
$value_style = smarty_element_style( $value_styles );

// Description styles
$desc_styles = array(
    'font-size:' . esc_attr( $desc_font_size ),
    'color:' . esc_attr( $desc_color )
);
$desc_style = smarty_element_style( $desc_styles );

$id = rand();

?>
<div class="stm-stats stm-stats_counter clearfix stm-stats_icon_<?php echo esc_attr( $stats_style ) ?><?php echo esc_attr( $css_class ); ?>">
    <?php if( $icon_type == 'font' && ${'icon_'.$icon_library}  ) : ?>
        <div class="stm-stats__icon<?php echo esc_attr( $icon_class ); ?>" <?php echo sanitize_text_field( $icon_css_style ); ?>><i class="<?php echo esc_attr( ${'icon_'.$icon_library} ); ?>"></i></div>
    <?php endif; ?>

		<?php if( $icon_type == 'svg' && $svg_id ) : ?>
			<?php $svg_src = wp_get_attachment_image_src( $svg_id, 'full' ); ?>
			<div class="stm-stats__icon<?php echo esc_attr( $icon_class ); ?>" <?php echo sanitize_text_field( $icon_css_style ); ?>>
				<object id="stm-stats-svg-<?php echo esc_attr( $id ); ?>" type="image/svg+xml" data="<?php echo esc_url( $svg_src[0] ); ?>"></object>
			</div>
		<?php endif; ?>

    <div class="stm-stats__content">
        <?php if( !empty( $value ) ) : ?>
            <div class="stm-stats__value">
                <span class="stats__value-number" id="counter_<?php echo esc_attr( $id ); ?>" <?php echo sanitize_text_field( $value_style ); ?>><?php echo esc_html( $value ); ?></span>
            </div>
        <?php endif; ?>

        <?php if( !empty( $desc ) ) : ?>
         <div class="stm-stats__descr" <?php echo sanitize_text_field( $desc_style ); ?>><?php echo esc_html( $desc ) ?></div>
        <?php endif; ?>
      </div>
</div>

<script>

    (function($) {
	    "use strict";

      $(document).ready(function () {
          var counterId        = '<?php echo esc_js( $id ); ?>',
              counterValue     = '<?php echo esc_js( $value ); ?>',
              counterDuration  = '<?php echo esc_js( $duration ); ?>',
              counterSuffix    = '<?php echo esc_js( $count_suffix ); ?>',
              counterSeparator = '<?php echo esc_js( $count_separator ); ?>',
              counterGrouping  = '<?php echo esc_js( $count_grouping ); ?>',
              svgAnimated      = '<?php echo esc_js( $svg_animated ); ?>',
              svgWidth         = '<?php echo esc_js( $svg_width ); ?>',
              iconColor        = $("#counter_" + counterId).closest(".stm-stats").find(".stm-stats__icon").css("color"),
              options          = {
                  useEasing: true,
                  useGrouping: false
              };

              if( counterSuffix ) {
                  options['suffix'] = counterSuffix;
              }

              if( counterSeparator ) {
                  options['separator'] = counterSeparator;
              }

              if( counterGrouping ) {
                  options['useGrouping'] = counterGrouping;
              }

          var counter = new countUp("counter_" + counterId, 0, counterValue , 0, counterDuration, options);

          $(window).load(function () {
              if ($("#counter_" + counterId).is_on_screen()) {
                  counter.start();
              }
          });

          $(window).scroll(function () {
              if ($("#counter_" + counterId).is_on_screen()) {
                counter.start();
              }
          });

          if( svgAnimated ) {
			var svgPath;

            new Vivus('stm-stats-svg-' + counterId, {
                type: 'async',
                duration: 250,
                pathTimingFunction: Vivus.EASE_OUT,
                animTimingFunction: Vivus.EASE_OUT,
                onReady: function (svgInit) {
                    if( svgWidth ) {
                        svgInit.el.setAttribute('width', svgWidth);
                        svgInit.el.setAttribute('height', 'auto');
                    }

                    svgPath = svgInit.el.getElementsByTagName('path');
                    for( var i = 0; i < svgPath.length; i++ ) {
                        svgPath[i].style.stroke = iconColor;
                    }
                }
            });

            if( $("#site-skin-color").length ) {
                $(document).on("click", "#site-skin-color span", function() {
                    setTimeout(function(){
                        for( var i = 0; i < svgPath.length; i++ ) {
                            svgPath[i].style.stroke = $("#counter_" + counterId).closest(".stm-stats").find(".stm-stats__icon").css("color");
                        }
                    }, 500);
                });
            }
          }
      });
    })(jQuery);

</script>

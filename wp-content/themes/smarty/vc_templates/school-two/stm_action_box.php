<?php
/** Variables **/
$output = '';
$title = '';
$descr = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/** Styles **/
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Box styles
$action_box_classes = '';

$action_box_inline_styles = array(
  'text-align:' . esc_attr( $text_alignment )
);

$action_box_inline_style = smarty_element_style( $action_box_inline_styles );

// Title styles
$title_classes = '';

$title_inline_styles = array(
    'font-size:' . esc_attr( $title_font_size )
);

if( $title_color === 'custom' && !empty( $title_color_custom ) ) {
    $title_inline_styles[] = 'color:' . $title_color_custom;
} elseif ( !empty( $title_color ) && $title_color !== 'custom' ) {
    $title_classes .= ' stm-font_color_' . esc_attr( $title_color );
}

$title_inline_style = smarty_element_style( $title_inline_styles );

// Link
$action_box_link = vc_build_link($action_box_link);
?>

<div class="stm-action-box<?php echo esc_attr( $action_box_classes ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $action_box_inline_style ); ?>>
			<?php if( $style === 'caption' ): ?>
		    <figure class="stm-action-box__figure">
			    <?php if( !empty( $img_id ) ) : ?>
				      <?php
				          $img = wpb_getImageBySize(array(
					          'attach_id' => $img_id,
					          'thumb_size' => '350x180'
				          ));

				          echo wp_kses_post( $img['thumbnail'] );
				      ?>
			    <?php endif; ?>
			    <?php if( !empty( $title ) ) : ?>
				    <figcaption class="stm-action-box__figcaption">
					      <div class="stm-action-box__figcaption-title<?php echo esc_attr( $title_classes ); ?>" <?php echo safecss_filter_attr( $title_inline_style ); ?>>
						      <span class="stm-action-box__title-text"><?php echo esc_html( $title ); ?></span>
					      </div>
				    </figcaption>
			    <?php endif; ?>
			    <?php if( $action_box_link['url'] ) : ?>
				    <?php
					    if( ! $action_box_link['target'] ) {
						    $action_box_link['target'] = '_self';
					    }
				    ?>
			      <a class="stm-action-box__figcaption-link" href="<?php echo esc_url( $action_box_link['url'] ); ?>" target="<?php echo esc_attr( $action_box_link['target'] ); ?>"></a>
					<?php endif; ?>
		    </figure>
			<?php endif; ?>
</div>

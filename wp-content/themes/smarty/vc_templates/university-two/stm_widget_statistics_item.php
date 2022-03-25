<?php
$label = '';
$value = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<li class="stm-statistics__item">
	<?php if( $label != '' ) : ?>
		<div class="stm-statistics__item-label"><?php echo esc_html( $label ); ?></div>
	<?php endif; ?>

	<?php if( $value != '' ) : ?>
		<div class="stm-statistics__item-value"><?php echo esc_html( $value ); ?></div>
	<?php endif; ?>
</li>

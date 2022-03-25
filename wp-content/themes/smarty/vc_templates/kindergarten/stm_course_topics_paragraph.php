<?php
$title = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<?php if( $title != '' ) : ?>
<tr class="stm-table__heading"><td colspan="3"><?php echo esc_html( $title ); ?></td></tr>
<?php endif; ?>

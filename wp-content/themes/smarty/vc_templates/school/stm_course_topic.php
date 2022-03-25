<?php
$title = '';
$date = '';
$assignments = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<tr>
	<td><?php echo esc_html( $title ); ?></td>
	<td><?php echo esc_html( $date ); ?></td>
	<td><?php echo esc_html( $assignments ); ?></td>
</tr>

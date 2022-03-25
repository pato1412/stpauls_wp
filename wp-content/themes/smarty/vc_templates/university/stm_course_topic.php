<?php
$title = '';
$teacher = '';
$hours = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<tr>
	<td><?php echo esc_html( $title ); ?></td>
	<td><?php echo esc_html( $hours ); ?></td>
</tr>

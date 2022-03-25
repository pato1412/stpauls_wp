<?php
$stm_color = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === CELL ===
 *
 * 1. Content data
 * 2. Style
 *
 * */

// 1. Content data
if ( isset( $atts['stm_cell'] ) && strlen( $atts['stm_cell'] ) > 0 ) {
	$stm_cell = vc_param_group_parse_atts( $atts['stm_cell'] );
	if ( ! is_array( $stm_cell ) ) {
		$temp        = explode( ',', $atts['stm_cell'] );
		$paramValues = array();
		if( !empty( $temp ) ) {
			foreach ( $temp as $value ) {
				$data             = explode( '|', $value );
				$newLine          = array();
				$newLine['stm_text'] = isset( $data[0] ) ? $data[0] : 0;
				if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
					$newLine['stm_text'] = (float) str_replace( '%', '', $data[1] );
				}
				$paramValues[] = $newLine;
			}
		}
		$atts['stm_cell'] = urlencode( json_encode( $paramValues ) );
	}
}

// 2. Style
$stm_cell_styles = array(
	'border-left-color:' . esc_attr( $stm_color )
);
$stm_cell_style = smarty_element_style( $stm_cell_styles );

?>
<?php if( !empty( $stm_cell ) ) : ?>
<tr>
	<?php $i = 1; ?>
	<?php foreach( $stm_cell as $stm_cell_content ) : ?>
		<td <?php echo (( $i == 1 ) ? $stm_cell_style : ''); ?>>
			<?php if( !empty( $stm_cell_content['stm_text'] ) ) : ?>
				<?php echo wp_kses_post( $stm_cell_content['stm_text'] ); ?>
			<?php endif; ?>
		</td>
		<?php $i = 0; ?>
	<?php endforeach; ?>
</tr>
<?php endif; ?>

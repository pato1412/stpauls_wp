<?php
$heading = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( isset( $atts['heading'] ) && strlen( $atts['heading'] ) > 0 ) {
	$heading = vc_param_group_parse_atts( $atts['heading'] );
	if ( ! is_array( $heading ) ) {
		$temp        = explode( ',', $atts['heading'] );
		$paramValues = array();
		if( !empty( $temp ) ) {
			foreach ( $temp as $value ) {
				$data             = explode( '|', $value );
				$newLine          = array();
				$newLine['title'] = isset( $data[0] ) ? $data[0] : 0;
				if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
					$newLine['title'] = (float) str_replace( '%', '', $data[1] );
				}
				$paramValues[] = $newLine;
			}
		}
		$atts['heading'] = urlencode( json_encode( $paramValues ) );
	}
}
?>
<?php if( !empty( $heading ) ) : ?>
	<thead>
		<tr>
			<?php foreach( $heading as $heading_item ) : ?>
				<th><?php echo esc_html( $heading_item['title'] ); ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
<?php endif; ?>
<?php
	/* === VARIABLES === */
	$title = '';
	$subscribe_form_id = '';
	$launcher_alignment = '';

	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	extract( $atts );

	$modal_id = uniqid('stm-subscribe-popup-');
	$modal_label_id = uniqid('stm-subscribe-popup-label-');

	$launcher_class = '';

	if( !empty( $launcher_alignment ) ) {
		$launcher_class .= ' subscribe-modal-launcher_'. esc_attr( $launcher_alignment );
	}
?>
<?php if( function_exists( 'mc4wp_show_form' ) && !empty( $subscribe_form_id ) ) : ?>
	<div class="subscribe-modal-launcher-holder<?php echo esc_attr( $launcher_class ); ?>">
		<a href="#" class="subscribe-modal-launcher" data-toggle="modal" data-target="#<?php echo esc_attr( $modal_id ); ?>"><i class="fa fa-envelope-o"></i><?php esc_html_e('Subscribe', 'smarty'); ?></a>
	</div>
	<div class="modal modal_subscribe fade" id="<?php echo esc_attr( $modal_id ); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo esc_attr( $modal_label_id ); ?>">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<?php if( !empty( $title ) ) : ?>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="stm-icon stm-icon-times-thin" aria-hidden="true"></span></button>
						<h4 class="modal-title" id="<?php echo esc_attr( $modal_label_id ); ?>"><i class="fa fa-envelope-o"></i><?php echo esc_html( $title ); ?></h4>
					</div>
				<?php endif; ?>
				<div class="modal-body"><?php mc4wp_show_form( $subscribe_form_id ); ?></div>
			</div>
		</div>
	</div>
<?php endif; ?>
<script>
	(function($) {
		$(document).ready(function() {
			"use strict";

			var $modal = $( "#" + '<?php echo esc_js( $modal_id ); ?>' );

			if( $modal.length ) {
				$('#wrapper').append($modal);
			}
		});
	})(jQuery);
</script>


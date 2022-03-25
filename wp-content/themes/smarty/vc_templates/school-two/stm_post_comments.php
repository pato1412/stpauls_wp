<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<?php if( is_singular('stm_event') ) : ?>
<div class="join-event">
	<h4 class="join-event__title"><?php esc_html_e( 'Join event', 'smarty' ); ?></h4>
	<form action="<?php echo esc_url( home_url() ); ?>" method="post" class="form form_join-event">
		<div class="form__content">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<input type="text" name="event_member[name]" placeholder="<?php esc_attr_e( 'Name', 'smarty'); ?> *" value="" />
				</div>
				<div class="col-sm-4 col-xs-12">
					<input type="text" name="event_member[email]" placeholder="<?php esc_attr_e( 'E-Mail', 'smarty'); ?> *" value=""/>
				</div>
				<div class="col-sm-4 col-xs-12">
					<input type="text" name="event_member[phone]" placeholder="<?php esc_attr_e('Phone', 'smarty'); ?> *" value="" />
				</div>
				<div class="col-xs-12">
					<textarea name="event_member[message]" cols="30" rows="10" placeholder="<?php esc_attr_e('Message', 'smarty'); ?> *"></textarea>
				</div>
				<div class="col-xs-12">
					<button type="submit" class="form__submit stm-btn stm-btn_outline stm-btn_md stm-btn_blue stm-btn_icon-right"><?php esc_html_e('Submit', 'smarty'); ?><i class="stm-icon stm-icon-arrow-right"></i></button>
					<input type="hidden" name="action" value="event_join" />
					<input type="hidden" name="event_member[event_id]" value="<?php the_ID(); ?>" />
					<div class="form__loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
				</div>
			</div>
		</div>
		<div class="form__notice form__notice_information notice notice_information">
			<div class="notice__message">
				<?php esc_html_e('You already has been joined the event.', 'smarty'); ?>
			</div>
			<div class="notice__hide">&times;</div>
		</div>
		<div class="form__notice form__notice_success notice notice_success">
			<div class="notice__message">
				<?php esc_html_e('Thank you! You joined the event.', 'smarty'); ?>
			</div>
			<div class="notice__hide">&times;</div>
		</div>
	</form>
</div>
<?php else : ?>
<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
?>
<?php endif; ?>
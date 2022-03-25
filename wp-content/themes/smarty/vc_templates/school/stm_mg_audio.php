<?php
/* === VARIABLES === */
$title = '';
$item_count = '';
$view_type = '';
$button_link = '';
$button_text = '';

/* === GET ATTRIBUTES === */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === CSS CLASS === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === QUERY === */
$items_query_args = array(
	'post_type' => 'stm_media_gallery',
	'posts_per_page' => -1,
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key'     => 'media_featured',
			'value'   => 'on',
			'compare' => 'LIKE',
		),
		array(
			'key'     => 'media_type',
			'value'   => 'audio',
			'compare' => 'LIKE',
		)
	)
);

if( $item_count ) {
	$items_query_args['posts_per_page'] = $item_count;
}

$items_query = new WP_Query( $items_query_args );

/* === BUTTON ===
 *
 * 1. Link
 *
*/

// 1. Link
if( !empty( $button_link ) ) {
	$button_link = vc_build_link( $button_link );
	if( empty( $button_link['target'] ) ) $button_link['target'] = '_self';
}
?>

<?php if( $items_query->have_posts() ) : ?>

	<div class="stm-media-gallery stm-media-gallery_format_audio<?php echo esc_attr( $css_class ); ?>">
		<?php while( $items_query->have_posts() ) : $items_query->the_post(); ?>

		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<?php if( $media_item_embed = get_post_meta( get_the_ID() ,'media_item_embed', true ) ) : ?>
					<?php echo wp_kses( $media_item_embed, array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'scrolling' => array(), 'frameborder' => array() ) ) ); ?>
				<?php endif; ?>
			</div>
			<div class="col-sm-6 col-xs-12">
				<h4 class="stm-media-gallery__item-title"><?php the_title(); ?></h4>
				<?php if( $item_description = get_post_meta( get_the_ID() ,'media_item_descr', true ) ) : ?>
					<p class="stm-media-gallery__item-description"><?php echo esc_html( $item_description ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<?php endwhile; ?>

		<?php if( isset( $button_link['url'] ) && !empty( $button_link['url'] ) && $button_text ) : ?>
			<div class="stm-media-gallery__action stm-media-gallery__action_centered">
				<a href="<?php echo esc_url( $button_link['url'] ); ?>" class="stm-btn stm-btn_warning stm-btn_outline stm-btn_md stm-btn_icon-left"><i class="fa fa-soundcloud"></i><?php echo esc_html( $button_text ); ?></a>
			</div>
		<?php endif; ?>
	</div>

	<?php wp_reset_postdata(); ?>
<?php endif; ?>

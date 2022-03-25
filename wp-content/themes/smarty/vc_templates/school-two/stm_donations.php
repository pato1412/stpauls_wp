<?php
$donation_style = '';
$donations_count = '';
$pagination_enable = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Donations - WP Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$donations_q_args = array(
	'post_type' => 'stm_donation',
	'posts_per_page' => -1,
	'paged' => $paged
);

if( $donations_count ) {
	$donations_q_args['posts_per_page'] = $donations_count;
}

$donations_q = new WP_Query( $donations_q_args );

?>
<?php if( $donations_q->have_posts() ) : ?>

	<div class="stm-donations<?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $donation_style ); ?>">
		<div class="row">
			<?php while( $donations_q->have_posts() ) : $donations_q->the_post(); ?>
                <?php get_template_part('vc_templates/'. smarty_get_layout_mode() . '/stm_donations/' . $donation_style ); ?>
			<?php endwhile; ?>
			<?php
			if( $pagination_enable ) {
				//Pagination
				smarty_paging_nav( 'paging_view_posts-list', $donations_q );
			}
			?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>

<?php endif; ?>
<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<footer class="entry-footer<?php echo esc_attr( $css_class ); ?>">
	<?php
	$tags_list = get_the_tag_list();
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'smarty' ),
			$tags_list
		);
	}
	?>
    <?php if(!get_theme_mod('post_soc_show_hide', false)): ?>
	<div class="share entry-share">
		<span class="share__title"><?php esc_html_e('Share', 'smarty'); ?></span>
		<script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "07305ded-c299-419b-bbfc-2f15806f61b2", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

		<span class="share__item st_facebook_large" displayText='Facebook'></span>
		<span class="share__item st_twitter_large" displayText='Tweet'></span>
		<span class="share__item st_googleplus_large" displayText='Google +'></span>
		<span class="share__item st_sharethis_large" displayText='ShareThis'></span>
	</div>
    <?php endif; ?>
</footer>

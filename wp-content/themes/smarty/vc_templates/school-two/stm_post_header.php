<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<header class="entry-header<?php echo esc_attr( $css_class ); ?>">
	<div class="entry-date">
		<div class="entry-date__day"><?php echo get_the_date('j', get_the_ID()); ?></div>
		<div class="entry-date__month"><?php echo get_the_date('F', get_the_ID()); ?></div>
	</div>
	<div class="entry-header__heading">
		<h2 class="entry-title"><?php the_title(); ?></h2>
		<ul class="entry-meta">
			<li><span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'smarty' ) ); ?></span></li>
			<?php
			if ( ! is_multi_author() ) {
				printf( '<li><span class="byline"><span class="author vcard"><i class="fa fa-user"></i><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span></li>',
					_x( 'Author', 'Used before post author name.', 'smarty' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			}
			?>
			<li><i class="fa fa-commenting-o"></i><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'Leave a comment', 'smarty' ) . '</span>', esc_html__( '1 comment', 'smarty' ), esc_html__( '% comments', 'smarty' ) ); ?></li>
		</ul>
	</div>
</header>

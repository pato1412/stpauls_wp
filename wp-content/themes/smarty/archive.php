<?php get_header(); ?>
<?php get_template_part( 'parts/page', 'title' ); ?>
<?php get_template_part( 'parts/page', 'breadcrumbs' ); ?>
<?php
	$posts_sidebar_pos = get_theme_mod( 'posts_sidebar', 'right' );
	$posts_sidebar_id = get_theme_mod( 'posts_sidebar_id', 'wp' );
	$posts_sidebar = false;
	$content_layout = smarty_content_layout( $posts_sidebar_pos );

	if( !empty( $posts_sidebar_id ) && $posts_sidebar_id != 'wp' ) {
		$posts_sidebar_data = get_post( $posts_sidebar_id );

		if( $posts_sidebar_data ) {
			$posts_sidebar = 'vc';
		}
	} elseif( $posts_sidebar_id == 'wp' && is_active_sidebar( 'blog-sidebar' ) ) {
		$posts_sidebar = 'wp';
	}
?>

<div class="content<?php echo esc_attr( $content_layout['content_class'] ) ?>">
	<div class="container">
		<?php if( $posts_sidebar && $content_layout['sidebar'] ) echo wp_kses_post( $content_layout['main_before'] ); ?>
		<main class="main">
			<div class="stm-posts stm-posts_list">
				<?php if( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
                        <?php
                            smarty_get_layout_file('/parts', '/content');
                        ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'parts/content', 'none' ); ?>
				<?php endif; ?>
			</div><!-- /stm-posts stm-posts_list -->
			<?php smarty_paging_nav('paging_view_posts-list'); ?>
		</main><!-- /main -->
		<?php if( $posts_sidebar && $content_layout['sidebar'] ) echo wp_kses_post( $content_layout['main_after'] ); ?>
		<?php if( $posts_sidebar && $content_layout['sidebar'] ) : ?>
			<?php echo wp_kses_post( $content_layout["sidebar_before"] ); ?>
			<?php if( $posts_sidebar == 'wp' ) : ?>
				<?php get_sidebar(); ?>
			<?php elseif( $posts_sidebar == 'vc' ) : ?>
				<div class="stm-vc-sidebar">
                    <style type="text/css" scoped>
                        <?php echo get_post_meta( $posts_sidebar_data->ID, '_wpb_shortcodes_custom_css', true ); ?>
                    </style>
					<?php echo apply_filters( 'the_content', $posts_sidebar_data->post_content ); ?>
				</div>
			<?php endif; ?>
			<?php echo wp_kses_post( $content_layout["sidebar_after"] ); ?>
		<?php endif; ?>
	</div><!-- /сontainer -->
</div><!-- /content -->

<?php get_footer(); ?>
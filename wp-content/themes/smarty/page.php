<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <?php
    smarty_get_layout_file( '/parts', '/page-title' );
    smarty_get_layout_file( '/parts', '/page-breadcrumbs' );
    ?>
	<?php $vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>

	<div class="content<?php echo (( $vc_status != 'false' && $vc_status == true ) ? ' content_type_vc' : ''); ?>">
		<div class="container">
			<main class="main">
				<?php
				get_template_part( 'parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</main><!-- /main -->
		</div>
	</div><!-- /content -->
<?php endwhile; ?>
<?php get_footer(); ?>
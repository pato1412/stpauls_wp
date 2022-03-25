<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php
    smarty_get_layout_file( '/parts', '/page-title' );
    smarty_get_layout_file( '/parts', '/page-breadcrumbs' );
    ?>
    <div class="content">
		<div class="container">
			<main class="main">
				<div id="teacher-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</div>
			</main><!-- /Main -->
		</div>
	</div><!-- /Content -->
<?php endwhile; ?>
<?php get_footer(); ?>
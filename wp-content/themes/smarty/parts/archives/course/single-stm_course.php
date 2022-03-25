<?php
    get_header();
    while ( have_posts() ) : the_post();

    smarty_get_layout_file('/parts', '/page-title');
?>
	<div class="content">
		<div class="container">
			<main class="main">
				<article id="course-<?php the_ID(); ?>">
					<?php the_content(); ?>
				</article>
			</main><!-- /Main -->
		</div><!-- /Container -->
	</div><!-- /Content -->
<?php
    endwhile;

    get_footer();
?>
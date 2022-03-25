<div class="author-info">
	<div class="author-info__avatar">
		<?php
		$author_bio_avatar_size = apply_filters( 'smarty_author_bio_avatar_size', 87 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-info__content">
		<div class="author-info__heading"><?php esc_html_e( 'Author', 'smarty' ); ?>:</div>
		<div class="author-info__description">
			<div class="author-info__title"><a class="author-info__link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></div>
			<p class="author-info__bio">
				<?php the_author_meta( 'description' ); ?>
			</p><!-- .author-bio -->
		</div><!-- .author-description -->
	</div><!-- .author-content -->

</div><!-- .author-info -->

<?php
if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
	<div id="tertiary" class="sidebar sidebar_shop" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'shop-sidebar' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>
<?php
	/* Top Bar - Style 4 */

	$top_bar_language = get_theme_mod( 'top_bar_language', true );
?>

<div class="top-bar top-bar_view-style_4">
	<div class="container">
		<div class="top-bar__content">

            <?php
            /* --- Search --- */
            if( get_theme_mod( 'top_bar_search', true ) ) : ?>
                <div class="top-bar__search">
                    <?php echo get_search_form(); ?>
                </div>
            <?php endif; ?>

			<?php
            /* --- Contact Details --- */
            if( get_theme_mod( 'top_bar_contacts', true ) ) : ?>
                <?php $contact_details = get_theme_mod( 'contact_details', false ); ?>
                <?php if( !empty( $contact_details ) ): ?>
                    <ul class="contact_details__box">
                        <?php foreach( $contact_details as $contact_key => $contact_val ): ?>
                            <?php if( $contact_key == 'phone' && !empty( $contact_val ) ) : ?>
                                <li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $contact_val ) ); ?>"><?php echo wp_kses_data( $contact_val ); ?></a></li>
                            <?php elseif( $contact_key == 'email' && !empty( $contact_val ) ): ?>
                                <li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><a href="mailto:<?php echo esc_attr( str_replace( ' ', '', $contact_val ) ); ?>"><?php echo wp_kses_data( $contact_val ); ?></a></li>
                            <?php elseif( $contact_key == 'address' && !empty( $contact_val ) ): ?>
                                <li class="top-bar__contact top-bar__contact_<?php echo esc_attr( $contact_key ); ?>"><?php echo wp_kses_data( $contact_val ); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>

            <?php
            /* --- Shopping_Cart --- */
            if( get_theme_mod( 'top_bar_shopping_cart', true ) ) : ?>
                <?php smarty_get_layout_file('/parts', '/mini-cart'); ?>
            <?php endif; ?>

		</div><!-- / top-bar__content -->
	</div><!-- / container -->
</div><!-- / top-bar -->
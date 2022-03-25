<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="stm-donation">
        <?php if( has_post_thumbnail() ): ?>
            <div class="stm-donation__thumbnail">
                <?php
                $thumbnail = wpb_getImageBySize( array(
                    'attach_id'  => get_post_thumbnail_id(),
                    'thumb_size' => '455x455'
                ) );
                ?>
                <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail['thumbnail'] ); ?></a>
            </div>
        <?php else : ?>
            <div class="stm-donation__thumbnail">
                <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url( SMARTY_TEMPLATE_URI . '/assets/img/tmp/placeholder.jpg' ); ?>" alt="<?php echo esc_attr__('Placeholder', 'smarty'); ?>"></a>
            </div>
        <?php endif; ?>

        <div class="stm-donation__body">
            <div class="stm-donation__content">
                <h5 class="stm-donation__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <?php
                // Data
                $stm_donation_goal = get_post_meta( get_the_ID(), 'stm_donation_goal', true );
                $stm_donation_raised = get_post_meta( get_the_ID(), 'stm_donation_raised', true );
                $stm_donation_currency = get_post_meta( get_the_ID(), 'stm_donation_currency', true );
                $stm_donation_donors = get_post_meta( get_the_ID(), 'stm_donation_donors', true );
                $stm_donation_currency_pos = get_post_meta( get_the_ID(), 'stm_donation_currency_pos', true );

                // Progress
                $stm_donation_progress = 0;
                if( $stm_donation_goal != '' && $stm_donation_raised != '' ) {
                    $stm_donation_progress = round(( $stm_donation_raised / $stm_donation_goal ) * 100);
                    if ( $stm_donation_progress > 100 || $stm_donation_progress == 100 ) {
                        $stm_donation_progress = 100;
                    }
                }
                ?>

                <?php if( $stm_donation_goal != '' ) : ?>
                    <?php
                    // Donated
                    $stm_donation_donated = $stm_donation_progress . esc_html__('%' , 'smarty');
                    $stm_donation_donated .= '&nbsp;' . esc_html__( 'Donated of', 'smarty' );

                    if( $stm_donation_currency_pos == 'right' ) {
                        $stm_donation_donated .= '&nbsp;' . number_format($stm_donation_goal) . $stm_donation_currency;
                    } else {
                        $stm_donation_donated .= '&nbsp;' . $stm_donation_currency . number_format($stm_donation_goal);
                    }
                    ?>
                    <div class="stm-donation__donated"><?php echo esc_html( $stm_donation_donated ); ?></div>
                <?php else: ?>
                    <div class="stm-donation__donated"><?php esc_html_e( 'Please, Set goal', 'smarty' ); ?></div>
                <?php endif; ?>

                <div class="stm-donation__progress">
                    <div class="stm-donation__progress-bar" style="width:<?php echo esc_attr( $stm_donation_progress ) . '%' ; ?>"></div>
                </div>

                <a href="<?php the_permalink() ?>" class="donate_link">
                <?php esc_html_e( 'Donate now', 'smarty' ); ?> <span class="stm-icon stm-icon-arrow-top-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
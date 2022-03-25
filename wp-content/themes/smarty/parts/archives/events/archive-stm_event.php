<?php
get_header();
smarty_get_layout_file('/parts', '/page-title');
?>
<div class="content">
    <div class="container">
        <main class="main">
            <?php if( have_posts() ) : ?>
                <div class="stm-events">
                    <div class="row">
                        <?php while( have_posts() ) : the_post(); ?>
                            <div class="col-md-6 col-sm-12">
                                <div class="stm-event stm-event_view_grid">
                                    <div class="stm-event__body">
                                        <div class="stm-event__left">
                                            <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                                                <div class="stm-event__date">
                                                    <div class="stm-event__date-day"><?php echo date_i18n( 'j', $stm_event_date_start ); ?></div>
                                                    <div class="stm-event__date-month"><?php echo date_i18n( 'F', $stm_event_date_start ); ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="stm-event__content">
                                            <div class="stm-event__meta">
                                                <ul>
                                                    <?php if( $stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true ) ) : ?>
                                                        <li><span class="stm-event__time"><i class="fa fa-clock-o"></i><?php echo esc_html( $stm_event_time_text ); ?></span></li>
                                                    <?php else: ?>
                                                        <?php
                                                        $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
                                                        $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );
                                                        ?>
                                                        <?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
                                                            <li>
                                                                <span class="stm-event__time"><i class="fa fa-clock-o"></i>
                                                                    <?php
                                                                    if( !empty( $stm_event_time_start ) && !empty( $stm_event_time_end ) ) {
                                                                        echo esc_html( $stm_event_time_start ) . ' ' . esc_html__( 'to', 'smarty' ) . ' ' . esc_html( $stm_event_time_end );
                                                                    } elseif( empty( $stm_event_time_start ) ) {
                                                                        echo esc_html( $stm_event_time_end );
                                                                    } elseif( empty( $stm_event_time_end ) ) {
                                                                        echo esc_html( $stm_event_time_start );
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                                                        <li><span class="stm-event__venue"><i class="fa fa-map-marker"></i><?php echo esc_html($stm_event_venue); ?></span></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                            <h5 class="stm-event__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                                            <div class="stm-event__summary"><?php the_excerpt(); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php smarty_paging_nav( 'paging_view_posts-list' ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php get_footer(); ?>
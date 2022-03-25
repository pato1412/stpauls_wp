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
                                <div class="stm-event stm-event_view_grid <?php if( has_post_thumbnail() ) : ?>events_post__has_thumbnail<?php endif; ?>">
                                    <div class="stm-event__body">
                                        <?php if( has_post_thumbnail() ) : ?>
                                            <div class="stm-event__left">
                                                <?php
                                                // Thumbnail size
                                                $thumb_size = '450x450';

                                                $thumb = wpb_getImageBySize( array(
                                                    'attach_id'  => get_post_thumbnail_id(),
                                                    'thumb_size' => $thumb_size
                                                ) );
                                                ?>
                                                <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $thumb['thumbnail'] ); ?></a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="stm-event__content">
                                            <h5 class="stm-event__title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                                            <div class="stm-event__meta">
                                                <ul>
                                                    <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
                                                        <li>
                                                            <div class="stm-event__date">
                                                                <span class="stm-icon stm-icon-calendar"></span> <?php echo date_i18n( 'F j, Y', $stm_event_date_start ); ?>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if( $stm_event_time_text = get_post_meta( get_the_ID(), 'stm_event_time_text', true ) ) : ?>
                                                        <li>
                                                            <div class="stm-event__time">
                                                                <span class="stm-icon stm-icon-time"></span> <?php echo esc_html( $stm_event_time_text ); ?>
                                                            </div>
                                                        </li>
                                                    <?php else: ?>
                                                        <?php
                                                        $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
                                                        $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );
                                                        ?>
                                                        <?php if( !empty( $stm_event_time_start ) || !empty( $stm_event_time_end ) ) : ?>
                                                            <li>
                                                                <span class="stm-event__time"><span class="stm-icon stm-icon-time"></span>
                                                                    <?php
                                                                    if( $stm_event_time_start != '' && $stm_event_time_end != '' ) {
                                                                        echo esc_html( $stm_event_time_start ) . ' ' . esc_html__('to', 'smarty') . ' ' . esc_html( $stm_event_time_end );
                                                                    } elseif( $stm_event_time_start == '' ) {
                                                                        echo esc_html( $stm_event_time_end );
                                                                    } elseif( $stm_event_time_end == '' ) {
                                                                        echo esc_html( $stm_event_time_start );
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
                                                        <li>
                                                            <div class="stm-event__venue">
                                                                <span class="stm-icon stm-icon-location"></span> <?php echo esc_html($stm_event_venue); ?>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
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
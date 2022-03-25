<div class="stm-event">

    <?php if( has_post_thumbnail() ) : ?>
    <a href="<?php the_permalink() ?>" class="stm-event_thumb">
        <?php
            $img = wpb_getImageBySize( array( 'attach_id' => get_post_thumbnail_id(), 'thumb_size' => '432x366' ) );
            echo wp_kses_post( $img['thumbnail'] );
        ?>
    </a>
    <?php if( $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true ) ) : ?>
        <div class="stm-event__date">
            <div class="stm-event__date-day"><?php echo date_i18n( 'j', $stm_event_date_start ); ?></div>
            <div class="stm-event__date-month"><?php echo date_i18n( 'M', $stm_event_date_start ); ?></div>
        </div>
    <?php endif; ?>
    <?php endif; ?>

    <a href="<?php the_permalink() ?>" class="stm-event_content">
        <span class="event_title"><?php the_title(); ?></span>
        <?php if( $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true ) ) : ?>
            <span class="event_address"><?php echo esc_html( $stm_event_venue ); ?></span>
        <?php endif; ?>
    </a>
</div>
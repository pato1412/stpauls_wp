<?php
$img_id = $title = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );

$img_size = '160x190';

if( ! $count ) {
	$count = -1;
}

$stm_administrators_q = new WP_Query(array(
	'post_type' => 'stm_administrator',
	'posts_per_page' => $count
));

?>

<?php if( $stm_administrators_q->have_posts() ) : ?>

<div class="stm-administrators<?php echo esc_attr( $css_class ); ?>">
    <?php while( $stm_administrators_q->have_posts() ) : $stm_administrators_q->the_post(); ?>
    <div class="stm-administrator stm-administrator_view_list-item">
            <?php if( has_post_thumbnail() ) : ?>
                <?php
                    $img = wpb_getImageBySize( array(
                        'attach_id' => get_post_thumbnail_id(),
                        'thumb_size' => $img_size
                    ) );
                ?>
            <div class="stm-administrator__photo">
                <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $img['thumbnail'] ); ?></a>
            </div>
            <?php endif; ?>
            <div class="stm-administrator__info">
                <div class="stm-administrator__info-content">
                    <?php if( $administrator_position = get_post_meta( get_the_ID(), 'stm_administrator_position', true ) ) : ?>
                        <div class="stm-administrator__position"><?php echo esc_html( $administrator_position ); ?></div>
                    <?php endif; ?>
                    <div class="stm-administrator__name"><?php the_title(); ?></div>
                    <?php if( $administrator_description = get_post_meta( get_the_ID(), 'stm_administrator_description', true ) ) : ?>
                        <div class="stm-administrator__description"><?php echo esc_html( $administrator_description ); ?></div>
                    <?php endif; ?>
                    <?php if( !empty( $socials_enable ) ) : ?>
                        <div class="stm-administrator__socials">
                            <?php
                            $administrator_socials = array(
                                'facebook' => get_post_meta( get_the_ID(), 'stm_administrator_fb', true ),
                                'twitter' => get_post_meta( get_the_ID(), 'stm_administrator_tw', true ),
                                'google-plus' => get_post_meta( get_the_ID(), 'stm_administrator_gplus', true ),
                                'instagram' => get_post_meta( get_the_ID(), 'stm_administrator_inst', true ),
                                'envelope' => get_post_meta( get_the_ID(), 'stm_administrator_email', true ),
                            )
                            ?>
                            <ul class="socials-list socials-list_type_administrator">
                                <?php foreach( $administrator_socials as $administrator_social_name => $administrator_social_url ) : ?>
                                    <?php if( !empty( $administrator_social_url ) ) : ?>
                                        <li class="socials-list__item">
                                            <?php if( $administrator_social_name == 'envelope' ) : ?>
                                            <a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $administrator_social_name ) ?>" href="mailto:<?php echo esc_attr( $administrator_social_url ); ?>">
                                                <?php else : ?>
                                                <a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $administrator_social_name ) ?>" href="<?php echo esc_url( $administrator_social_url ); ?>" target="_blank">
                                                    <?php endif; ?>
                                                    <?php if( $administrator_social_name !== 'instagram' && $administrator_social_name !== 'envelope' ): ?>
                                                        <span class="fa fa-<?php echo esc_attr( $administrator_social_name ); ?>"></span>
                                                    <?php else: ?>
                                                        <span class="stm-icon stm-icon-<?php echo esc_attr( $administrator_social_name ); ?>"></span>
                                                    <?php endif; ?>
                                                </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink() ?>" class="stm-administrator__profile_link"><?php esc_html_e( 'Read full profile', 'smarty' ); ?></a>
                </div>
            </div>
    </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>

<?php endif; ?>
<?php
$img_id = $title = '';
$teachers_category = '';
$teachers_per_row = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$img_size = '350x240';

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$stm_teachers_args = array(
	'post_type' => 'stm_teacher',
    'paged' 		 => $paged,
	'posts_per_page' => -1
);

if( $count ) {
    $stm_teachers_args['posts_per_page'] = $count;
}

if( $teachers_category ) {
    $stm_teachers_args['stm_teacher_category'] = $teachers_category;
}

if( $teachers_department ) {
    $stm_teachers_args['stm_course_department'] = $teachers_department;
}

$stm_teachers_q = new WP_Query( $stm_teachers_args );

?>
<?php if( $stm_teachers_q->have_posts() ) : ?>

<div class="stm-teachers<?php echo esc_attr( $css_class ); ?>">
	<div class="row">
		<?php while( $stm_teachers_q->have_posts() ) : $stm_teachers_q->the_post(); ?>
		<div class="stm-teacher stm-teacher_view_grid-item col-lg-<?php echo esc_html( $teachers_per_row ); ?> col-md-<?php echo esc_html( $teachers_per_row ); ?> col-sm-6 col-xs-12">
            <?php if( has_post_thumbnail() ) : ?>
                <?php
                    $img = wpb_getImageBySize( array(
                        'attach_id' => get_post_thumbnail_id(),
                        'thumb_size' => $img_size
                    ) );
                ?>
            <div class="stm-teacher__photo">
                <a href="<?php the_permalink() ?>"><?php echo wp_kses_post( $img['thumbnail'] ); ?>
                </a>
            </div>
            <?php endif; ?>
            <div class="stm-teacher__info">
                <div class="stm-teacher__info-content">
                    <?php if( $teacher_position = get_post_meta( get_the_ID(), 'stm_teacher_position', true ) ) : ?>
                        <div class="stm-teacher__position"><?php echo esc_html( $teacher_position ); ?></div>
                    <?php endif; ?>
                    <div class="stm-teacher__name"><?php the_title(); ?></div>
                </div>
                <div class="stm-teacher__socials">
                    <?php
                    $teacher_socials = array(
                        'facebook' => get_post_meta( get_the_ID(), 'stm_teacher_fb', true ),
                        'twitter' => get_post_meta( get_the_ID(), 'stm_teacher_tw', true ),
                        'google-plus' => get_post_meta( get_the_ID(), 'stm_teacher_gplus', true ),
                        'instagram' => get_post_meta( get_the_ID(), 'stm_teacher_inst', true ),
                        'envelope' => get_post_meta( get_the_ID(), 'stm_teacher_email', true ),
                    )
                    ?>
                    <ul class="socials-list socials-list_type_teacher">
                        <?php foreach( $teacher_socials as $teacher_social_name => $teacher_social_url ) : ?>
                            <?php if( !empty( $teacher_social_url ) ) : ?>
                                <li class="socials-list__item">
                                    <?php if( $teacher_social_name == 'envelope' ) : ?>
                                    <a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $teacher_social_name ) ?>" href="mailto:<?php echo esc_attr( $teacher_social_url ); ?>">
                                    <?php else : ?>
                                    <a class="socials-list__item-link socials-list__item-link_type_<?php echo esc_attr( $teacher_social_name ) ?>" href="<?php echo esc_url( $teacher_social_url ); ?>" target="_blank">
                                        <?php endif; ?>
                                        <?php if( $teacher_social_name !== 'instagram' && $teacher_social_name !== 'envelope' ): ?>
                                            <span class="fa fa-<?php echo esc_attr( $teacher_social_name ); ?>"></span>
                                        <?php else: ?>
                                            <span class="stm-icon stm-icon-<?php echo esc_attr( $teacher_social_name ); ?>"></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</div>

<?php endif; ?>
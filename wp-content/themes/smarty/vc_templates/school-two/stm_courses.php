<?php
$courses_count = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Classes - WP Query
$courses_query_args = array(
	'post_type' => 'stm_course',
	'posts_per_page' => -1,
);

if( $courses_count ) {
	$courses_query_args['posts_per_page'] = $courses_count;
}

$courses_query = new WP_Query( $courses_query_args );
?>
<?php if( $courses_query->have_posts() ) : ?>

	<table class="stm-table stm-table_style-1 stm-courses stm-courses_table<?php echo esc_attr( $css_class ); ?>">
			<thead>
				<tr>
					<th><?php esc_html_e('Class name', 'smarty'); ?></th>
					<th><?php esc_html_e('Teacher', 'smarty'); ?></th>
					<th><?php esc_html_e('Assignments', 'smarty'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php while( $courses_query->have_posts() ) : $courses_query->the_post(); ?>
				<tr>
					<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
					<?php
						if( $course_teacher_id = get_post_meta( get_the_ID(), 'course_teacher', true ) ) {
								$course_teacher = '<a href="'. esc_url( get_the_permalink( $course_teacher_id ) ) .'">' . get_the_title( $course_teacher_id ) . '</a>';
						} else {
								$course_teacher = esc_html__('', 'smarty');
						}
					?>
					<td><?php echo wp_kses_post( $course_teacher ); ?></td>
					<td><?php echo (( $course_assignments = get_post_meta( get_the_ID(), 'course_assignments', true ) ) ? $course_assignments : 0 ); ?></td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			<?php wp_reset_postdata(); ?>
	</table>

<?php endif; ?>
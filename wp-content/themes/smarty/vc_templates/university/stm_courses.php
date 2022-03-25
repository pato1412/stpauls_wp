<?php
$courses_count = '';
$course_category = '';
$pagination_enable = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Classes - WP Query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$courses_query_args = array(
	'post_type' => 'stm_course',
	'posts_per_page' => -1,
    'paged' => $paged,
);

if( $courses_count ) {
	$courses_query_args['posts_per_page'] = $courses_count;
}

if( $course_category ) {
    $courses_query_args['stm_course_department'] = $course_category;
}

$courses_query = new WP_Query( $courses_query_args );
?>
<?php if( $courses_query->have_posts() ) : ?>

	<table class="stm-table stm-table_style-1 stm-courses stm-courses_table<?php echo esc_attr( $css_class ); ?>">
			<thead>
				<tr>
					<th><?php esc_html_e('Course name', 'smarty'); ?></th>
					<th><?php esc_html_e('Department', 'smarty'); ?></th>
					<th><?php esc_html_e('Semester', 'smarty'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php while( $courses_query->have_posts() ) : $courses_query->the_post(); ?>
				<tr>
					<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
					<td>
                        <?php
                        $terms = wp_get_post_terms(get_the_ID(), 'stm_course_department');
                        $names = array();
                        foreach($terms as $term){
                            $names[] = $term->name;
                        }
                        echo implode(', ', $names);
                        ?>
                    </td>
					<td style="text-align: right">
                        <?php
                            $terms = wp_get_post_terms(get_the_ID(), 'stm_course_semester');
                            $names = array();
                            foreach($terms as $term){
                                $names[] = $term->name;
                            }
                            echo implode(', ', $names);
                        ?>
                    </td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			<?php wp_reset_postdata(); ?>
	</table>
    <?php
    if( $pagination_enable ) {
        //Pagination
        smarty_paging_nav( 'paging_view_posts-list', $courses_query );
    }
    ?>


<?php endif; ?>
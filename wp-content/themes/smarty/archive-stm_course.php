<?php get_header(); ?>
<?php get_template_part( 'parts/page', 'title' ); ?>
<div class="content">
    <div class="container">
        <main class="main">

        <?php if( have_posts() ) : ?>

            <table class="stm-table stm-table_style-1 stm-courses stm-courses_table">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Class name', 'smarty'); ?></th>
                        <th><?php esc_html_e('Teacher', 'smarty'); ?></th>
                        <th><?php esc_html_e('Assignments', 'smarty'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php while( have_posts() ) : the_post(); ?>
                    <tr>
                        <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                        <?php
                        if( $course_teacher_id = get_post_meta( get_the_ID(), 'course_teacher', true ) ) {
                            $course_teacher = '<a href="'. esc_url( get_the_permalink( $course_teacher_id ) ) .'">' . get_the_title( $course_teacher_id ) . '</a>';
                        } else {
                            $course_teacher = esc_html__('Teacher didn\'t  selected', 'smarty');
                        }
                        ?>
                        <td><?php echo wp_kses_post( $course_teacher ); ?></td>
                        <td><?php echo (( $course_assignments = get_post_meta( get_the_ID(), 'course_assignments', true ) ) ? $course_assignments : 0 ); ?></td>
                    </tr>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                </tbody>
            </table>

        <?php endif; ?>

        </main><!-- /main --->
    </div><!-- /сontainer -->
</div><!-- /content -->
<?php get_footer(); ?>

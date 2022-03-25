<?php
get_header();
smarty_get_layout_file( '/parts', '/page-title' );
smarty_get_layout_file( '/parts', '/page-breadcrumbs' );
?>
<div class="content">
    <div class="container">
        <main class="main">
            <?php if( have_posts() ) : ?>
                <div class="stm-teachers">
                    <div class="row">
                        <?php while( have_posts() ) : the_post(); ?>
                            <div class="stm-teacher stm-teacher_view_grid-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <?php if( has_post_thumbnail() ) : ?>
                                    <div class="stm-teacher__photo">
                                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'post-thumbnail' ); ?></a>
                                    </div>
                                <?php endif; ?>
                                <div class="stm-teacher__info">
                                    <div class="stm-teacher__info-content">
                                        <div class="stm-teacher__name"><?php the_title(); ?></div>
                                        <?php if( $teacher_position = get_post_meta( get_the_ID(), 'stm_teacher_position', true ) ) : ?>
                                            <div class="stm-teacher__position"><?php echo esc_html( $teacher_position ); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="stm-teacher__socials">
                                        <?php
                                        $teacher_socials = array(
                                            'facebook' => get_post_meta( get_the_ID(), 'stm_teacher_fb', true ),
                                            'twitter' => get_post_meta( get_the_ID(), 'stm_teacher_tw', true ),
                                            'google-plus' => get_post_meta( get_the_ID(), 'stm_teacher_gplus', true ),
                                            'instagram' => get_post_meta( get_the_ID(), 'stm_teacher_inst', true ),
                                            'envelope' => get_post_meta( get_the_ID(), 'stm_teacher_email', true ),
                                        );
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
        </main><!-- /main --->
    </div><!-- /сontainer -->
</div><!-- /content -->
<?php get_footer(); ?>

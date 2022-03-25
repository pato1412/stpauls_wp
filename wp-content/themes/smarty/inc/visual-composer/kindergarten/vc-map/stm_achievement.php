<?php
$achievement_cat_terms = get_terms( 'stm_achievement_category' );

if( !empty( $achievement_cat_terms ) && ! is_wp_error( $achievement_cat_terms ) ) {

    foreach( $achievement_cat_terms as $achievement_cat_term ) {
        $stm_achievement_cat_params[] = array(
            'type' => 'checkbox',
            'heading' => $achievement_cat_term->name,
            'param_name' => 'stm_cat_' . $achievement_cat_term->slug
        );
    }
}

$stm_achievement_params = array(
    array(
        'type'       => 'textfield',
        'heading'    => esc_html__( 'Items per page', 'smarty' ),
        'param_name' => 'posts_count',
        'description' => esc_html__('By default unlimited posts', 'smarty')
    ),
    array(
        'type'       => 'textfield',
        'heading'    => esc_html__( 'Image size', 'smarty' ),
        'param_name' => 'img_size',
        'description' => esc_html__('Default size: 548x342, Example: 300x300', 'smarty')
    ),
    array(
        'type'       => 'css_editor',
        'heading'    => esc_html__( 'Css', 'smarty' ),
        'param_name' => 'css',
        'group'      => esc_html__( 'Design options', 'smarty' )
    )
);

if( isset( $stm_achievement_cat_params ) ) {
    $stm_achievement_params = array_merge($stm_achievement_cat_params, $stm_achievement_params);
}

vc_map( array(
    'name'        => esc_html__( 'Achievement', 'smarty' ),
    'base'        => 'stm_achievement',
    'category'    => esc_html__( 'STM', 'smarty' ),
    'params'      => $stm_achievement_params
) );
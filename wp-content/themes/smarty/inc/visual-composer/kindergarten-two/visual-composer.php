<?php
add_action( 'vc_before_init', 'smarty_vc_set_as_theme' );

if ( ! function_exists('smarty_vc_set_as_theme') ) {
    function smarty_vc_set_as_theme() {
        vc_set_as_theme( true );
    }
}

if( function_exists( 'vc_set_default_editor_post_types' ) ){
    vc_set_default_editor_post_types( array( 'page', 'post', 'stm_sidebar', 'stm_course', 'stm_footer', 'stm_teacher', 'stm_event', 'stm_donation' ) );
}

add_action('vc_after_init', 'smarty_remove_param');

if( ! function_exists('smarty_remove_param') ) {
    function smarty_remove_param() {
        if( function_exists('vc_remove_param') ) {
            vc_remove_param('vc_tta_accordion', 'style');
            vc_remove_param('vc_tta_accordion', 'shape');
            vc_remove_param('vc_tta_accordion', 'color');
            vc_remove_param('vc_tta_accordion', 'spacing');
            vc_remove_param('vc_tta_accordion', 'no_fill');
            vc_remove_param('vc_tta_accordion', 'c_align');
            vc_remove_param('vc_tta_accordion', 'autoplay');

            //Tabs
            vc_remove_param( 'vc_tta_tabs', 'title' );
            vc_remove_param( 'vc_tta_tabs', 'style' );
            vc_remove_param( 'vc_tta_tabs', 'color' );
            vc_remove_param( 'vc_tta_tabs', 'spacing' );
            vc_remove_param( 'vc_tta_tabs', 'gap' );
            vc_remove_param( 'vc_tta_tabs', 'alignment' );
            vc_remove_param( 'vc_tta_tabs', 'pagination_style' );
            vc_remove_param( 'vc_tta_tabs', 'pagination_color' );
        }
    }
}

add_action( 'vc_after_init', 'smarty_update_existing_shortcodes' );

if( ! function_exists('smarty_update_existing_shortcodes') ) {
    function smarty_update_existing_shortcodes(){
        if ( function_exists( 'vc_add_params' ) ) {

            vc_add_params( 'vc_tta_tabs', array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Tabs - Style', 'smarty' ),
                    'param_name' => 'stm_tabs_style',
                    'weight' => 5,
                    'value' => array(
                        esc_html__( 'Justify', 'smarty' )  => 'style-1',
                        esc_html__( 'Justify small', 'smarty' )  => 'style-2',
                    )
                )
            ));

            vc_add_params( 'vc_tta_accordion', array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Style', 'smarty' ),
                    'param_name' => 'stm_accordion_style',
                    'weight' => 5,
                    'value' => array(
                        esc_html__( 'Outline', 'smarty' )  => 'outline'
                    )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Color', 'smarty' ),
                    'param_name' => 'stm_accordion_color',
                    'weight' => 10,
                    'value' => array(
                        esc_html__( 'Yellow', 'smarty' )  => 'yellow',
                        esc_html__( 'Blue', 'smarty' )  => 'blue'
                    )
                )
            ));

            vc_add_params( 'vc_progress_bar', array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'View style', 'smarty' ),
                    'param_name' => 'progress_bar_view',
                    'weight' => 5,
                    'value' => array(
                        esc_html__( 'Large', 'smarty' )  => 'large',
                        esc_html__( 'Compact', 'smarty' )  => 'compact'
                    )
                )
            ));

            vc_add_params( 'vc_message', array(
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Hide Icon', 'smarty' ),
                    'param_name' => 'hide_icon',
                    'weight' => 20,
                    'value' => ''
                )
            ));
        }
    }
}

if ( function_exists( 'vc_map' ) ) {

    if ( ! function_exists('smarty_vc_map_shortcodes') ) {

        function smarty_vc_map_shortcodes() {
            $custom_vc_map_path = get_template_directory() . '/inc/visual-composer/'.smarty_get_layout_mode().'/vc-map';

            // Achievement
            require_once $custom_vc_map_path . '/stm_achievement.php';

            // Spacing
            vc_map( array(
                'name'        => esc_html__( '(STM) Spacing', 'smarty' ),
                'base'        => 'stm_spacing',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Large Screen', 'smarty' ),
                        'param_name' => 'lg_spacing'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Medium Screen', 'smarty' ),
                        'param_name' => 'md_spacing'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Small Screen', 'smarty' ),
                        'param_name' => 'sm_spacing'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Extra Small Screen', 'smarty' ),
                        'param_name' => 'xs_spacing'
                    )
                )
            ) );

            // Title
            vc_map( array(
                'name'        => esc_html__( '(STM) Title', 'smarty' ),
                'base'        => 'stm_title',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Page title', 'smarty' ),
                        'param_name' => 'page_title_enable'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Tag', 'smarty' ),
                        'param_name' => 'title_tag',
                        'value' => array(
                            esc_html__( 'H1', 'smarty' ) => 'h1',
                            esc_html__( 'H2', 'smarty' ) => 'h2',
                            esc_html__( 'H3', 'smarty' ) => 'h3',
                            esc_html__( 'H4', 'smarty' ) => 'h4',
                            esc_html__( 'H5', 'smarty' ) => 'h5',
                            esc_html__( 'H6', 'smarty' ) => 'h6',
                            esc_html__( 'Div', 'smarty' ) => 'div'
                        ),
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Separator', 'smarty' ),
                        'param_name' => 'sep_enable'
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Subtitle', 'smarty' ),
                        'param_name' => 'subtitle_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Alignment', 'smarty' ),
                        'param_name' => 'title_align',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'title_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Black', 'smarty' ) => 'black',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'title_color_custom',
                        'dependency' => array( 'element' => 'title_color', 'value' => 'custom' )
                    ),
                    array(
                        'type' => 'textarea_html',
                        'heading' => esc_html__( 'Text', 'smarty' ),
                        'param_name' => 'content',
                        'dependency' => array( 'element' => 'subtitle_enable', 'value' => 'true' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Font size', 'smarty' ),
                        'param_name' => 'subtitle_font_size',
                        'dependency' => array( 'element' => 'subtitle_enable', 'value' => 'true' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Font weight', 'smarty' ),
                        'param_name' => 'subtitle_font_weight',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Thin', 'smarty' ) => 100,
                            esc_html__( 'Light', 'smarty' ) => 300,
                            esc_html__( 'Regular', 'smarty' ) => 400,
                            esc_html__( 'Medium', 'smarty' ) => 500,
                            esc_html__( 'Bold', 'smarty' ) => 700,
                            esc_html__( 'Black', 'smarty' ) => 900
                        ),
                        'dependency' => array( 'element' => 'subtitle_enable', 'value' => 'true' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Font style', 'smarty' ),
                        'param_name' => 'subtitle_font_style',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Normal', 'smarty' ) => 'normal',
                            esc_html__( 'Italic', 'smarty' ) => 'italic'
                        ),
                        'dependency' => array( 'element' => 'subtitle_enable', 'value' => 'true' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Line height', 'smarty' ),
                        'param_name' => 'subtitle_line_height',
                        'dependency' => array( 'element' => 'subtitle_enable', 'value' => 'true' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'subtitle_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'dependency' => array( 'element' => 'subtitle_enable', 'value' => 'true' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Custom', 'smarty' ),
                        'param_name' => 'subtitle_color_custom',
                        'dependency' => array( 'element' => 'subtitle_color', 'value' => 'custom' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Margin bottom', 'smarty' ),
                        'param_name' => 'subtitle_margin_b',
                        'dependency' => array( 'element' => 'subtitle_enable', 'value' => 'true' ),
                        'group' => esc_html__('Subtitle', 'smarty')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'sep_position',
                        'value' => array(
                            esc_html__( 'Bottom', 'smarty' ) => 'bottom',
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                        ),
                        'dependency' => array( 'element' => 'sep_enable', 'value' => 'true' ),
                        'group' => esc_html__('Separator', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Margin bottom', 'smarty' ),
                        'param_name' => 'sep_margin_b',
                        'dependency' => array( 'element' => 'sep_enable', 'value' => 'true' ),
                        'group' => esc_html__('Separator', 'smarty')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Line - Color', 'smarty' ),
                        'param_name' => 'sep_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'dependency' => array( 'element' => 'sep_enable', 'value' => 'true' ),
                        'group' => esc_html__('Separator', 'smarty')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Line - Color custom', 'smarty' ),
                        'param_name' => 'sep_color_custom',
                        'dependency' => array( 'element' => 'sep_color', 'value' => 'custom' ),
                        'group' => esc_html__('Separator', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Line - Width', 'smarty' ),
                        'param_name' => 'sep_line_width',
                        'dependency' => array( 'element' => 'sep_enable', 'value' => 'true' ),
                        'group' => esc_html__('Separator', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Line - Height', 'smarty' ),
                        'param_name' => 'sep_line_height',
                        'dependency' => array( 'element' => 'sep_enable', 'value' => 'true' ),
                        'group' => esc_html__('Separator', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title - Font size', 'smarty' ),
                        'param_name' => 'title_font_size',
                        'group' => esc_html__('CSS', 'smarty')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Title - Font weight', 'smarty' ),
                        'param_name' => 'title_font_weight',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Thin', 'smarty' ) => 100,
                            esc_html__( 'Light', 'smarty' ) => 300,
                            esc_html__( 'Regular', 'smarty' ) => 400,
                            esc_html__( 'Medium', 'smarty' ) => 500,
                            esc_html__( 'Bold', 'smarty' ) => 700,
                            esc_html__( 'Black', 'smarty' ) => 900
                        ),
                        'group' => esc_html__('CSS', 'smarty')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Title - Font style', 'smarty' ),
                        'param_name' => 'title_font_style',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Normal', 'smarty' ) => 'normal',
                            esc_html__( 'Italic', 'smarty' ) => 'italic'
                        ),
                        'group' => esc_html__('CSS', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title - Line height', 'smarty' ),
                        'param_name' => 'title_line_height',
                        'group' => esc_html__('CSS', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title - Text indent', 'smarty' ),
                        'param_name' => 'title_text_indent',
                        'group' => esc_html__('CSS', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title - Margin top', 'smarty' ),
                        'param_name' => 'title_margin_t',
                        'group' => esc_html__('CSS', 'smarty')
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title - Margin bottom', 'smarty' ),
                        'param_name' => 'title_margin_b',
                        'group' => esc_html__('CSS', 'smarty')
                    )
                )
            ) );

            // Separator
            vc_map( array(
                'name'        => esc_html__( '(STM) Separator', 'smarty' ),
                'base'        => 'stm_separator',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text', 'smarty' ),
                        'param_name' => 'separator_text'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Text - Color', 'smarty' ),
                        'param_name' => 'text_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Text - Color custom', 'smarty' ),
                        'param_name' => 'title_color_custom',
                        'dependency' => array( 'element' => 'text_color', 'value' => 'custom' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text - Size', 'smarty' ),
                        'param_name' => 'text_size'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Icon - Library', 'smarty' ),
                        'param_name' => 'separator_icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'separator_icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'separator_icon_library', 'value' => 'fontawesome' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'separator_icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'separator_icon_library', 'value' => 'openiconic' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'separator_icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'separator_icon_library', 'value' => 'typicons' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'separator_icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'separator_icon_library', 'value' => 'entypo' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'separator_icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'separator_icon_library', 'value' => 'linecons' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'separator_icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'separator_icon_library', 'value' => 'pixel' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Icon - Color', 'smarty' ),
                        'param_name' => 'icon_color',
                        'value' => array(
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Icon - Color custom', 'smarty' ),
                        'param_name' => 'icon_color_custom',
                        'dependency' => array( 'element' => 'icon_color', 'value' => 'custom' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Icon - Size', 'smarty' ),
                        'param_name' => 'icon_size'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Height', 'smarty' ),
                        'param_name' => 'sep_width'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Width', 'smarty' ),
                        'param_name' => 'sep_line_width'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Style', 'smarty' ),
                        'param_name' => 'sep_style',
                        'value' => array(
                            esc_html__( 'Solid', 'smarty' ) => 'solid',
                            esc_html__( 'Dashed', 'smarty' ) => 'dashed',
                            esc_html__( 'Dotted', 'smarty' ) => 'dotted',
                            esc_html__( 'Double', 'smarty' ) => 'double'
                        ),
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'sep_color',
                        'value' => array(
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom', 'smarty' ),
                        'param_name' => 'sep_color_custom',
                        'dependency' => array( 'element' => 'sep_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Alignment', 'smarty' ),
                        'param_name' => 'sep_alignment',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Call to action
            vc_map( array(
                'name'        => esc_html__( '(STM) Call to action', 'smarty' ),
                'base'        => 'stm_call_to_action',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div'
                    ),
                    array(
                        'type' => 'textarea_html',
                        'heading' => esc_html__( 'Description', 'smarty' ),
                        'param_name' => 'content'
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_id',
                        'group'      => esc_html__( 'Image', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'img_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right'
                        ),
                        'group'      => esc_html__( 'Image', 'smarty' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'img_size',
                        'description' => esc_html__( 'Example: 300x240', 'smarty' ),
                        'group'      => esc_html__( 'Image', 'smarty' )
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Button - Link', 'smarty' ),
                        'param_name' => 'btn_link',
                        'group'      => esc_html__( 'Button', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'btn_color',
                        'value' => array(
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Purpure', 'smarty' ) => 'purpure',
                        ),
                        'group'      => esc_html__( 'Button', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Border color', 'smarty' ),
                        'param_name' => 'cta_border_color',
                        'value' => array(
                            esc_html__( 'Design options', 'smarty' ) => '',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac'
                        ),
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Background color', 'smarty' ),
                        'param_name' => 'cta_bg_color',
                        'value' => array(
                            esc_html__( 'Design options', 'smarty' ) => '',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac'
                        ),
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Font Size', 'smarty' ),
                        'param_name' => 'title_font_size',
                        'value' => "",
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Title - Font weight', 'smarty' ),
                        'param_name' => 'title_font_weight',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Thin', 'smarty' ) => 100,
                            esc_html__( 'Light', 'smarty' ) => 300,
                            esc_html__( 'Regular', 'smarty' ) => 400,
                            esc_html__( 'Medium', 'smarty' ) => 500,
                            esc_html__( 'Bold', 'smarty' ) => 700,
                            esc_html__( 'Black', 'smarty' ) => 900,
                        ),
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Title - Font style', 'smarty' ),
                        'param_name' => 'title_font_style',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Normal', 'smarty' ) => 'normal',
                            esc_html__( 'Italic', 'smarty' ) => 'italic'
                        ),
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Line height', 'smarty' ),
                        'param_name' => 'title_line_height',
                        'value' => "",
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Title - Font color', 'smarty' ),
                        'param_name' => 'title_color',
                        'group'      => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Font size', 'smarty' ),
                        'param_name' => 'descr_font_size',
                        'value' => "",
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Description - Font weight', 'smarty' ),
                        'param_name' => 'descr_font_weight',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Thin', 'smarty' ) => 100,
                            esc_html__( 'Light', 'smarty' ) => 300,
                            esc_html__( 'Regular', 'smarty' ) => 400,
                            esc_html__( 'Medium', 'smarty' ) => 500,
                            esc_html__( 'Bold', 'smarty' ) => 700,
                            esc_html__( 'Black', 'smarty' ) => 900,
                        ),
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Description - Font style', 'smarty' ),
                        'param_name' => 'descr_font_style',
                        'value' => array(
                            esc_html__( 'Choose', 'smarty' ) => '',
                            esc_html__( 'Normal', 'smarty' ) => 'normal',
                            esc_html__( 'Italic', 'smarty' ) => 'italic'
                        ),
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Line height', 'smarty' ),
                        'param_name' => 'descr_line_height',
                        'value' => "",
                        'group' => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Description - Font color', 'smarty' ),
                        'param_name' => 'descr_color',
                        'group'      => esc_html__( 'CSS', 'smarty' ),
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Btn - Simple
            vc_map( array(
                'name'        => esc_html__( '(STM) Button', 'smarty' ),
                'base'        => 'stm_btn_simple',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Link', 'smarty' ),
                        'param_name' => 'btn_link'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Link - Text', 'smarty' ),
                        'param_name' => 'btn_link_text'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Style', 'smarty' ),
                        'param_name' => 'btn_style',
                        'value' => array(
                            esc_html__( 'Outline', 'smarty' ) => 'outline',
                            esc_html__( 'Flat', 'smarty' )    => 'flat',
                            esc_html__( 'Custom', 'smarty' )  => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'btn_color',
                        'value' => array(
                            esc_html__( 'Orange', 'smarty' )   => 'orange',
                            esc_html__( 'Blue', 'smarty' )   => 'blue',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Background', 'smarty' ),
                        'param_name' => 'btn_color_custom_bg',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover Background', 'smarty' ),
                        'param_name' => 'btn_color_custom_hover_bg',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active Background', 'smarty' ),
                        'param_name' => 'btn_color_custom_active_bg',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Border', 'smarty' ),
                        'param_name' => 'btn_color_custom_border',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover Border', 'smarty' ),
                        'param_name' => 'btn_color_custom_hover_border',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active Border', 'smarty' ),
                        'param_name' => 'btn_color_custom_active_border',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_hover_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_active_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'btn_size',
                        'value' => array(
                            esc_html__( 'Normal', 'smarty' ) => 'md',
                            esc_html__( 'Small', 'smarty' )  => 'sm',
                            esc_html__( 'Custom', 'smarty' )  => 'size-custom'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Text size', 'smarty' ),
                        'param_name' => 'btn_custom_text_size',
                        'description' => esc_html__( 'Button Text size. Example: 15px.', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_size', 'value' => 'size-custom' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Width', 'smarty' ),
                        'param_name' => 'btn_custom_width',
                        'description' => esc_html__( 'Button width. Example: 100% or auto, 200px;', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_size', 'value' => 'size-custom' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Height', 'smarty' ),
                        'param_name' => 'btn_custom_height',
                        'description' => esc_html__( 'Button height. Example: 36px', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_size', 'value' => 'size-custom' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Padding left', 'smarty' ),
                        'param_name' => 'btn_custom_padd_l',
                        'dependency' => array( 'element' => 'btn_size', 'value' => 'size-custom' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Padding right', 'smarty' ),
                        'param_name' => 'btn_custom_padd_r',
                        'dependency' => array( 'element' => 'btn_size', 'value' => 'size-custom' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Disabled', 'smarty' ),
                        'param_name' => 'btn_disabled'
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Show Icon', 'smarty' ),
                        'param_name' => 'btn_icon_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'btn_icon_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'btn_icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Stm', 'smarty' ) => 'stm_icon',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_stm_icon',
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'stm_icon' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'btn_icon_size',
                        'value' => '',
                        'description' => esc_html__( 'Enter icon size. Example: 12px', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom', 'smarty' ),
                        'param_name' => 'btn_icon_color_custom',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover', 'smarty' ),
                        'param_name' => 'btn_icon_color_custom_hover',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active', 'smarty' ),
                        'param_name' => 'btn_icon_color_custom_active',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Vertical Spacing', 'smarty' ),
                        'param_name' => 'btn_icon_vspace',
                        'value' => '',
                        'description' => esc_html__( 'Enter vertical spacing. Example: 5px', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Horizontal Spacing', 'smarty' ),
                        'param_name' => 'btn_icon_hspace',
                        'value' => '',
                        'description' => esc_html__( 'Enter horizontal spacing. Example: 5px', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Alignment', 'smarty' ),
                        'param_name' => 'btn_alignment',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center',
                            esc_html__( 'Inline', 'smarty' ) => 'inline'
                        ),
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Top', 'smarty' ),
                        'param_name' => 'btn_margin_t',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Right', 'smarty' ),
                        'param_name' => 'btn_margin_r',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Bottom', 'smarty' ),
                        'param_name' => 'btn_margin_b',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Left', 'smarty' ),
                        'param_name' => 'btn_margin_l',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    )
                )
            ) );

            // Btn - Download
            vc_map( array(
                'name'        => esc_html__( '(STM) Button - Download', 'smarty' ),
                'base'        => 'stm_btn',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Link', 'smarty' ),
                        'param_name' => 'btn_link'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'btn_download_color',
                        'value' => array(
                            esc_html__( 'Pink', 'smarty' )  => 'pink',
                            esc_html__( 'Yellow', 'smarty' )  => 'yellow',
                            esc_html__( 'Lilac', 'smarty' )  => 'lilac',
                            esc_html__( 'Grey', 'smarty' )   => 'grey',
                            esc_html__( 'Purpure', 'smarty' )   => 'purpure'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Secondary text', 'smarty' ),
                        'param_name' => 'btn_secondary_text'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Width', 'smarty' ),
                        'param_name' => 'btn_width',
                        'value' => array(
                            esc_html__( 'Auto', 'smarty' )       => '',
                            esc_html__( 'Full width', 'smarty' ) => 'full-width'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Text align', 'smarty' ),
                        'param_name' => 'btn_text_align',
                        'value' => array(
                            esc_html__( 'Center', 'smarty' ) => 'center',
                            esc_html__( 'Left', 'smarty' )   => 'left',
                            esc_html__( 'Right', 'smarty' )  => 'right'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Alignment', 'smarty' ),
                        'param_name' => 'btn_alignment',
                        'value' => array(
                            esc_html__( 'Select', 'smarty' ) => '',
                            esc_html__( 'Left', 'smarty' )         => 'left',
                            esc_html__( 'Right', 'smarty' )        => 'right',
                            esc_html__( 'Center', 'smarty' )        => 'right'
                        )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Show Icon', 'smarty' ),
                        'param_name' => 'btn_icon_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'btn_icon_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'icon_img_id',
                        'group'      => esc_html__( 'Icon', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'icon_color',
                        'value' => array(
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'White', 'smarty' ) => 'white',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom', 'smarty' ),
                        'param_name' => 'icon_color_custom',
                        'dependency' => array( 'element' => 'icon_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'btn_icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'btn_icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'btn_icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'btn_icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'btn_icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'btn_icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon - Picker', 'smarty' ),
                        'param_name' => 'btn_icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'btn_icon_size',
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Vertical spacing', 'smarty' ),
                        'param_name' => 'btn_icon_vspacing',
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Horizontal spacing', 'smarty' ),
                        'param_name' => 'btn_icon_hspacing',
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Btn - Big
            vc_map( array(
                'name'        => esc_html__( '(STM) Button - Big', 'smarty' ),
                'base'        => 'stm_btn_big',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Link', 'smarty' ),
                        'param_name' => 'btn_link'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Link - Text', 'smarty' ),
                        'param_name' => 'btn_link_text'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Secondary Text', 'smarty' ),
                        'param_name' => 'btn_secondary_text'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Style', 'smarty' ),
                        'param_name' => 'btn_style',
                        'value' => array(
                            esc_html__( 'Outline', 'smarty' ) => 'outline',
                            esc_html__( 'Flat', 'smarty' )    => 'flat',
                            esc_html__( 'Custom', 'smarty' )  => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'btn_color',
                        'value' => array(
                            esc_html__( 'Blue', 'smarty' )   => 'blue',
                            esc_html__( 'Light Blue', 'smarty' )   => 'light_blue',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Background', 'smarty' ),
                        'param_name' => 'btn_color_custom_bg',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover Background', 'smarty' ),
                        'param_name' => 'btn_color_custom_hover_bg',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active Background', 'smarty' ),
                        'param_name' => 'btn_color_custom_active_bg',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Border', 'smarty' ),
                        'param_name' => 'btn_color_custom_border',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover Border', 'smarty' ),
                        'param_name' => 'btn_color_custom_hover_border',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active Border', 'smarty' ),
                        'param_name' => 'btn_color_custom_active_border',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_hover_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_active_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Secondary Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_s_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover Secondary Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_hover_s_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active Secondary Text', 'smarty' ),
                        'param_name' => 'btn_color_custom_active_s_text',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Custom size', 'smarty' ),
                        'param_name' => 'btn_custom_size'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Width', 'smarty' ),
                        'param_name' => 'btn_custom_width',
                        'description' => esc_html__( 'Button width. Example: 100% or auto, 200px;', 'smarty' ),
                        'dependency' => array( 'element' => 'btn_custom_size', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Padding left', 'smarty' ),
                        'param_name' => 'btn_custom_padd_l',
                        'dependency' => array( 'element' => 'btn_custom_size', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Padding right', 'smarty' ),
                        'param_name' => 'btn_custom_padd_r',
                        'dependency' => array( 'element' => 'btn_custom_size', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Disabled', 'smarty' ),
                        'param_name' => 'btn_disabled'
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Show Icon', 'smarty' ),
                        'param_name' => 'btn_icon_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'btn_icon_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'btn_icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'btn_icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'btn_icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'btn_icon_size',
                        'value' => '',
                        'description' => esc_html__( 'Enter icon size. Example: 12px', 'smarty' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom', 'smarty' ),
                        'param_name' => 'btn_icon_color_custom',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Hover', 'smarty' ),
                        'param_name' => 'btn_icon_color_custom_hover',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom - Active', 'smarty' ),
                        'param_name' => 'btn_icon_color_custom_active',
                        'dependency' => array( 'element' => 'btn_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Vertical Spacing', 'smarty' ),
                        'param_name' => 'btn_icon_vspace',
                        'value' => '',
                        'description' => esc_html__( 'Enter vertical spacing. Example: 5px', 'smarty' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Alignment', 'smarty' ),
                        'param_name' => 'btn_alignment',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center',
                            esc_html__( 'Inline', 'smarty' ) => 'inline'
                        ),
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Top', 'smarty' ),
                        'param_name' => 'btn_margin_t',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Right', 'smarty' ),
                        'param_name' => 'btn_margin_r',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Bottom', 'smarty' ),
                        'param_name' => 'btn_margin_b',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Left', 'smarty' ),
                        'param_name' => 'btn_margin_l',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    )
                )
            ) );

            // Link
            vc_map( array(
                'name'        => esc_html__( '(STM) Link', 'smarty' ),
                'base'        => 'stm_link',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Link', 'smarty' ),
                        'param_name' => 'link'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Link - Text', 'smarty' ),
                        'param_name' => 'link_text'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'link_color',
                        'value' => array(
                            esc_html__( 'Default', 'smarty' )   => '',
                            esc_html__( 'Blue', 'smarty' )   => 'blue',
                            esc_html__( 'Dark-blue', 'smarty' )  => 'dark-blue',
                            esc_html__( 'Green ', 'smarty' )  => 'green',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom', 'smarty' ),
                        'param_name' => 'link_color_custom',
                        'dependency' => array( 'element' => 'link_color', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'link_size',
                        'description' => esc_html__( 'Button Text size. Example: 15px.', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Show Icon', 'smarty' ),
                        'param_name' => 'link_icon_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'link_icon_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right'
                        ),
                        'dependency' => array( 'element' => 'link_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'link_icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'link_icon_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'link_icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'description' => esc_html__( 'Pick icon. By default used arrow icon.', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'link_icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'description' => esc_html__( 'Pick icon. By default used arrow icon.', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'link_icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'description' => esc_html__( 'Pick icon. By default used arrow icon.', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'link_icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'description' => esc_html__( 'Pick icon. By default used arrow icon.', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'link_icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'description' => esc_html__( 'Pick icon. By default used arrow icon.', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'link_icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'description' => esc_html__( 'Pick icon. By default used arrow icon.', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'icon_size',
                        'value' => '',
                        'description' => esc_html__( 'Enter icon size. Example: 12px', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_enable', 'value' => 'true' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Horizontal Spacing', 'smarty' ),
                        'param_name' => 'icon_hspace',
                        'value' => '',
                        'description' => esc_html__( 'Enter horizontal spacing. Example: 5px', 'smarty' ),
                        'dependency' => array( 'element' => 'link_icon_enable', 'value' => 'true' ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Alignment', 'smarty' ),
                        'param_name' => 'link_alignment',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center',
                            esc_html__( 'Inline', 'smarty' ) => 'inline'
                        ),
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Top', 'smarty' ),
                        'param_name' => 'link_margin_t',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Right', 'smarty' ),
                        'param_name' => 'link_margin_r',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Bottom', 'smarty' ),
                        'param_name' => 'link_margin_b',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Margin - Left', 'smarty' ),
                        'param_name' => 'link_margin_l',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    )
                )
            ) );

            // Posts
            $post_categories = get_categories();
            $post_categories_list = array(
                esc_html__('Choose', 'smarty') => 0
            );

            if( !empty( $post_categories ) && ! is_wp_error( $post_categories ) ) {
                foreach( $post_categories as $post_category ) {
                    $post_categories_list[$post_category->name] = $post_category->slug;
                }
            }

            vc_map( array(
                'name'        => esc_html__( '(STM) Posts', 'smarty' ),
                'base'        => 'stm_posts',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div',
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'View', 'smarty' ),
                        'param_name' => 'view',
                        'value' => array(
                            esc_html__( 'Carousel', 'smarty' ) => 'carousel',
                            esc_html__( 'List', 'smarty' ) => 'list',
                            esc_html__( 'List small', 'smarty' ) => 'list-small',
                            esc_html__( 'Grid', 'smarty' ) => 'grid'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Categories', 'smarty' ),
                        'param_name' => 'posts_category',
                        'value' => $post_categories_list
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Thumbnail size', 'smarty' ),
                        'param_name' => 'thumb_size',
                        'description' => esc_html__( 'Enter Thumbnail size. Example: 480x300', 'smarty' ),
                        'dependency' => array( 'element' => 'view', 'value' => array('carousel', 'grid') )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Posts count', 'smarty' ),
                        'param_name' => 'posts_count',
                        'description' => esc_html__( 'Posts per page', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Masonry', 'smarty' ),
                        'param_name' => 'masonry_box',
                        'dependency' => array( 'element' => 'view', 'value' => array('grid') )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Pagination', 'smarty' ),
                        'param_name' => 'pagination_enable',
                        'dependency' => array( 'element' => 'view', 'value' => array('list', 'grid') )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Pagination position', 'smarty' ),
                        'param_name' => 'pagination_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'text-left',
                            esc_html__( 'Center', 'smarty' ) => 'text-center',
                            esc_html__( 'Right', 'smarty' ) => 'text-right'
                        ),
                        'dependency' => array( 'element' => 'pagination_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Events
            $event_categories = get_terms( 'stm_event_category', array(
                'hide_empty' => false,
            ) );
            $event_categories_list = array(
                esc_html__('Select', 'smarty') => 0
            );

            if(!is_wp_error($event_categories) and !empty( $event_categories ) ) {
                foreach( $event_categories as $event_category ) {
                    $event_categories_list[$event_category->name] = $event_category->slug;
                }
            }

            vc_map( array(
                'name'        => esc_html__( '(STM) Events', 'smarty' ),
                'base'        => 'stm_events',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'View', 'smarty' ),
                        'param_name' => 'view_style',
                        'value' => array(
                            esc_html__( 'Grid', 'smarty' ) => 'grid',
                            esc_html__( 'List', 'smarty' ) => 'list'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Category', 'smarty' ),
                        'param_name' => 'event_category',
                        'value' => $event_categories_list
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Events count', 'smarty' ),
                        'param_name' => 'events_count',
                        'description' => esc_html__( 'Events per page', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Small Box', 'smarty' ),
                        'param_name' => 'small_box'
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Pagination', 'smarty' ),
                        'param_name' => 'pagination_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Pagination position', 'smarty' ),
                        'param_name' => 'pagination_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'text-left',
                            esc_html__( 'Center', 'smarty' ) => 'text-center',
                            esc_html__( 'Right', 'smarty' ) => 'text-right'
                        ),
                        'dependency' => array( 'element' => 'pagination_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Event header
            vc_map( array(
                'name'        => esc_html__( '(STM) Event - Entry header', 'smarty' ),
                'base'        => 'stm_event_header',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Donations
            vc_map( array(
                'name'        => esc_html__( '(STM) Donations', 'smarty' ),
                'base'        => 'stm_donations',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'View', 'smarty' ),
                        'param_name' => 'view',
                        'value' => array(
                            esc_html__( 'Grid', 'smarty' ) => 'grid'
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Donations count', 'smarty' ),
                        'param_name' => 'donations_count',
                        'description' => esc_html__( 'Donations per page', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Pagination', 'smarty' ),
                        'param_name' => 'pagination_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Pagination position', 'smarty' ),
                        'param_name' => 'pagination_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'text-left',
                            esc_html__( 'Center', 'smarty' ) => 'text-center',
                            esc_html__( 'Right', 'smarty' ) => 'text-right'
                        ),
                        'dependency' => array( 'element' => 'view', 'value' => array('list', 'grid') )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Donation info
            vc_map( array(
                'name'        => esc_html__( '(STM) Donation - Information', 'smarty' ),
                'base'        => 'stm_donation_info',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Stats counter
            vc_map( array(
                'name'        => esc_html__( '(STM) Stats Counter', 'smarty' ),
                'base'        => 'stm_stats',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Value', 'smarty' ),
                        'param_name' => 'value',
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Description', 'smarty' ),
                        'param_name' => 'desc',
                        'holder'     => 'div',
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Type', 'smarty' ),
                        'param_name' => 'icon_type',
                        'value' => array(
                            esc_html__( 'Font Icons', 'smarty' ) => 'font',
                            esc_html__( 'SVG', 'smarty' )        => 'svg'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'SVG', 'smarty' ),
                        'param_name' => 'svg_id',
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Width', 'smarty' ),
                        'param_name' => 'svg_width',
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Animated', 'smarty' ),
                        'param_name' => 'svg_animated',
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'font' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon', 'smarty' ),
                        'param_name' => 'icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon', 'smarty' ),
                        'param_name' => 'icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon', 'smarty' ),
                        'param_name' => 'icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon', 'smarty' ),
                        'param_name' => 'icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon', 'smarty' ),
                        'param_name' => 'icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon', 'smarty' ),
                        'param_name' => 'icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'stats_style',
                        'value'      => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'icon_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'icon_color_custom',
                        'dependency' => array( 'element' => 'icon_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'icon_size',
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Padding top', 'smarty' ),
                        'param_name' => 'icon_padd_top',
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Padding bottom', 'smarty' ),
                        'param_name' => 'icon_padd_bottom',
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Suffix', 'smarty' ),
                        'param_name' => 'count_suffix',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Separator', 'smarty' ),
                        'param_name' => 'count_separator',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Grouping', 'smarty' ),
                        'param_name' => 'count_grouping',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Duration', 'smarty' ),
                        'param_name' => 'duration',
                        'value'      => '2.5',
                        'group'      => esc_html__( 'Options', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Value Color', 'smarty' ),
                        'param_name' => 'value_color',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Value Font Size', 'smarty' ),
                        'param_name' => 'value_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Description Color', 'smarty' ),
                        'param_name' => 'desc_color',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description Font Size', 'smarty' ),
                        'param_name' => 'desc_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Icon box
            vc_map( array(
                'name'     => esc_html__( '(STM) Icon box', 'smarty' ),
                'base'     => 'stm_icon_box',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Style', 'smarty' ),
                        'param_name' => 'view_style',
                        'value' => array(
                            esc_html__( 'Simple', 'smarty' ) => 'style-3',
                            esc_html__( 'Icon title', 'smarty' ) => 'style-2',
                            esc_html__( 'Box 1', 'smarty' ) => 'style-1',
                            esc_html__( 'Box 2', 'smarty' ) => 'style-4',
                            esc_html__( 'Box 3', 'smarty' ) => 'style-5'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder'     => 'div',
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Separator - Enable', 'smarty' ),
                        'param_name' => 'separator_enable',
                        'dependency' => array( 'element' => 'view_style', 'value' => array('style-1', 'style-2') )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'sep_color',
                        'value' => array(
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                            esc_html__( 'Custom', 'smarty' ) => 'custom',
                        ),
                        'dependency' => array( 'element' => 'separator_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Separator', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom', 'smarty' ),
                        'param_name' => 'sep_color_custom',
                        'dependency' => array( 'element' => 'sep_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Separator', 'smarty' )
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Title - Link', 'smarty' ),
                        'param_name' => 'title_link',
                        'dependency' => array( 'element' => 'view_style', 'value' => array( 'style-3', 'style-4','style-5' ) )
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Sub title', 'smarty' ),
                        'param_name' => 'sub_title',
                        'dependency' => array( 'element' => 'view_style', 'value' => 'style-3' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Small title', 'smarty' ),
                        'param_name' => 'title_small',
                        'dependency' => array( 'element' => 'view_style', 'value' => array( 'style-1', 'style-5' ) )
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Description', 'smarty' ),
                        'param_name' => 'descr',
                        'dependency' => array( 'element' => 'view_style', 'value' => array( 'style-1', 'style-4', 'style-5' ) )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Image - Enable', 'smarty' ),
                        'param_name' => 'image_enable',
                        'dependency' => array( 'element' => 'view_style', 'value' => array('style-5') )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Alignment', 'smarty' ),
                        'param_name' => 'text_alignment',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Text', 'smarty' ),
                        'param_name' => 'button_text',
                        'group'      => esc_html__( 'Button', 'smarty' ),
                        'dependency' => array( 'element' => 'view_style', 'value' => 'style-4' )
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Link', 'smarty' ),
                        'param_name' => 'button_link',
                        'group'      => esc_html__( 'Button', 'smarty' ),
                        'dependency' => array( 'element' => 'view_style', 'value' => 'style-4' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Step - Enable', 'smarty' ),
                        'param_name' => 'step_enable',
                        'dependency' => array( 'element' => 'view_style', 'value' => 'style-4' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Number', 'smarty' ),
                        'param_name' => 'step_number',
                        'group'      => esc_html__( 'Step', 'smarty' ),
                        'dependency' => array( 'element' => 'step_enable', 'value' => 'true' ),
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'step_number_size',
                        'group'      => esc_html__( 'Step', 'smarty' ),
                        'dependency' => array( 'element' => 'step_enable', 'value' => 'true' ),
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'step_number_color',
                        'group'      => esc_html__( 'Step', 'smarty' ),
                        'dependency' => array( 'element' => 'step_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Position - Bottom', 'smarty' ),
                        'param_name' => 'step_number_pos_b',
                        'group'      => esc_html__( 'Step', 'smarty' ),
                        'dependency' => array( 'element' => 'step_enable', 'value' => 'true' ),
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Position - Right', 'smarty' ),
                        'param_name' => 'step_number_pos_r',
                        'group'      => esc_html__( 'Step', 'smarty' ),
                        'dependency' => array( 'element' => 'step_enable', 'value' => 'true' ),
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_single_id',
                        'dependency' => array( 'element' => 'image_enable', 'value' => 'true' ),
                        'group'      => esc_html__( 'Image', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Type', 'smarty' ),
                        'param_name' => 'icon_type',
                        'value' => array(
                            esc_html__( 'Font Icons', 'smarty' ) => 'font_icons',
                            esc_html__( 'SVG', 'smarty' )   => 'svg',
                            esc_html__( 'Image', 'smarty' ) => 'img'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__( 'SVG', 'smarty' ),
                        'param_name' => 'svg_id',
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Animated', 'smarty' ),
                        'param_name' => 'svg_animated',
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_id',
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'img' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'icon_type', 'value' => 'font_icons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon Picker', 'smarty' ),
                        'param_name' => 'icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon Picker', 'smarty' ),
                        'param_name' => 'icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon Picker', 'smarty' ),
                        'param_name' => 'icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon Picker', 'smarty' ),
                        'param_name' => 'icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon Picker', 'smarty' ),
                        'param_name' => 'icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Icon Picker', 'smarty' ),
                        'param_name' => 'icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'icon_position',
                        'value'      => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Top', 'smarty' ) => 'top'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'icon_color',
                        'value' => array(
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                            esc_html__( 'Custom', 'smarty' ) => 'custom',
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color custom', 'smarty' ),
                        'param_name' => 'icon_color_custom',
                        'dependency' => array( 'element' => 'icon_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Size', 'smarty' ),
                        'param_name' => 'icon_size',
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Top Indent', 'smarty' ),
                        'param_name' => 'top_indent',
                        'description' => esc_html__( 'Example: 12px', 'smarty' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Title - Color', 'smarty' ),
                        'param_name' => 'title_color',
                        'value' => array(
                            esc_html__( 'Dark', 'smarty' ) => 'dark',
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Title - Color custom', 'smarty' ),
                        'param_name' => 'title_color_custom',
                        'dependency' => array( 'element' => 'title_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Font size', 'smarty' ),
                        'param_name' => 'title_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Line-height', 'smarty' ),
                        'param_name' => 'title_line_height',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Margin bottom', 'smarty' ),
                        'param_name' => 'title_margin_b',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Description - Color', 'smarty' ),
                        'param_name' => 'descr_color',
                        'value' => array(
                            esc_html__( 'Dark', 'smarty' ) => 'dark',
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Description - Color custom', 'smarty' ),
                        'param_name' => 'descr_color_custom',
                        'dependency' => array( 'element' => 'descr_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Font size', 'smarty' ),
                        'param_name' => 'descr_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Line-height', 'smarty' ),
                        'param_name' => 'descr_line_height',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Margin top', 'smarty' ),
                        'param_name' => 'descr_margin_t',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Margin bottom', 'smarty' ),
                        'param_name' => 'descr_margin_b',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Sub title - Color', 'smarty' ),
                        'param_name' => 'sub_title_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Gray', 'smarty' ) => 'gray',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Sub title - Color custom', 'smarty' ),
                        'param_name' => 'sub_title_color_custom',
                        'dependency' => array( 'element' => 'sub_title_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Sub title - Font size', 'smarty' ),
                        'param_name' => 'sub_title_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Sub title - Line-height', 'smarty' ),
                        'param_name' => 'sub_title_line_height',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Image box
            vc_map( array(
                'name'     => esc_html__( '(STM) Image box', 'smarty' ),
                'base'     => 'stm_image_box',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Title Position', 'smarty' ),
                        'param_name' => 'title_position',
                        'value' => array(
                            esc_html__( 'Inside Box', 'smarty' ) => 'inside',
                            esc_html__( 'Outside Box', 'smarty' ) => 'outside'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder'     => 'div',
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Title - Link', 'smarty' ),
                        'param_name' => 'title_link'
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Description', 'smarty' ),
                        'param_name' => 'description'
                    ),
                    array(
                        'type'       => 'textarea_html',
                        'heading'    => esc_html__( 'Text', 'smarty' ),
                        'param_name' => 'content'
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_id',
                        'group'      => esc_html__( 'Image', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'img_position',
                        'value'      => array(
                            esc_html__( 'Left', 'smarty' ) => 'left'
                        ),
                        'group'      => esc_html__( 'Image', 'smarty' )
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__( 'Size', 'smarty' ),
                        'param_name'  => 'img_size',
                        'description' => esc_html__( 'Image size. Example: 400x500', 'smarty' ),
                        'group'       => esc_html__( 'Image', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Separator', 'smarty' ),
                        'param_name' => 'sep_enable'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Separator - Color', 'smarty' ),
                        'param_name' => 'sep_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'dependency' => array(
                            'element' => 'sep_enable',
                            'value' => 'true'
                        ),
                        'group'      => esc_html__( 'Separator', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Separator - Color custom', 'smarty' ),
                        'param_name' => 'sep_color_custom',
                        'dependency' => array( 'element' => 'sep_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Separator', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Title - Color', 'smarty' ),
                        'param_name' => 'title_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Title - Color custom', 'smarty' ),
                        'param_name' => 'title_color_custom',
                        'dependency' => array( 'element' => 'title_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Font size', 'smarty' ),
                        'param_name' => 'title_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Line-height', 'smarty' ),
                        'param_name' => 'title_line_height',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Margin bottom', 'smarty' ),
                        'param_name' => 'title_margin_b',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Description - Color', 'smarty' ),
                        'param_name' => 'description_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Description - Color custom', 'smarty' ),
                        'param_name' => 'description_color_custom',
                        'dependency' => array( 'element' => 'description', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Font size', 'smarty' ),
                        'param_name' => 'description_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Line-height', 'smarty' ),
                        'param_name' => 'description_line_height',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Description - Margin bottom', 'smarty' ),
                        'param_name' => 'description_margin_b',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Single Image
            vc_map( array(
                'name'     => esc_html__( '(STM) Single Image', 'smarty' ),
                'base'     => 'stm_single_image',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_id'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Image Alignment', 'smarty' ),
                        'param_name' => 'img_alignment',
                        'value'      => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        )
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__( 'Image Size', 'smarty' ),
                        'param_name'  => 'img_size',
                        'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Responsive', 'smarty' ),
                        'param_name' => 'img_responsive_enable'
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Border Radius', 'smarty' ),
                        'param_name' => 'img_border_radius'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Text box
            vc_map( array(
                'name'     => esc_html__( '(STM) Text Box', 'smarty' ),
                'base'     => 'stm_text_box',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder'     => 'div',
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Tag', 'smarty' ),
                        'param_name' => 'title_tag',
                        'value' => array(
                            esc_html__( 'H1', 'smarty' ) => 'h1',
                            esc_html__( 'H2', 'smarty' ) => 'h2',
                            esc_html__( 'H3', 'smarty' ) => 'h3',
                            esc_html__( 'H4', 'smarty' ) => 'h4',
                            esc_html__( 'H5', 'smarty' ) => 'h5',
                            esc_html__( 'H6', 'smarty' ) => 'h6',
                            esc_html__( 'Div', 'smarty' ) => 'div'
                        ),
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Separator', 'smarty' ),
                        'param_name' => 'sep_enable'
                    ),
                    array(
                        'type'       => 'textarea_html',
                        'heading'    => esc_html__( 'Text', 'smarty' ),
                        'param_name' => 'content'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Button - Text', 'smarty' ),
                        'param_name' => 'button_text',
                        'group'      => esc_html__( 'Button', 'smarty' )
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Button - Link', 'smarty' ),
                        'param_name' => 'button_link',
                        'group'      => esc_html__( 'Button', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Button - Color', 'smarty' ),
                        'param_name' => 'button_color_scheme',
                        'value' => array(
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'White - Text Hover Green', 'smarty' ) => 'white',
                            esc_html__( 'White - Text Hover Blue', 'smarty' ) => 'white-secondary',
                        ),
                        'group'      => esc_html__( 'Button', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Button - Position', 'smarty' ),
                        'param_name' => 'button_position',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        ),
                        'group'      => esc_html__( 'Button', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Separator - Color', 'smarty' ),
                        'param_name' => 'sep_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'dependency' => array(
                            'element' => 'sep_enable',
                            'value' => 'true'
                        ),
                        'group'      => esc_html__( 'Separator', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Separator - Color custom', 'smarty' ),
                        'param_name' => 'sep_color_custom',
                        'dependency' => array( 'element' => 'sep_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Separator', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Title - Color', 'smarty' ),
                        'param_name' => 'title_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Title - Color custom', 'smarty' ),
                        'param_name' => 'title_color_custom',
                        'dependency' => array( 'element' => 'title_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Font size', 'smarty' ),
                        'param_name' => 'title_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Line-height', 'smarty' ),
                        'param_name' => 'title_line_height',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Margin bottom', 'smarty' ),
                        'param_name' => 'title_margin_b',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Text - Color', 'smarty' ),
                        'param_name' => 'text_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Text - Color custom', 'smarty' ),
                        'param_name' => 'text_color_custom',
                        'dependency' => array( 'element' => 'text_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Text - Font size', 'smarty' ),
                        'param_name' => 'text_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Text - Line-height', 'smarty' ),
                        'param_name' => 'text_line_height',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Text - Margin bottom', 'smarty' ),
                        'param_name' => 'text_margin_b',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Box - Background color', 'smarty' ),
                        'param_name' => 'stm_bg_color',
                        'value' => array(
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Style', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color picker', 'smarty' ),
                        'param_name' => 'stm_bg_color_custom',
                        'dependency' => array( 'element' => 'stm_bg_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Style', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Box - Padding top', 'smarty' ),
                        'param_name' => 'padding_top',
                        'group'      => esc_html__( 'Style', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Box - Padding right', 'smarty' ),
                        'param_name' => 'padding_right',
                        'group'      => esc_html__( 'Style', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Box - Padding bottom', 'smarty' ),
                        'param_name' => 'padding_bottom',
                        'group'      => esc_html__( 'Style', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Box - Padding left', 'smarty' ),
                        'param_name' => 'padding_left',
                        'group'      => esc_html__( 'Style', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Contact person
            vc_map( array(
                'name'     => esc_html__( '(STM) Contact person', 'smarty' ),
                'base'     => 'stm_contact_person',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Photo', 'smarty' ),
                        'param_name' => 'img_id'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Name', 'smarty' ),
                        'param_name' => 'name',
                        'holder'     => 'div',
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Question', 'smarty' ),
                        'param_name' => 'question'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Telephone', 'smarty' ),
                        'param_name' => 'tel'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'E-Mail', 'smarty' ),
                        'param_name' => 'email'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Action box
            vc_map( array(
                'name'     => esc_html__( '(STM) Action box', 'smarty' ),
                'base'     => 'stm_action_box',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Style', 'smarty' ),
                        'param_name' => 'style',
                        'value' => array(
                            esc_html__( 'Box', 'smarty' ) => 'box',
                            esc_html__( 'Caption', 'smarty' ) => 'caption'
                        )
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_id'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Image - Size', 'smarty' ),
                        'param_name' => 'img_size',
                        'description' => esc_html__( 'Example: 300x240', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Icon - Color', 'smarty' ),
                        'param_name' => 'icon_color',
                        'value' => array(
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' ),
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Icon - Color custom', 'smarty' ),
                        'param_name' => 'icon_color_custom',
                        'dependency' => array( 'element' => 'icon_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Icon - Font size', 'smarty' ),
                        'param_name' => 'icon_font_size',
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder'     => 'div',
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Link', 'smarty' ),
                        'param_name' => 'action_box_link'
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading' => esc_html__( 'Content', 'smarty' ),
                        'param_name' => 'content'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Content alignment', 'smarty' ),
                        'param_name' => 'text_alignment',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Title - Color', 'smarty' ),
                        'param_name' => 'title_color',
                        'value' => array(
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' ),
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Title - Color custom', 'smarty' ),
                        'param_name' => 'title_color_custom',
                        'dependency' => array( 'element' => 'title_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title - Font size', 'smarty' ),
                        'param_name' => 'title_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Description - Color', 'smarty' ),
                        'param_name' => 'description_color',
                        'value' => array(
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Custom', 'smarty' ) => 'custom'
                        ),
                        'group'      => esc_html__( 'Typography', 'smarty' ),
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Description - Color custom', 'smarty' ),
                        'param_name' => 'description_color_custom',
                        'dependency' => array( 'element' => 'description_color', 'value' => 'custom' ),
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Descriptione - Font size', 'smarty' ),
                        'param_name' => 'description_font_size',
                        'group'      => esc_html__( 'Typography', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Blockquote
            vc_map( array(
                'name'     => esc_html__( '(STM) Blockquote', 'smarty' ),
                'base'     => 'stm_blockquote',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Style', 'smarty' ),
                        'param_name' => 'blockquote_view_style',
                        'value' => array(
                            esc_html__( 'Default', 'smarty' ) => '',
                            esc_html__( 'Bordered', 'smarty' ) => 'bordered'
                        )
                    ),
                    array(
                        'type' => 'textarea_html',
                        'heading' => esc_html__( 'Content', 'smarty' ),
                        'param_name' => 'content'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Cite', 'smarty' ),
                        'param_name' => 'cite'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Footer - Space top', 'smarty' ),
                        'param_name' => 'footer_space_t',
                        'group'      => esc_html__( 'CSS', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Teacher - Contact details
            vc_map( array(
                'name'     => esc_html__( '(STM) Teacher - Contact details', 'smarty' ),
                'base'     => 'stm_teacher_contact_details',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Address', 'smarty' ),
                        'param_name' => 'teacher_address'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Telephone', 'smarty' ),
                        'param_name' => 'teacher_tel'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Skype', 'smarty' ),
                        'param_name' => 'teacher_skype'
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'URL', 'smarty' ),
                        'param_name' => 'teacher_url'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Teachers - Grid
            $teacher_categories = get_terms( 'stm_teacher_category', array(
                'hide_empty' => false,
            ) );
            $teacher_categories_list = array(
                esc_html__('Select', 'smarty') => 0
            );

            if(!is_wp_error($teacher_categories) and !empty( $teacher_categories ) ) {
                foreach( $teacher_categories as $teacher_category ) {
                    $teacher_categories_list[$teacher_category->name] = $teacher_category->slug;
                }
            }

            vc_map( array(
                'name'        => esc_html__( '(STM) Teachers - Grid', 'smarty' ),
                'base'        => 'stm_teachers',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'View', 'smarty' ),
                        'param_name' => 'view',
                        'value' => array(
                            esc_html__( 'Grid', 'smarty' ) => 'grid',
                            esc_html__( 'Carousel', 'smarty' ) => 'carousel'
                        )
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Per Row', 'smarty' ),
                        'param_name' => 'teachers_per_row',
                        'value' => array(
                            esc_html__( 'Four', 'smarty' ) => '3',
                            esc_html__( 'One', 'smarty' ) => '12',
                            esc_html__( 'Two', 'smarty' ) => '6',
                            esc_html__( 'Three', 'smarty' ) => '4'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Categories', 'smarty' ),
                        'param_name' => 'teachers_category',
                        'value' => $teacher_categories_list
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Count', 'smarty' ),
                        'param_name' => 'count',
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Teacher - Bio
            vc_map( array(
                'name'        => esc_html__( '(STM) Teacher - Bio', 'smarty' ),
                'base'        => 'stm_teacher_bio',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Photo', 'smarty' ),
                        'param_name' => 'img_id'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder'     => 'div',
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'position'
                    ),
                    array(
                        'type' => 'textarea_html',
                        'heading' => esc_html__( 'Content', 'smarty' ),
                        'param_name' => 'content'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Partners
            vc_map( array(
                'name'        => esc_html__( '(STM) Partners', 'smarty' ),
                'base'        => 'stm_partners',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Photo', 'smarty' ),
                        'param_name' => 'img_id'
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'URL', 'smarty' ),
                        'param_name' => 'partners_url'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Countdown
            vc_map( array(
                'name'        => __( 'Countdown', 'smarty' ),
                'base'        => 'stm_countdown',
                'icon'        => 'stm_countdown',
                'category'    => __( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'stm_datepicker_vc',
                        'heading' => __( 'Count to date', 'smarty' ),
                        'param_name' => 'datepicker',
                        'holder' => 'div'
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => __( 'Labels color', 'smarty' ),
                        'param_name' => 'label_color',
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => __( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => __( 'Design options', 'smarty' )
                    )
                )
            ) );

            if ( in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
                $available_cf7 = array();
                if( $cf7Forms = get_posts( $args ) ){
                    foreach($cf7Forms as $cf7Form){
                        $available_cf7[$cf7Form->post_title] = $cf7Form->ID;
                    };
                } else {
                    $available_cf7['No CF7 forms found'] = 'none';
                };
                vc_map( array(
                    'name'        => __( '(STM) Course Info', 'smarty' ),
                    'base'        => 'stm_course_info',
                    'icon'        => 'icon-wpb-contactform7',
                    'category'    => __( 'STM', 'smarty' ),
                    'params'      => array(
                        array(
                            'type' => 'textfield',
                            'heading' => __( 'Title', 'smarty' ),
                            'param_name' => 'title'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Choose form', 'smarty' ),
                            'param_name' => 'form',
                            'value' => $available_cf7,
                        ),
                        array(
                            'type'       => 'css_editor',
                            'heading'    => __( 'Css', 'smarty' ),
                            'param_name' => 'css',
                            'group'      => __( 'Design options', 'smarty' )
                        )
                    )
                ) );

                vc_map( array(
                    'name'        => __( '(STM) Leave a Review', 'smarty' ),
                    'base'        => 'stm_leave_review',
                    'icon'        => 'icon-wpb-contactform7',
                    'category'    => __( 'STM', 'smarty' ),
                    'params'      => array(
                        array(
                            'type' => 'textfield',
                            'heading' => __( 'Button Title', 'smarty' ),
                            'param_name' => 'button_title'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __( 'Button Sub Title', 'smarty' ),
                            'param_name' => 'button_sub_title'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __( 'Box Title', 'smarty' ),
                            'param_name' => 'box_title'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Choose form', 'smarty' ),
                            'param_name' => 'form',
                            'value' => $available_cf7,
                        ),
                        array(
                            'type'       => 'css_editor',
                            'heading'    => __( 'Css', 'smarty' ),
                            'param_name' => 'css',
                            'group'      => __( 'Design options', 'smarty' )
                        )
                    )
                ) );
            }

            // Meal
            vc_map( array(
                'name'        => esc_html__( '(STM) Meal', 'smarty' ),
                'base'        => 'stm_meal',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Items count', 'smarty' ),
                        'param_name' => 'items_count',
                        'description' => esc_html__( 'The number of items you want to see on the screen.', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Courses
            $courses_categories = get_terms( 'stm_course_category', array(
                'hide_empty' => false,
            ) );
            $courses_categories_list = array(
                esc_html__('Select', 'smarty') => 0
            );

            if(!is_wp_error($courses_categories) and !empty( $courses_categories ) ) {
                foreach( $courses_categories as $courses_category ) {
                    $courses_categories_list[$courses_category->name] = $courses_category->slug;
                }
            }

            vc_map( array(
                'name'        => esc_html__( '(STM) Classes', 'smarty' ),
                'base'        => 'stm_courses',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'View', 'smarty' ),
                        'param_name' => 'view',
                        'value' => array(
                            esc_html__( 'Grid', 'smarty' ) => 'grid',
                            esc_html__( 'Carousel', 'smarty' ) => 'carousel'
                        )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Category', 'smarty' ),
                        'param_name' => 'courses_category',
                        'value' => $courses_categories_list
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Classes count', 'smarty' ),
                        'param_name' => 'courses_count',
                        'description' => esc_html__( 'Classes per page', 'smarty' ),
                        'dependency' => array(
                            'element' => 'view',
                            'value' => 'grid'
                        ),
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Course - Teacher bio
            vc_map( array(
                'name'        => esc_html__( '(STM) Teacher course- Bio', 'smarty' ),
                'base'        => 'stm_course_teacher_bio',
                'category'    => esc_html__( 'STM - Course', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Course - Topics
            vc_map( array(
                'name' => esc_html__( '(STM) Topics', 'smarty' ),
                'base' => 'stm_course_topics',
                'category' => esc_html__( 'STM - Course', 'smarty' ),
                "as_parent" => array( 'only' => 'stm_course_topic,stm_course_topics_paragraph' ),
                "is_container" => true,
                "content_element" => true,
                "show_settings_on_create" => false,
                'params' => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                ),
                "js_view" => 'VcColumnView'
            ) );

            // Course - Paragraph
            vc_map( array(
                "name" => esc_html__('Paragraph', 'smarty'),
                "base" => "stm_course_topics_paragraph",
                "content_element" => true,
                "as_child" => array('only' => 'stm_course_topics'),
                "params" => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div'
                    )
                )
            ) );

            // Course - Topic
            vc_map( array(
                "name" => esc_html__('Topic', 'smarty'),
                "base" => "stm_course_topic",
                "content_element" => true,
                "as_child" => array('only' => 'stm_course_topics'),
                "params" => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Date', 'smarty' ),
                        'param_name' => 'date'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Hours', 'smarty' ),
                        'param_name' => 'assignments'
                    )
                )
            ) );

            // Camps - Table
            vc_map( array(
                'name' => esc_html__( '(STM) Camps Table', 'smarty' ),
                'base' => 'stm_camps_table',
                'category' => esc_html__( 'STM', 'smarty' ),
                "as_parent" => array( 'only' => 'stm_camps_table_heading,stm_camps_table_row' ),
                "is_container" => true,
                "content_element" => true,
                "show_settings_on_create" => false,
                'params' => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                ),
                "js_view" => 'VcColumnView'
            ) );

            // Camps Table - Heading
            vc_map( array(
                "name" => esc_html__('Heading', 'smarty'),
                "base" => "stm_camps_table_heading",
                "content_element" => true,
                "as_child" => array('only' => 'stm_camps_table'),
                "params" => array(
                    array(
                        'type' => 'param_group',
                        'heading' => esc_html__( 'Heading', 'smarty' ),
                        'param_name' => 'heading',
                        'value' => urlencode( json_encode( array(
                            array(
                                'label' => esc_html__( 'Title', 'smarty' ),
                                'value' => '',
                            )
                        ) ) ),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__( 'Title', 'smarty' ),
                                'param_name' => 'title',
                                'admin_label' => true,
                            )
                        )
                    )
                )
            ) );

            // Camps Table - Row
            vc_map( array(
                "name" => esc_html__('Row', 'smarty'),
                "base" => "stm_camps_table_row",
                "content_element" => true,
                "as_child" => array('only' => 'stm_camps_table'),
                "params" => array(
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'stm_color'
                    ),
                    array(
                        'type' => 'param_group',
                        'heading' => esc_html__( 'Cell', 'smarty' ),
                        'param_name' => 'stm_cell',
                        'value' => urlencode( json_encode( array(
                            array(
                                'label' => esc_html__( 'Content', 'smarty' ),
                                'value' => ''
                            ),
                        ) ) ),
                        'params' => array(
                            array(
                                'type' => 'textarea',
                                'heading' => esc_html__( 'Content', 'smarty' ),
                                'param_name' => 'stm_text',
                                'admin_label' => true
                            )
                        )
                    )
                )
            ) );

            $stm_pt_params = array();

            $stm_pt_params[] = array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Tables', 'smarty' ),
                'param_name' => 'pricing_tables_count',
                'value' => array(
                    esc_html__( 'Three', 'smarty' ) => 'three'
                )
            );

            for($i = 1; $i <= 3; $i++ ) {
                $stm_pt_params[] = array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Color scheme', 'smarty' ),
                    'param_name' => 'pt_'. $i .'_color_scheme',
                    'dependency' => array(
                        'element' => 'pricing_tables_count',
                        'value' => 'three'
                    ),
                    'group'      => sprintf( esc_html__( "Table %s", 'smarty' ), $i )
                );

                $stm_pt_params[] = array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Title', 'smarty' ),
                    'param_name' => 'pt_'. $i .'_title',
                    'dependency' => array(
                        'element' => 'pricing_tables_count',
                        'value' => 'three'
                    ),
                    'group'      => sprintf( esc_html__( "Table %s", 'smarty' ), $i )
                );

                $stm_pt_params[] = array(
                    'type' => 'param_group',
                    'heading' => esc_html__( 'Period', 'smarty' ),
                    'param_name' => 'pt_'. $i .'_periods',
                    'value' => urlencode( json_encode( array(
                        array(
                            'label' => esc_html__( 'Period', 'smarty' ),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__( 'Price', 'smarty' ),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__( 'Period Text', 'smarty' ),
                            'value' => '',
                        )
                    ) ) ),
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__( 'Period', 'smarty' ),
                            'param_name' => 'pt_'. $i .'_periods_period',
                            'value' => array(
                                esc_html__( 'Monthly', 'smarty' ) => 'monthly',
                                esc_html__( 'Yearly', 'smarty' ) => 'yearly'
                            ),
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Price', 'smarty' ),
                            'param_name' => 'pt_'. $i .'_periods_price',
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Text', 'smarty' ),
                            'param_name' => 'pt_'. $i .'_periods_text',
                            'admin_label' => true,
                        )
                    ),
                    'group'      => sprintf( esc_html__( "Table %s", 'smarty' ), $i )
                );

                $stm_pt_params[] = array(
                    'type' => 'param_group',
                    'heading' => esc_html__( 'Features', 'smarty' ),
                    'param_name' => 'pt_'. $i .'_features',
                    'value' => urlencode( json_encode( array(
                        array(
                            'label' => esc_html__( 'Title', 'smarty' ),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__( 'Check', 'smarty' ),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__( 'Text', 'smarty' ),
                            'value' => '',
                        )
                    ) ) ),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Title', 'smarty' ),
                            'param_name' => 'pt_'. $i .'_feature_title',
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'checkbox',
                            'heading' => esc_html__( 'Check', 'smarty' ),
                            'param_name' => 'pt_'. $i .'_feature_check',
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Text', 'smarty' ),
                            'param_name' => 'pt_'. $i .'_feature_text',
                            'admin_label' => true,
                        )
                    ),
                    'group'      => sprintf( esc_html__( "Table %s", 'smarty' ), $i )
                );

                $stm_pt_params[] = array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Link text', 'smarty' ),
                    'param_name' => 'pt_'. $i .'_link_text',
                    'group'      => sprintf( esc_html__( "Table %s", 'smarty' ), $i )
                );

                $stm_pt_params[] = array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Link', 'smarty' ),
                    'param_name' => 'pt_'. $i .'_link',
                    'group'      => sprintf( esc_html__( "Table %s", 'smarty' ), $i )
                );
            }

            $stm_pt_params[] = array(
                'type'       => 'css_editor',
                'heading'    => esc_html__( 'Css', 'smarty' ),
                'param_name' => 'css',
                'group'      => esc_html__( 'Design options', 'smarty' )
            );

            // Pricing Tables
            vc_map( array(
                'name'     => esc_html__( '(STM) Pricing Tables', 'smarty' ),
                'base'     => 'stm_pricing_tables',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => $stm_pt_params
            ) );

            // Contact details
            vc_map( array(
                'name'     => esc_html__( '(STM) Contact details', 'smarty' ),
                'base'     => 'stm_contact_details',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Telephone', 'smarty' ),
                        'param_name' => 'contact_tel'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Email', 'smarty' ),
                        'param_name' => 'contact_email'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Fax', 'smarty' ),
                        'param_name' => 'contact_fax'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Skype', 'smarty' ),
                        'param_name' => 'contact_skype'
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Web site', 'smarty' ),
                        'param_name' => 'contact_url'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Schedulee', 'smarty' ),
                        'param_name' => 'contact_schedule'
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Address', 'smarty' ),
                        'param_name' => 'contact_address'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Google Map
            $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
            $available_cf7 = array();
            if( $cf7Forms = get_posts( $args ) ){
                foreach($cf7Forms as $cf7Form){
                    $available_cf7[$cf7Form->post_title] = $cf7Form->ID;
                };
            } else {
                $available_cf7['No CF7 forms found'] = 'none';
            };
            vc_map( array(
                'name'     => esc_html__( '(STM) Google Map', 'smarty' ),
                'base'     => 'stm_google_map',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params'   => array(
                    array(
                        'type' => 'dropdown',
                        'heading'    => esc_html__( 'Map - Coordinates', 'smarty' ),
                        'param_name' => 'map_coordinates',
                        'value' => array(
                            esc_html__( 'Custom', 'smarty' ) => 'custom',
                            esc_html__( 'Event', 'smarty' ) => 'event'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Map - Latitude', 'smarty' ),
                        'param_name' => 'latitude',
                        'dependency' => array( 'element' => 'map_coordinates', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Map - Longitude', 'smarty' ),
                        'param_name' => 'longitude',
                        'dependency' => array( 'element' => 'map_coordinates', 'value' => 'custom' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Map - Height', 'smarty' ),
                        'param_name' => 'height'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Map - Zoom', 'smarty' ),
                        'param_name' => 'zoom'
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Contact Details - Enable', 'smarty' ),
                        'param_name' => 'contact_details_enable'
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Contact Form - Enable', 'smarty' ),
                        'param_name' => 'contact_form_enable'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Choose form', 'smarty' ),
                        'param_name' => 'form',
                        'value' => $available_cf7,
                        'dependency' => array( 'element' => 'contact_form_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Address', 'smarty' ),
                        'param_name' => 'address',
                        'dependency' => array( 'element' => 'contact_details_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Telephone', 'smarty' ),
                        'param_name' => 'tel',
                        'dependency' => array( 'element' => 'contact_details_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Fax', 'smarty' ),
                        'param_name' => 'fax',
                        'dependency' => array( 'element' => 'contact_details_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Skype', 'smarty' ),
                        'param_name' => 'skype',
                        'dependency' => array( 'element' => 'contact_details_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'E-Mail', 'smarty' ),
                        'param_name' => 'email',
                        'dependency' => array( 'element' => 'contact_details_enable', 'value' => 'true' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    ),
                )
            ) );

            // Championships - List
            vc_map( array(
                'name' => esc_html__( '(STM) Championships - List', 'smarty' ),
                'base' => 'stm_championships_list',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params' => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder'     => 'div'
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_id',
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Library', 'smarty' ),
                        'param_name' => 'icon_library',
                        'value' => array(
                            esc_html__( 'Font Awesome', 'smarty' ) => 'fontawesome',
                            esc_html__( 'Open Iconic', 'smarty' ) => 'openiconic',
                            esc_html__( 'Typicons', 'smarty' ) => 'typicons',
                            esc_html__( 'Entypo', 'smarty' ) => 'entypo',
                            esc_html__( 'Linecons', 'smarty' ) => 'linecons',
                            esc_html__( 'Pixel', 'smarty' ) => 'pixel'
                        ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_fontawesome',
                        'settings'   => array(
                            'type' => 'fontawesome'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'fontawesome' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_openiconic',
                        'settings'   => array(
                            'type' => 'openiconic'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'openiconic' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_typicons',
                        'settings'   => array(
                            'type' => 'typicons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'typicons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_entypo',
                        'settings'   => array(
                            'type' => 'entypo'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'entypo' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_linecons',
                        'settings'   => array(
                            'type' => 'linecons'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'linecons' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'iconpicker',
                        'heading'    => esc_html__( 'Picker', 'smarty' ),
                        'param_name' => 'icon_pixel',
                        'settings'   => array(
                            'type' => 'pixel'
                        ),
                        'dependency' => array( 'element' => 'icon_library', 'value' => 'pixel' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Color', 'smarty' ),
                        'param_name' => 'icon_color',
                        'value' => array(
                            esc_html__( 'Pink', 'smarty' ) => 'pink',
                            esc_html__( 'Yellow', 'smarty' ) => 'yellow',
                            esc_html__( 'Lilac', 'smarty' ) => 'lilac',
                            esc_html__( 'White', 'smarty' ) => 'white',
                            esc_html__( 'Picker', 'smarty' ) => 'picker'
                        ),
                        'group' => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color - Picker', 'smarty' ),
                        'param_name' => 'icon_color_picker',
                        'dependency' => array( 'element' => 'icon_color', 'value' => 'picker' ),
                        'group'      => esc_html__( 'Icon', 'smarty' )
                    ),
                    array(
                        'type' => 'param_group',
                        'heading' => esc_html__( 'Items', 'smarty' ),
                        'param_name' => 'items',
                        'description' => esc_html__( 'Enter values for items - title, sub title.', 'smarty' ),
                        'value' => urlencode( json_encode( array(
                            array(
                                'label' => esc_html__( 'Title', 'smarty' ),
                                'value' => '',
                            ),
                            array(
                                'label' => esc_html__( 'Subtitle', 'smarty' ),
                                'value' => '',
                            ),
                        ) ) ),
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__( 'Title', 'smarty' ),
                                'param_name' => 'item_title',
                                'description' => esc_html__( 'Enter text used as title of items.', 'smarty' ),
                                'admin_label' => true,
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__( 'Subtitle', 'smarty' ),
                                'param_name' => 'item_sub_title',
                                'description' => esc_html__( 'Enter value of items.', 'smarty' ),
                                'admin_label' => true,
                            )
                        ),
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Media Gallery - Video
            vc_map( array(
                'name'        => esc_html__( '(STM) Media Gallery - Video', 'smarty' ),
                'base'        => 'stm_mg_video',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Items count', 'smarty' ),
                        'param_name' => 'items_count'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'View type', 'smarty' ),
                        'param_name' => 'view_type',
                        'value' => array(
                            esc_html__( 'Carousel', 'smarty' ) => 'carousel'
                        ),
                        'description' => esc_html__( 'Display view type.', 'smarty' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Button - Text', 'smarty' ),
                        'param_name' => 'button_text'
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Button - Link', 'smarty' ),
                        'param_name' => 'button_link'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Media Gallery - Audio
            vc_map( array(
                'name'        => esc_html__( '(STM) Media Gallery - Audio', 'smarty' ),
                'base'        => 'stm_mg_audio',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Button - Text', 'smarty' ),
                        'param_name' => 'button_text'
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Button - Link', 'smarty' ),
                        'param_name' => 'button_link'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Media Gallery
            $media_gallery_categories = get_terms( 'stm_media_gallery_category', array(
                'hide_empty' => false,
            ) );
            $media_gallery_categories_list = array(
                esc_html__('Select', 'smarty') => 0
            );

            if(!is_wp_error($media_gallery_categories) and !empty( $media_gallery_categories ) ) {
                foreach( $media_gallery_categories as $media_gallery_category ) {
                    $media_gallery_categories_list[$media_gallery_category->name] = $media_gallery_category->slug;
                }
            }

            vc_map( array(
                'name'        => esc_html__( '(STM) Media Gallery', 'smarty' ),
                'base'        => 'stm_media_gallery',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Categories', 'smarty' ),
                        'param_name' => 'media_gallery_category',
                        'value' => $media_gallery_categories_list
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Items count', 'smarty' ),
                        'param_name' => 'items_count'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'View type', 'smarty' ),
                        'param_name' => 'view_type',
                        'value' => array(
                            esc_html__( 'Masonry', 'smarty' ) => 'masonry',
                            esc_html__( 'Grid', 'smarty' ) => 'grid'
                        ),
                        'description' => esc_html__( 'Display view type.', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            $stm_sidebars = get_posts(array(
                'posts_per_page' => -1,
                'post_type' => 'stm_sidebar'
            ));

            $stm_sidebars_list = array(
                esc_html__('Select', 'smarty') => ''
            );

            if( !empty( $stm_sidebars ) ) {
                foreach( $stm_sidebars as $stm_sidebar ) {
                    $stm_sidebars_list[$stm_sidebar->post_title] = $stm_sidebar->ID;
                }
            }

            // Sidebar
            vc_map( array(
                'name'        => esc_html__( '(STM) Sidebar', 'smarty' ),
                'base'        => 'stm_sidebar',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Sidebar', 'smarty' ),
                        'param_name' => 'sidebar_id',
                        'value' => $stm_sidebars_list
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Post header
            vc_map( array(
                'name'        => esc_html__( '(STM) Entry - Header', 'smarty' ),
                'base'        => 'stm_post_header',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Post footer
            vc_map( array(
                'name'        => esc_html__( '(STM) Entry - Footer', 'smarty' ),
                'base'        => 'stm_post_footer',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Author info
            vc_map( array(
                'name'        => esc_html__( '(STM) Post - Author Info', 'smarty' ),
                'base'        => 'stm_post_author_info',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Post Comments
            vc_map( array(
                'name'        => esc_html__( '(STM) Post - Comments', 'smarty' ),
                'base'        => 'stm_post_comments',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Widget - Media Gallery
            vc_map( array(
                'name'        => esc_html__( '(STM) Widget - Media Gallery', 'smarty' ),
                'base'        => 'stm_widget_mediagallery',
                'category'    => esc_html__( 'STM - Widgets', 'smarty' ),
                'params'      => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Widget Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder' => 'div',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Count items', 'smarty' ),
                        'param_name' => 'count_items'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Gallery
            vc_map( array(
                'name'        => esc_html__( 'Gallery', 'smarty' ),
                'base'        => 'stm_gallery',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Filter', 'smarty' ),
                        'param_name' => 'filter_enable'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Slider
            vc_map( array(
                'name' => esc_html__( '(STM) Slider', 'smarty' ),
                'base' => 'stm_slider',
                'category' => esc_html__( 'STM', 'smarty' ),
                "as_parent" => array( 'only' => 'stm_slider_item' ),
                "is_container" => true,
                "content_element" => true,
                "show_settings_on_create" => false,
                'params' => array(
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Buttons on slider', 'smarty' ),
                        'param_name' => 'buttons_on_slider'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Slider Width', 'smarty' ),
                        'param_name' => 'slider_width'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                ),
                "js_view" => 'VcColumnView'
            ) );

            // Slider item
            vc_map( array(
                "name" => esc_html__('(STM) Slider item', 'smarty'),
                "base" => "stm_slider_item",
                "content_element" => true,
                "as_child" => array('only' => 'stm_slider'),
                "params" => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Type', 'smarty' ),
                        'param_name' => 'item_type',
                        'value' => array(
                            esc_html__( 'Image', 'smarty' ) => 'img',
                            esc_html__( 'Video', 'smarty' ) => 'video'
                        ),
                        'holder' => 'div'
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'smarty' ),
                        'param_name' => 'img_id',
                        'dependency' => array( 'element' => 'item_type', 'value' => 'img' )
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__( 'Size', 'smarty' ),
                        'param_name'  => 'img_size',
                        'description' => esc_html__( 'Image size. Example: 400x500', 'smarty' ),
                        'dependency'  => array( 'element' => 'item_type', 'value' => 'img' )
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Poster', 'smarty' ),
                        'param_name' => 'video_img_id',
                        'dependency' => array( 'element' => 'item_type', 'value' => 'video' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__('Video link', 'smarty'),
                        "param_name" => "video_link",
                        'description' => esc_html__('Enter link to video', 'smarty'),
                        'dependency' => array( 'element' => 'item_type', 'value' => 'video' )
                    )
                )
            ) );

            // Widget - Statistics
            vc_map( array(
                'name' => esc_html__( '(STM) Widget - Statistics', 'smarty' ),
                'base' => 'stm_widget_statistics',
                'category' => esc_html__( 'STM - Widgets', 'smarty' ),
                "as_parent" => array( 'only' => 'stm_widget_statistics_item' ),
                "is_container" => true,
                "content_element" => true,
                "show_settings_on_create" => false,
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__('Widget Title', 'smarty'),
                        "param_name" => "title",
                        "holder" => 'div'
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                ),
                "js_view" => 'VcColumnView'
            ) );

            // Widget - Statistics item
            vc_map( array(
                "name" => esc_html__('(STM) Widget - Statistics Item', 'smarty'),
                "base" => "stm_widget_statistics_item",
                "content_element" => true,
                "as_child" => array('only' => 'stm_widget_statistics'),
                "params" => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Label', 'smarty' ),
                        'param_name' => 'label',
                        'holder' => 'div'
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Value', 'smarty' ),
                        'param_name' => 'value'
                    )
                )
            ) );

            // Social networks
            vc_map( array(
                'name' => esc_html__( '(STM) Social Networks', 'smarty' ),
                'base' => 'stm_social_networks',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params' => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

            // Subscribe - Popup
            $subscribe_form = get_posts(
                array(
                    'post_type' => 'mc4wp-form',
                    'posts_per_page' => -1
                )
            );

            $subscribe_form_data = array(
                esc_html__( 'Choose', 'smarty' ) => ''
            );

            if( !empty( $subscribe_form ) ) {
                foreach( $subscribe_form as $subscribe_form_val ) {
                    $subscribe_form_data[$subscribe_form_val->post_title] = $subscribe_form_val->ID;
                }
            }

            vc_map( array(
                'name' => esc_html__( '(STM) Subscribe - Popup', 'smarty' ),
                'base' => 'stm_subscribe_popup',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params' => array(
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'holder'     => 'div'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Choose Form:', 'smarty' ),
                        'param_name' => 'subscribe_form_id',
                        'value'      => $subscribe_form_data
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Launcher - Alignment', 'smarty' ),
                        'param_name' => 'launcher_alignment',
                        'value' => array(
                            esc_html__( 'Left', 'smarty' ) => 'left',
                            esc_html__( 'Right', 'smarty' ) => 'right',
                            esc_html__( 'Center', 'smarty' ) => 'center'
                        )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            // Testimonials
            vc_map( array(
                'name'        => esc_html__( 'Testimonials', 'smarty' ),
                'base'        => 'stm_testimonials',
                'category'    => esc_html__( 'STM', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Type', 'smarty' ),
                        'param_name' => 'stm_testimonial_type',
                        'value' => array(
                            esc_html__( 'Carousel', 'smarty' ) => 'carousel',
                            esc_html__( 'Single static', 'smarty' ) => 'single_static',
                        )
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Avatar', 'smarty' ),
                        'param_name' => 'avatar_id',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'single_static' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Avatar - Size', 'smarty' ),
                        'param_name' => 'avatar_size',
                        'description' => esc_html__( 'Example: Full or 250x300', 'smarty' ),
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'single_static' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'title',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'single_static' )
                    ),
                    array(
                        'type' => 'textarea_html',
                        'heading' => esc_html__( 'Text', 'smarty' ),
                        'param_name' => 'content',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'single_static' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Cite', 'smarty' ),
                        'param_name' => 'cite',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'single_static' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Cite - Customization', 'smarty' ),
                        'param_name' => 'enable_cite_customization',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'single_static' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Space - Top', 'smarty' ),
                        'param_name' => 'cite_space_top',
                        'dependency' => array( 'element' => 'enable_cite_customization', 'value' => 'true' )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Items', 'smarty' ),
                        'param_name' => 'stm_carousel_items',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'carousel' ),
                        'group'      => esc_html__( 'Carousel', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Show Thumbnails', 'smarty' ),
                        'param_name' => 'stm_carousel_thumb',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'carousel' ),
                        'group'      => esc_html__( 'Carousel', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Auto play', 'smarty' ),
                        'param_name' => 'stm_carousel_autoplay',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'carousel' ),
                        'group'      => esc_html__( 'Carousel', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Loop', 'smarty' ),
                        'param_name' => 'stm_carousel_loop',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'carousel' ),
                        'group'      => esc_html__( 'Carousel', 'smarty' )
                    ),
                    array(
                        'type'       => 'checkbox',
                        'heading'    => esc_html__( 'Dots', 'smarty' ),
                        'param_name' => 'stm_carousel_dots',
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'carousel' ),
                        'group'      => esc_html__( 'Carousel', 'smarty' )
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Dots - Color', 'smarty' ),
                        'param_name' => 'stm_dots_color',
                        'value' => array(
                            esc_html__( 'Blue', 'smarty' ) => 'blue',
                            esc_html__( 'Orange', 'smarty' ) => 'orange',
                        ),
                        'dependency' => array( 'element' => 'stm_testimonial_type', 'value' => 'carousel' ),
                        'group'      => esc_html__( 'Carousel', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                )
            ) );

            /* --- Custom Menu --- */
            $custom_menus = array(
                esc_html__( 'Select', 'smarty' ) => ''
            );
            if( !empty( $custom_menus ) && ! is_wp_error( $custom_menus ) ) {
                $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
                if ( is_array( $menus ) && ! empty( $menus ) ) {
                    foreach ( $menus as $single_menu ) {
                        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
                            $custom_menus[ $single_menu->name ] = $single_menu->term_id;
                        }
                    }
                }
            }

            vc_map( array(
                'name' => esc_html__( 'Custom Menu', 'smarty' ),
                'base' => 'stm_wp_custommenu',
                'category' => esc_html__( 'STM', 'smarty' ),
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Menu', 'smarty' ),
                        'param_name' => 'nav_menu',
                        'value' => $custom_menus,
                        'description' => empty( $custom_menus ) ? wp_kses( __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'smarty' ), array( 'b' => array() )) : esc_html__( 'Select menu to display.', 'smarty' ),
                        'admin_label' => true,
                        'save_always' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'smarty' ),
                        'param_name' => 'custommenu_title',
                        'value' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Width', 'smarty' ),
                        'param_name' => 'width',
                        'value' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Position', 'smarty' ),
                        'param_name' => 'position',
                        'value' => array(
                            esc_html__('Static', 'smarty') => 'static',
                            esc_html__('Absolute', 'smarty') => 'absolute'
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Offset - Top', 'smarty' ),
                        'param_name' => 'position_top',
                        'value' => '',
                        'dependency' => array( 'element' => 'position', 'value' => 'absolute' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Offset - Left', 'smarty' ),
                        'param_name' => 'position_left',
                        'value' => '',
                        'dependency' => array( 'element' => 'position', 'value' => 'absolute' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Extra class name', 'smarty' ),
                        'param_name' => 'el_class',
                        'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'smarty' ),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Create Custom menu', 'smarty' ),
                        'param_name' => 'create_custom_menu',
                        'description' => esc_html__( 'You can create your custom menu.', 'smarty' ),
                    ),
                    array(
                        'type' => 'param_group',
                        'heading' => esc_html__( 'Custom links', 'smarty' ),
                        'param_name' => 'menu_items',
                        'description' => esc_html__( 'Enter values for menu items - title, sub title.', 'smarty' ),
                        'value' => urlencode( json_encode( array(
                            array(
                                'label' => esc_html__( 'URL', 'smarty' ),
                                'value' => ''
                            ),
                            array(
                                'label' => esc_html__( 'Link Text', 'smarty' ),
                                'value' => ''
                            ),
                        ) ) ),
                        'params' => array(
                            array(
                                'type' => 'vc_link',
                                'heading' => esc_html__( 'URL', 'smarty' ),
                                'param_name' => 'menu_item_url',
                                'description' => esc_html__( 'Enter text used as title of items.', 'smarty' ),
                                'admin_label' => true
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__( 'Link Text', 'smarty' ),
                                'param_name' => 'menu_item_link_text',
                                'description' => esc_html__( 'Enter value of items.', 'smarty' ),
                                'admin_label' => true
                            )
                        ),
                        'dependency' => array( 'element' => 'create_custom_menu', 'value' => 'true' ),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Hidden SM', 'smarty' ),
                        'param_name' => 'hidden_sm',
                        'description' => esc_html__( 'Menu do not display on small screen.', 'smarty' )
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Hidden XS', 'smarty' ),
                        'param_name' => 'hidden_xs',
                        'description' => esc_html__( 'Menu do not display on extra small screen.', 'smarty' )
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design options', 'smarty' )
                    )
                ),
            ) );

            /* === Footer === */
            vc_map( array(
                'name'        => esc_html__( '(STM) Page - Footer', 'smarty' ),
                'base'        => 'stm_footer',
                'category'    => esc_html__( 'STM - Partials', 'smarty' ),
                'params'      => array(
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__( 'Css', 'smarty' ),
                        'param_name' => 'css'
                    )
                )
            ) );

        }

    }

    add_action( 'init', 'smarty_vc_map_shortcodes' );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Stm_Slider extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Stm_Widget_Statistics extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Stm_Course_Topics extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Stm_Pt_Tab extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Stm_Camps_Table extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Stm_Title extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Subscribe_Popup extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Spacing extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Slider_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Widget_Statistics_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Post_Header extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Event_Header extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Donation_Info extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Post_Footer extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Post_Author_Info extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Post_Comments extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Widget_Mediagallery extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Separator extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Call_To_Action extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Btn extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Link extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Btn_Simple extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Btn_Big extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Text_Box extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Image_Box extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Single_Image extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Action_Box extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Blockquote extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Teacher_Contact_Details extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Contact_Details extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Google_Map extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Contact_Person extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Teachers extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Teacher_Bio extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Partners extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Posts extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Events extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Donations extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Courses extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Meal extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Media_Gallery extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Mg_Video extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Mg_Audio extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Course_Teacher_Bio extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Course_Topic extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Course_Topics_Paragraph extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Camps_Table_Heading extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Camps_Table_Row extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Championships_List extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Pricing_Tables extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Stats extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Gallery extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Social_Networks extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Achievement extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Footer extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Wp_Custommenu extends WPBakeryShortCode {}
    class WPBakeryShortCode_Stm_Countdown extends WPBakeryShortCode {}
    if ( in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        class WPBakeryShortCode_Stm_Course_Info extends WPBakeryShortCode {}
        class WPBakeryShortCode_Stm_Leave_Review extends WPBakeryShortCode {}
    }
}

add_filter( 'vc_iconpicker-type-fontawesome', 'smarty_vc_icons' );

if( !function_exists('smarty_vc_icons') ) {
    function smarty_vc_icons($icons ) {

        global $wp_filesystem;

        if ( empty( $wp_filesystem ) ) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $stm_icons_json = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/fonts/stm-icon/selection.json' ), true );
        $stm_icons_arr['STM Icons'] = array();
        foreach($stm_icons_json['icons'] as $stm_icon) {
            $stm_icons_arr['STM Icons'][] = array( 'stm-icon stm-icon-'.$stm_icon['properties']['name'] => $stm_icon['properties']['name']);
        }

        return array_merge( $icons, $stm_icons_arr );
    }
}

if( function_exists('stm_add_vc_settings') ) {
    stm_add_vc_settings( 'stm_margin', 'smarty_margin_param', SMARTY_TEMPLATE_URI . '/assets/js/admin/vc/vc_margin.js');
}

function smarty_margin_param($settings, $value ) {
    $output = '';
    $output .= '<div class="stm-margin">';
    $output .= '<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value stm-margin__val ' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />';
    $output .= '<table><tbody><tr>';
    if( !empty( $settings['positions'] ) ) {
        foreach( $settings['positions'] as $margin_label => $margin_position ) {
            $output .= '<td><label for="stm-'. esc_attr( $settings['param_name'] ) .'-'. $margin_position .'" style="display:block;margin-bottom:5px;font-style:italic">'. $margin_label .'</label><input id="stm-'. esc_attr( $settings['param_name'] ) .'-'. $margin_position .'" class="stm-margin__position-val" type="text" data-stm-margin-position="'. $margin_position .'"/></td>';
        }
    }
    $output .= '</tr></tbody></table>';
    $output .= '</div>';
    return $output;
}

if( function_exists('stm_add_vc_settings') ) {
    stm_add_vc_settings( 'stm_font', 'smarty_font_param', SMARTY_TEMPLATE_URI . '/assets/js/admin/vc/vc_font.js');
}
function smarty_font_param($settings, $value ) {
    $output = '';
    $output .= '<div class="stm-font">';
    $output .= '<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value stm-font__val ' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />';
    if( !empty( $settings['font_options'] ) ) {
        foreach( $settings['font_options'] as $font_option_label => $font_option ) {
            $output .= '<fieldset class="stm-font__fieldset" style="margin-bottom:15px">';
            $output .= '<label for="stm-'. esc_attr( $settings['param_name'] ) .'-'. $font_option .'" style="display:block;margin-bottom:5px;font-style:italic">'. $font_option_label .'</label>';
            if( $font_option === 'font-weight' ) {
                $output .= '<select id="stm-'. esc_attr( $settings['param_name'] ) .'-'. $font_option .'" class="stm-font__option-val" data-stm-param-option="'. $font_option .'">';
                $output .= '<option value="">'. esc_html__('Select', 'smarty') .'</option>';
                $output .= '<option value="100">'. esc_html__('Thin', 'smarty') .'</option>';
                $output .= '<option value="300">'. esc_html__('Light', 'smarty') .'</option>';
                $output .= '<option value="400">'. esc_html__('Regular', 'smarty') .'</option>';
                $output .= '<option value="500">'. esc_html__('Medium', 'smarty') .'</option>';
                $output .= '<option value="600">'. esc_html__('Semi-bold', 'smarty') .'</option>';
                $output .= '<option value="700">'. esc_html__('Bold', 'smarty') .'</option>';
                $output .= '<option value="900">'. esc_html__('Black', 'smarty') .'</option>';
                $output .= '</select>';
            } elseif( $font_option === 'font-style' ) {
                $output .= '<select id="stm-'. esc_attr( $settings['param_name'] ) .'-'. $font_option .'" class="stm-font__option-val" data-stm-param-option="'. $font_option .'">';
                $output .= '<option value="">'. esc_html__('Select', 'smarty') .'</option>';
                $output .= '<option value="normal">'. esc_html__('Normal', 'smarty') .'</option>';
                $output .= '<option value="italic">'. esc_html__('Italic', 'smarty') .'</option>';
                $output .= '</select>';
            } else {
                $output .= '<input id="stm-'. esc_attr( $settings['param_name'] ) .'-'. $font_option .'" class="stm-font__option-val" type="text" data-stm-param-option="'. $font_option .'"/>';
            }
            $output .= '</fieldset>';
        }
    }
    $output .= '</div>';
    return $output;
}

if( function_exists('stm_add_vc_settings') ) {
	stm_add_vc_settings( 'stm_css', 'smarty_css_param', SMARTY_TEMPLATE_URI . '/assets/js/admin/vc/vc_stm-css.js');
}

function smarty_css_param($settings, $value ) {
    $output = '';
    $output .= '<div class="stm-css">';
    $output .= '<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value stm-css__style ' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />';
    if( $settings['css_options'] ) {
        foreach( $settings['css_options'] as $css_option_name => $css_option_slug ) {
            $output .= '<fieldset class="stm-css__fieldset" style="margin-bottom:15px">';
            $output .= '<label for="stm-'. esc_attr( $settings['param_name'] ) .'-'. $css_option_slug .'" style="display:block;margin-bottom:5px;font-style:italic">'. $css_option_name .'</label>';
            if( $css_option_slug === 'font-weight' ) {
                $output .= '<select id="stm-'. esc_attr( $settings['param_name'] ) .'-'. $css_option_slug .'" class="stm-css__option-val" data-stm-param-option="'. $css_option_slug .'">';
                $output .= '<option value="">'. esc_html__('Select', 'smarty') .'</option>';
                $output .= '<option value="100">'. esc_html__('Thin', 'smarty') .'</option>';
                $output .= '<option value="300">'. esc_html__('Light', 'smarty') .'</option>';
                $output .= '<option value="400">'. esc_html__('Regular', 'smarty') .'</option>';
                $output .= '<option value="500">'. esc_html__('Medium', 'smarty') .'</option>';
                $output .= '<option value="600">'. esc_html__('Semi-bold', 'smarty') .'</option>';
                $output .= '<option value="700">'. esc_html__('Bold', 'smarty') .'</option>';
                $output .= '<option value="900">'. esc_html__('Black', 'smarty') .'</option>';
                $output .= '</select>';
            } elseif( $css_option_slug === 'font-style' ) {
                $output .= '<select id="stm-'. esc_attr( $settings['param_name'] ) .'-'. $css_option_slug .'" class="stm-css__option-val" data-stm-param-option="'. $css_option_slug .'">';
                $output .= '<option value="">'. esc_html__('Select', 'smarty') .'</option>';
                $output .= '<option value="normal">'. esc_html__('Normal', 'smarty') .'</option>';
                $output .= '<option value="italic">'. esc_html__('Italic', 'smarty') .'</option>';
                $output .= '</select>';
            } else {
                $output .= '<input id="stm-'. esc_attr( $settings['param_name'] ) .'-'. $css_option_slug .'" class="stm-css__option-val" type="text" data-stm-param-option="'. $css_option_slug .'"/>';
            }
            $output .= '</fieldset>';
        }
    }
    $output .= '</div>';
    return $output;
}
if(function_exists('stm_add_vc_settings')){
	stm_add_vc_settings( 'stm_datepicker_vc', 'stm_datepicker_vc_st', get_template_directory_uri().'/inc/vc_extend/jquery.stmdatetimepicker.js' );
}
function stm_datepicker_vc_st( $settings, $value ) {
    return '<div class="stm_datepicker_vc_field">'
    .'<input type="text" name="' . esc_attr( $settings['param_name'] ) . '" class="stm_datepicker_vc wpb_vc_param_value wpb-textinput ' .
    esc_attr( $settings['param_name'] ) . ' ' .
    esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
    '</div>';
}
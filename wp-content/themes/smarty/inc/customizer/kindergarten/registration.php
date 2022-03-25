<?php
$socials = array(
	'facebook' => esc_html__( 'Facebook', 'smarty' ),
	'google-plus' => esc_html__( 'Google plus', 'smarty' ),
	'twitter' => esc_html__( 'Twitter', 'smarty' ),
	'youtube' => esc_html__( 'YouTube', 'smarty' ),
	'instagram' => esc_html__( 'Instagram', 'smarty' ),
	'soundcloud' => esc_html__( 'SoundCloud', 'smarty' ),
);

STM_Customizer::setPanels( array(
	'site_settings' => array(
		'title'       => esc_html__( 'Site Settings', 'smarty' ),
		'priority'    => 10
	),
	'nav_menus'   => array(
		'title'     => esc_html__( 'Menus', 'smarty' ),
		'priority'  => 130
	),
	'widgets'    => array(
		'title'    => esc_html__( 'Widgets', 'smarty' ),
		'priority' => 135
	),
	'page_settings'     => array(
		'title'    => esc_html__( 'Page Settings', 'smarty' ),
		'priority' => 145
	),
	'footer'     => array(
		'title'    => esc_html__( 'Footer', 'smarty' ),
		'priority' => 150
	)
) );

STM_Customizer::setSection( 'static_front_page', array(
	'title' => esc_html__( 'Static Front Page', 'smarty' ),
	'priority' => 10,
	'panel' => 'site_settings'
) );

STM_Customizer::setSection( 'title_tagline', array(
	'title'    => esc_html__( 'Logo &amp; Title', 'smarty' ),
	'panel'    => 'site_settings',
	'priority' => 15,
	'fields'   => array(
		'logo' => array(
			'label' => esc_html__( 'Logo', 'smarty' ),
			'type'  => 'image'
		),
		'logo_width' => array(
			'label'       => esc_html__( 'Logo - Width', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'max-width',
			'units'       => 'px',
			'output'      => '.header .logo'
		),
	)
) );

STM_Customizer::setSection( 'typography', array(
	'title'    => esc_html__( 'Typography', 'smarty' ),
	'panel'    => 'site_settings',
	'priority' => 20,
	'fields'   => array(
		't_body_section_title' => array(
			'label'       => esc_html__( 'Body', 'smarty' ),
			'type'        => 'stm-heading'
		),
		't_body_font_family' => array(
			'label'       => esc_html__( 'Font Family', 'smarty' ),
			'type'        => 'stm-font-family',
			'output'      => 'body'
		),
        't_header_font_family' => array(
            'label'       => esc_html__( 'Font Family secondary', 'smarty' ),
            'type'        => 'stm-font-family',
            'output'      => ''
        ),
		't_body_font_size' => array(
			'label'       => esc_html__( 'Font Size', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'font-size',
			'units'       => 'px',
			'output'      => 'body'
		),
		't_body_line_height' => array(
			'label'       => esc_html__( 'Line Height', 'smarty' ),
			'type'        => 'stm-attr',
			'units'       => 'px',
			'mode'        => 'line-height',
			'output'      => 'body'
		),
		't_h1_section_title' => array(
			'label'       => esc_html__( 'H1', 'smarty' ),
			'type'        => 'stm-heading'
		),
		't_h1_font_family' => array(
			'label'       => esc_html__( 'Font Family', 'smarty' ),
			'type'        => 'stm-font-family',
			'output'      => 'h1,.h1'
		),
		't_h1_font_weight' => array(
			'label'       => esc_html__( 'Font Weight', 'smarty' ),
			'type'        => 'stm-font-weight',
			'output'      => 'h1,.h1'
		),
		't_h1_font_size' => array(
			'label'       => esc_html__( 'Font Size', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'font-size',
			'units'       => 'px',
			'output'      => 'h1,.h1'
		),
		't_h1_line_height' => array(
			'label'       => esc_html__( 'Line Height', 'smarty' ),
			'type'        => 'stm-attr',
			'units'       => 'px',
			'mode'        => 'line-height',
			'output'      => 'h1,.h1'
		),
		't_h2_section_title' => array(
			'label'       => esc_html__( 'H2', 'smarty' ),
			'type'        => 'stm-heading'
		),
		't_h2_font_family' => array(
			'label'       => esc_html__( 'Font Family', 'smarty' ),
			'type'        => 'stm-font-family',
			'output'      => 'h2,.h2'
		),
		't_h2_font_weight' => array(
			'label'       => esc_html__( 'Font Weight', 'smarty' ),
			'type'        => 'stm-font-weight',
			'output'      => 'h2,.h2'
		),
		't_h2_font_size' => array(
			'label'       => esc_html__( 'Font Size', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'font-size',
			'units'       => 'px',
			'output'      => 'h2,.h2'
		),
		't_h2_line_height' => array(
			'label'       => esc_html__( 'Line Height', 'smarty' ),
			'type'        => 'stm-attr',
			'units'       => 'px',
			'mode'        => 'line-height',
			'output'      => 'h2,.h2'
		),
		't_h3_section_title' => array(
			'label'       => esc_html__( 'H3', 'smarty' ),
			'type'        => 'stm-heading'
		),
		't_h3_font_family' => array(
			'label'       => esc_html__( 'Font Family', 'smarty' ),
			'type'        => 'stm-font-family',
			'output'      => 'h3,.h3'
		),
		't_h3_font_weight' => array(
			'label'       => esc_html__( 'Font Weight', 'smarty' ),
			'type'        => 'stm-font-weight',
			'output'      => 'h3,.h3'
		),
		't_h3_font_size' => array(
			'label'       => esc_html__( 'Font Size', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'font-size',
			'units'       => 'px',
			'output'      => 'h3,.h3'
		),
		't_h3_line_height' => array(
			'label'       => esc_html__( 'Line Height', 'smarty' ),
			'type'        => 'stm-attr',
			'units'       => 'px',
			'mode'        => 'line-height',
			'output'      => 'h3,.h3'
		),
		't_h4_section_title' => array(
			'label'       => esc_html__( 'H4', 'smarty' ),
			'type'        => 'stm-heading'
		),
		't_h4_font_family' => array(
			'label'       => esc_html__( 'Font Family', 'smarty' ),
			'type'        => 'stm-font-family',
			'output'      => 'h4,.h4'
		),
		't_h4_font_weight' => array(
			'label'       => esc_html__( 'Font Weight', 'smarty' ),
			'type'        => 'stm-font-weight',
			'output'      => 'h4,.h4'
		),
		't_h4_font_size' => array(
			'label'       => esc_html__( 'Font Size', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'font-size',
			'units'       => 'px',
			'output'      => 'h4,.h4'
		),
		't_h4_line_height' => array(
			'label'       => esc_html__( 'Line Height', 'smarty' ),
			'type'        => 'stm-attr',
			'units'       => 'px',
			'mode'        => 'line-height',
			'output'      => 'h4,.h4'
		),
		't_h5_section_title' => array(
			'label'       => esc_html__( 'H5', 'smarty' ),
			'type'        => 'stm-heading'
		),
		't_h5_font_family' => array(
			'label'       => esc_html__( 'Font Family', 'smarty' ),
			'type'        => 'stm-font-family',
			'output'      => 'h5,.h5'
		),
		't_h5_font_weight' => array(
			'label'       => esc_html__( 'Font Weight', 'smarty' ),
			'type'        => 'stm-font-weight',
			'output'      => 'h5,.h5'
		),
		't_h5_font_size' => array(
			'label'       => esc_html__( 'Font Size', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'font-size',
			'units'       => 'px',
			'output'      => 'h5,.h5'
		),
		't_h5_line_height' => array(
			'label'       => esc_html__( 'Line Height', 'smarty' ),
			'type'        => 'stm-attr',
			'units'       => 'px',
			'mode'        => 'line-height',
			'output'      => 'h5,.h5'
		),
		't_h6_section_title' => array(
			'label'       => esc_html__( 'H6', 'smarty' ),
			'type'        => 'stm-heading'
		),
		't_h6_font_family' => array(
			'label'       => esc_html__( 'Font Family', 'smarty' ),
			'type'        => 'stm-font-family',
			'output'      => 'h6,.h6'
		),
		't_h6_font_weight' => array(
			'label'       => esc_html__( 'Font Weight', 'smarty' ),
			'type'        => 'stm-font-weight',
			'output'      => 'h6,.h6'
		),
		't_h6_font_size' => array(
			'label'       => esc_html__( 'Font Size', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'font-size',
			'units'       => 'px',
			'output'      => 'h6,.h6'
		),
		't_h6_line_height' => array(
			'label'       => esc_html__( 'Line Height', 'smarty' ),
			'type'        => 'stm-attr',
			'units'       => 'px',
			'mode'        => 'line-height',
			'output'      => 'h6,.h6'
		)
	)
) );

STM_Customizer::setSection( 'site_settings', array(
	'title'    => esc_html__( 'Style &amp; Settings', 'smarty' ),
	'panel'    => 'site_settings',
	'priority' => 25,
	'fields'   => array(
		'site_skin_color' => array(
			'label'   => esc_html__( 'Skin Color', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => array(
				'default' => esc_html__( 'Default', 'smarty' ),
				'orange'  => esc_html__( 'Purple', 'smarty' ),
				'purple'  => esc_html__( 'Coral', 'smarty' ),
				'red'     => esc_html__( 'Green', 'smarty' ),
				'custom'  => esc_html__( 'Custom Colors', 'smarty' ),
			),
			'default' => 'default'
		),
		'skin_color_base' => array(
			'label'   => esc_html__( 'Custom Base Color', 'smarty' ),
			'type'    => 'color',
			'default' => '#ff6682'
		),
		'skin_color_secondary' => array(
			'label'   => esc_html__( 'Custom Secondary Color', 'smarty' ),
			'type'    => 'color',
			'default' => '#56509f'
		),
        'skin_color_third' => array(
            'label'   => esc_html__( 'Custom Third Color', 'smarty' ),
            'type'    => 'color',
            'default' => '#ffdd00'
        ),
		'frontend_customizer_show' => array(
			'label'   => esc_html__( 'Frontend Customizer', 'smarty' ),
			'type'    => 'stm-checkbox',
			'default' => false
		),
		'site_layout_boxed' => array(
			'label'   => esc_html__( 'Boxed', 'smarty' ),
			'type'    => 'stm-checkbox',
			'default' => false
		),
		'site_bg_type' => array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Background', 'smarty' ),
			'choices'  => array(
				'image'   => esc_html__( 'Image', 'smarty' ),
				'pattern' => esc_html__( 'Pattern', 'smarty' )
			),
			'default' => 'image'
		),
		'site_bg_image' => array(
			'label'   => esc_html__( 'Image', 'smarty' ),
			'type'    => 'stm-select-bg',
			'choices' => array(
				'bg_img_1' => 'prev_img_1.png',
				'bg_img_2' => 'prev_img_2.png',
				'custom'   => 'prev_img_custom.png'
			)
		),
		'site_bg_image_custom' => array(
			'label' => esc_html__( 'Custom', 'smarty' ),
			'type'  => 'image'
		),
		'site_bg_pattern' => array(
			'label'   => esc_html__( 'Pattern', 'smarty' ),
			'type'    => 'stm-select-bg',
			'choices' => array(
				'bg_pattern_1' => 'prev_pattern_1.png',
				'bg_pattern_2' => 'prev_pattern_2.png',
				'bg_pattern_3' => 'prev_pattern_3.png',
				'custom'       => 'prev_img_custom.png'
			)
		),
		'site_bg_patter_custom' => array(
			'label' => esc_html__( 'Custom', 'smarty' ),
			'type'  => 'image'
		),
        'enable_preloader' => array(
            'label'   => esc_html__( 'Enable Preloader', 'smarty' ),
            'type'    => 'stm-checkbox',
            'default' => false
        ),
	)
) );

STM_Customizer::setSection( 'envato_api_settings', array(
	'title'    => esc_html__( 'One Click update', 'smarty' ),
	'panel'    => 'site_settings',
	'priority' => 30,
	'fields'   => array(
		'envato_username' => array(
			'label' => esc_html__( 'Envato Username', 'smarty' ),
			'type'  => 'text',
			'default' => '',
			'description' => esc_html__( 'Envato Username - your ThemeForest (or Envato) username (i.e. Stylemixthemes).', 'smarty' )
		),
		'envato_api' => array(
			'label' => esc_html__( 'Envato API Key', 'smarty' ),
			'type'  => 'text',
			'default' => '',
			'description' => esc_html__( 'Envato API Key - secret API key you have on ThemeForest. You can create a new one under the Settings > API Keys section of your profile.', 'smarty' )
		),
	)
) );

//Google Api
STM_Customizer::setSection( 'google_api_settings', array(
    'title'    => esc_html__( 'Google Api Settings', 'smarty' ),
    'panel'    => 'site_settings',
    'priority' => 35,
    'fields'   => array(
        'google_api_key' => array(
            'label' => esc_html__( 'Google API Key', 'smarty' ),
            'type'  => 'text',
            'default' => '',
            'description' => esc_html__( 'Enter here the secret api key you have created on Google APIs. You can enable MAP API in Google APIs > Google Maps APIs > Google Maps JavaScript API.', 'smarty' )
        ),
    )
) );

// Social Networks
STM_Customizer::setSection( 'socials', array(
	'title'  => esc_html__( 'Socials Networks', 'smarty' ),
	'priority'  => 136,
	'fields' => array(
		'socials' => array(
			'label'   => esc_html__( 'Socials', 'smarty' ),
			'type'    => 'stm-socials',
			'choices' => $socials
		)
	)
) );

STM_Customizer::setSection( 'header', array(
	'title'    => esc_html__( 'Header', 'smarty' ),
	'priority'  => 140,
	'fields'   => array(
		'header_section_title_1' => array(
			'label'       => esc_html__( 'Style', 'smarty' ),
			'type'        => 'stm-heading'
		),
		'header_view_style' => array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Choose:', 'smarty' ),
			'choices'  => array(
				1 => esc_html__( 'Style 1', 'smarty' ),
				2 => esc_html__( 'Style 2', 'smarty' ),
				3 => esc_html__( 'Style 3', 'smarty' ),
				4 => esc_html__( 'Style 4', 'smarty' )
			),
			'default' => 1
		),
        'sticky_header'     => array(
            'label'             => esc_html__( 'Sticky header', 'smarty' ),
            'type'              => 'stm-checkbox',
            'sanitize_callback' => 'sanitize_checkbox',
            'default'           => false
        ),
		'header_section_title_2' => array(
			'label'       => esc_html__( 'Top Bar', 'smarty' ),
			'type'        => 'stm-heading'
		),
		'top_bar_show'     => array(
			'label'             => esc_html__( 'Show', 'smarty' ),
			'type'              => 'stm-checkbox',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => true
		),
		'header_break_1'       => array(
			'type' => 'stm-separator'
		),
		'top_bar_language'     => array(
			'label'             => esc_html__( 'Language', 'smarty' ),
			'type'              => 'stm-checkbox',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => true
		),
		'top_bar_contacts'        => array(
			'label'             => esc_html__( 'Contact Details', 'smarty' ),
			'type'              => 'stm-checkbox',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => true
		),
		'contact_details[phone]' => array(
			'label'       => esc_html__( 'Phone', 'smarty' ),
			'placeholder' => esc_html__( 'Phone', 'smarty' ),
			'type'        => 'stm-text',
			'default'	  => '+1 998 71 150 30 20'
		),
		'contact_details[email]' => array(
			'label'       => esc_html__( 'E-Mail', 'smarty' ),
			'placeholder' => esc_html__( 'E-Mail', 'smarty' ),
			'type'        => 'stm-text',
			'default' 	  => 'info@stylemixthemes.com'
		),
        'contact_details[schedule]' => array(
            'label'       => esc_html__( 'Work schedulel', 'smarty' ),
            'placeholder' => esc_html__( 'Work schedulel', 'smarty' ),
            'type'        => 'stm-text',
            'default' 	  => 'Mon — Fri: 8.00 AM — 18.00 PM'
        ),
		'contact_details[address]' => array(
			'label'       => esc_html__( 'Address', 'smarty' ),
			'placeholder' => esc_html__( 'Address', 'smarty' ),
			'type'        => 'textarea',
			'default' 	  => esc_html__('16-2, Best Avenue Street, CA 23653, USA', 'smarty')
		),
		'top_bar_search'        => array(
			'label'             => esc_html__( 'Search', 'smarty' ),
			'type'              => 'stm-checkbox',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => true
		),
        'top_bar_shopping_cart'        => array(
            'label'             => esc_html__( 'Shopping Cart', 'smarty' ),
            'type'              => 'stm-checkbox',
            'sanitize_callback' => 'sanitize_checkbox',
            'default'           => true
        ),
		'top_bar_nav'        => array(
			'label'             => esc_html__( 'Navigation menu', 'smarty' ),
			'type'              => 'stm-checkbox',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => true
		),
		'top_bar_account'        => array(
			'label'             => esc_html__( 'Account menu', 'smarty' ),
			'type'              => 'stm-checkbox',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => true
		),
		'top_bar_socials'        => array(
			'label'             => esc_html__( 'Social Networks', 'smarty' ),
			'type'              => 'stm-checkbox',
			'sanitize_callback' => 'sanitize_checkbox',
			'default'           => true
		),
		'topbar_socials_enable' => array(
			'label'   => esc_html__( 'Choose:', 'smarty' ),
			'type'    => 'stm-multiple-checkbox',
			'choices' => $socials
		)
	)
));

STM_Customizer::setSection( 'footer_layout', array(
	'title'  => esc_html__( 'Layout', 'smarty' ),
	'panel'  => 'footer',
	'fields' => array(
		'footer_sidebar_count' => array(
			'label'   => esc_html__( 'Widget Areas - Columns', 'smarty' ),
			'type'    => 'stm-select',
			'default' => 4,
			'choices' => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4
			)
		),
		'footer_break_2'       => array(
			'type' => 'stm-separator',
		),
		'footer_socials_enable' => array(
			'label'   => esc_html__( 'Choose:', 'smarty' ),
			'type'    => 'stm-multiple-checkbox',
			'choices' => $socials
		),
		'footer_copyright'     => array(
			'label'       => esc_html__( 'Copyright', 'smarty' ),
			'placeholder' => esc_html__( 'Copyright &copy; 2016 Stylemix Themes', 'smarty' ),
			'type'        => 'stm-text',
			'default'     => sprintf( wp_kses(__('Copyright &copy; Secondary School Theme by <a href="%s" target="_blank">Stylemix Themes</a>', 'smarty'), array( 'a' => array( 'href' => array(), 'target' => array() ))), 'http://stylemixthemes.com/' )
		),
	)
) );

STM_Customizer::setSection( 'footer_scripts', array(
	'title'  => esc_html__( 'Additional Scripts', 'smarty' ),
	'panel'  => 'footer',
	'fields' => array(
		'footer_custom_scripts' => array(
			'label'       => '',
			'type'        => 'stm-code',
			'placeholder' => 'alert("hello");',
			'description' => esc_html__( "Enter in any custom script to include in your site's footer. Be sure to use double quotes for strings.", 'smarty' )
		)
	)
) );

$stm_sidebars = get_posts(array(
	'posts_per_page' => -1,
	'post_type' => 'stm_sidebar'
));

$stm_sidebars_list = array(
	'wp' => esc_html__('WordPress', 'smarty')
);

if( $stm_sidebars ) {
	foreach( $stm_sidebars as $stm_sidebar ) {
		$stm_sidebars_list[$stm_sidebar->ID] = $stm_sidebar->post_title;
	}
}

// Page Title
STM_Customizer::setSection( 'page_title_settings', array(
	'title'    => esc_html__( 'Page Title', 'smarty' ),
	'panel'    => 'page_settings',
	'priority' => 5,
	'fields'   => array(
		'page_title_padd_top' => array(
			'label'       => esc_html__( 'Padding Top', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'padding-top',
			'units'       => 'px',
			'output'      => '.stm-page-head'
		),
		'page_title_padd_bottom' => array(
			'label'       => esc_html__( 'Padding Bottom', 'smarty' ),
			'type'        => 'stm-attr',
			'mode'        => 'padding-bottom',
			'units'       => 'px',
			'output'      => '.stm-page-head'
		)
	)
) );

// Layout
STM_Customizer::setSection( 'layout_settings', array(
	'title'  => esc_html__( 'Layout', 'smarty' ),
	'panel'    => 'page_settings',
	'priority' => 10,
	'fields' => array(
		'section_title_1' => array(
			'label'        => esc_html__( 'Blog', 'smarty' ),
			'type'         => 'stm-heading'
		),
		'posts_title' => array(
			'label'       => esc_html__( 'Title', 'smarty' ),
			'placeholder' => esc_html__( 'Enter posts title', 'smarty' ),
			'type'        => 'stm-text'
		),
		'posts_sidebar' => array(
			'label'   => esc_html__( 'Archive - Sidebar Position', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => array(
				'left'  => esc_html__( 'Left', 'smarty' ),
				'right' => esc_html__( 'Right', 'smarty' ),
				'hide'  => esc_html__( 'Hide', 'smarty' )
			),
			'default' => 'right'
		),
		'posts_sidebar_id' => array(
			'label'   => esc_html__( 'Archive - Sidebar', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => $stm_sidebars_list,
			'default' => 'wp'
		),
		'posts_single_sidebar' => array(
			'label'   => esc_html__( 'Single Post - Sidebar Position', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => array(
				'left'  => esc_html__( 'Left', 'smarty' ),
				'right' => esc_html__( 'Right', 'smarty' ),
				'hide'  => esc_html__( 'Hide', 'smarty' )
			),
			'default' => 'right'
		),
		'single_post_sidebar' => array(
			'label'   => esc_html__( 'Single Post - Sidebar', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => $stm_sidebars_list,
			'default' => 'wp'
		),
        'post_soc_show_hide' => array(
            'label'   => esc_html__( 'Hide share social buttons', 'smarty' ),
            'type'    => 'stm-checkbox',
            'default' => false
        ),

		'section_break_1' => array(
			'type' => 'stm-separator'
		),
		'section_title_2' => array(
			'label'        => esc_html__( 'Donation', 'smarty' ),
			'type'         => 'stm-heading'
		),
		'donation_sidebar_pos' => array(
			'label'   => esc_html__( 'Donation - Sidebar Position', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => array(
				'left'  => esc_html__( 'Left', 'smarty' ),
				'right' => esc_html__( 'Right', 'smarty' ),
				'hide'  => esc_html__( 'Hide', 'smarty' )
			),
			'default' => 'right'
		),
		'donation_sidebar' => array(
			'label'   => esc_html__( 'Donation - Sidebar', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => $stm_sidebars_list,
			'default' => 'wp'
		),
        'donation_soc_show_hide' => array(
            'label'   => esc_html__( 'Hide share social buttons', 'smarty' ),
            'type'    => 'stm-checkbox',
            'default' => false
        ),

		'section_title_3' => array(
			'label'        => esc_html__( 'Event', 'smarty' ),
			'type'         => 'stm-heading'
		),
		'event_sidebar_pos' => array(
			'label'   => esc_html__( 'Event - Sidebar Position', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => array(
				'left'  => esc_html__( 'Left', 'smarty' ),
				'right' => esc_html__( 'Right', 'smarty' ),
				'hide'  => esc_html__( 'Hide', 'smarty' )
			),
			'default' => 'right'
		),
		'event_sidebar' => array(
			'label'   => esc_html__( 'Event - Sidebar', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => $stm_sidebars_list,
			'default' => 'wp'
		),
        'event_soc_show_hide' => array(
            'label'   => esc_html__( 'Hide share social buttons', 'smarty' ),
            'type'    => 'stm-checkbox',
            'default' => false
        ),

		'section_title_4' => array(
			'label'        => esc_html__( 'Shop', 'smarty' ),
			'type'         => 'stm-heading'
		),
		'shop_sidebar' => array(
			'label'   => esc_html__( 'Archive - Sidebar Position', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => array(
				'left'  => esc_html__( 'Left', 'smarty' ),
				'right' => esc_html__( 'Right', 'smarty' ),
				'hide'  => esc_html__( 'Hide', 'smarty' )
			),
			'default' => 'right'
		),
		'product_sidebar' => array(
			'label'   => esc_html__( 'Product - Sidebar Position', 'smarty' ),
			'type'    => 'stm-select',
			'choices' => array(
				'left'  => esc_html__( 'Left', 'smarty' ),
				'right' => esc_html__( 'Right', 'smarty' ),
				'hide'  => esc_html__( 'Hide', 'smarty' )
			),
			'default' => 'right'
		)
	)
) );

// Page Not Found ( 404 )
STM_Customizer::setSection( 'page_not_found', array(
	'title'  => esc_html__( 'Page Not Found (404)', 'smarty' ),
	'panel'    => 'page_settings',
	'priority' => 15,
	'fields'   => array(
		'page_404_bg_img' => array(
			'label' => esc_html__( 'Background Image', 'smarty' ),
			'type'  => 'image'
		)
	)
) );

// Custom CSS
STM_Customizer::setSection( 'css', array(
	'title'  => esc_html__( 'CSS', 'smarty' ),
	'fields' => array(
		'custom_css'     => array(
			'label'       => '',
			'type'        => 'stm-code',
			'placeholder' => ".classname {\n\tbackground: #000;\n}"
		)
	)
) );
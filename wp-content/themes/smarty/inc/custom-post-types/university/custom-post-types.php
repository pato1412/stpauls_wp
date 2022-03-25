<?php
if( class_exists('STM_PostType') ) {

	if( ! function_exists('stm_post_type_init')  ) {

		function stm_post_type_init() {

			STM_PostType::addMetaBox( 'stm_page_title_mb', esc_html__( 'Page title', 'smarty' ), array( 'page', 'stm_teacher', 'stm_event', 'stm_donation', 'stm_administrator' ), '', '', '', array(
				'fields' => array(
					'stm_page_title_hide' => array(
						'label'   => esc_html__( 'Hide', 'smarty' ),
						'type'    => 'checkbox'
					),
					'stm_page_title_style_size' => array(
						'label'   => esc_html__( 'Style - Size', 'smarty' ),
						'type'    => 'select',
						'options' => array(
							'small' => esc_html__( 'Small', 'smarty' ),
							'medium' => esc_html__( 'Medium', 'smarty' )
						)
					),
					'stm_page_title_style_color' => array(
						'label'   => esc_html__( 'Style - Color', 'smarty' ),
						'type'    => 'select',
						'options' => array(
							'white'  => esc_html__( 'White', 'smarty' )
						)
					),
					'stm_page_title' => array(
						'label' => esc_html__( 'Title', 'smarty' ),
						'type'  => 'textarea'
					),
					'stm_page_subtitle' => array(
						'label'   => esc_html__( 'Subtitle', 'smarty' ),
						'type'    => 'textarea'
					),
					'stm_page_title_bgimage' => array(
						'label' => esc_html__( 'Background Image', 'smarty' ),
						'type'  => 'image'
					),
					'stm_page_title_bgimage_position' => array(
						'label'   => esc_html__( 'Background Position', 'smarty' ),
						'type'    => 'text',
						'description' => esc_html__( 'Example: center top or 0 50px', 'smarty' )
					),
					'stm_page_title_overlay' => array(
						'label'   => esc_html__( 'Overlay', 'smarty' ),
						'type'    => 'checkbox',
						'default' => true
					),
					'stm_separator_1' => array(
						'label'   => esc_html__( 'Custom Styles', 'smarty' ),
						'type'    => 'separator'
					),
					'stm_page_title_height' => array(
						'label' => esc_html__( 'Height', 'smarty' ),
						'type'  => 'text'
					),
					'stm_page_title_padding' => array(
						'label' => esc_html__( 'Padding', 'smarty' ),
						'type'  => 'spacing',
						'sides' => array(
							'top'    => esc_html__('Top', 'smarty'),
							'bottom' => esc_html__('Bottom', 'smarty'),
						)
					),
					'stm_page_title_bgcolor' => array(
						'label'   => esc_html__( 'Background Color', 'smarty' ),
						'type'    => 'color_picker',
					),
					'stm_page_title_overlay_color' => array(
						'label'   => esc_html__( 'Overlay - Color', 'smarty' ),
						'type'    => 'color_picker'
					),
					'stm_page_title_overlay_opacity' => array(
						'label'   => esc_html__( 'Overlay - Color Opacity', 'smarty' ),
						'type'    => 'text',
						'description' => esc_html__( 'Example: 0.5', 'smarty' )
					),
					'stm_page_title_color' => array(
						'label'   => esc_html__( 'Title - Color', 'smarty' ),
						'type'    => 'color_picker',
					),
					'stm_page_title_sep_line_color' => array(
						'label'   => esc_html__( 'Separator - Color', 'smarty' ),
						'type'    => 'color_picker',
					),
					'stm_page_subtitle_color' => array(
						'label'   => esc_html__( 'Subtitle - Color', 'smarty' ),
						'type'    => 'color_picker',
					),
					'stm_separator_2' => array(
						'label'   => esc_html__( 'Woocommerce', 'smarty' ),
						'type'    => 'separator'
					),
					'stm_show_shipping_cart' => array(
						'label'   => esc_html__( 'Show - Shipping Cart', 'smarty' ),
						'type'    => 'checkbox'
					),
				)
			) );

            STM_PostType::addMetaBox( 'stm_page_breadcrumbs_mb', esc_html__( 'Breadcrumbs', 'smarty' ), array( 'page', 'stm_teacher', 'stm_event', 'stm_donation', 'stm_administrator' ), '', '', '', array(
                'fields' => array(
                    'stm_page_breadcrumbs_hide' => array(
                        'label'   => esc_html__( 'Hide', 'smarty' ),
                        'type'    => 'checkbox'
                    ),
                )
            ) );

			$stm_footers = get_posts(array(
				'posts_per_page' => -1,
				'post_type' => 'stm_footer'
			));

			$stm_footers_data = array(
				'' => esc_html__( 'Default', 'smarty' )
			);

			if( !empty( $stm_footers ) ) {
				foreach( $stm_footers as $stm_footer ) {
					$stm_footers_data[$stm_footer->ID] = $stm_footer->post_title;
				}
			}

			STM_PostType::addMetaBox( 'stm_footer_mb', esc_html__( 'Footer', 'smarty' ), array( 'page', 'post', 'stm_teacher', 'stm_event', 'stm_donation', 'stm_course', 'stm_administrator' ), '', '', '', array(
				'fields' => array(
					'stm_footer_id' => array(
						'label'   => esc_html__( 'Footers', 'smarty' ),
						'type'    => 'select',
						'options' => $stm_footers_data
					),
					'stm_footer_bgcolor' => array(
						'label'   => esc_html__( 'Background color', 'smarty' ),
						'type'    => 'color_picker',
					)
				)
			) );

			STM_PostType::addMetaBox( 'stm_teacher_details_mb', esc_html__( 'Details', 'smarty' ), array( 'stm_teacher' ), '', '', '', array(
				'fields' => array(
					'stm_teacher_position' => array(
						'label'   => esc_html__( 'Position', 'smarty' ),
						'type'    => 'text'
					),
					'stm_teacher_socials' => array(
						'label'   => esc_html__( 'Socials', 'smarty' ),
						'type'    => 'separator'
					),
					'stm_teacher_fb' => array(
						'label'   => esc_html__( 'Facebook', 'smarty' ),
						'type'    => 'text'
					),
					'stm_teacher_tw' => array(
						'label'   => esc_html__( 'Twitter', 'smarty' ),
						'type'    => 'text'
					),
					'stm_teacher_gplus' => array(
						'label'   => esc_html__( 'Google plus', 'smarty' ),
						'type'    => 'text'
					),
					'stm_teacher_inst' => array(
						'label'   => esc_html__( 'Instagram', 'smarty' ),
						'type'    => 'text'
					),
					'stm_teacher_email' => array(
						'label'   => esc_html__( 'E-Mail', 'smarty' ),
						'type'    => 'text'
					)
				)
			) );

            STM_PostType::addMetaBox( 'stm_administrator_details_mb', esc_html__( 'Details', 'smarty' ), array( 'stm_administrator' ), '', '', '', array(
                'fields' => array(
                    'stm_administrator_position' => array(
                        'label'   => esc_html__( 'Position', 'smarty' ),
                        'type'    => 'text'
                    ),
                    'stm_administrator_description' => array(
                        'label'   => esc_html__( 'Description', 'smarty' ),
                        'type'    => 'textarea'
                    ),
                    'stm_administrator_socials' => array(
                        'label'   => esc_html__( 'Socials', 'smarty' ),
                        'type'    => 'separator'
                    ),
                    'stm_administrator_fb' => array(
                        'label'   => esc_html__( 'Facebook', 'smarty' ),
                        'type'    => 'text'
                    ),
                    'stm_administrator_tw' => array(
                        'label'   => esc_html__( 'Twitter', 'smarty' ),
                        'type'    => 'text'
                    ),
                    'stm_administrator_gplus' => array(
                        'label'   => esc_html__( 'Google plus', 'smarty' ),
                        'type'    => 'text'
                    ),
                    'stm_administrator_inst' => array(
                        'label'   => esc_html__( 'Instagram', 'smarty' ),
                        'type'    => 'text'
                    ),
                    'stm_administrator_email' => array(
                        'label'   => esc_html__( 'E-Mail', 'smarty' ),
                        'type'    => 'text'
                    )
                )
            ) );

			STM_PostType::addMetaBox( 'stm_event_info_mb', esc_html__( 'Information', 'smarty' ), array( 'stm_event' ), '', '', '', array(
				'fields' => array(
					'stm_event_date_start' => array(
						'label'   => esc_html__( 'Date - Start:', 'smarty' ),
						'type'    => 'datepicker'
					),
					'stm_event_date_end' => array(
						'label'   => esc_html__( 'Date - End:', 'smarty' ),
						'type'    => 'datepicker'
					),
					'stm_event_time_text' => array(
						'label'   => esc_html__( 'Time - Text:', 'smarty' ),
						'type'    => 'text'
					),
					'stm_event_time_start' => array(
						'label'   => esc_html__( 'Time - Start:', 'smarty' ),
						'type'    => 'timepicker'
					),
					'stm_event_time_end' => array(
						'label'   => esc_html__( 'Time - End:', 'smarty' ),
						'type'    => 'timepicker'
					),
                    'stm_event_time_zone' => array(
                        'label'   => esc_html__( 'Time - Zone:', 'smarty' ),
                        'type'    => 'select',
                        'options' => array(
                            'Pacific/Midway'  => esc_html__( '(UTC-1100) Pacific/Midway', 'smarty' ),
                            'America/New_York'  => esc_html__( '(UTC-0500) America/New_York', 'smarty' ),
                            'Europe/London'  => esc_html__( 'Europe/London', 'smarty' ),
                            'Europe/Amsterdam'  => esc_html__( '(UTC+0100) Europe/Amsterdam', 'smarty' ),
                            'Europe/Madrid'  => esc_html__( '(UTC+0100) Europe/Madrid', 'smarty' ),
                            'Europe/Monaco'  => esc_html__( '(UTC+0100) Europe/Monaco', 'smarty' ),
                            'Europe/Paris'  => esc_html__( '(UTC+0100) Europe/Paris', 'smarty' ),
                            'Europe/Podgorica'  => esc_html__( '(UTC+0100) Europe/Podgorica', 'smarty' ),
                            'Europe/Prague'  => esc_html__( '(UTC+0100) Europe/Prague', 'smarty' ),
                            'Europe/Rome'  => esc_html__( '(UTC+0100) Europe/Rome', 'smarty' ),
                            'Europe/Athens'  => esc_html__( '(UTC+0200) Europe/Athens', 'smarty' ),
                            'Europe/Bucharest'  => esc_html__( '(UTC+0200) Europe/Bucharest', 'smarty' ),
                            'Europe/Chisinau'  => esc_html__( '(UTC+0200) Europe/Chisinau', 'smarty' ),
                            'Europe/Helsinki'  => esc_html__( '(UTC+0200) Europe/Helsinki', 'smarty' ),
                            'Europe/Istanbul'  => esc_html__( '(UTC+0200) Europe/Istanbul', 'smarty' ),
                            'Europe/Kiev'  => esc_html__( '(UTC+0200) Europe/Kiev', 'smarty' ),
                            'Asia/Tehran'  => esc_html__( '(UTC+0330) Asia/Tehran', 'smarty' ),
                            'Asia/Samarkand'  => esc_html__( '(UTC+0500) Asia/Samarkand', 'smarty' ),
                            'Asia/Tashkent'  => esc_html__( '(UTC+0500) Asia/Tashkent', 'smarty' ),
                            'Asia/Almaty'  => esc_html__( '(UTC+0600) Asia/Almaty', 'smarty' ),
                            'Asia/Bishkek'  => esc_html__( '(UTC+0600) Asia/Bishkek', 'smarty' ),
                            'Asia/Bangkok'  => esc_html__( '(UTC+0700) Asia/Bangkok', 'smarty' ),
                            'Asia/Barnaul'  => esc_html__( '(UTC+0700) Asia/Barnaul', 'smarty' ),
                            'Asia/Hong_Kong'  => esc_html__( '(UTC+0800) Asia/Hong_Kong', 'smarty' ),
                            'Australia/Perth'  => esc_html__( '(UTC+0800) Australia/Perth', 'smarty' ),
                            'Australia/Eucla'  => esc_html__( '(UTC+0845) Australia/Eucla', 'smarty' ),
                            'Asia/Seoul'  => esc_html__( '(UTC+0900) Asia/Seoul', 'smarty' ),
                            'Asia/Tokyo'  => esc_html__( '(UTC+0900) Asia/Tokyo', 'smarty' ),
                            'Asia/Chita'  => esc_html__( '(UTC+1000) Asia/Chita', 'smarty' ),
                            'Australia/Brisbane'  => esc_html__( '(UTC+1000) Australia/Brisbane', 'smarty' ),
                            'Australia/Lindeman'  => esc_html__( '(UTC+1000) Australia/Lindeman', 'smarty' ),
                            'Australia/Adelaide'  => esc_html__( '(UTC+1030) Australia/Adelaide', 'smarty' ),
                            'Australia/Broken_Hill'  => esc_html__( '(UTC+1030) Australia/Broken_Hill', 'smarty' ),
                            'Antarctica/Macquarie'  => esc_html__( '(UTC+1100) Antarctica/Macquarie', 'smarty' ),
                            'Australia/Currie'  => esc_html__( '(UTC+1100) Australia/Currie', 'smarty' ),
                            'UTC-12'  => esc_html__( 'UTC-12', 'smarty' ),
                            'UTC-11'  => esc_html__( 'UTC-11', 'smarty' ),
                            'UTC-10'  => esc_html__( 'UTC-10', 'smarty' ),
                            'UTC-9'  => esc_html__( 'UTC-9', 'smarty' ),
                            'UTC-8'  => esc_html__( 'UTC-8', 'smarty' ),
                            'UTC-7'  => esc_html__( 'UTC-7', 'smarty' ),
                            'UTC-6'  => esc_html__( 'UTC-6', 'smarty' ),
                            'UTC-5'  => esc_html__( 'UTC-5', 'smarty' ),
                            'UTC-4'  => esc_html__( 'UTC-4', 'smarty' ),
                            'UTC-3'  => esc_html__( 'UTC-3', 'smarty' ),
                            'UTC-2'  => esc_html__( 'UTC-2', 'smarty' ),
                            'UTC-1'  => esc_html__( 'UTC-1', 'smarty' ),
                            'UTC-0'  => esc_html__( 'UTC 0', 'smarty' ),
                            'UTC+1'  => esc_html__( 'UTC+1', 'smarty' ),
                            'UTC+2'  => esc_html__( 'UTC+2', 'smarty' ),
                            'UTC+3'  => esc_html__( 'UTC+3', 'smarty' ),
                            'UTC+4'  => esc_html__( 'UTC+4', 'smarty' ),
                            'UTC+5'  => esc_html__( 'UTC+5', 'smarty' ),
                            'UTC+6'  => esc_html__( 'UTC+6', 'smarty' ),
                            'UTC+7'  => esc_html__( 'UTC+7', 'smarty' ),
                            'UTC+8'  => esc_html__( 'UTC+8', 'smarty' ),
                            'UTC+9'  => esc_html__( 'UTC+9', 'smarty' ),
                            'UTC+10'  => esc_html__( 'UTC+10', 'smarty' ),
                            'UTC+11'  => esc_html__( 'UTC+11', 'smarty' ),
                            'UTC+12'  => esc_html__( 'UTC+12', 'smarty' ),
                        ),
                        'default' => 'Europe/London'
                    ),
					'stm_event_venue' => array(
						'label'   => esc_html__( 'Venue:', 'smarty' ),
						'type'    => 'textarea'
					),
					'stm_event_map_lat' => array(
						'label'   => esc_html__( 'Latitude:', 'smarty' ),
						'type'    => 'text'
					),
					'stm_event_map_lng' => array(
						'label'   => esc_html__( 'Longitude:', 'smarty' ),
						'type'    => 'text'
					),
					'stm_event_tel' => array(
						'label'   => esc_html__( 'Telephone:', 'smarty' ),
						'type'    => 'textarea'
					),
					'stm_event_email' => array(
						'label'   => esc_html__( 'E-Mail:', 'smarty' ),
						'type'    => 'textarea'
					)
				)
			) );

			$teachers = get_posts(array(
				'posts_per_page' => -1,
				'post_type' => 'stm_teacher'
			));

			$teachers_data = array(
				null => esc_html__('Choose', 'smarty')
			);

			if( !empty( $teachers ) ) {
				foreach( $teachers as $teacher ) {
					$teachers_data[$teacher->ID] = $teacher->post_title;
				}
			}

            $administrators = get_posts(array(
                'posts_per_page' => -1,
                'post_type' => 'stm_administrator'
            ));

            $administrators_data = array(
                0 => esc_html__('Choose', 'smarty')
            );

            if( !empty( $administrators ) ) {
                foreach( $administrators as $administrator ) {
                    $administrators_data[$administrator->ID] = $administrator->post_title;
                }
            }

			STM_PostType::addMetaBox( 'course_details', esc_html__( 'Details', 'smarty' ), array( 'stm_course' ), '', '', '', array(
				'fields' => array(
					'course_teacher' => array(
						'label'   => esc_html__( 'Teacher', 'smarty' ),
						'type'    => 'multi-select',
						'options' => $teachers_data
					)
				)
			) );

			STM_PostType::addMetaBox( 'donor_info', esc_html__( 'Donor Info', 'smarty' ), array( 'donor' ), '', '', '', array(
				'fields' => array(
					'donor_email'   => array(
						'label' => esc_html__( 'Email', 'smarty' ),
						'type'  => 'text'
					),
					'donor_phone'   => array(
						'label' => esc_html__( 'Phone', 'smarty' ),
						'type'  => 'text'
					),
					'donor_address'   => array(
						'label' => esc_html__( 'Address', 'smarty' ),
						'type'  => 'text'
					),
					'donor_note'   => array(
						'label' => esc_html__( 'Additional Note', 'smarty' ),
						'type'  => 'text'
					),
					'donor_amount'   => array(
						'label' => esc_html__( 'Amount', 'smarty' ),
						'type'  => 'text'
					),
					'donor_donation'   => array(
						'label' => esc_html__( 'Donation', 'smarty' ),
						'type'  => 'text'
					)
				)
			) );

			STM_PostType::addMetaBox( 'event_member_contact_info', esc_html__( 'Contact Info', 'smarty' ), array( 'event_member' ), '', '', '', array(
				'fields' => array(
					'event_member_email'   => array(
						'label' => esc_html__( 'Email', 'smarty' ),
						'type'  => 'text'
					),
					'event_member_phone'   => array(
						'label' => esc_html__( 'Phone', 'smarty' ),
						'type'  => 'text'
					)
				)
			) );

			STM_PostType::addMetaBox( 'stm_donation_mb', esc_html__( 'Information', 'smarty' ), array( 'stm_donation' ), '', '', '', array(
				'fields' => array(
					'stm_donation_goal' => array(
						'label'   => esc_html__( 'Goal:', 'smarty' ),
						'type'    => 'text'
					),
					'stm_donation_currency' => array(
						'label'   => esc_html__( 'Currency:', 'smarty' ),
						'type'    => 'text',
						'default' => '$'
					),
					'stm_donation_currency_pos' => array(
						'label'   => esc_html__( 'Currency - Position:', 'smarty' ),
						'type'    => 'select',
						'options' => array(
							'left'  => esc_html__( 'Left', 'smarty' ),
							'right' => esc_html__( 'Right', 'smarty' )
						)
					),
					'stm_donation_donors' => array(
						'label'   => esc_html__( 'Donors:', 'smarty' ),
						'type'    => 'text'
					),
					'stm_donation_raised' => array(
						'label'   => esc_html__( 'Raised:', 'smarty' ),
						'type'    => 'text'
					),
					'stm_donation_time' => array(
						'label'   => esc_html__( 'Time:', 'smarty' ),
						'type'    => 'datetimepicker'
					),
					'stm_donation_state' => array(
						'label'   => esc_html__( 'State:', 'smarty' ),
						'type'    => 'select',
						'options' => array(
							'active'  => esc_html__( 'Active', 'smarty' ),
							'completed' => esc_html__('Completed', 'smarty')
						)
					),
				)
			) );

			STM_PostType::addMetaBox( 'media_gallery_item_mb', esc_html__( 'Details', 'smarty' ), array( 'stm_media_gallery' ), '', '', '', array(
				'fields' => array(
					'media_type' => array(
						'label'   => esc_html__( 'Type:', 'smarty' ),
						'type'    => 'select',
						'options' => array(
							'image'  => esc_html__( 'Image', 'smarty' ),
							'audio' => esc_html__( 'Audio', 'smarty' ),
							'video' => esc_html__( 'Video', 'smarty' )
						),
						'default' => 'image'
					),
					'media_item_descr' => array(
						'label' => esc_html__( 'Description', 'smarty' ),
						'type'  => 'textarea'
					),
					'media_item_img' => array(
						'label' => esc_html__( 'Image', 'smarty' ),
						'type'  => 'image'
					),
					'media_item_link' => array(
						'label' => esc_html__( 'Link', 'smarty' ),
						'type'  => 'text'
					),
					'media_item_embed' => array(
						'label' => esc_html__( 'Embed code', 'smarty' ),
						'type'  => 'textarea'
					),
					'media_featured' => array(
						'label' => esc_html__( 'Featured', 'smarty' ),
						'type'  => 'checkbox'
					)
				)
			) );
		}

		add_action('init', 'stm_post_type_init');
	}

	$options = get_option('stm_post_types_options');

	$defaultPostTypesOptions = array(
		'stm_meal' => array(
			'title' => esc_html__( 'Meal', 'smarty' ),
			'plural_title' => esc_html__( 'Meal', 'smarty' ),
			'rewrite' => 'meal'
		),
		'stm_media_gallery' => array(
			'title' => esc_html__( 'Media Gallery', 'smarty' ),
			'plural_title' => esc_html__( 'Media Gallery', 'smarty' ),
			'rewrite' => 'stm-media-gallery'
		),
		'stm_sidebar' => array(
			'title' => esc_html__( 'Sidebar', 'smarty' ),
			'plural_title' => esc_html__( 'Sidebar', 'smarty' ),
			'rewrite' => 'stm-sidebar'
		),
		'stm_footer' => array(
			'title' => esc_html__( 'Footer', 'smarty' ),
			'plural_title' => esc_html__( 'Footer', 'smarty' ),
			'rewrite' => 'stm-footer'
		),
		'stm_event' => array(
			'title' => esc_html__( 'Meeting', 'smarty' ),
			'plural_title' => esc_html__( 'Meeting', 'smarty' ),
			'rewrite' => 'meeting'
		),
		'stm_testimonial' => array(
			'title' => esc_html__( 'Testimonial', 'smarty' ),
			'plural_title' => esc_html__( 'Testimonials', 'smarty' ),
			'rewrite' => 'stm-testimonial'
		),
		'stm_achievement' => array(
			'title' => esc_html__( 'Achievement', 'smarty' ),
			'plural_title' => esc_html__( 'Achievements', 'smarty' ),
			'rewrite' => 'stm-achievement'
		),
		'stm_teacher' => array(
			'title' => esc_html__( 'Teacher', 'smarty' ),
			'plural_title' => esc_html__( 'Teachers', 'smarty' ),
			'rewrite' => 'teachers'
		),
        'stm_administrator' => array(
			'title' => esc_html__( 'Administrator', 'smarty' ),
			'plural_title' => esc_html__( 'Administrators', 'smarty' ),
			'rewrite' => 'administrators'
		),
		'stm_donation' => array(
			'title' => esc_html__( 'Donation', 'smarty' ),
			'plural_title' => esc_html__( 'Donations', 'smarty' ),
			'rewrite' => 'donations',
			'page_for_donations' => ''
		),
		'stm_course' => array(
			'title' => esc_html__( 'Course', 'smarty' ),
			'plural_title' => esc_html__( 'Courses', 'smarty' ),
			'rewrite' => 'courses',
			'page_for_courses' => ''
		)
	);

	$stm_post_types_options = wp_parse_args( $options, $defaultPostTypesOptions );

	// Meeting
	STM_PostType::registerPostType(
		'stm_event',
		$stm_post_types_options['stm_event']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_event']['plural_title'],
			'menu_icon'   => 'dashicons-megaphone',
			'supports' => array( 'title', 'editor', 'excerpt', 'comments', 'author', 'thumbnail' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_event']['rewrite'] ),
			'show_in_nav_menus' => true,
			'taxonomies' => array('post_tag')
		)
	);

	STM_PostType::addTaxonomy( 'stm_event_category', esc_html__( 'Categories', 'smarty' ), 'stm_event' );

	STM_PostType::registerPostType(
		'event_member',
		esc_html__( 'Member', 'smarty' ),
		array(
			'supports' => array( 'title', 'editor' ),
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_in_menu' => 'edit.php?post_type=stm_event'
		)
	);

	// Sidebars
	STM_PostType::registerPostType(
		'stm_sidebar',
		$stm_post_types_options['stm_sidebar']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_sidebar']['plural_title'],
			'menu_icon'   => 'dashicons-welcome-widgets-menus',
			'supports' => array( 'title', 'editor' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_sidebar']['rewrite'] ),
			'exclude_from_search' => true
		)
	);

	// Footer
	STM_PostType::registerPostType(
		'stm_footer',
		$stm_post_types_options['stm_footer']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_footer']['plural_title'],
			'menu_icon'   => 'dashicons-layout',
			'supports' => array( 'title', 'editor' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_footer']['rewrite'] ),
			'exclude_from_search' => true
		)
	);

	// Donation
	STM_PostType::registerPostType(
		'stm_donation',
		$stm_post_types_options['stm_donation']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_donation']['plural_title'],
			'menu_icon'   => 'dashicons-sos',
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments', ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_donation']['rewrite'] ),
			'show_in_nav_menus' => true
		)
	);

	STM_PostType::registerPostType(
		'donor',
		esc_html__( 'Donor', 'smarty' ),
		array(
			'supports' => array( 'title' ),
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_in_menu' => 'edit.php?post_type=stm_donation'
		)
	);

	// Course
	STM_PostType::registerPostType(
		'stm_course',
		$stm_post_types_options['stm_course']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_course']['plural_title'],
			'menu_icon'   => 'dashicons-welcome-learn-more',
			'supports' => array( 'title', 'editor' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_course']['rewrite'] )
		)
	);
    STM_PostType::addTaxonomy( 'stm_course_department', esc_html__( 'Department', 'smarty' ), array (
        'stm_course', 'stm_teacher'
    ) );
    STM_PostType::addTaxonomy( 'stm_course_semester', esc_html__( 'Semester', 'smarty' ), 'stm_course' );

	// Media Gallery
	STM_PostType::registerPostType(
		'stm_media_gallery',
		$stm_post_types_options['stm_media_gallery']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_media_gallery']['plural_title'],
			'menu_icon'   => 'dashicons-format-gallery',
			'public' => true,
			'supports' => array( 'title' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_media_gallery']['rewrite'] ),
			'exclude_from_search' => true
		)
	);
	STM_PostType::addTaxonomy( 'stm_media_gallery_category', esc_html__( 'Categories', 'smarty' ), 'stm_media_gallery' );

	// Testimonial
	STM_PostType::registerPostType(
		'stm_testimonial',
		$stm_post_types_options['stm_testimonial']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_testimonial']['plural_title'],
			'menu_icon'   => 'dashicons-format-quote',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_testimonial']['rewrite'] ),
			'exclude_from_search' => true
		)
	);

	// Meal
	STM_PostType::registerPostType(
		'stm_meal',
		$stm_post_types_options['stm_meal']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_meal']['plural_title'],
			'menu_icon'   => 'dashicons-carrot',
			'supports' => array( 'title', 'excerpt', 'thumbnail' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_meal']['rewrite'] ),
			'exclude_from_search' => true
		)
	);
	STM_PostType::addTaxonomy( 'stm_meal_weekdays', esc_html__( 'Weekdays', 'smarty' ), 'stm_meal', array( 'plural' => 'Weekdays' ) );
	STM_PostType::addTaxonomy( 'stm_meal_time', esc_html__( 'Meal Time', 'smarty' ), 'stm_meal' );

	// Achievement
	STM_PostType::registerPostType(
		'stm_achievement',
		$stm_post_types_options['stm_achievement']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_achievement']['plural_title'],
			'menu_icon'   => 'dashicons-awards',
			'supports' => array( 'title', 'thumbnail' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_achievement']['rewrite'] ),
			'exclude_from_search' => true
		)
	);

	STM_PostType::addTaxonomy( 'stm_achievement_category', esc_html__( 'Categories', 'smarty' ), 'stm_achievement' );

	// Teacher
	STM_PostType::registerPostType(
		'stm_teacher',
		$stm_post_types_options['stm_teacher']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_teacher']['plural_title'],
			'menu_icon'   => 'dashicons-groups',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_teacher']['rewrite'] )
		)
	);
    STM_PostType::addTaxonomy( 'stm_teacher_category', esc_html__( 'Categories', 'smarty' ), 'stm_teacher' );

	// Administrator
	STM_PostType::registerPostType(
		'stm_administrator',
		$stm_post_types_options['stm_administrator']['title'],
		array(
			'pluralTitle' => $stm_post_types_options['stm_administrator']['plural_title'],
			'menu_icon'   => 'dashicons-businessman',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'rewrite' => array( 'slug' => $stm_post_types_options['stm_administrator']['rewrite'] ),
		)
	);

	add_action( 'admin_menu', 'stm_register_post_types_options_menu' );

	if( ! function_exists( 'stm_register_post_types_options_menu' ) ){
		function stm_register_post_types_options_menu(){
			add_theme_page( esc_html__('STM Post Types', 'smarty'), esc_html__('STM Post Types', 'smarty'), 'manage_options', 'stm_post_types', 'stm_post_types_options' );
		}
	}

	if( ! function_exists( 'stm_post_types_options' ) ){
		function stm_post_types_options(){

			if ( ! empty( $_POST['stm_post_types_options'] ) ) {
				update_option( 'stm_post_types_options', smarty_sanitize_text_field($_POST['stm_post_types_options']) );
			}

			$options = get_option('stm_post_types_options');

			$defaultPostTypesOptions = array(
				'stm_event' => array(
					'title' => esc_html__( 'Meeting', 'smarty' ),
					'plural_title' => esc_html__( 'Meeting', 'smarty' ),
					'rewrite' => 'meeting'
				),
				'stm_teacher' => array(
					'title' => esc_html__( 'Teacher', 'smarty' ),
					'plural_title' => esc_html__( 'Teachers', 'smarty' ),
					'rewrite' => 'teachers'
				),
                'stm_administrator' => array(
					'title' => esc_html__( 'Administrator', 'smarty' ),
					'plural_title' => esc_html__( 'Administrators', 'smarty' ),
					'rewrite' => 'administrators'
				),
				'stm_donation' => array(
					'title' => esc_html__( 'Donation', 'smarty' ),
					'plural_title' => esc_html__( 'Donations', 'smarty' ),
					'rewrite' => 'donations',
					'page_for_donations' => ''
				),
				'stm_course' => array(
					'title' => esc_html__( 'Course', 'smarty' ),
					'plural_title' => esc_html__( 'Courses', 'smarty' ),
					'rewrite' => 'courses',
					'page_for_courses' => ''
				)
			);

			$options = wp_parse_args( $options, $defaultPostTypesOptions );

			$stm_pages = get_pages();
			$stm_pages_data = array();

			if( !empty( $stm_pages ) ) {
				foreach( $stm_pages as $stm_page ) {
					$stm_pages_data[$stm_page->ID] = $stm_page->post_title;
				}
			}
			?>
			<div class="wrap">
		        <h2><?php esc_html_e( 'Custom Post Type Renaming Settings', 'smarty' ); ?></h2>

		        <form method="POST" action="">
		            <table class="form-table">
				            <tr valign="top">
					            <th scope="row">
						            <label for="stm_course_title"><?php esc_html_e( '"Courses" title (admin panel tab name)', 'smarty' ); ?></label>
					            </th>
					            <td>
						            <input type="text" id="stm_course_title" name="stm_post_types_options[stm_course][title]" value="<?php echo esc_attr( $options['stm_course']['title'] ); ?>"  size="25" />
					            </td>
				            </tr>
				            <tr valign="top">
					            <th scope="row">
						            <label for="stm_course_plural_title"><?php esc_html_e( '"Courses" plural title', 'smarty' ); ?></label>
					            </th>
					            <td>
						            <input type="text" id="stm_course_plural_title" name="stm_post_types_options[stm_course][plural_title]" value="<?php echo esc_attr( $options['stm_course']['plural_title'] ); ?>"  size="25" />
					            </td>
				            </tr>
				            <tr valign="top">
					            <th scope="row">
						            <label for="stm_course_rewrite"><?php esc_html_e( '"Courses" rewrite (URL text)', 'smarty' ); ?></label>
					            </th>
					            <td>
						            <input type="text" id="stm_course_rewrite" name="stm_post_types_options[stm_course][rewrite]" value="<?php echo esc_attr( $options['stm_course']['rewrite'] ); ?>"  size="25" />
					            </td>
			             </tr>
			             <tr valign="top">
				            <th scope="row">
					            <label for="stm_course_page_for_donations"><?php esc_html_e( '"Courses Page"', 'smarty' ); ?></label>
				            </th>
				            <td>
					            <?php if( !empty( $stm_pages_data ) ) : ?>
						            <select id="stm_course_page_for_donations" name="stm_post_types_options[stm_course][page_for_courses]">
							            <?php foreach( $stm_pages_data as $stm_page_id => $stm_page_title ): ?>
								            <option value="<?php echo esc_attr( $stm_page_id ); ?>" <?php echo (( $options['stm_course']['page_for_courses'] == $stm_page_id ) ? ' selected="selected"' : '' ); ?>><?php echo esc_html( $stm_page_title ); ?></option>
							            <?php endforeach; ?>
						            </select>
					            <?php endif; ?>
				            </td>
			             </tr>
		               <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_donation_title"><?php esc_html_e( '"Donations" title (admin panel tab name)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_donation_title" name="stm_post_types_options[stm_donation][title]" value="<?php echo esc_attr( $options['stm_donation']['title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_donation_plural_title"><?php esc_html_e( '"Donations" plural title', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_donation_plural_title" name="stm_post_types_options[stm_donation][plural_title]" value="<?php echo esc_attr( $options['stm_donation']['plural_title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_donation_rewrite"><?php esc_html_e( '"Donations" rewrite (URL text)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_donation_rewrite" name="stm_post_types_options[stm_donation][rewrite]" value="<?php echo esc_attr( $options['stm_donation']['rewrite'] ); ?>"  size="25" />
		                    </td>
		                </tr>

		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_donation_rewrite"><?php esc_html_e( '"Donations Page"', 'smarty' ); ?></label>
		                    </th>
		                    <td>
			                    <?php if( !empty( $stm_pages_data ) ) : ?>
		                        <select id="stm_donation_rewrite" name="stm_post_types_options[stm_donation][page_for_donations]">
			                        <?php foreach( $stm_pages_data as $stm_page_id => $stm_page_title ): ?>
			                          <option value="<?php echo esc_attr( $stm_page_id ); ?>" <?php echo (( $options['stm_donation']['page_for_donations'] == $stm_page_id ) ? ' selected="selected"' : '' ); ?>><?php echo esc_html( $stm_page_title ); ?></option>
					                   <?php endforeach; ?>
		                        </select>
								<?php endif; ?>
							</td>
		                </tr>

		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_event_title"><?php esc_html_e( '"Meeting" title (admin panel tab name)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_event_title" name="stm_post_types_options[stm_event][title]" value="<?php echo esc_attr( $options['stm_event']['title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_event_plural_title"><?php esc_html_e( '"Meeting" plural title', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_event_plural_title" name="stm_post_types_options[stm_event][plural_title]" value="<?php echo esc_attr( $options['stm_event']['plural_title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_event_rewrite"><?php esc_html_e( '"Meeting" rewrite (URL text)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_event_rewrite" name="stm_post_types_options[stm_event][rewrite]" value="<?php echo esc_attr( $options['stm_event']['rewrite'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_teacher_title"><?php esc_html_e( '"Teacher" title (admin panel tab name)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_teacher_title" name="stm_post_types_options[stm_teacher][title]" value="<?php echo esc_attr( $options['stm_teacher']['title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_teacher_plural_title"><?php esc_html_e( '"Teacher" plural title', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_teacher_plural_title" name="stm_post_types_options[stm_teacher][plural_title]" value="<?php echo esc_attr( $options['stm_teacher']['plural_title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_teacher_rewrite"><?php esc_html_e( '"Teacher" rewrite (URL text)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_teacher_rewrite" name="stm_post_types_options[stm_teacher][rewrite]" value="<?php echo esc_attr( $options['stm_teacher']['rewrite'] ); ?>"  size="25" />
		                    </td>
		                </tr>
                        <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_administrator_title"><?php esc_html_e( '"Administrator" title (admin panel tab name)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_administrator_title" name="stm_post_types_options[stm_administrator][title]" value="<?php echo esc_attr( $options['stm_administrator']['title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_administrator_plural_title"><?php esc_html_e( '"Administrator" plural title', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_administrator_plural_title" name="stm_post_types_options[stm_administrator][plural_title]" value="<?php echo esc_attr( $options['stm_administrator']['plural_title'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="stm_administrator_rewrite"><?php esc_html_e( '"Administrator" rewrite (URL text)', 'smarty' ); ?></label>
		                    </th>
		                    <td>
		                        <input type="text" id="stm_administrator_rewrite" name="stm_post_types_options[stm_administrator][rewrite]" value="<?php echo esc_attr( $options['stm_administrator']['rewrite'] ); ?>"  size="25" />
		                    </td>
		                </tr>
		            </table>
		            <p>
						<?php printf(
							wp_kses(__( 'NOTE: After you change the rewrite field values, you\'ll need to refresh permalinks under Settings -> <a href="%s">Permalinks</a>', 'smarty' ), array( 'a' => array( 'href' => array() ) ) ),
							esc_url( admin_url( 'options-permalink.php') )
						); ?>
					</p>

		            <br/>
		            <p>
						<input type="submit" value="<?php esc_attr_e( 'Save settings', 'smarty' ); ?>" class="button-primary"/>
					</p>
		        </form>
		    </div>
		<?php
		}
	}

}

add_action( 'admin_menu', 'stm_register_donation_options_menu' );

if( ! function_exists( 'stm_register_donation_options_menu' ) ){
	function stm_register_donation_options_menu(){
		add_theme_page( esc_html__('STM Donation Options', 'smarty'), esc_html__('STM Donation Options', 'smarty'), 'manage_options', 'donation', 'stm_donation_options' );
	}
}

if( ! function_exists( 'donation_options' ) ){
	function stm_donation_options(){

		if ( ! empty( $_POST['donation_options'] ) ) {
			set_theme_mod( 'donation_options', smarty_sanitize_text_field($_POST['donation_options']) );
		}

		$options = get_theme_mod( 'donation_options' );

		$defaultDonationOptions = array(
			'email'               => 'paypalemail@gmail.com',
			'currency'            => 'USD',
			'currency_symbol'     => '$',
			'currency_position'   => 'right',
			'donation_amount_1'   => '10',
			'donation_amount_2'   => '20',
			'donation_amount_3'   => '30',
			'admin_email_subject' => 'Put email subject Here',
			'admin_email_message' => 'Put email content Here',
			'donor_email_subject' => 'Put email subject Here',
			'donor_email_message' => 'Put email content Here',
			'mode'                => 'sandbox'
		);

		$options = wp_parse_args( $options, $defaultDonationOptions );

		echo '
			<div class="wrap">
		        <h2>Donation options</h2>

		        <form method="POST" action="">
		            <table class="form-table">
		            	<tr valign="top">
		                    <th scope="row">
		                        <label for="currencyCode">' . esc_html__( 'Mode:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <select name="donation_options[mode]">
		                            <option value="live" ' . ( ( $options['mode'] == 'live' ) ? 'selected="true"' : '' ) . '>' . esc_html__( 'Live', 'smarty' ) . '</option>
		                            <option value="sandbox" ' . ( ( $options['mode'] == 'sandbox' ) ? 'selected="true"' : '' ) . '>' . esc_html__( 'Sandbox', 'smarty' ) . '</option>
		                        </select>
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="email">' . esc_html__( 'Paypal email:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="email" name="donation_options[email]" value="' . $options['email'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="currency">' . esc_html__( 'Currency code:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="currency" name="donation_options[currency]" value="' . $options['currency'] . '" size="25" /> ex. USD
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="currency_symbol">' . esc_html__( 'Currency symbol:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="currency_symbol" name="donation_options[currency_symbol]" value="' . $options['currency_symbol'] . '" size="25" /> ex. $
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="currency_position">' . esc_html__( 'Currency position:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <select name="donation_options[currency_position]">
		                            <option value="left" ' . ( ( $options['currency_position'] == 'left' ) ? 'selected="true"' : '' ) . '>' . esc_html__( 'Left', 'smarty' ) . '</option>
		                            <option value="right" ' . ( ( $options['currency_position'] == 'right' ) ? 'selected="true"' : '' ) . '>' . esc_html__( 'Right', 'smarty' ) . '</option>
		                        </select>
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="donation_amount_1">' . esc_html__( 'Donation amount 1:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="donation_amount_1" name="donation_options[donation_amount_1]" value="' . $options['donation_amount_1'] . '" size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="donation_amount_2">' . esc_html__( 'Donation amount 2:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="donation_amount_2" name="donation_options[donation_amount_2]" value="' . $options['donation_amount_2'] . '" size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="donation_amount_3">' . esc_html__( 'Donation amount 3:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="donation_amount_3" name="donation_options[donation_amount_3]" value="' . $options['donation_amount_3'] . '" size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="adminEmailSubject">' . esc_html__( 'Admin email subject:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" size="45" id="adminEmailSubject" name="donation_options[admin_email_subject]"  value="' . $options['admin_email_subject'] . '" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="adminEmailBody">' . esc_html__( 'Admin email body:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <textarea  cols="70" rows="10" id="adminEmailBody" name="donation_options[admin_email_message]"  >' . $options['admin_email_message'] . '</textarea>
		                        <p><b>' . esc_html__( 'Shortcodes:', 'smarty' ) . '</b> <br />
		                            [name] -  ' . esc_html__( 'Donor name', 'smarty' ) . ',
		                            [amount] - ' . esc_html__( 'Donate amount', 'smarty' ) . ',
		                            [cause] - ' . esc_html__( 'Cause name', 'smarty' ) . '
		                        </p>
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="donorEmailContent">' . esc_html__( 'Donor email subject:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" size="45" id="donorEmailSubject" name="donation_options[donor_email_subject]"  value="' . $options['donor_email_subject'] . '" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="donorEmailBody">' . esc_html__( 'Donor email body:', 'smarty' ) . '</label>
		                    </th>
		                    <td>
		                        <textarea  cols="70" rows="10" id="donorEmailBody" name="donation_options[donor_email_message]"  >' . $options['donor_email_message'] . '</textarea>
		                        <p><b>' . esc_html__( 'Shortcodes:', 'smarty' ) . '</b> <br />
		                            [name] -  ' . esc_html__( 'Donor name', 'smarty' ) . ',
		                            [amount] - ' . esc_html__( 'Donate amount', 'smarty' ) . ',
		                            [cause] - ' . esc_html__( 'Cause name', 'smarty' ) . '
		                        </p>
		                    </td>
		                </tr>
		            </table>
		            <p>
						<input type="submit" value="' . esc_html__( 'Save settings', 'smarty' ) . '" class="button-primary"/>
					</p>
		        </form>
		    </div>
		';
	}
}
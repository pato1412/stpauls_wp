<?php

function stm_theme_import_sliders( $layout )
{

    $school_sliders = array(
        'home',
        'home-2',
        'home-3',
        'home-4',
    );

    $slider_names = array(
        'kindergarten' => 'home_slider_kindergarten',
        'kindergarten-two' => 'home_slider_kindergarten-two',
        'university' => 'home_slider_university',
        'university-two' => 'home_slider_university-two'
    );

    if( class_exists( 'RevSlider' ) ) {
        if( !empty( $slider_names[ $layout ] ) ) {
            $path = STM_DEMO_PATH . '/demo/' . $layout . '/sliders/';
            $slider_path = $path . $slider_names[ $layout ] . '.zip';

            if( file_exists( $slider_path ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $slider_path );
            }
        }

        if( $layout == 'school' ) {
            $default_path = STM_DEMO_PATH . '/demo/school/sliders/';
            foreach ( $school_sliders as $slider_name ) {
                $slider_path = $default_path . $slider_name . '.zip';
                if( file_exists( $slider_path ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $slider_path );
                }
            }
        }
    }

}
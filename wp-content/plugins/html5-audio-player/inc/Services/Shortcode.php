<?php
namespace H5APPlayer\Services;
use H5APPlayer\Model\AnalogSystem;
use H5APPlayer\Model\AdvanceSystem;
class Shortcode {

    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        add_shortcode('player',[$this, 'player']);
    }

    /**
     * Create instance function
     */
    public static function instance(){
        if(self::$_instance === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function player($atts){
        $post_type = get_post_type($atts['id']);

        $isGutenberg = (boolean) get_post_meta($atts['id'], 'h5ap_gutenberg_enable', true);

        if($post_type !== 'audioplayer'){
            return false;
        }

        ob_start(); 
        
        if($isGutenberg){
            echo( AdvanceSystem::html($atts['id']));
        }else {
            echo AnalogSystem::html($atts['id']);
        }
        return ob_get_clean(); 
    }
}

Shortcode::instance();
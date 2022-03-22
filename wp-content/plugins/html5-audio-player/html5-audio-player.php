<?php 
/*
 * Plugin Name: Html5 Audio Player
 * Plugin URI:  http://audioplayerwp.com/
 * Description: You can easily integrate html5 audio player in your wordress website using this plugin.
 * Version: 2.1.6
 * Author: bPlugins LLC
 * Author URI: http://bplugins.com
 * License: GPLv3
 * Text Domain:  html5-audio-player
 * Domain Path:  /languages
 */

use H5APPlayer\Model\Import;
// load text domain
function h5ap_load_textdomain() {
    load_plugin_textdomain( 'h5ap', false, dirname( __FILE__ ) . "/languages" );
}

add_action( "plugins_loaded", 'h5ap_load_textdomain' );

/*Some Set-up*/
define('H5AP_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('H5AP_PLUGIN_VERSION','2.1.6' );
define('H5AP_VER','2.1.6' );

function get_h5ap_setting($id, $key, $default = null, $true = false){
	$meta = metadata_exists( 'post', $id, '_h5ap_plyr' ) ? get_post_meta($id, '_h5ap_plyr', true) : '';
    if(isset($meta[$key]) && $meta != ''){
        if($true == true){
            if($meta[$key] == '1'){
                return true;
            }else if($meta[$key] == '0'){
                return false;
            }
        }else {
            return $meta[$key];
        }
        
    }else {
        return $default;
    }
}

// Register Activation Hook
register_activation_hook(__FILE__, 'h5ap_plugin_activate');
add_action('admin_init', 'h5ap_plugin_redirect');

function h5ap_plugin_activate() {
	Import::meta();
    add_option('h5ap_plugin_do_activation_redirect', true);
}

function h5ap_plugin_redirect() {
    if (get_option('h5ap_plugin_do_activation_redirect', false)) {
        delete_option('h5ap_plugin_do_activation_redirect');
        wp_redirect('edit.php?post_type=audioplayer&page=how-to');
    }

	if(get_option('h5ap_import', '1.4.1') != '2.1.3'){
        Import::meta();
        update_option('h5ap_import', '2.1.3');
    }
}

if(!class_exists('H5AP')){
class H5AP{
	private $plugin ;
	function __construct(){
		$this->plugin = plugin_basename(__FILE__);
		add_action('plugins_loaded', [$this, 'plugins_loaded']);
		add_filter("plugin_action_links_$this->plugin", [$this, 'your_plugin_settings_link'] );
	}

	function plugins_loaded(){
		require_once(__DIR__.'/admin/framework/codestar-framework.php');
		require_once(__DIR__.'/admin/inc/metabox-free.php');
	}

	// Add settings link on plugin page
	function your_plugin_settings_link($links) {
		$settings_link = '<a href="#" class="h5ap_import_data">Import Data</a>';
		array_unshift($links, $settings_link); 
		return $links; 
	}

}

new H5AP();
}

require_once(__DIR__.'/upgrade.php');
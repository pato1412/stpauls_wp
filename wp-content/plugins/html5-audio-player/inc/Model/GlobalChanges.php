<?php
namespace H5APPlayer\Model;

class GlobalChanges{
    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        // add_action('wp_footer',[$this, 'initializePlayer'], 1000);
        add_action( 'admin_menu', [$this, 'h5ap_addon_page'] );
        add_filter( 'admin_footer_text', [$this, 'h5ap_admin_footer']);	
        add_action( 'wp_dashboard_setup', [$this, 'h5ap_add_dashboard_widgets'] );
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

    // Addons Page 
    function h5ap_addon_page() {
        //Addons page
        // $h5ap_addon_page = add_submenu_page('edit.php?post_type=audioplayer', 'Addons', __('Addons', 'h5ap'), 'edit_posts', 'h5ap_featured_plugins', [$this, 'h5ap_addon_page_cb']);
        
        //How to use page
        // add_submenu_page( 'edit.php?post_type=audioplayer', 'How To Use', 'How To Use', 'manage_options', 'how-to', [$this, 'h5ap_howto_page_callback'] );

        // Developer Page
        // add_submenu_page( 'edit.php?post_type=audioplayer', 'Developer', 'Developer', 'manage_options', 'h5ap-developer', [$this, 'h5ap_submenu_page_callback'] );

        // add_submenu_page('edit.php?post_type=audioplayer', 'My Free Plugins', __('My Free Plugins', 'html5audio'), 'edit_posts', 'plugin-install.php?s=abuhayat&tab=search&type=author');
    }

    /**
     * addons page callback
     */
    function h5ap_addon_page_cb() {
        ob_start(); ?>
        <div class="wrap" id="ghozy-featured">
            <h2>
                <?php _e( 'Addons', 'h5ap' ); ?>
            </h2>
            <p><?php _e( 'Add-on sum up additional features and abilities.', 'h5ap' ); ?></p>
            <div id="the-list">
                <div class="plugin-card">
                    <div class="gumroad-product-embed" data-gumroad-product-id="euOlG" data-outbound-embed="true"><a href="https://gumroad.com/l/euOlG">Loading...</a></div>
                </div>
            </div>	
            <?php // echo h5ap_get_feed(); ?>
        </div>
        <?php
        echo ob_get_clean();
    }

    /**
     * How to page callback
     */
    function h5ap_howto_page_callback() {
	
        echo "<div class='wrap'><div id='icon-tools' class='icon32'></div>";
            echo "<h2>How to use ? </h2>
                <h2>We made a movie for you ! Watch it and learn. </h2>
                <br/>
                <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 85%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/MbY9oyERJck' frameborder='0' allowfullscreen></iframe></div>
                <br />
            ";
        echo '</div>';
    }

    /**
     * Footer Text Change
     */
    function h5ap_admin_footer( $text ) {
		if ( 'audioplayer' == get_post_type() ) {
			$url = 'https://wordpress.org/support/plugin/html5-audio-player/reviews/?filter=5#new-post';
			$text = sprintf( __( 'If you like <strong>Html5 Audio Player</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'h5ap-domain' ), $url );
		}

		return $text;
	}

    /**
     * Developer page callback
     */
    function h5ap_submenu_page_callback() {
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
            echo '<h2>Developer</h2>
            <h2>Md Abu hayat polash</h2>
            <h3>Professional Web Developer</h3>
            <p>Hire Me : <a target="_blank" href="https://www.upwork.com/freelancers/~01c73e1e24504a195e">On Upwork.com</a>
            Email: <a href="mailto:abuhayat.du@gmail.com">abuhayat.du@gmail.com </a>
            <h5>Skype: ah_polash</h5>
            <h5>Web : <a target="_blank" href="http://abuhayatpolash.com">www.abuhayatpolash.com</a></h5>
            <br />
            
            ';
        echo '</div>';
    
    }

    function h5ap_add_dashboard_widgets() {
        wp_add_dashboard_widget( 'example_dashboard_widget', 'Support html5 Audio Player', [$this, 'h5ap_dashboard_widget_function'] );
    
        global $wp_meta_boxes;
        $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
        $example_widget_backup = array( 'example_dashboard_widget' => $normal_dashboard['example_dashboard_widget'] );
        unset( $normal_dashboard['example_dashboard_widget'] );
       $sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
   } 
   
   function h5ap_dashboard_widget_function() {
   
       // Display whatever it is you want to show.
        echo '<div class="uds-box" data-id="1"></div>';
        echo '<p>It is hard to continue development and support for this plugin without contributions from users like you. If you enjoy using the plugin and find it useful, please consider support by <b>DONATION</b> Or <b>BUY THE PRO VERSION (NO ADS)</b> of the Plugin. Your support will help encourage and support the plugin’s continued development and better user support.</p>
       
        <center>
        <a target="_blank" href="https://gum.co/wpdonate"><div><img width="200" src="'.H5AP_PLUGIN_DIR.'img/donation.png'.'" alt="Donate Now" /></div></a>
        </center>	
            
        <br />
        <div class="gumroad-product-embed" data-gumroad-product-id="dkbMR" data-outbound-embed="true"><a target="_blank" href="https://gumroad.com/l/dkbMR">Loading...</a></div>';
    }
}

GlobalChanges::instance();
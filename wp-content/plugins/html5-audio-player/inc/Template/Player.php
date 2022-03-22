<?php
namespace H5APPlayer\Template;

class Player{
    private static $uniqID = null;
    
    public static function html($data){
        self::createId();
        $t = $data['template'];
        $type = 'audio/mp3';
        $ext = pathinfo($t['source'], PATHINFO_EXTENSION);

        if($ext == 'm4a'){
            $type = 'audio/mp4';
        }
        
        wp_enqueue_script('h5ap-public');
        wp_enqueue_style('bplugins-plyrio');
        ob_start();
        // echo $t['attr']
        ?>
        
    <div>
        <div id="<?php echo esc_attr(self::$uniqID); ?>" class="h5ap_standard_player" style='width:<?php echo esc_attr($t['width']); ?>;margin:0 auto;max-width: 100%;'>
            <audio class="player" playsinline controls <?php echo esc_attr($t['attr']); ?> >
                <source src="<?php echo esc_attr($t['source']);?>"  type="<?php echo esc_attr($type) ?>" />
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>

    <?php
        $output = ob_get_contents();
        ob_get_clean();
        return $output;
    }

    public static function createId(){
        self::$uniqID = "h5ap".uniqid();
    }
}
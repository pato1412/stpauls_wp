<?php
namespace H5APPlayer\Model;
use H5APPlayer\Helper\DefaultArgs;
use H5APPlayer\Template\Player;

class AnalogSystem{

    public static function html($id){
        $data = DefaultArgs::parsePlayerArgs(self::getData($id));
        return Player::html($data);
    }

    public static function getData($id){
        $width = get_h5ap_setting($id, 'width', ['width' => '100', 'unit' => '%']);
        $autoplay = get_h5ap_setting($id, 'autoplay', '0') === '1' ? true: false;
        $repeat = get_h5ap_setting($id, 'repeat', '0') === '1' ? true : false;
        $muted = get_h5ap_setting($id, 'muted', '0') === '1' ? true : false;

        $attr = $autoplay ? ' autoplay' : '';
        $attr .= $repeat ? ' loop' : '';
        $attr .= $muted ? ' muted' : '';

        $options = [
            
        ];

        $infos = [
            'autoplay' => $autoplay,
            'repeat' => $repeat,
            'muted' => $muted,
        ];

        $template = [
            'width' => $width['width'].$width['unit'],
            'autoplay' => get_h5ap_setting($id, 'autoplay', '0') === '1' ? ' autoplay ': '',
            'repeat' => get_h5ap_setting($id, 'repeat', '0') === '1' ? ' loop ': '',
            'muted' => get_h5ap_setting($id, 'muted', '0') === '1' ? ' muted ': '',
            'attr' => $attr,
            'source' => get_h5ap_setting($id, 'h5vp_default_audio')
        ];

        return [
            'options' => $options,
            'infos' => $infos,
            'template' => $template,
        ];
    }
}
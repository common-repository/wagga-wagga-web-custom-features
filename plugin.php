<?php

    /*
    Plugin Name: Wagga Wagga Web Custom Features
    Plugin URI: http://www.waggawaggaweb.com.au/
    Description: Adds features to your Wordpress site designed by Wagga Wagga Web for ease of use including shortcodes and other fixes.
    Author URI: http://www.waggawaggaweb.com.au/
    Version: 0.1
    Put this in /wp-content/plugins/ of your Wordpress installation.
    */

function www_box($atts, $content = null)
{
    $a = shortcode_atts(array('id' => '', 'class' => ''), $atts);
    return '<div class="www-box ' . $a['class'] . '" id="' . $a['id'] . '">' . do_shortcode($content) . '</div>';
} add_shortcode('www-box', 'www_box');

function www_clear($atts)
{
    return '<div class="www-clear"></div>';
} add_shortcode('www-clear', 'www_clear');

function www_map($atts)
{
    $a = shortcode_atts(array('api_key' => '', 'map_lat' => '', 'map_long' => '', 'pin_lat' => '', 'pin_long' => '', 'map_address' => '', 'map_title' => '', 'zoom' => '15', 'class' => ''), $atts);
    if (!$a['pin_lat']) {
        $a['pin_lat'] = $a['map_lat'];
    }
    if (!$a['pin_long']) {
        $a['pin_long'] = $a['map_long'];
    }
    return '<div id="www-map-canvas" class="' . $a['class'] . '"></div><script src="https://maps.googleapis.com/maps/api/js?key=' . $a['api_key'] . '&sensor=false"></script><script>function initialize(){var mapOptions={center:new google.maps.LatLng(' . $a['map_lat'] . ',' . $a['map_long'] . '),zoom:' . $a['zoom'] . ',zoomControl:true,scrollwheel:false,};var map=new google.maps.Map(document.getElementById("www-map-canvas"),mapOptions);var marker=new google.maps.Marker({position:new google.maps.LatLng(' . $a['pin_lat'] . ',' . $a['pin_long'] . '),map:map,title:"' . $a['map_title'] . '",icon:"' . $a['pin_img'] . '"});var contentString="' . $a['map_title'] . '<br>' . $a['map_address'] . '";var infowindow=new google.maps.InfoWindow({content:contentString});google.maps.event.addListener(marker,"click",function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window,"load",initialize);</script>';
} add_shortcode('www-map', 'www_map');

function www_social_list($atts, $content = null)
{
    $a = shortcode_atts(array('id' => '', 'class' => ''), $atts);
    return '<ul class="www-social-list '. $a['class'] .'" id="' . $a['id'] . '">' . do_shortcode($content) . '</ul>';
} add_shortcode('www-social-list', 'www_social_list');

function www_social_item($atts)
{
    $a = shortcode_atts(array('network' => '', 'link' => '', 'icon' => '', 'id' => '', 'class' => ''), $atts);
    return '<li class="' . $a['network'] . ' '. $a['class'] .'" id="'. $a['id'] .'"><a href="' . $a['link'] . '" title="' . $a['network'] . '"><i class="fa ' . $a['icon'] . '"></i></a></li>';
} add_shortcode('www-social-item', 'www_social_item');

function www_fa($atts)
{
    $a = shortcode_atts(array('icon' => '', 'id' => '', 'class' => ''), $atts);
    return '<i class="fa ' . $a['icon'] . ' ' . $a['class'] . '" id="' . $a['id'] . '"></i>';
} add_shortcode('www-fa', 'www_fa');

function www_div($atts, $content = null) 
{
    $a = shortcode_atts(array('id' => '', 'class' => ''), $atts);
    return '<div class="' . $a['class'] . '" id="' . $a['id'] . '">' . do_shortcode($content) . '</div>';
} add_shortcode('www-div', 'www_div');

function www_span($atts, $content = null) 
{
    $a = shortcode_atts(array('id' => '', 'class' => ''), $atts);
    return '<span class="' . $a['class'] . '" id="' . $a['id'] . '">' . do_shortcode($content) . '</span>';
} add_shortcode('www-span', 'www_span');

function www_gap($atts) 
{
    $a = shortcode_atts(array('unit' => 'px', 'height' => '','id' => '', 'class' => ''), $atts);
    return '<div style="height:' . $a['height'] . $a['unit'] .  '" class="' . $a['class'] . '" id="' . $a['id'] . '"></div>';
} add_shortcode('www-gap', 'www_gap');

function register_style() {
    wp_enqueue_style('www-style', plugins_url('style.css', __FILE__));
} add_action('wp_enqueue_scripts', 'register_style');

function www_empty_p_tag_fix($content) {
    $array = array('<p>[' => '[', ']</p>' => ']', ']<br />' => ']');
    $content = strtr($content, $array);
    return $content;
} add_filter('the_content', 'www_empty_p_tag_fix');
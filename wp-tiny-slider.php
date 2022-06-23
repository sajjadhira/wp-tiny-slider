<?php
/*
Plugin Name: WP Tiny Slider
Plugin URI: http://pluginoo.com/wp-tiny-slider
Author: Pluginoo
Author URI: http://pluginoo.com
Description: This  is a simple slider for WordPress.
Text Domain: wp-tiny-slider
Version: 1.0.0
*/

defined('ABSPATH') or die();
define('wpts_plugin_url', plugin_dir_path(__FILE__));
define('wpts_version', '1.0.0');

function wpts_load_textdomain()
{
    load_plugin_textdomain('wp-tiny-slider', false, plugin_dir_path(__FILE__) . '/languages');
}
add_action('plugins_loaded', 'wpts_load_textdomain');

function wpts_init()
{
    add_image_size('wpts-slider', 800, 800, true);
}
add_action('init', 'wpts_init');

function wpts_assets()
{
    wp_enqueue_style('wpts-css', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.8.4/tiny-slider.css', null, '1.0');
    wp_enqueue_script('wpts-script', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.8.4/min/tiny-slider.js', null, '1.0', true);
    wp_enqueue_script('wpts-main', plugin_dir_url(__FILE__) . '/assets/js/main.js', ['jquery'], '1.0', true);
}

add_action('wp_enqueue_scripts', 'wpts_assets');

function wpts_slider($atts, $content = '')
{
    $defaults = [
        'width' => 800,
        'height' => 800,
        'id' => ''
    ];

    $attributes = shortcode_atts($defaults, $atts);
    $content = do_shortcode($content);

    $shortcode_output = <<<EOD
    <div style="height:{$attributes['height']};width:{$attributes['width']}" id="wpts">
        <div class="wpts-slider">
        {$content}
        </div>
    </div>
    EOD;
    return $shortcode_output;
}

function wpts_slide($atts)
{
    $defaults = [
        'id' => '',
        'caption' => '',
        'size' => 'wpts-slider',
    ];
    $attributes = shortcode_atts($defaults, $atts);

    $image_src = wp_get_attachment_image_src($attributes['id'], $attributes['size']);

    $shortcode_output = <<<EOD
    <div class="slide">
    <p><img src="{$image_src[0]}" alt="{$attributes['caption']}"></p>
    <p>{$attributes['caption']}</p>
    </div>
    EOD;

    return $shortcode_output;
}

add_shortcode('wpts', 'wpts_slider');
add_shortcode('wptslide', 'wpts_slide');

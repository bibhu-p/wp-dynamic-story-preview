<?php
/*
Plugin Name: Dynamic Story Preview
Plugin URI: https://github.com/bibhu-p
Description: A plugin to create expandable previews for stories.
Version: 1.0
Author: Bibhu Prasad
Author URI: https://bibhu-prasad.netlify.app/
License: GPL2
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register shortcode
function dsp_preview_shortcode($atts, $content = null) {
    global $post;
    $full_content = do_shortcode($content);
    $word_limit = get_option('dsp_word_limit', 50);
    $preview = wp_trim_words($full_content, $word_limit, '...');
    $read_more_text = get_option('dsp_read_more_text', 'Read More');
    $read_more_url = get_permalink($post->ID);

    return '<div class="dsp-preview" data-full-content="' . esc_attr($full_content) . '">' 
    . $preview 
    . ' <a href="' . esc_url($read_more_url) . '" class="dsp-read-more">' . esc_html($read_more_text) . '</a></div>';

}
add_shortcode('dsp_preview', 'dsp_preview_shortcode');

function dsp_enqueue_scripts() {
    wp_enqueue_script('dsp-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'dsp_enqueue_scripts');

// Include the settings page
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
}

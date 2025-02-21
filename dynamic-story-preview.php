<?php
/*
Plugin Name: Dynamic Story Preview
Plugin URI: https://github.com/bibhu-p/wp-dynamic-story-preview
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

// Include settings page
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';

function dsp_add_custom_preview_meta_box() {
    add_meta_box(
        'dsp_custom_preview_meta_box',
        'Story Preview',
        'dsp_custom_preview_meta_box_callback',
        'post',
        'advanced',
        'default'
    );
}
add_action('add_meta_boxes', 'dsp_add_custom_preview_meta_box');

function dsp_custom_preview_meta_box_callback($post) {
    $custom_preview = get_post_meta($post->ID, '_dsp_custom_preview', true);
    wp_nonce_field('dsp_custom_preview_nonce', 'dsp_custom_preview_nonce_field');

    ?>
    <p>Enter a custom preview for this post:</p>
    <textarea name="dsp_custom_preview" style="width:100%; height:100px;"><?php echo esc_textarea($custom_preview); ?></textarea>
    <?php
}

function dsp_save_custom_preview($post_id) {
    if (!isset($_POST['dsp_custom_preview_nonce_field']) || !wp_verify_nonce($_POST['dsp_custom_preview_nonce_field'], 'dsp_custom_preview_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['dsp_custom_preview'])) {
        update_post_meta($post_id, '_dsp_custom_preview', sanitize_textarea_field($_POST['dsp_custom_preview']));
    } else {
        delete_post_meta($post_id, '_dsp_custom_preview');
    }
}
add_action('save_post', 'dsp_save_custom_preview');

// ============================
// 3️⃣ MODIFY EXCERPT TO SHOW CUSTOM PREVIEW
// ============================
function dsp_modify_excerpt($excerpt) {
    global $post;

    // Get the custom preview from meta
    $custom_preview = get_post_meta($post->ID, '_dsp_custom_preview', true);
    $read_more_text = get_option('dsp_read_more_text', 'Read More');
    $read_more_url = get_permalink($post->ID); // Ensure correct post URL

    if (!empty($custom_preview)) {
        return '<div class="dsp-preview">' 
            . esc_html($custom_preview) 
            . ' <a href="' . esc_url($read_more_url) . '" class="dsp-read-more">'
            . esc_html($read_more_text) . 
            '</a></div>';
    }

    return $excerpt;
}
add_filter('the_excerpt', 'dsp_modify_excerpt');
// ============================
// 4️⃣ ENQUEUE STYLES & JAVASCRIPT
// ============================
function dsp_enqueue_scripts() {
    wp_enqueue_style('dsp-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('dsp-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'dsp_enqueue_scripts');

// ============================
// 5️⃣ ADD SHORTCODE SUPPORT
// ============================
function dsp_preview_shortcode($atts, $content = null) {
    global $post;
    $custom_preview = get_post_meta($post->ID, '_dsp_custom_preview', true);
    $read_more_text = get_option('dsp_read_more_text', 'Read More');
    $read_more_url = get_permalink($post->ID);

    if (!empty($custom_preview)) {
        return '<div class="dsp-preview">' 
            . esc_html($custom_preview) 
            . ' <a href="' . esc_url($read_more_url) . '" class="dsp-read-more">' 
            . esc_html($read_more_text) . 
            '</a></div>';
    }

    return do_shortcode($content);
}
add_shortcode('dsp_preview', 'dsp_preview_shortcode');
?>
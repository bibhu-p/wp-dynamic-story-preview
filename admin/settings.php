<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register the admin menu page
function dsp_add_admin_menu() {
    add_options_page(
        'Story Preview Settings',    // Page Title
        'Story Preview',             // Menu Title
        'manage_options',            // Capability
        'dsp_settings',              // Menu Slug
        'dsp_settings_page'          // Callback Function
    );
}
add_action('admin_menu', 'dsp_add_admin_menu');

// Register and initialize settings
function dsp_register_settings() {
    register_setting('dsp_options_group', 'dsp_word_limit');
    register_setting('dsp_options_group', 'dsp_read_more_text');
    register_setting('dsp_options_group', 'dsp_effect');

    add_settings_section(
        'dsp_settings_section',
        'Customize Story Preview',
        null,
        'dsp_settings'
    );

    add_settings_field(
        'dsp_word_limit',
        'Word Limit for Preview:',
        'dsp_word_limit_callback',
        'dsp_settings',
        'dsp_settings_section'
    );

    add_settings_field(
        'dsp_read_more_text',
        'Read More Button Text:',
        'dsp_read_more_text_callback',
        'dsp_settings',
        'dsp_settings_section'
    );

    add_settings_field(
        'dsp_effect',
        'Reveal Effect:',
        'dsp_effect_callback',
        'dsp_settings',
        'dsp_settings_section'
    );
}
add_action('admin_init', 'dsp_register_settings');

// Callback for word limit setting
function dsp_word_limit_callback() {
    $word_limit = get_option('dsp_word_limit', 50);
    echo '<input type="number" name="dsp_word_limit" value="' . esc_attr($word_limit) . '" min="10">';
}

// Callback for read more text setting
function dsp_read_more_text_callback() {
    $read_more_text = get_option('dsp_read_more_text', 'Read More');
    echo '<input type="text" name="dsp_read_more_text" value="' . esc_attr($read_more_text) . '">';
}

// Callback for reveal effect setting
function dsp_effect_callback() {
    $effect = get_option('dsp_effect', 'fade');
    ?>
    <select name="dsp_effect">
        <option value="fade" <?php selected($effect, 'fade'); ?>>Fade</option>
        <option value="slide" <?php selected($effect, 'slide'); ?>>Slide</option>
        <option value="none" <?php selected($effect, 'none'); ?>>None</option>
    </select>
    <?php
}

// Render the settings page
function dsp_settings_page() {
    ?>
    <div class="wrap">
        <h1>Story Preview Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('dsp_options_group');
            do_settings_sections('dsp_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

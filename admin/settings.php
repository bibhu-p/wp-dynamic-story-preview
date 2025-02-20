<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add settings menu
function dsp_add_admin_menu() {
    add_options_page('Story Preview Settings', 'Story Preview', 'manage_options', 'dsp_settings', 'dsp_settings_page');
}
add_action('admin_menu', 'dsp_add_admin_menu');

// Register settings
function dsp_register_settings() {
    register_setting('dsp_options_group', 'dsp_word_limit');
    register_setting('dsp_options_group', 'dsp_read_more_text');
    register_setting('dsp_options_group', 'dsp_reveal_effect');
}
add_action('admin_init', 'dsp_register_settings');

// Settings Page HTML
function dsp_settings_page() { ?>
    <div class="wrap">
        <h1>Dynamic Story Preview Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('dsp_options_group'); ?>
            <?php do_settings_sections('dsp_options_group'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">Word Limit</th>
                    <td>
                        <input type="number" name="dsp_word_limit" value="<?php echo esc_attr(get_option('dsp_word_limit', 50)); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Read More Button Text</th>
                    <td>
                        <input type="text" name="dsp_read_more_text" value="<?php echo esc_attr(get_option('dsp_read_more_text', 'Read More')); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Reveal Effect</th>
                    <td>
                        <select name="dsp_reveal_effect">
                            <option value="instant" <?php selected(get_option('dsp_reveal_effect'), 'instant'); ?>>Instant</option>
                            <option value="fade" <?php selected(get_option('dsp_reveal_effect'), 'fade'); ?>>Fade</option>
                            <option value="slide" <?php selected(get_option('dsp_reveal_effect'), 'slide'); ?>>Slide</option>
                        </select>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
<?php } ?>

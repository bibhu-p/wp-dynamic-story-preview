=== Dynamic Story Preview ===
Contributors: Bibhu Prasad
Tags: excerpt, preview, read more, content teaser, expand, WordPress plugin
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.2
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Dynamic Story Preview is a WordPress plugin that allows users to customize post excerpts and add a "Read More" button. Users can replace the default excerpt with their own custom preview text, enhancing engagement on listing pages.

**Features:**
- Set a custom preview instead of the default excerpt.
- Automatically appends a "Read More" button linking to the full post.
- Works with any WordPress theme.
- SEO-friendly implementation.
- Supports AJAX-based expansion (future enhancement).

== Installation ==
1. Download the plugin and extract the `dynamic-story-preview` folder.
2. Upload the `dynamic-story-preview` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to **Settings > Dynamic Story Preview** to configure the plugin settings.

== Usage ==
### Using Custom Preview for Posts
- In the post editor, you will find a **"Custom Preview"** field in the sidebar.
- Enter the text you want to display instead of the default excerpt.
- Save or update the post.

### Adding the Plugin to Templates
If your theme does not display excerpts automatically, use this function inside your theme's loop:
```php
if (function_exists('dsp_modify_excerpt')) {
    echo dsp_modify_excerpt(get_the_excerpt());
}
```

== Frequently Asked Questions ==
**Q: Does this plugin work with custom post types?**
A: Yes, it supports custom post types that use excerpts.

**Q: Can I change the "Read More" text?**
A: Yes, you can modify it from the plugin settings page.

**Q: Will this work with page builders like Elementor or Gutenberg?**
A: Yes, the plugin is compatible with most themes and page builders.

== Screenshots ==
1. Custom preview field in the post editor sidebar.
2. Example of the customized excerpt with a "Read More" button.

== Changelog ==
= 1.0 =
- Initial release.
- Custom excerpt functionality added.
- Read More button dynamically links to full post.

== Upgrade Notice ==
= 1.0 =
Initial release with basic custom excerpt features.


# Dynamic Story Preview

**A WordPress plugin that lets users set custom previews instead of default excerpts, enhancing engagement with a dynamic "Read More" button.**

## 🚀 Features
- **Custom Previews:** Replace default excerpts with personalized content.
- **Dynamic Read More Button:** Automatically links to the full post.
- **Theme Compatibility:** Works seamlessly with any WordPress theme.
- **SEO-Friendly:** Ensures proper metadata handling.
- **Expandable Content (Future Feature):** AJAX-based reveal for a smoother experience.

## 📥 Installation
1. Download the repository or clone it.
2. Upload the `dynamic-story-preview` folder to `/wp-content/plugins/`.
3. Activate the plugin via **WordPress Admin > Plugins**.
4. Configure settings under **Settings > Dynamic Story Preview**.

## 📌 Usage
### Adding Custom Preview
- Navigate to the WordPress **Post Editor**.
- Locate the **Custom Preview** field in the sidebar.
- Enter your custom excerpt and save the post.

### Manually Adding in Theme
If your theme does not display excerpts automatically, add this inside the loop:
```php
if (function_exists('dsp_modify_excerpt')) {
    echo dsp_modify_excerpt(get_the_excerpt());
}
```

## 📖 Changelog
### v1.0
- Initial release with custom preview functionality.
- Dynamic "Read More" button linking to full post.

## 🎯 Future Enhancements
- **AJAX-based content expansion.**
- **Gutenberg block for easier integration.**
- **More customization options for button styling.**

## 🤝 Contributing
Feel free to submit **issues, feature requests, or pull requests** to improve the plugin.

## 💖 Support
If you find this plugin helpful, consider **starring the repo**.

## 📜 License
Licensed under **GPL v2 or later**. See [LICENSE](LICENSE) for details.

---
⭐ **Like this plugin? Give it a star on GitHub!** ⭐


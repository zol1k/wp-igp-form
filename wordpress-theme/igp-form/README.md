IGP Multi-step Form (child theme)

1) Include loader from your child theme's `functions.php`:

```php
require_once get_stylesheet_directory() . '/igp-form/php/loader.php';
```

2) Place the shortcode on a page where you want the form to appear:

```
[igp_form]
```

3) Files created:
- `igp-form/php/loader.php` - enqueues assets and registers shortcode
- `igp-form/js/form.js` - basic multi-step client logic
- `igp-form/css/form.css` - basic styles
- `igp-form/templates/form-template.php` - example form markup

4) Next steps (suggested):
- Add server-side validation + AJAX save
- Implement calculations for výkon (power) based on inputs
- Improve accessibility and responsive styles
- Replace placeholder styles/icons with project assets

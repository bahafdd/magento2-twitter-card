# magento2-twitter-card
Here’s a clean and simple `README.md` (you can rename to `README.txt` if needed, but GitHub prefers `README.md`):

---

```markdown
# Magento 2 Twitter Card Module – Themestar_Xcard

This module adds Twitter Card meta tags (Summary, Summary Large Image, App, Player) to your Magento 2 store's frontend pages for better social sharing previews.

## Features

- Enable/Disable Twitter Card globally
- Set Twitter username and author
- Set card type per page type (CMS, Category, Product)
- Optionally use product thumbnail or fallback images
- Supports multiple fallback images
- Auto-detects dynamic titles and descriptions
- Meta tag rendering via block/template
- Safe for SEO (does not conflict with robots.txt)

---

## Installation

### Method 1: Upload to `app/code`

1. Copy the folder `Themestar/Xcard` into `app/code/Themestar/Xcard`
2. Run:

```bash
php bin/magento module:enable Themestar_Xcard
php bin/magento setup:upgrade
php bin/magento cache:flush
```

### Method 2: Composer (coming soon)

---

## Configuration

Go to:

**Stores > Configuration > Twitter Card**

There you can:

- Enable or disable the module
- Enter your Twitter `@username` and optional `author`
- Select card type per page type
- Choose to use product thumbnail
- Upload fallback image(s)

---

## Twitter Card Types Supported

- `summary`
- `summary_large_image`
- `app` *(for mobile apps - not yet used)*
- `player` *(for videos - not yet used)*

---

## Customization

**Template File:**
`view/frontend/templates/meta/twitter.phtml`

To override it, copy it to your theme and adjust as needed.

---

## Notes

- Make sure your fallback image is publicly accessible and **not blocked by robots.txt**
- Validate your pages using [Twitter Card Validator](https://cards-dev.twitter.com/validator)

---

## Credits

Built by [Themestar](https://magentoarabic.com)

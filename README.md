# 🧭 Piedmont Global WordPress Theme

> A modern WordPress starter theme powered by **TailwindCSS**, **Alpine.js**, and **self-hosted fonts**. Built for performance, flexibility, and clean developer workflows.

---

## 🚀 Features

- ⚡ **TailwindCSS v3** – JIT compiler with purge included
- 🎯 **Alpine.js v3** – Lightweight, reactive components
- 🖋 **Self-hosted fonts** – Fast, private, and CLS-friendly
- 💨 Zero jQuery, zero Sass, zero Composer
- 🧼 Minimal boilerplate from Underscores (_s)

---

## 📦 Requirements

- [Node.js](https://nodejs.org/)
- [npm](https://www.npmjs.com/)

---

## ⚙️ Quick Start

### 1. Clone the Theme

```bash
git clone https://github.com/your-org/piedmont-global-theme.git your-theme
cd your-theme
```

### 2. Install Dependencies

```bash
npm install
```

### 3. Start the Dev Server (Tailwind Watch Mode)

```bash
npm run dev
```

### 4. Build for Production

```bash
npm run build
```

> This compiles and minifies Tailwind to `assets/css/output.css` with all unused styles removed.

---

## 🧬 Folder Structure

```
your-theme/
├── assets/
│   ├── css/
│   │   ├── input.css        # Tailwind entry point
│   │   ├── output.css       # Compiled + purged
│   │   └── fonts.css        # @font-face declarations
│   ├── fonts/
│   │   └── inter/           # Self-hosted font files
│   └── js/
│       └── alpine-init.js   # Optional Alpine logic
├── functions.php            # Asset enqueue + WP functions
├── tailwind.config.js       # Tailwind config
├── postcss.config.js        # PostCSS setup
├── package.json             # Build scripts
└── README.md
```

---

## ✍️ Self-Hosting Fonts (Inter Example)

1. Download font via [Google Webfonts Helper](https://google-webfonts-helper.herokuapp.com/fonts/inter).
2. Add `.woff2` files to `/assets/fonts/inter/`.
3. Create `/assets/css/fonts.css`:

```css
@font-face {
    font-family: 'Inter';
    src: url('../fonts/inter/inter-regular.woff2') format('woff2');
    font-weight: 400;
    font-display: swap;
}
```

4. Enqueue it in `functions.php` (see below).

---

## 📜 Enqueue Assets in `functions.php`

```php
function pg_enqueue_assets() {
        // Tailwind CSS
        $css_path = get_template_directory() . '/assets/css/output.css';
        wp_enqueue_style('pg-style', get_template_directory_uri() . '/assets/css/output.css', [], filemtime($css_path));

        // Self-hosted fonts
        wp_enqueue_style('pg-fonts', get_template_directory_uri() . '/assets/css/fonts.css', [], null);

        // Alpine.js
        wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'pg_enqueue_assets');
```

---

## 🧠 Tailwind Config (`tailwind.config.js`)

```js
module.exports = {
    content: [
        './*.php',
        './**/*.php',
        './assets/js/**/*.js'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif']
            }
        }
    },
    plugins: []
}
```

---

## 🔧 Scripts in `package.json`

```json
"scripts": {
    "dev": "tailwindcss -i ./assets/css/input.css -o ./assets/css/output.css --watch",
    "build": "tailwindcss -i ./assets/css/input.css -o ./assets/css/output.css --minify"
}
```

---

## 🧩 Using Tailwind in Templates

```php
<section class="bg-white py-10 px-6">
    <h1 class="text-3xl font-bold">Welcome to the Future</h1>
</section>
```

> Tailwind will automatically detect these classes and purge unused ones in production builds.

---

## 🔐 License

This theme is licensed under the **GNU General Public License v2 or later**.

---

## ✨ Final Words

This is not your average WordPress theme.  
It’s a performance-first, developer-led foundation for serious digital experiences.

# WPCore Modern

A modern, lightweight WordPress starter theme built with **Tailwind CSS 4**, designed for speed, simplicity, and scalability.

[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-8.0%2B-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPL--2.0-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

## ✨ Features

### 🎨 Modern Stack
- **Tailwind CSS 4** with `@theme` directive
- **PostCSS** for CSS processing
- **esbuild** for JavaScript bundling
- Fast build times (< 500ms)

### 🧩 Component Library
- Pre-built components (Cards, Buttons, Hero, Breadcrumbs)
- Reusable PHP component helpers
- Consistent design system
- Easy to customize and extend

### 📱 Responsive & Accessible
- Mobile-first responsive design
- WCAG 2.1 Level AA compliant
- Keyboard navigation support
- Screen reader friendly

### ⚡ Performance
- Minimal dependencies (10 packages)
- Optimized bundle sizes (~12KB CSS purged)
- Lazy loading images
- Native WordPress features

### 🎯 Block Editor Support
- **Block Templates**: Full Site Editing (FSE) templates (index, single, page, archive, search, 404)
- **Template Parts**: Header and Footer template parts
- **Block Patterns**: Hero, Features, CTA, Testimonials, Pricing, Stats
- **Block Styles**: Outline, Ghost buttons, Modern quote, etc.
- **Full theme.json**: Complete configuration
- **Custom Page Templates**: Full Width, Sidebar, Transparent Header, Blank

### 🔧 Developer Experience
- Clean, organized code structure
- Modular JavaScript
- Comprehensive documentation
- Easy to customize and extend

## 📋 Requirements

- **WordPress**: 6.0 or higher
- **PHP**: 8.0 or higher
- **Node.js**: 18+ and npm 8.6+

## 🚀 Quick Start

### 1. Install Theme

```bash
cd wp-content/themes/
git clone [repository-url] wpcore-modern
cd wpcore-modern
```

### 2. Install Dependencies

```bash
npm install
```

### 3. Build Assets

**Development mode** (with watch):
```bash
npm run dev
```

**Production build**:
```bash
npm run build
```

### 4. Activate Theme

Go to **Appearance → Themes** in WordPress admin and activate **WPCore Modern**.

## 📁 Project Structure

```
wpcore-modern/
├── core/                          # Core functionality
│   ├── setup.php                 # Theme setup & configuration
│   ├── enqueue.php               # Asset loading
│   ├── nav-walker.php            # Navigation walker
│   ├── widgets.php               # Widget areas
│   ├── template-functions.php    # Helper functions
│   └── template-parts.php        # Template parts helpers
│
├── features/                      # Optional features
│   ├── block-patterns.php        # Block patterns
│   └── block-styles.php          # Block styles
│
├── components/                     # Reusable PHP components
│   ├── card.php                  # Card component
│   ├── button.php                # Button component
│   ├── hero.php                  # Hero section
│   └── breadcrumbs.php           # Breadcrumbs
│
├── template-parts/                 # Template partials
│   ├── header/                   # Header templates
│   │   ├── header-default.php
│   │   ├── header-transparent.php
│   │   └── header-minimal.php
│   ├── footer/                   # Footer templates
│   │   ├── footer-default.php
│   │   ├── footer-minimal.php
│   │   └── footer-full.php
│   └── content/                  # Content templates
│
├── page-templates/                 # Page templates
│   ├── template-fullwidth.php
│   ├── template-sidebar.php
│   ├── template-fullwidth-transparent-header.php
│   └── template-blank.php
│
├── templates/                      # Block templates (FSE)
│   ├── index.html
│   ├── single.html
│   ├── page.html
│   ├── home.html
│   ├── archive.html
│   ├── search.html
│   └── 404.html
│
├── parts/                          # Template parts (FSE)
│   ├── header.html
│   └── footer.html
│
├── assets/
│   ├── src/                      # Source files
│   │   ├── css/
│   │   │   ├── main.css          # Main stylesheet
│   │   │   ├── theme.css         # Tailwind variables
│   │   │   ├── editor.css        # Editor styles
│   │   │   ├── base/             # Base styles
│   │   │   └── components/       # Component styles
│   │   └── js/
│   │       ├── main.js           # Main script
│   │       ├── block-editor.js   # Editor script
│   │       └── modules/          # JS modules
│   └── dist/                     # Build output (gitignored)
│
├── functions.php                  # Entry point
├── style.css                      # Theme header
├── theme.json                     # WordPress theme config
├── package.json                   # npm dependencies
└── postcss.config.js              # PostCSS configuration
```

## 🎨 Usage

### Components

#### Card Component

```php
wpcore_render_card(array(
    'title'      => 'Card Title',
    'content'    => 'Card description...',
    'image_url'  => get_the_post_thumbnail_url(),
    'link_url'   => get_permalink(),
    'link_text'  => 'Read More',
    'classes'    => 'custom-class',
));
```

#### Button Component

```php
wpcore_render_button(array(
    'text'    => 'Click Me',
    'url'     => home_url('/contact'),
    'variant' => 'primary', // primary, secondary, accent, outline, ghost
    'size'    => 'lg',     // sm, lg, xl
));
```

#### Hero Section

```php
wpcore_render_hero(array(
    'title'              => 'Welcome',
    'subtitle'           => 'Your journey starts here',
    'content'            => 'Discover amazing features.',
    'image_url'          => get_template_directory_uri() . '/assets/images/hero.jpg',
    'cta_text'           => 'Get Started',
    'cta_url'            => home_url('/get-started'),
    'secondary_cta_text' => 'Learn More',
    'secondary_cta_url'  => home_url('/about'),
    'alignment'          => 'center', // left, center
    'height'             => 'full',   // sm, md, lg, full
    'overlay'            => 'medium', // light, medium, dark
));
```

#### Breadcrumbs

```php
wpcore_render_breadcrumbs(array(
    'home_text' => 'Home',
    'separator' => '→',
    'classes'   => 'mb-8',
));
```

### Page Templates

The theme includes several page templates:

- **Full Width** - Full width page without sidebar
- **With Sidebar** - Page with sidebar
- **Full Width - Transparent Header** - Full width with transparent header
- **Blank** - Blank page without header/footer

To use: Edit page → Page Attributes → Template

### Header & Footer Templates

The theme automatically selects header/footer templates based on page settings:

- **Default Header** - Standard header with navigation
- **Transparent Header** - Transparent header (for hero pages)
- **Minimal Header** - Simple header without navigation

- **Default Footer** - Footer with 3 widget columns
- **Minimal Footer** - Simple footer with copyright only
- **Full Footer** - Footer with 4 widget columns

### Block Patterns

The theme includes custom block patterns:

- **Hero Section** - Hero with title, description, and CTA buttons
- **Features Section** - Features section with 3 columns
- **Call to Action** - CTA section with gradient background
- **Testimonials** - Testimonials section with customer reviews
- **Pricing** - Pricing section with three pricing tiers
- **Stats** - Statistics section with numbers and descriptions

To use: Block Editor → Add Block → Patterns → WPCore Modern

### Block Templates (FSE)

The theme includes Full Site Editing (FSE) block templates:

- **index.html** - Main blog template
- **single.html** - Single post template
- **page.html** - Page template
- **home.html** - Home page template
- **archive.html** - Archive template
- **search.html** - Search results template
- **404.html** - 404 error template

**Note:** WordPress will prioritize block templates (`templates/*.html`) over PHP templates (`*.php`). If a block template exists, it will be used. Otherwise, PHP templates will be used as fallback.

To use: Appearance → Editor → Templates

### Template Parts (FSE)

The theme includes template parts:

- **header.html** - Header template part
- **footer.html** - Footer template part

To use: Appearance → Editor → Template Parts

### Block Styles

Custom block styles available:

- **Button**: Outline, Ghost
- **Quote**: Modern
- **Image**: Rounded Large, Shadow Large
- **Group**: Card, Section
- **Columns**: Features

## 🛠️ Development

### Available Commands

| Command | Description |
|---------|-------------|
| `npm run dev` | Start development mode with file watching |
| `npm run build` | Build for production (minified) |
| `npm run dev:css` | Build CSS only (watch mode) |
| `npm run dev:js` | Build JavaScript only (watch mode) |
| `npm run build:css` | Build CSS for production |
| `npm run build:js` | Build JavaScript for production |

### Customization

#### Colors

Edit `assets/src/css/theme.css`:

```css
@theme {
    --color-primary: #3b82f6;
    --color-secondary: #8b5cf6;
    --color-accent: #ec4899;
}
```

Or update `theme.json` for WordPress block editor integration.

#### Typography

Edit `assets/src/css/base/typography.css` or update `theme.json`.

#### Adding Features

Uncomment in `functions.php`:

```php
require_once WPCORE_DIR . '/features/custom-post-types.php';
require_once WPCORE_DIR . '/features/acf-blocks.php';
```

## 📦 WordPress Integration

### Navigation Menus

Register menus in **Appearance → Menus**:
- **Primary** - Main header navigation
- **Footer** - Footer navigation

### Widget Areas

- **Sidebar** - Main sidebar widget area
- **Footer 1, 2, 3, 4** - Footer widget columns

### Block Editor

- Full `theme.json` configuration
- Custom block patterns
- Custom block styles
- Template parts support
- Custom page templates

## ⚡ Performance

- Build time: < 500ms (development)
- CSS bundle: ~12KB (purged and minified)
- JavaScript bundle: ~15KB (minified)
- Zero runtime overhead
- Lazy loading images

## 🌐 Browser Support

- Chrome (last 2 versions)
- Firefox (last 2 versions)
- Safari (last 2 versions)
- Edge (last 2 versions)

## ♿ Accessibility

- WCAG 2.1 Level AA compliant
- Keyboard navigation support
- Screen reader friendly
- Skip links
- Focus management
- ARIA labels

## 📄 License

This theme, like WordPress, is licensed under the **GPL v2 or later**.

```
Copyright (C) 2024 WPCore Modern

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
```

## 🙏 Credits

- Built with [Tailwind CSS](https://tailwindcss.com/)
- Powered by [WordPress](https://wordpress.org/)
- Icons from [Heroicons](https://heroicons.com/)

## 📚 Documentation

### Core Documentation
- **README.md** - This file
- **CHANGELOG.md** - Version history

### Development Guides
- **[Development Guide](.docs/DEVELOPMENT.md)** - Coding standards, best practices, and workflow
- **[Block Editor Development](.docs/BLOCK_EDITOR_DEVELOPMENT.md)** - Block Editor integration guide
- **[Block Templates Guide](.docs/BLOCK_TEMPLATES.md)** - FSE templates and template parts

### Evaluation
- **[Final Evaluation](.docs/FINAL_EVALUATION.md)** - Comprehensive theme evaluation report

### Code Documentation
- **Code comments** - Inline documentation in all PHP files

## 🤝 Contributing

Contributions are welcome! Please read our contributing guidelines before submitting pull requests.

## 📞 Support

For issues, questions, or contributions, please visit [GitHub repository](https://github.com/phongnguyen/wpcore-modern) or [phongnguyen.net](https://phongnguyen.net).

---

**Made with ❤️ for the WordPress community**

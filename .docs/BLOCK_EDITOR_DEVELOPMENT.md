# 🎨 Block Editor Development Guide - WPCore Modern

Hướng dẫn phát triển với WordPress Block Editor (Gutenberg) cho theme WPCore Modern.

---

## 📋 Mục lục

1. [Overview](#overview)
2. [Theme.json Configuration](#themejson-configuration)
3. [Block Patterns](#block-patterns)
4. [Block Styles](#block-styles)
5. [Block Variations](#block-variations)
6. [Custom Blocks](#custom-blocks)
7. [Template Parts](#template-parts)
8. [Editor Styles](#editor-styles)
9. [Best Practices](#best-practices)
10. [Examples](#examples)

---

## 🎯 Overview

WPCore Modern hỗ trợ đầy đủ WordPress Block Editor với:

- ✅ **theme.json**: Cấu hình đầy đủ cho block editor
- ✅ **Block Patterns**: Custom patterns (Hero, Features, CTA)
- ✅ **Block Styles**: Custom styles cho core blocks
- ✅ **Template Parts**: Header, Footer templates
- ✅ **Page Templates**: Custom page templates
- ✅ **Editor Styles**: Styling cho block editor

---

## 📝 Theme.json Configuration

### File Location

```
wpcore-modern/
└── theme.json
```

### Cấu trúc cơ bản

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "color": { ... },
    "typography": { ... },
    "layout": { ... },
    "spacing": { ... }
  },
  "styles": { ... },
  "templateParts": { ... },
  "customTemplates": [ ... ]
}
```

### Color Palette

```json
{
  "settings": {
    "color": {
      "palette": [
        {
          "slug": "primary",
          "color": "#3b82f6",
          "name": "Primary"
        },
        {
          "slug": "secondary",
          "color": "#8b5cf6",
          "name": "Secondary"
        }
      ]
    }
  }
}
```

### Typography

```json
{
  "settings": {
    "typography": {
      "fontFamilies": [
        {
          "fontFamily": "'Inter', sans-serif",
          "slug": "sans",
          "name": "Sans Serif"
        }
      ],
      "fontSizes": [
        {
          "slug": "small",
          "size": "0.875rem",
          "name": "Small"
        }
      ]
    }
  }
}
```

### Layout

```json
{
  "settings": {
    "layout": {
      "contentSize": "1140px",
      "wideSize": "1320px"
    }
  }
}
```

### Custom Templates

```json
{
  "customTemplates": [
    {
      "name": "fullwidth",
      "title": "Full Width",
      "postTypes": ["page"]
    }
  ]
}
```

### Template Parts

```json
{
  "templateParts": {
    "header": {
      "title": "Header",
      "area": "header"
    },
    "footer": {
      "title": "Footer",
      "area": "footer"
    }
  }
}
```

---

## 🎨 Block Patterns

### Tạo Block Pattern

File: `features/block-patterns.php`

```php
<?php
/**
 * Register block pattern
 */
function wpcore_register_block_patterns() {
    // Register pattern category
    register_block_pattern_category(
        'wpcore-modern',
        array('label' => __('WPCore Modern', 'wpcore-modern'))
    );

    // Register pattern
    register_block_pattern(
        'wpcore-modern/hero',
        array(
            'title'       => __('Hero Section', 'wpcore-modern'),
            'description' => __('A hero section with title and CTA.', 'wpcore-modern'),
            'content'     => '<!-- wp:group {...} -->...',
            'categories'  => array('wpcore-modern', 'header'),
        )
    );
}
add_action('init', 'wpcore_register_block_patterns');
```

### Pattern Categories

- `wpcore-modern`: Custom category
- `header`: Header patterns
- `featured`: Featured content
- `call-to-action`: CTA sections
- `text`: Text patterns

### Pattern Structure

```html
<!-- wp:group {"align":"full","style":{...}} -->
<div class="wp-block-group alignfull">
    <!-- wp:heading -->
    <h2>Title</h2>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph -->
    <p>Content</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:buttons -->
    <div class="wp-block-buttons">
        <!-- wp:button -->
        <div class="wp-block-button">
            <a class="wp-block-button__link">Button</a>
        </div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
```

### Sử dụng Pattern

1. Vào Block Editor
2. Click **Add Block** (+)
3. Chọn tab **Patterns**
4. Chọn category **WPCore Modern**
5. Chọn pattern muốn sử dụng

---

## 🎭 Block Styles

### Tạo Block Style

File: `features/block-styles.php`

```php
<?php
/**
 * Register block style
 */
function wpcore_register_block_styles() {
    // Button styles
    register_block_style(
        'core/button',
        array(
            'name'         => 'outline',
            'label'        => __('Outline', 'wpcore-modern'),
        )
    );

    register_block_style(
        'core/button',
        array(
            'name'         => 'ghost',
            'label'        => __('Ghost', 'wpcore-modern'),
        )
    );
}
add_action('init', 'wpcore_register_block_styles');
```

### Style CSS

File: `assets/src/css/editor-blocks.css`

```css
/**
 * Button Block Styles
 */
.wp-block-button.is-style-outline .wp-block-button__link {
    background-color: transparent;
    border: 2px solid var(--wp--preset--color--primary);
    color: var(--wp--preset--color--primary);
}

.wp-block-button.is-style-ghost .wp-block-button__link {
    background-color: transparent;
    border: 2px solid transparent;
    color: var(--wp--preset--color--primary);
}
```

### Blocks có thể style

- `core/button`: Buttons
- `core/quote`: Quotes
- `core/image`: Images
- `core/group`: Groups
- `core/columns`: Columns
- `core/paragraph`: Paragraphs
- `core/heading`: Headings

---

## 🔄 Block Variations

### Tạo Block Variation

File: `assets/src/js/block-editor.js`

```javascript
wp.domReady(() => {
    // Register block variation
    wp.blocks.registerBlockVariation('core/button', {
        name: 'primary-button',
        title: 'Primary Button',
        attributes: {
            className: 'btn-primary',
            backgroundColor: 'primary',
            textColor: 'white'
        },
        scope: ['inserter', 'transform']
    });
});
```

### Variation Properties

- `name`: Unique identifier
- `title`: Display name
- `description`: Description
- `attributes`: Default attributes
- `scope`: Where variation appears
- `icon`: Custom icon
- `isDefault`: Set as default

---

## 🧱 Custom Blocks

### Tạo Custom Block (JavaScript)

#### 1. Tạo Block Folder

```
wpcore-modern/
└── blocks/
    └── custom-hero/
        ├── block.json
        ├── index.js
        ├── edit.js
        ├── save.js
        └── style.css
```

#### 2. Block.json

```json
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "wpcore/custom-hero",
  "title": "Custom Hero",
  "category": "wpcore",
  "icon": "star-filled",
  "description": "A custom hero block",
  "supports": {
    "html": false,
    "align": ["wide", "full"]
  },
  "attributes": {
    "title": {
      "type": "string",
      "default": "Welcome"
    },
    "content": {
      "type": "string",
      "default": ""
    }
  },
  "editorScript": "file:./index.js",
  "editorStyle": "file:./style.css",
  "style": "file:./style.css"
}
```

#### 3. Register Block (PHP)

File: `features/custom-blocks.php`

```php
<?php
/**
 * Register custom blocks
 */
function wpcore_register_custom_blocks() {
    // Register block
    register_block_type(
        WPCORE_DIR . '/blocks/custom-hero',
        array(
            'render_callback' => 'wpcore_render_custom_hero',
        )
    );
}
add_action('init', 'wpcore_register_custom_blocks');

/**
 * Render custom hero block
 */
function wpcore_render_custom_hero($attributes) {
    $title = isset($attributes['title']) ? $attributes['title'] : '';
    $content = isset($attributes['content']) ? $attributes['content'] : '';
    
    ob_start();
    ?>
    <div class="wp-block-wpcore-custom-hero">
        <?php if ($title) : ?>
            <h2><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($content) : ?>
            <div><?php echo wp_kses_post($content); ?></div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
```

#### 4. Block JavaScript

File: `blocks/custom-hero/index.js`

```javascript
import { registerBlockType } from '@wordpress/blocks';
import { RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit: ({ attributes, setAttributes }) => {
        const { title, content } = attributes;
        
        return (
            <>
                <InspectorControls>
                    <PanelBody title="Settings">
                        <TextControl
                            label="Title"
                            value={title}
                            onChange={(value) => setAttributes({ title: value })}
                        />
                    </PanelBody>
                </InspectorControls>
                <div className="wp-block-wpcore-custom-hero">
                    <RichText
                        tagName="h2"
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                        placeholder="Enter title..."
                    />
                    <RichText
                        tagName="p"
                        value={content}
                        onChange={(value) => setAttributes({ content: value })}
                        placeholder="Enter content..."
                    />
                </div>
            </>
        );
    },
    save: ({ attributes }) => {
        const { title, content } = attributes;
        
        return (
            <div className="wp-block-wpcore-custom-hero">
                <RichText.Content tagName="h2" value={title} />
                <RichText.Content tagName="p" value={content} />
            </div>
        );
    }
});
```

### Build Custom Blocks

```bash
# Install @wordpress/scripts
npm install --save-dev @wordpress/scripts

# Build blocks
npm run build:blocks
```

---

## 🧩 Template Parts

### Tạo Template Part

File: `template-parts/header/header-default.php`

```php
<?php
/**
 * Default header template part
 *
 * @package WPCore
 */
defined('ABSPATH') || exit;
?>

<header id="masthead" class="site-header">
    <!-- Header content -->
</header>
```

### Sử dụng Template Part

1. Vào **Site Editor** (Appearance → Editor)
2. Chọn **Template Parts**
3. Chọn **Header** hoặc **Footer**
4. Edit template part

### Template Part Areas

- `header`: Header area
- `footer`: Footer area
- `sidebar`: Sidebar area (optional)

---

## 🎨 Editor Styles

### Editor CSS

File: `assets/src/css/editor.css`

```css
/**
 * Block Editor styles
 */
.editor-styles-wrapper {
    font-family: var(--font-sans);
    font-size: 1rem;
    line-height: 1.6;
    color: #111827;
}

.editor-styles-wrapper .block-editor-block-list__block {
    max-width: var(--container-content);
    margin-left: auto;
    margin-right: auto;
}
```

### Enqueue Editor Styles

File: `core/setup.php`

```php
add_theme_support('editor-styles');
add_editor_style('assets/dist/css/editor.css');
```

### Editor JavaScript

File: `assets/src/js/block-editor.js`

```javascript
wp.domReady(() => {
    // Block editor enhancements
    console.log('Block editor enhancements loaded');
});
```

---

## ✅ Best Practices

### 1. Use theme.json

- ✅ Define colors, typography, spacing in `theme.json`
- ✅ Use CSS variables from theme.json
- ✅ Keep styles consistent

### 2. Block Patterns

- ✅ Create reusable patterns
- ✅ Use semantic HTML
- ✅ Keep patterns simple
- ✅ Document pattern usage

### 3. Block Styles

- ✅ Style core blocks when needed
- ✅ Use CSS variables
- ✅ Keep styles minimal
- ✅ Test across blocks

### 4. Custom Blocks

- ✅ Use block.json
- ✅ Follow WordPress block standards
- ✅ Provide good defaults
- ✅ Handle errors gracefully

### 5. Performance

- ✅ Lazy load block assets
- ✅ Minimize JavaScript
- ✅ Use CSS efficiently
- ✅ Optimize images

### 6. Accessibility

- ✅ Use semantic HTML
- ✅ Add ARIA labels
- ✅ Ensure keyboard navigation
- ✅ Test with screen readers

---

## 📚 Examples

### Example 1: Hero Pattern

```html
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}},"color":{"background":"linear-gradient(135deg, #667eea 0%, #764ba2 100%)"}},"textColor":"white"} -->
<div class="wp-block-group alignfull has-white-color has-text-color" style="padding-top:5rem;padding-bottom:5rem;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%)">
    <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"4rem"}},"textColor":"white"} -->
    <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:4rem">Welcome</h1>
    <!-- /wp:heading -->
    
    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"backgroundColor":"white","textColor":"primary"} -->
        <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background">Get Started</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
```

### Example 2: Button Style

```php
register_block_style('core/button', array(
    'name'  => 'outline',
    'label' => __('Outline', 'wpcore-modern'),
));
```

```css
.wp-block-button.is-style-outline .wp-block-button__link {
    background-color: transparent;
    border: 2px solid var(--wp--preset--color--primary);
    color: var(--wp--preset--color--primary);
}
```

### Example 3: Block Variation

```javascript
wp.blocks.registerBlockVariation('core/button', {
    name: 'primary-button',
    title: 'Primary Button',
    attributes: {
        className: 'btn-primary',
        backgroundColor: 'primary',
        textColor: 'white'
    }
});
```

---

## 🛠️ Development Workflow

### 1. Create Pattern/Style

1. Create pattern/style in PHP
2. Add CSS if needed
3. Test in block editor
4. Document usage

### 2. Create Custom Block

1. Create block folder
2. Add block.json
3. Write JavaScript
4. Add PHP render callback
5. Build assets
6. Test in editor

### 3. Update theme.json

1. Edit theme.json
2. Test in editor
3. Verify CSS variables
4. Check compatibility

---

## 📖 Resources

### WordPress Documentation

- [Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [theme.json Reference](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/)
- [Block Patterns](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/)
- [Block Styles](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-styles/)

### Tools

- [Block Pattern Creator](https://wordpress.github.io/gutenberg/)
- [Block Editor Playground](https://wordpress.github.io/gutenberg/)

---

## ❓ FAQ

### Q: Làm sao để tạo custom block?

A: Xem phần [Custom Blocks](#custom-blocks) trong tài liệu này.

### Q: Làm sao để style block trong editor?

A: Sử dụng `editor.css` và `editor-blocks.css` files.

### Q: Làm sao để tạo block pattern?

A: Sử dụng `register_block_pattern()` function trong `features/block-patterns.php`.

### Q: Làm sao để thêm block style?

A: Sử dụng `register_block_style()` function trong `features/block-styles.php`.

---

**Last Updated:** 2024-01-XX  
**Maintained by:** Development Team  
**Questions?** Contact team lead or create an issue.


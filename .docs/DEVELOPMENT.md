# 🛠️ Development Guide - WPCore Modern

Tài liệu hướng dẫn phát triển cho team, bao gồm coding standards, best practices, workflow, và guidelines.

---

## 📋 Mục lục

1. [Getting Started](#getting-started)
2. [Coding Standards](#coding-standards)
3. [File Structure](#file-structure)
4. [Naming Conventions](#naming-conventions)
5. [Git Workflow](#git-workflow)
6. [Code Review Guidelines](#code-review-guidelines)
7. [Testing Guidelines](#testing-guidelines)
8. [Performance Best Practices](#performance-best-practices)
9. [Security Guidelines](#security-guidelines)
10. [Accessibility Standards](#accessibility-standards)
11. [Documentation Standards](#documentation-standards)

---

## 🚀 Getting Started

### Prerequisites

- **WordPress**: 6.0 or higher
- **PHP**: 8.0 or higher
- **Node.js**: 18+ and npm 8.6+
- **Git**: Latest version

### Setup Development Environment

```bash
# Clone repository
git clone [repository-url] wpcore-modern
cd wpcore-modern

# Install dependencies
npm install

# Start development mode
npm run dev
```

### Available Commands

| Command | Description |
|---------|-------------|
| `npm run dev` | Start development mode with file watching |
| `npm run build` | Build for production (minified) |
| `npm run dev:css` | Build CSS only (watch mode) |
| `npm run dev:js` | Build JavaScript only (watch mode) |
| `npm run build:css` | Build CSS for production |
| `npm run build:js` | Build JavaScript for production |

---

## 📝 Coding Standards

### PHP Coding Standards

#### WordPress Coding Standards

Theme tuân thủ **WordPress Coding Standards**:

- **Indentation**: Tabs (không phải spaces)
- **Line length**: Tối đa 80 ký tự (có thể lên 120 nếu cần)
- **Naming**: 
  - Functions: `snake_case` với prefix `wpcore_`
  - Classes: `PascalCase` với prefix `WPCore_`
  - Constants: `UPPER_CASE` với prefix `WPCORE_`
- **Brace style**: Opening brace on same line

#### Example

```php
<?php
/**
 * Function description
 *
 * @param string $param Parameter description
 * @return string Return description
 */
function wpcore_example_function($param = '') {
    if (empty($param)) {
        return '';
    }
    
    return sanitize_text_field($param);
}
```

#### Required in Every PHP File

```php
<?php
/**
 * File description
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;
```

### JavaScript Coding Standards

#### ES6+ Standards

- **Indentation**: 2 spaces
- **Line length**: Tối đa 100 ký tự
- **Naming**:
  - Functions: `camelCase`
  - Constants: `UPPER_CASE`
  - Classes: `PascalCase`
- **Semicolons**: Required
- **Quotes**: Single quotes for strings

#### Example

```javascript
/**
 * Function description
 *
 * @param {string} param Parameter description
 * @returns {string} Return description
 */
export function exampleFunction(param = '') {
    if (!param) {
        return '';
    }
    
    return param.trim();
}
```

### CSS Coding Standards

#### Tailwind CSS + Custom CSS

- **Indentation**: 2 spaces
- **Naming**: BEM-like hoặc Tailwind utilities
- **Organization**: 
  - Base styles
  - Components
  - Utilities
- **Comments**: Required for complex styles

#### Example

```css
/**
 * Component description
 *
 * @package WPCore
 */

@layer components {
  .component-name {
    /* Base styles */
  }
  
  .component-name__element {
    /* Element styles */
  }
  
  .component-name--modifier {
    /* Modifier styles */
  }
}
```

---

## 📁 File Structure

### Directory Organization

```
wpcore-modern/
├── core/                    # Core functionality
│   ├── setup.php           # Theme setup
│   ├── enqueue.php         # Asset loading
│   ├── nav-walker.php      # Navigation walker
│   ├── widgets.php         # Widget areas
│   ├── template-functions.php  # Helper functions
│   └── template-parts.php  # Template parts helpers
│
├── features/                # Optional features
│   ├── block-patterns.php
│   └── block-styles.php
│
├── components/              # Reusable PHP components
│   ├── card.php
│   ├── button.php
│   ├── hero.php
│   └── breadcrumbs.php
│
├── template-parts/         # Template partials
│   ├── header/
│   ├── footer/
│   └── content/
│
├── page-templates/         # Page templates
│
├── assets/
│   ├── src/                # Source files
│   │   ├── css/
│   │   └── js/
│   └── dist/               # Build output (gitignored)
│
└── functions.php           # Entry point
```

### File Naming Conventions

- **PHP files**: `kebab-case.php` (e.g., `template-functions.php`)
- **JavaScript files**: `kebab-case.js` (e.g., `lazy-load.js`)
- **CSS files**: `kebab-case.css` (e.g., `navigation.css`)
- **Template files**: `template-name.php` (e.g., `template-fullwidth.php`)

---

## 🏷️ Naming Conventions

### Functions

- **Prefix**: `wpcore_`
- **Format**: `snake_case`
- **Example**: `wpcore_get_header_template()`

### Classes

- **Prefix**: `WPCore_`
- **Format**: `PascalCase`
- **Example**: `WPCore_Nav_Walker`

### Constants

- **Prefix**: `WPCORE_`
- **Format**: `UPPER_CASE`
- **Example**: `WPCORE_VERSION`

### Variables

- **Format**: `snake_case`
- **Example**: `$header_template`

### CSS Classes

- **Format**: `kebab-case` hoặc Tailwind utilities
- **Example**: `site-header`, `btn-primary`

### JavaScript Variables

- **Format**: `camelCase`
- **Example**: `headerTemplate`

---

## 🌿 Git Workflow

### Branch Strategy

- **main**: Production-ready code
- **develop**: Development branch
- **feature/**: Feature branches
- **fix/**: Bug fix branches
- **hotfix/**: Urgent fixes

### Commit Messages

Tuân thủ **Conventional Commits**:

```
<type>(<scope>): <subject>

<body>

<footer>
```

#### Types

- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation
- `style`: Code style changes
- `refactor`: Code refactoring
- `perf`: Performance improvements
- `test`: Adding tests
- `chore`: Maintenance tasks

#### Examples

```
feat(header): add transparent header support

Add support for transparent header with scroll effects.
Includes CSS transitions and JavaScript enhancements.

Closes #123
```

```
fix(navigation): fix mobile menu toggle

Fix issue where mobile menu toggle button was not working
on iOS devices. Added touch event handlers.

Fixes #456
```

### Pull Request Guidelines

1. **Title**: Clear, descriptive
2. **Description**: 
   - What changed
   - Why changed
   - How to test
3. **Screenshots**: If UI changes
4. **Testing**: List tested scenarios
5. **Breaking changes**: Document if any

---

## 👀 Code Review Guidelines

### Review Checklist

#### Code Quality
- [ ] Code follows coding standards
- [ ] Functions are well-documented
- [ ] No hardcoded values
- [ ] Proper error handling
- [ ] No console.logs in production code

#### Security
- [ ] All inputs are sanitized
- [ ] All outputs are escaped
- [ ] Nonces are used for AJAX
- [ ] Capability checks are in place
- [ ] No SQL injection risks

#### Performance
- [ ] No unnecessary queries
- [ ] Assets are optimized
- [ ] Images use lazy loading
- [ ] No blocking scripts
- [ ] Proper caching

#### Accessibility
- [ ] Semantic HTML
- [ ] ARIA labels where needed
- [ ] Keyboard navigation works
- [ ] Color contrast is sufficient
- [ ] Screen reader friendly

#### Testing
- [ ] Code is tested
- [ ] Edge cases handled
- [ ] Cross-browser tested
- [ ] Mobile responsive

---

## 🧪 Testing Guidelines

### Manual Testing

#### Before Committing

1. **Functionality**: All features work as expected
2. **Responsive**: Test on mobile, tablet, desktop
3. **Browsers**: Chrome, Firefox, Safari, Edge
4. **Accessibility**: Keyboard navigation, screen reader
5. **Performance**: Page load time, Core Web Vitals

#### Test Scenarios

- **Navigation**: Desktop and mobile menus
- **Forms**: All form submissions
- **Images**: Lazy loading works
- **JavaScript**: No console errors
- **CSS**: No layout breaks

### Automated Testing

#### PHPUnit (Future)

```php
<?php
class WPCore_Template_Functions_Test extends WP_UnitTestCase {
    public function test_wpcore_container_class() {
        $class = wpcore_container_class();
        $this->assertStringContainsString('max-w-7xl', $class);
    }
}
```

#### JavaScript Testing (Future)

```javascript
describe('Navigation', () => {
    it('should toggle mobile menu', () => {
        // Test implementation
    });
});
```

---

## ⚡ Performance Best Practices

### PHP

1. **Avoid N+1 queries**: Use `WP_Query` properly
2. **Cache queries**: Use `wp_cache_get/set`
3. **Lazy load**: Load only what's needed
4. **Optimize loops**: Use `pre_get_posts` filters

### JavaScript

1. **Defer/Async**: Use for non-critical scripts
2. **Code splitting**: Split by routes
3. **Minify**: Always minify for production
4. **Tree shaking**: Remove unused code

### CSS

1. **Purge unused**: Remove unused Tailwind classes
2. **Minify**: Always minify for production
3. **Critical CSS**: Inline critical CSS
4. **Optimize**: Use PostCSS optimizations

### Images

1. **Responsive images**: Use `srcset` and `sizes`
2. **Lazy loading**: Use `loading="lazy"`
3. **Format**: Use WebP/AVIF when possible
4. **Optimize**: Compress images before upload

### Example: Responsive Images

```php
<?php
$image_id = get_post_thumbnail_id();
$image_src = wp_get_attachment_image_src($image_id, 'full');
$image_srcset = wp_get_attachment_image_srcset($image_id, 'full');
$image_sizes = wp_get_attachment_image_sizes($image_id, 'full');
?>

<img src="<?php echo esc_url($image_src[0]); ?>"
     srcset="<?php echo esc_attr($image_srcset); ?>"
     sizes="<?php echo esc_attr($image_sizes); ?>"
     alt="<?php echo esc_attr(get_the_title()); ?>"
     loading="lazy">
```

---

## 🔒 Security Guidelines

### Input Sanitization

```php
// ✅ Good
$input = sanitize_text_field($_POST['input']);
$email = sanitize_email($_POST['email']);
$url = esc_url_raw($_POST['url']);

// ❌ Bad
$input = $_POST['input'];
```

### Output Escaping

```php
// ✅ Good
echo esc_html($variable);
echo esc_url($url);
echo esc_attr($attribute);

// ❌ Bad
echo $variable;
```

### Nonces

```php
// ✅ Good
wp_nonce_field('action_name', 'nonce_name');
wp_verify_nonce($_POST['nonce_name'], 'action_name');

// ❌ Bad
// No nonce check
```

### Capability Checks

```php
// ✅ Good
if (current_user_can('manage_options')) {
    // Do something
}

// ❌ Bad
// No capability check
```

### SQL Injection Prevention

```php
// ✅ Good
$wpdb->prepare("SELECT * FROM table WHERE id = %d", $id);

// ❌ Bad
$wpdb->query("SELECT * FROM table WHERE id = $id");
```

---

## ♿ Accessibility Standards

### Semantic HTML

```html
<!-- ✅ Good -->
<header>
    <nav aria-label="Main navigation">
        <ul>
            <li><a href="/">Home</a></li>
        </ul>
    </nav>
</header>

<!-- ❌ Bad -->
<div class="header">
    <div class="nav">
        <div class="menu-item">Home</div>
    </div>
</div>
```

### ARIA Labels

```html
<!-- ✅ Good -->
<button aria-label="Close menu" aria-expanded="false">
    <span class="sr-only">Close</span>
</button>

<!-- ❌ Bad -->
<button>X</button>
```

### Keyboard Navigation

- All interactive elements must be keyboard accessible
- Focus indicators must be visible
- Tab order must be logical
- Skip links must be present

### Color Contrast

- Text: Minimum 4.5:1 ratio
- Large text: Minimum 3:1 ratio
- Use tools like WebAIM Contrast Checker

---

## 📚 Documentation Standards

### PHP Documentation

```php
/**
 * Function description
 *
 * @since 1.0.0
 * @package WPCore
 *
 * @param string $param1 Parameter description
 * @param int    $param2 Parameter description
 * @return string Return description
 */
function wpcore_example($param1 = '', $param2 = 0) {
    // Implementation
}
```

### JavaScript Documentation

```javascript
/**
 * Function description
 *
 * @param {string} param1 Parameter description
 * @param {number} param2 Parameter description
 * @returns {string} Return description
 */
export function example(param1 = '', param2 = 0) {
    // Implementation
}
```

### CSS Documentation

```css
/**
 * Component description
 *
 * @package WPCore
 */

.component-name {
    /* Styles */
}
```

### Inline Comments

- Explain **why**, not **what**
- Use clear, concise language
- Update comments when code changes

---

## 🎯 Best Practices

### Do's ✅

- ✅ Follow WordPress Coding Standards
- ✅ Use WordPress functions when available
- ✅ Sanitize inputs, escape outputs
- ✅ Write self-documenting code
- ✅ Add comments for complex logic
- ✅ Test before committing
- ✅ Keep functions small and focused
- ✅ Use meaningful variable names
- ✅ Handle errors gracefully

### Don'ts ❌

- ❌ Don't use `eval()` or `create_function()`
- ❌ Don't hardcode values
- ❌ Don't ignore WordPress hooks
- ❌ Don't bypass security checks
- ❌ Don't commit debug code
- ❌ Don't use deprecated functions
- ❌ Don't mix concerns
- ❌ Don't ignore accessibility
- ❌ Don't skip documentation

---

## 🔧 Tools & Setup

### Recommended IDE Setup

- **VS Code** with extensions:
  - PHP Intelephense
  - WordPress Snippets
  - ESLint
  - Prettier
  - Tailwind CSS IntelliSense

### Linting & Formatting

#### PHP

```bash
# Install PHPCS
composer require --dev wp-coding-standards/wpcs

# Run PHPCS
./vendor/bin/phpcs --standard=WordPress .
```

#### JavaScript

```bash
# Install ESLint
npm install --save-dev eslint

# Run ESLint
npm run lint
```

#### CSS

```bash
# Install Stylelint
npm install --save-dev stylelint

# Run Stylelint
npm run lint:css
```

---

## 📞 Support & Resources

### Internal Resources

- **README.md**: Project overview
- **CHANGELOG.md**: Version history
- **THEME_ANALYSIS.md**: Theme analysis

### External Resources

- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/)
- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [WCAG Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

### Getting Help

1. Check documentation first
2. Search existing issues
3. Ask in team chat
4. Create new issue if needed

---

## 🎓 Learning Resources

### WordPress Development

- [WordPress Developer Resources](https://developer.wordpress.org/)
- [WordPress Theme Development](https://developer.wordpress.org/themes/)
- [WordPress Plugin Development](https://developer.wordpress.org/plugins/)

### Modern Web Development

- [MDN Web Docs](https://developer.mozilla.org/)
- [Can I Use](https://caniuse.com/)
- [Web.dev](https://web.dev/)

---

## 📝 Changelog

Khi thêm features hoặc fix bugs, cập nhật `CHANGELOG.md` theo format:

```markdown
## [1.0.1] - 2024-01-XX

### Added
- New feature description

### Changed
- Change description

### Fixed
- Bug fix description
```

---

## ✅ Checklist Before Release

- [ ] All tests pass
- [ ] Code reviewed
- [ ] Documentation updated
- [ ] CHANGELOG.md updated
- [ ] Version bumped
- [ ] Assets built for production
- [ ] Cross-browser tested
- [ ] Mobile responsive tested
- [ ] Accessibility tested
- [ ] Performance tested

---

**Last Updated:** 2024-01-XX  
**Maintained by:** Development Team  
**Questions?** Contact team lead or create an issue.


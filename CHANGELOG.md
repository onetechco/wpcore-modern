# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.1] - 2024-01-XX

### Added
- **Developer Tools:**
  - `.editorconfig` for code style consistency
  - `.phpcs.xml` for PHP linting (WordPress Coding Standards)
  - `.eslintrc.json` for JavaScript linting
- **Security Enhancements:**
  - `core/security.php` with input validation helpers
  - AJAX handlers with nonce verification and capability checks
  - Example contact form and load more posts handlers
- **Performance Optimizations:**
  - `core/performance.php` with Content Security Policy headers
  - Security headers (X-Content-Type-Options, X-Frame-Options, etc.)
  - Resource hints (preconnect/prefetch) for Google Fonts
  - Font optimization with `font-display: swap`
  - Image optimization with srcset, sizes, and lazy loading
  - Disable emoji scripts and remove unnecessary WordPress features
- **Accessibility Improvements:**
  - `core/accessibility.php` with ARIA live regions
  - Skip link improvements
  - Image alt text enforcement
  - Navigation and search form ARIA labels
  - Focus management for modals
  - Color contrast verification helper
- **Documentation:**
  - Documentation index (`.docs/README.md`)
  - Final evaluation report (`.docs/FINAL_EVALUATION.md`)

### Changed
- Improved `wpcore_post_thumbnail()` function with responsive images (srcset, sizes)
- Updated skip link target from `id="primary"` to `id="main-content"`
- Enhanced font loading with `font-display: swap` strategy
- Added resource hints for better performance
- Updated README.md with documentation links
- Cleaned up unnecessary documentation files

### Security
- Added input validation helpers
- Added AJAX security with nonce verification
- Added Content Security Policy headers
- Added security headers (X-Content-Type-Options, X-Frame-Options, etc.)

### Performance
- Added resource hints (preconnect/prefetch)
- Optimized font loading
- Improved image optimization
- Removed unnecessary WordPress features

### Accessibility
- Added ARIA live regions for announcements
- Improved skip links
- Enforced image alt text
- Added ARIA labels to navigation and search forms
- Added focus management

## [1.0.0] - 2024-01-XX

### Added
- Initial release
- Tailwind CSS 4 integration
- Component library (Cards, Buttons, Hero, Breadcrumbs)
- Block editor support (patterns, styles, theme.json)
- Page templates (Full Width, Sidebar, Transparent Header, Blank)
- Header templates (Default, Transparent, Minimal)
- Footer templates (Default, Minimal, Full)
- Responsive navigation (desktop & mobile)
- Widget areas (Sidebar + 4 Footer columns)
- Block patterns (Hero, Features, CTA)
- Block styles (Outline, Ghost buttons, Modern quote, etc.)
- Editor styles and block editor enhancements
- Accessibility features (WCAG 2.1 Level AA)
- Performance optimizations

### Features
- Modern stack: Tailwind CSS 4, PostCSS, esbuild
- Component-based architecture
- Template parts system
- Automatic header/footer template selection
- Custom color palette and typography
- Responsive design (mobile-first)
- SEO-friendly structure
- Translation-ready

### Documentation
- Comprehensive README
- Inline code documentation
- Component usage examples


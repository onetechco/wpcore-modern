# 📋 Block Templates Guide

Hướng dẫn đầy đủ về Block Templates (FSE) trong theme WPCore Modern.

## 🔄 Template Hierarchy

WordPress **ưu tiên Block Templates** trước PHP Templates:

1. **Block Templates** (`templates/*.html`) - ✅ Ưu tiên cao nhất
2. **PHP Templates** (`*.php`) - ✅ Fallback nếu không có block template

### Override Behavior

**Block Templates tự động override PHP Templates** khi tồn tại:

| Tình Huống | Block Template | PHP Template | WordPress Dùng |
|------------|----------------|--------------|----------------|
| **Có cả 2** | ✅ `templates/index.html` | ✅ `index.php` | **Block Template** ✅ |
| **Chỉ có Block** | ✅ `templates/index.html` | ❌ Không có | **Block Template** ✅ |
| **Chỉ có PHP** | ❌ Không có | ✅ `index.php` | **PHP Template** ✅ |

---

## 📁 Cấu Trúc Templates

### Block Templates (FSE) - `templates/`

- `index.html` - Main blog template
- `single.html` - Single post template
- `page.html` - Default page template
- `page-fullwidth.html` - Full Width page template
- `page-sidebar.html` - Page with sidebar template
- `page-fullwidth-transparent-header.html` - Full Width with transparent header
- `home.html` - Home page template (blog posts)
- `front-page.html` - Front page template (static page)
- `archive.html` - Archive template
- `search.html` - Search results template
- `404.html` - 404 error template

### PHP Templates - Root (Fallback)

- `index.php` - Main blog template (fallback)
- `single.php` - Single post template (fallback)
- `page.php` - Page template (fallback)
- `front-page.php` - Front page template
- `archive.php` - Archive template (fallback)
- `search.php` - Search results template (fallback)
- `404.php` - 404 error template (fallback)

### Template Parts

#### Block Template Parts (FSE) - `parts/`
- `header.html` - Header template part
- `footer.html` - Footer template part
- `sidebar.html` - Sidebar template part

#### PHP Template Parts - `template-parts/`
- `header/header-default.php` - Default header
- `header/header-transparent.php` - Transparent header
- `header/header-minimal.php` - Minimal header
- `footer/footer-default.php` - Default footer
- `footer/footer-minimal.php` - Minimal footer
- `footer/footer-full.php` - Full footer

---

## 🏠 Homepage Template Hierarchy

WordPress chọn template dựa trên **Settings → Reading**:

### Blog Posts làm Homepage

**Cấu hình**: Settings → Reading → "Your homepage displays" → "Your latest posts"

**Template Hierarchy**:
1. `templates/home.html` ✅
2. `templates/index.html` (fallback) ✅
3. `home.php` (không có)
4. `index.php` (fallback) ✅

**WordPress sẽ dùng**: `templates/home.html` ✅

### Static Page làm Homepage

**Cấu hình**: Settings → Reading → "Your homepage displays" → "A static page"

**Template Hierarchy**:
1. `templates/front-page.html` ✅
2. `front-page.php` (fallback) ✅
3. `templates/page.html` (fallback) ✅
4. `page.php` (fallback) ✅

**WordPress sẽ dùng**: `templates/front-page.html` ✅

---

## 📄 Custom Page Templates

### Định Nghĩa trong `theme.json`

```json
{
  "customTemplates": [
    {
      "name": "fullwidth",
      "title": "Full Width",
      "postTypes": ["page"]
    },
    {
      "name": "sidebar",
      "title": "With Sidebar",
      "postTypes": ["page"]
    },
    {
      "name": "fullwidth-transparent-header",
      "title": "Full Width - Transparent Header",
      "postTypes": ["page"]
    }
  ]
}
```

### Template Files

WordPress tìm file với format: `templates/page-{template-name}.html`

**Ví dụ:**
- `fullwidth` → `templates/page-fullwidth.html`
- `sidebar` → `templates/page-sidebar.html`
- `fullwidth-transparent-header` → `templates/page-fullwidth-transparent-header.html`

### Cách Sử Dụng

1. **Edit Page** trong Block Editor
2. Click **Page** settings (sidebar bên phải)
3. Scroll xuống **Template**
4. Chọn template bạn muốn:
   - Default Template
   - Full Width
   - With Sidebar
   - Full Width - Transparent Header

### Template Variations

#### 1. Full Width (`page-fullwidth.html`)

**Đặc điểm:**
- ✅ Full width layout (không có sidebar)
- ✅ Content không bị giới hạn bởi container
- ✅ Featured image có thể full width

**Khi nào dùng:**
- Landing pages
- Full-width content pages
- Hero sections

#### 2. With Sidebar (`page-sidebar.html`)

**Đặc điểm:**
- ✅ 2-column layout (66.66% content + 33.33% sidebar)
- ✅ Sidebar bên phải
- ✅ Responsive: sidebar chuyển xuống dưới trên mobile
- ✅ Sidebar hiển thị widgets từ `sidebar-1`

**Khi nào dùng:**
- Blog pages
- Content pages cần sidebar
- Pages với widgets

#### 3. Full Width - Transparent Header (`page-fullwidth-transparent-header.html`)

**Đặc điểm:**
- ✅ Full width layout
- ✅ Featured image full width (có thể dùng làm hero)
- ✅ Header transparent (nếu theme hỗ trợ)

**Khi nào dùng:**
- Hero pages
- Landing pages với hero image
- Pages cần transparent header

---

## ⚙️ Cách WordPress Xử Lý

### Khi Có Block Template:

```php
// WordPress sẽ check:
1. templates/index.html → ✅ Tìm thấy → Dùng ngay
2. index.php → ❌ Bỏ qua (không check nữa)
```

### Khi KHÔNG Có Block Template:

```php
// WordPress sẽ check:
1. templates/index.html → ❌ Không có
2. index.php → ✅ Tìm thấy → Dùng ngay
```

---

## 💡 Lưu Ý Quan Trọng

### 1. Naming Convention

**Block Templates:**
- Format: `templates/page-{template-name}.html`
- `template-name` phải khớp với `name` trong `theme.json`

**PHP Templates:**
- Format: `page-templates/template-{template-name}.php`
- `template-name` phải khớp với `name` trong `theme.json`

### 2. Template Override

- **Block Template** sẽ override **PHP Template** nếu có
- Nếu xóa block template → WordPress tự động dùng PHP template
- PHP templates vẫn hữu ích cho backward compatibility

### 3. Sidebar Widget Area

- Sidebar template cần widget area được register
- Theme đã có `sidebar-1` widget area
- Sidebar sử dụng `wp:html` block để hiển thị widgets (vì block templates không hỗ trợ PHP trực tiếp)

---

## 🎯 Kết Luận

### ✅ Theme Hiện Tại

- ✅ Block Templates: `templates/*.html` (ưu tiên)
- ✅ PHP Templates: `*.php` (fallback)
- ✅ Custom Page Templates: Full Width, Sidebar, Transparent Header
- ✅ Template Parts: Header, Footer, Sidebar

### 📝 Cách Dùng

1. Edit page → Chọn template trong Block Editor
2. WordPress tự động load block template tương ứng
3. Nếu không có block template → fallback về PHP template

---

**Last Updated:** 2024-01-XX


# Component Structure & Reference

## Current Component Layout

```
resources/views/components/
├── public-layout.blade.php           ✅ Main public layout wrapper
├── application-logo.blade.php         - App logo component
├── auth-session-status.blade.php      - Session status alerts
├── carousel.blade.php                 - Image carousel
├── danger-button.blade.php            - Danger action button
├── dropdown.blade.php                 - Dropdown menu
├── dropdown-link.blade.php            - Dropdown link item
├── input-error.blade.php              - Error message display
├── input-label.blade.php              - Form label
├── modal.blade.php                    - Modal dialog
├── nav-link.blade.php                 - Navigation link
├── primary-button.blade.php           - Primary action button
├── responsive-nav-link.blade.php      - Responsive nav item
├── secondary-button.blade.php         - Secondary button
├── text-input.blade.php               - Text input field
└── layouts/                           - (REMOVED - was causing errors)
    └── public-layout.blade.php        ✗ Deleted (moved to root)
```

## public-layout Component Structure

### Root Element
```html
<!DOCTYPE html>
<html lang="{{ locale }}">
  <head>
    <!-- Meta tags, fonts, scripts -->
  </head>
  <body>
    <div class="min-h-screen flex flex-col">
      <!-- Navigation -->
      <!-- Main Content Slot -->
      <!-- Footer -->
    </div>
  </body>
</html>
```

### Sections

#### 1. Navigation Bar (`<nav>`)
- **Position**: Fixed, sticky on scroll
- **Features**:
  - UPH logo with icon badge
  - Desktop nav links (Departments, Programs, Faculty, Research, News)
  - Authentication buttons (Dashboard/Sign In/Register)
  - Mobile hamburger menu with dropdown
  - Scroll-triggered background change
  - Responsive breakpoints (hidden on mobile, visible on lg)

**Styling**:
- Background: `bg-white/50` normal, `bg-white/95` on scroll
- Blur: `backdrop-blur-lg`
- Height: `h-16` mobile, `h-18` desktop
- Z-index: `z-50` (stays above content)

#### 2. Main Content (`<main>`)
- Flex-grow container
- Uses `{{ $slot }}` to render page-specific content
- Maintains layout structure while allowing custom content

#### 3. Footer (`<footer>`)
- **Sections**:
  1. Brand info (logo, tagline)
  2. Academic links (Departments, Programs, Faculty)
  3. Resources links (News, Research, Support)
  4. Contact info (Email, Phone, Address)
  5. Bottom bar (Copyright, Policy links)

- **Styling**:
  - Background: Dark gradient (`gray-900` to `gray-950`)
  - Decorative shapes with `absolute` positioning
  - Gradient top border (maroon → gold → maroon)
  - Responsive grid (1 col mobile, 5 cols desktop)

## Using the Component

### Basic Usage
```blade
<x-public-layout>
    <div class="pt-24">
        <!-- Your page content here -->
    </div>
</x-public-layout>
```

### With Page Title
```blade
<x-public-layout :title="'Departments'">
    <div class="pt-24">
        <!-- Page content -->
    </div>
</x-public-layout>
```

### With Meta Description
```blade
<x-public-layout 
    :title="'Engineering Programs'"
    :metaDescription="'Explore our engineering programs...'"
>
    <div class="pt-24">
        <!-- Page content -->
    </div>
</x-public-layout>
```

## Component Features

### Responsive Behavior
| Breakpoint | Navigation | Menu | Display |
|------------|-----------|------|---------|
| Mobile (<768px) | Hidden | Hamburger | Simplified |
| Tablet (768-1024px) | Hidden | Hamburger | Simplified |
| Desktop (>1024px) | Full | None | Complete |

### Interactive Elements
1. **Mobile Menu Toggle** (`Alpine.js x-data`)
   - Click hamburger to open/close
   - Transitions with animations
   - Auth buttons in mobile footer

2. **Scroll Detection** (`Alpine.js window.addEventListener`)
   - Detects scroll position > 20px
   - Changes nav background opacity
   - Smooth transitions (500ms)

3. **Hover Effects**
   - Nav links: Color + background change
   - Buttons: Scale and shadow effects
   - Footer links: Color transitions

### Color Scheme
| Element | Color | Hover | Notes |
|---------|-------|-------|-------|
| Logo background | `maroon-500` to `maroon-700` | Lighter | Gradient |
| Badge dot | `primary-500` | - | Gold accent |
| Active nav link | `maroon-600` | - | White background |
| CTA buttons | `gradient-to-r from-primary-500` | Scale up | Gold gradient |
| Footer text | `gray-400` | `primary-400` | Subtle hover |

### Animation Classes
- `.transition-all` - Smooth transitions (300-500ms)
- `.group-hover:scale-105` - Logo scale on hover
- `.hover:scale-[1.02]` - Button scale effect
- `x-transition` - Alpine transitions (fade, slide)

## Props & Customization

### Available Props
```php
@props([
    'title' => null,        // Page title
    'metaDescription' => null  // Meta description
])
```

### CSS Classes Applied
- `.font-sans` - Inter font
- `.antialiased` - Smooth font rendering
- `.bg-white` - White background
- `.text-gray-900` - Dark text
- `.custom-scrollbar` - Custom scroll styling

## Navigation Routes
All navigation links point to these Laravel routes:
- `route('home')` - Homepage
- `route('view.departments')` - Departments index
- `route('view.programs')` - Programs index
- `route('view.faculty')` - Faculty index
- `route('view.research')` - Research index
- `route('view.news')` - News index
- `route('dashboard')` - User dashboard (auth only)
- `route('login')` - Login page
- `route('register')` - Registration page

## Performance Notes
- Uses Alpine.js for lightweight interactivity
- No external API calls in layout
- All styles compiled to Tailwind CSS
- Images referenced via `public/images/` or relative paths
- No blocking resources

## Security Features
- CSRF token in meta tag
- Blade directives for auth state: `@auth`, `@guest`
- Route checks for proper permissions
- No sensitive data in markup

## Troubleshooting

### Component Not Found
**Error**: `Unable to locate a class or view for component [public-layout]`
**Solution**: Ensure file is at `/resources/views/components/public-layout.blade.php` (not in subdirectory)

### Styling Issues
**Problem**: Colors not showing
**Solution**: Run `npm run build` to compile CSS, check `tailwind.config.js`

### Navigation Not Working
**Problem**: Links don't navigate
**Solution**: Verify routes exist in `routes/web.php`, check route names

### Mobile Menu Stuck
**Problem**: Hamburger menu won't open/close
**Solution**: Check Alpine.js is loaded (`@vite(['resources/js/app.js'])`), clear cache

---

## Related Files
- Layout wrapper: `/resources/views/components/public-layout.blade.php`
- Styles: `/resources/css/app.css` (Tailwind)
- Config: `/tailwind.config.js` (color definitions)
- Routes: `/routes/web.php` (navigation targets)
- Blade templates: `/resources/views/public/*/*.blade.php` (page content)

# UPH Engineering CMS - Laravel 11

A modern, elegant Content Management System for the University of Perpetual Help System DALTA's College of Engineering, Architecture, and Technology (CEAT).

## 🎯 Project Overview

This is a full-featured Laravel 11 CMS with a redesigned modern frontend featuring:
- **Maroon/Yellow/White** brand color scheme
- **Responsive design** (mobile-first approach)
- **Component-based architecture** with Blade
- **Modern animations** and gradient effects
- **Admin panel** with Filament v3
- **Role-based access control** (3 user roles, 18 permissions)

## 📋 Features

### Backend Infrastructure ✅
- **Database**: SQLite (development) / MySQL (production-ready)
- **8 Core Models** with relationships:
  - Users (with roles & permissions)
  - Departments
  - Programs
  - Faculty Members
  - Research Centers
  - News & Events
  - Courses
  - Resources

- **Three User Roles**:
  - Superadmin: Full system access
  - Admin: Department/Content management
  - Student: Portal access

- **18 Permissions** across all resources
- **500+ test data** entries via factories
- **Eloquent ORM** with proper relationships

### Admin Panel ✅
- **Filament v3** admin interface
- **6 CRUD Resources**:
  - Users Management
  - Departments
  - Programs
  - Faculty Members
  - Research Centers
  - News & Events

- **Advanced features**:
  - Search & filtering
  - Bulk actions
  - Export functionality
  - Audit logs

### Frontend - Phase 3 ✅
- **Landing Page**: Hero section, stats, featured departments, news section, CTA
- **Public Pages**:
  - Departments Index & Detail
  - Programs Index & Detail
  - Faculty Index & Detail
  - Research Index & Detail
  - News Index & Detail

- **Component Library**:
  - public-layout (main wrapper)
  - 14+ utility components
  - Reusable card components
  - Form components

- **Styling**:
  - Tailwind CSS 3.x
  - Custom maroon/yellow palettes
  - Gradient mesh animations
  - Smooth transitions
  - Custom scrollbar

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 11, Eloquent ORM |
| **Frontend** | Blade Templating, Tailwind CSS, Alpine.js |
| **Admin** | Filament v3 |
| **Database** | SQLite (dev), MySQL (prod) |
| **Build** | Vite, npm |
| **Testing** | Pest.php |
| **Version Control** | Git/GitHub |

## 📁 Project Structure

```
uph-engineering-cms/
├── app/
│   ├── Models/           (8 core models)
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   ├── Filament/Resources/
│   └── Providers/
├── resources/
│   ├── views/
│   │   ├── components/   (Blade components)
│   │   ├── layouts/
│   │   ├── public/       (Public pages)
│   │   ├── admin/        (Admin dashboards)
│   │   └── student/      (Student portal)
│   ├── css/              (Tailwind + custom)
│   └── js/               (Alpine.js)
├── routes/
│   ├── web.php           (Public routes)
│   └── auth.php          (Auth routes)
├── database/
│   ├── migrations/       (11 migrations)
│   ├── factories/        (7 factories)
│   └── seeders/
├── public/build/         (Compiled assets)
├── storage/              (Logs, cache)
├── tests/                (Pest tests)
└── vendor/               (Dependencies)
```

## 🚀 Getting Started

### Prerequisites
- PHP 8.3+
- Composer
- Node.js 18+
- npm or yarn
- SQLite (or MySQL for production)

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/JALadera/UPHSD_CEAT_CMS.git
cd UPHSD_CEAT_CMS
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node.js dependencies**
```bash
npm install
```

4. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Setup database**
```bash
php artisan migrate
php artisan db:seed
```

6. **Build frontend assets**
```bash
npm run build
# or for development with watch mode:
npm run dev
```

7. **Start development server**
```bash
php artisan serve
```

Visit: http://localhost:8000

### Admin Panel Access
```
URL: http://localhost:8000/admin
Default User: admin@uphsd.edu.ph
Default Password: password
```

## 📊 Database Schema

### Users Table
- id, name, email, password, role
- timestamps, soft deletes

### Departments Table
- id, code, name, slug, description, head_id
- timestamps

### Programs Table
- id, code, name, slug, description, department_id
- timestamps

### Faculty Members Table
- id, first_name, last_name, email, phone, specialization, department_id
- timestamps

### Research Centers Table
- id, name, slug, description, director_id, department_id
- timestamps

### News & Events Table
- id, title, slug, content, featured_image, published_at
- timestamps

### Courses Table
- id, code, title, description, credits, program_id
- timestamps

## 🎨 Design System

### Color Palette
- **Primary**: Maroon (#8B0000) - 8 shades
- **Accent**: Yellow (#FFCC00)
- **Neutral**: Gray/White

### Typography
- **Font Family**: Inter (Google Fonts)
- **Heading**: Bold/Black (700-900)
- **Body**: Regular/Medium (400-500)

### Components
- Cards with hover effects
- Gradient animations
- Smooth transitions (300-500ms)
- Responsive grids
- Mobile hamburger menu

## 🧪 Testing

Run tests with Pest:
```bash
php artisan test

# Run specific test file:
php artisan test tests/Feature/DepartmentTest.php

# Run with coverage:
php artisan test --coverage
```

## 🔐 Security Features

- **CSRF Protection**: Enabled on all forms
- **Password Hashing**: Bcrypt (Laravel default)
- **Role-Based Access Control**: 3 roles, 18 permissions
- **SQL Injection Prevention**: Eloquent ORM
- **XSS Protection**: Blade auto-escaping
- **Rate Limiting**: Configured
- **HTTPS Ready**: Support for production SSL

## 📈 Performance Metrics

- **CSS**: 87.08 KB (13.92 KB gzipped)
- **JS**: 83.36 KB (30.97 KB gzipped)
- **Lighthouse Target**: >90 score
- **First Contentful Paint**: <2s
- **Time to Interactive**: <3.5s

## 🔄 Development Workflow

### Available Commands

```bash
# Development
npm run dev           # Watch mode
npm run build         # Production build
php artisan serve     # Start dev server

# Database
php artisan migrate                    # Run migrations
php artisan migrate:rollback           # Rollback migrations
php artisan db:seed                    # Seed database
php artisan tinker                     # Interactive shell

# Testing
php artisan test                       # Run all tests
php artisan test --coverage            # With coverage report

# Cache & Optimization
php artisan cache:clear                # Clear application cache
php artisan config:clear               # Clear config cache
php artisan view:clear                 # Clear view cache
php artisan optimize                   # Optimize for production
```

## 📝 API Endpoints (Phase 4)

Coming in Phase 4:
- `/api/departments` - List all departments
- `/api/programs` - List all programs
- `/api/faculty` - List all faculty
- `/api/research` - List research centers
- `/api/news` - List news articles

## 🗂️ File Locations

### Key Configuration Files
- `.env` - Environment variables
- `config/app.php` - App configuration
- `config/database.php` - Database config
- `tailwind.config.js` - Tailwind config
- `vite.config.js` - Vite build config

### Important Directories
- `resources/views/` - All Blade templates
- `resources/css/` - Tailwind CSS
- `resources/js/` - Frontend JavaScript
- `public/build/` - Compiled assets (git ignored)
- `storage/logs/` - Application logs

## 🐛 Troubleshooting

### Component Not Found Error
**Solution**: Ensure component file is in `/resources/views/components/` directory with correct naming (kebab-case).

### CSS Not Applying
**Solution**: Run `npm run build` to compile CSS, clear cache with `php artisan cache:clear`

### Database Connection Error
**Solution**: Check `.env` file for correct database path, ensure `database.sqlite` exists

### Permission Issues
**Solution**: Run `chmod -R 775 storage bootstrap/cache` to fix file permissions

## 🤝 Contributing

1. Create a feature branch (`git checkout -b feature/amazing-feature`)
2. Commit changes (`git commit -m 'Add amazing feature'`)
3. Push to branch (`git push origin feature/amazing-feature`)
4. Open a Pull Request

## 📜 License

This project is licensed under the MIT License - see LICENSE file for details.

## 👥 Team

- **Lead Developer**: JALadera
- **Institution**: University of Perpetual Help System DALTA
- **College**: College of Engineering, Architecture, and Technology (CEAT)

## 📞 Support & Contact

- **Email**: info@uphsd.edu.ph
- **Website**: https://www.uphsd.edu.ph
- **Location**: Las Piñas, Manila, Philippines

## 🎯 Project Roadmap

### ✅ Completed
- Phase 1: Database & Backend Infrastructure
- Phase 2: Admin Panel (Filament v3)
- Phase 3: Frontend Redesign & Public Pages

### 🔄 In Progress
- Phase 4: Student Portal & API Development

### 📅 Planned
- Phase 5: Advanced Features & Optimization
- Phase 6: Production Deployment
- Phase 7: Monitoring & Maintenance

## 📚 Documentation

- `README.md` - This file
- `PHASE_2_COMPLETION_REPORT.md` - Backend completion details
- `SESSION_3_REDESIGN.md` - Frontend redesign documentation
- `SESSION_4_STATUS.md` - Latest status update
- `COMPONENT_REFERENCE.md` - Component documentation
- `FIX_COMPONENT_ERROR.md` - Component fix details

---

**Last Updated**: April 6, 2026
**Status**: Phase 3 Complete - Ready for Phase 4 Development
**Version**: 1.0.0

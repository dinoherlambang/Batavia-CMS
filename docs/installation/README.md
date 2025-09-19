# 🚀 Installation Guide

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- SQLite (for development) or MySQL/PostgreSQL

## Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/dinoherlambang/Batavia-CMS.git
   cd Batavia-CMS
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Setup**
   ```bash
   php artisan migrate --seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

8. **Access Admin Panel**
   Visit `http://localhost:8000/admin`
   
   **Test Credentials:**
   - Email: `admin@batavia-cms.local`
   - Password: `password`

## What's Included

After installation, you'll have:
- ✅ Complete user management system
- ✅ Role-based permissions (5 roles, 38 permissions)
- ✅ Professional Filament admin panel
- ✅ Dashboard with user statistics
- ✅ Ready for content management (Stage 7+)

For detailed development information, see the [Development Progress Report](../development/DEVELOPMENT-PROGRESS.md).
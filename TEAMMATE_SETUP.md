# Teammate Setup Guide for CareSync

**Quick setup guide for teammates joining the CareSync project**

## Prerequisites

- XAMPP installed on your computer
- Git installed
- Basic command line knowledge

## Step 1: Clone the Project

1. **Open Command Prompt or PowerShell**
2. **Navigate to XAMPP htdocs folder:**
   ```bash
   cd C:\xampp\htdocs
   ```
3. **Clone the repository:**
   ```bash
   git clone https://github.com/1Zephyr2/Capstone1-web.git caresync
   cd caresync
   ```

## Step 2: Set Up Environment File

1. **Copy the example environment file:**
   ```bash
   copy .env.example .env
   ```
2. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

## Step 3: Start XAMPP Services

1. **Open XAMPP Control Panel**
2. **Start Apache** - Click "Start" button (should turn green)
3. **Start MySQL** - Click "Start" button (should turn green)

## Step 4: Create Database

1. **Open web browser**
2. **Go to:** `http://localhost/phpmyadmin`
3. **Click "New"** in left sidebar
4. **Database name:** `caresync_db`
5. **Click "Create"**

## Step 5: Install PHP Dependencies

```bash
composer install
```

## Step 6: Run Database Migrations

```bash
php artisan migrate
```

## Step 7: Create Admin User and Sample Data

```bash
php create_admin_user.php
```

**Optional - Add sample data for development:**
```bash
php artisan db:seed --class=DevelopmentDataSeeder
```

This will create:
- Admin and staff user accounts
- 3 sample patients
- 3 sample appointments

## Step 8: Test the Application

1. **Open browser**
2. **Go to:** `http://localhost/caresync/public`
3. **Login with:**
   - Username: `admin`
   - Password: `admin123`

## Success! You should now see the CareSync dashboard.

## Daily Development Workflow

### When starting work:
1. Start XAMPP (Apache + MySQL)
2. Pull latest changes: `git pull`
3. Run any new migrations: `php artisan migrate`

### When you make database changes:
1. Create migration: `php artisan make:migration your_change_name`
2. Edit the migration file
3. Run migration: `php artisan migrate`
4. Commit and push your changes

### When ending work:
1. Commit your changes: `git add . && git commit -m "Your message"`
2. Push to repository: `git push`
3. Stop XAMPP (optional, saves system resources)

## Troubleshooting

### Problem: "php: command not found"
**Solution:** Add PHP to your system PATH or use full path: `C:\xampp\php\php.exe artisan migrate`

### Problem: Database connection error
**Solution:** 
1. Make sure MySQL is running in XAMPP
2. Check your `.env` file has correct database settings
3. Make sure database `caresync_db` exists

### Problem: Can't access localhost/caresync/public
**Solution:**
1. Make sure Apache is running in XAMPP (green status)
2. Check project is in `C:\xampp\htdocs\caresync\`

### Problem: Login doesn't work
**Solution:** Run the admin user creation script again: `php create_admin_user.php`

## Need Help?

Contact your teammate or check:
- Laravel documentation: https://laravel.com/docs
- XAMPP documentation
- Project README.md file
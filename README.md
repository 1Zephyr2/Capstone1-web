# PAWser - Pet Appointment and Workflow Service & Records System

**Capstone Project** - A comprehensive web-based pet clinic management system built with Laravel. PAWser streamlines pet registration, owner records, appointments, visit documentation, clinic operations, and administrative tasks for veterinary and pet care teams.

## Table of Contents
- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation Options](#installation-options)
- [User Accounts](#user-accounts)
- [Usage Guide](#usage-guide)
- [Demo Instructions](#demo-instructions)
- [Technical Details](#technical-details)
- [License](#license)

## Features

### **Pet Records Management**
- Pet registration and profile management
- Search and filter pets by name, owner, ID, or birthday
- Owner and emergency contact information
- Pet history and visit tracking

### **Appointment System**
- Schedule appointments for clinic and grooming services
- Calendar view for appointment management
- Service-specific scheduling and notes
- Appointment status tracking (scheduled, confirmed, completed, cancelled)

### **Clinic Services**
- **General Checkups**: Routine pet assessments and consultation records
- **Vaccination Tracking**: Immunization and follow-up monitoring
- **Visit Records**: Notes, history, and previous visit reference
- **Owner Support**: Linked owner details across multiple pets

### **Insight Center**
- Pet and appointment statistics
- Visit trends and service patterns
- Owner and pet record insights
- Operational summaries for staff and admins
- Export-ready reports for clinic review

### **Administration**
- User account management (Admin and Staff)
- System settings and configuration
- Data privacy conscious reporting
- Audit logging and security

### **Action Hub**
- Alert system for incomplete records
- Upcoming appointment monitoring
- No-show and incomplete record alerts
- Workflow-focused clinic reminders

## System Requirements

- **PHP**: 8.1 or higher
- **Database**: MySQL 8.0+ or SQLite
- **Web Server**: Apache or Nginx
- **Node.js**: 16+ (for frontend assets)
- **Composer**: PHP dependency manager

## Installation Options

### Option 1: Laravel Development Server (Quick Start)

1. **Clone the repository:**
   ```bash
   git clone https://github.com/1Zephyr2/Capstone1-web.git
   cd Capstone1-web
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Start the server:**
   ```bash
   php artisan serve
   ```

6. **Access the system:** http://localhost:8000

### Option 2: XAMPP Setup (Recommended for Demos)

1. **Start XAMPP services:**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL**

2. **Create database:**
   - Go to http://localhost/phpmyadmin
   - Create new database: `pawser_db`

3. **Copy project to XAMPP:**
   ```bash
   # Copy entire project folder to:
   C:\xampp\htdocs\Capstone1-web\
   ```

4. **Update environment:**
   ```env
   # Edit .env file
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pawser_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Setup database:**
   ```bash
   php artisan config:clear
   php artisan migrate
   ```

6. **Access the system:** http://localhost/Capstone1-web/public

## User Accounts

### Default Login Credentials

| Role | Username | Password | Access Level |
|------|----------|----------|-------------|
| **Administrator** | `admin` | `admin123` | Full system access, user management |
| **Clinic Staff** | `staff` | `staff123` | Pet records, appointments, visit workflow |

### Role Permissions

- **Administrator**: Complete system access, user management, system settings
- **Staff**: Pet records, appointments, visit management, and reporting

## Usage Guide

### For Clinic Staff

1. **Pet Registration:**
   - Navigate to "Pet List" → "Register New Pet"
   - Fill in pet details (name, species, birthdate, sex)
   - Add owner details and emergency contacts

2. **Scheduling Appointments:**
   - Go to "Book Appointment"
   - Select pet (or register new)
   - Choose service type and date/time
   - Add reason for visit and notes

3. **Recording Visits:**
   - Access "Today's Visits"
   - Document observations and visit notes
   - Update pet records
   - Schedule follow-up appointments

4. **Viewing Insights:**
   - Navigate to "Insight Center"
   - Review pet and appointment statistics
   - View visit trends and summaries
   - Export data for external use

### For Administrators

1. **User Management:**
   - Access admin dashboard via `/admin/dashboard`
   - Add new staff accounts
   - Modify user roles and permissions
   - Monitor user activity

2. **System Configuration:**
   - Update clinic information
   - Configure system settings
   - Manage data retention policies
   - Review Action Hub alerts

## Demo Instructions

### Quick Demo Setup

1. **Start XAMPP** (Apache + MySQL)
2. **Access Application:** http://localhost/Capstone1-web/public
3. **Login as Admin:** admin/admin123
4. **Show phpMyAdmin:** http://localhost/phpmyadmin

### Demo Flow

1. **Login Demo:** Show different user roles and dashboards
2. **Pet Management:** Register new pet, search existing records
3. **Appointment Booking:** Schedule various services
4. **Database View:** Show data in phpMyAdmin tables
5. **Insight Center:** Generate and view analytics
6. **Admin Functions:** User management and system overview

### Reset Demo Data

```sql
-- In phpMyAdmin, run these queries to reset:
TRUNCATE patients;
TRUNCATE appointments;
TRUNCATE visits;

-- Keep users table for login accounts
```

## Technical Details

### Built With
- **Backend**: Laravel 12, PHP 8.3+
- **Frontend**: Blade templates, Vanilla JavaScript, CSS3
- **Database**: MySQL/SQLite with Eloquent ORM
- **Security**: Laravel's built-in authentication and validation
- **Icons**: Bootstrap Icons

### Project Structure
```
app/
├── Http/Controllers/     # Application controllers
├── Models/              # Database models
└── Middleware/          # Custom middleware

resources/
├── views/               # Blade templates
├── css/                # Stylesheets
└── js/                 # JavaScript files

database/
├── migrations/         # Database schema
└── seeders/           # Sample data

routes/
└── web.php            # Application routes
```

### Security Features
- User authentication and authorization
- Role-based access control
- Data privacy compliance (anonymized reports)
- Input validation and sanitization
- CSRF protection

### Data Privacy Compliance
- Pet and owner data is restricted to authorized users
- Admin reports show only anonymized statistics
- Audit logging for data access
- Secure password policies

## License

This project is developed as a **capstone project** for educational and pet care operations improvement purposes. Please ensure compliance with applicable local data privacy regulations when deploying in production environments.

## Support

For technical support or questions:
- Check the codebase documentation
- Review Laravel documentation for framework-specific issues
- Ensure proper XAMPP configuration for local development

---

**PAWser** - Streamlining pet appointments, workflow support, and records management.
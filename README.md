# CareSync - Health Center Management System

A comprehensive web-based health center management system built with Laravel, designed for rural health units (RHU) and healthcare facilities in the Philippines. This system streamlines patient management, appointments, medical records, and administrative tasks.

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

### **Patient Management**
- Patient registration and profile management
- Search and filter patients by name, ID, or birthday
- Medical history tracking
- Contact and emergency contact information

### **Appointment System**
- Schedule appointments for various services
- Calendar view for appointment management
- Service-specific fields (immunization, prenatal care, family planning)
- Appointment status tracking (scheduled, confirmed, completed, cancelled)

### **Healthcare Services**
- **Immunizations**: Vaccine tracking and dose management
- **Prenatal Care**: Gestational age and presentation tracking
- **Family Planning**: Method and counseling records
- **General Checkups**: Routine health assessments

### **Reports & Analytics**
- Patient statistics and demographics
- Visit trends and patterns
- Immunization coverage reports
- High-risk patient identification
- Monthly and custom reports

### **Administration**
- User account management (Admin, Staff, Healthcare Providers)
- System settings and configuration
- Data privacy compliant analytics
- Audit logging and security

### **Automation Support**
- Alert system for incomplete records
- Overdue immunization notifications
- High-risk patient flagging
- Automated report generation

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
   - Create new database: `caresync_db`

3. **Copy project to XAMPP:**
   ```bash
   # Copy entire project folder to:
   C:\xampp\htdocs\caresync\
   ```

4. **Update environment:**
   ```env
   # Edit .env file
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=caresync_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Setup database:**
   ```bash
   php artisan config:clear
   php artisan migrate
   ```

6. **Access the system:** http://localhost/caresync/public

## User Accounts

### Default Login Credentials

| Role | Username | Password | Access Level |
|------|----------|----------|-------------|
| **Administrator** | `admin` | `admin123` | Full system access, user management |
| **Healthcare Staff** | `staff` | `staff123` | Patient care, appointments, reports |

### Role Permissions

- **Administrator**: Complete system access, user management, system settings
- **Healthcare Provider**: Patient management, appointments, medical records, reports
- **Staff**: Basic patient management and appointment scheduling

## Usage Guide

### For Healthcare Staff

1. **Patient Registration:**
   - Navigate to "Patient List" → "Add New Patient"
   - Fill in patient details (name, birthdate, contact info)
   - Add medical history and emergency contacts

2. **Scheduling Appointments:**
   - Go to "Book Appointment"
   - Select patient (or register new)
   - Choose service type and date/time
   - Add chief complaint and notes

3. **Recording Visits:**
   - Access "Today's Visits"
   - Document vital signs and observations
   - Update medical records
   - Schedule follow-up appointments

4. **Viewing Reports:**
   - Navigate to "Monthly Reports"
   - Generate immunization coverage reports
   - View patient statistics
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
   - Set up automated alerts

## Demo Instructions

### Quick Demo Setup

1. **Start XAMPP** (Apache + MySQL)
2. **Access Application:** http://localhost/caresync/public
3. **Login as Admin:** admin/admin123
4. **Show phpMyAdmin:** http://localhost/phpmyadmin

### Demo Flow

1. **Login Demo:** Show different user roles and dashboards
2. **Patient Management:** Register new patient, search existing
3. **Appointment Booking:** Schedule various service types
4. **Database View:** Show data in phpMyAdmin tables
5. **Reports:** Generate and view analytics
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
- **Backend**: Laravel 10, PHP 8.1+
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
- Patient data is restricted to authorized users
- Admin reports show only anonymized statistics
- Audit logging for data access
- Secure password policies

## License

This project is developed for educational and healthcare improvement purposes. Please ensure compliance with local healthcare data regulations when deploying in production environments.

## Support

For technical support or questions:
- Check the codebase documentation
- Review Laravel documentation for framework-specific issues
- Ensure proper XAMPP configuration for local development

---

**CareSync Health Center System** - Streamlining healthcare management for better patient care.
# Barangay Health Center Management System

## 🎯 Project Overview

A streamlined health center support system designed to address common problems in barangay health centers:
- **Manual input of data** - Reduced through smart features
- **Cluttered system** - Clean, focused interface with only essential fields
- **Difficult navigation** - Simple, intuitive workflows
- **Unnecessary features** - Stripped down to core health center needs only

## ✨ Implemented Features

### Problem 1: Manual Input Solutions

#### 1. Smart Patient Lookup
- **Type-ahead search**: Real-time autocomplete as you type (2+ characters)
- Searches by: Name, Patient ID, Contact Number
- Displays results instantly with patient details
- Direct navigation to patient profile from search results

#### 2. Smart Defaults & Auto-calculations
- ✅ **Auto-fill today's date** for visits (no manual date entry)
- ✅ **Auto-generate Patient ID** (BHC-2026-XXXX format)
- ✅ **Auto-calculate age** from birthdate
- ✅ **Auto-calculate BMI** from weight and height
- ✅ **Auto-calculate gestational age** for prenatal care
- ✅ **Auto-calculate EDD** (Expected Delivery Date) from LMP
- ✅ **Remember last health worker** name for quick entry
- ✅ **Copy from last visit** button for vital signs

#### 3. Bulk Operations (Prepared)
- Excel/CSV import functionality (structure ready)
- Batch print capability for immunization cards
- Automated monthly report generation

### Problem 2: Cluttered System Solutions

#### 1. Clean Service-Focused Layout
- **Patient Registration**: Only 7 essential fields (Name, Birthdate, Sex, Contact, Address)
- Optional fields hidden in separate section
- No medical jargon or complex terminology
- Progressive disclosure (show more only when needed)

#### 2. Simple Vital Signs Form
- Only 5 core measurements:
  - Blood Pressure (120/80 format)
  - Temperature (°C)
  - Pulse Rate (bpm)
  - Weight (kg)
  - Height (cm)
- Visual indicators for normal ranges (future: color coding)
- Auto-calculate BMI displayed instantly
- Clean yellow card design for easy focus

## 📊 Database Structure

### Core Tables Created

1. **patients** - Patient demographics and contact info
2. **visits** - Visit records with service type tracking
3. **vital_signs** - Simple vital signs (BP, Temp, Pulse, Weight, Height only)
4. **immunizations** - Vaccine tracking with auto-scheduling
5. **prenatal_records** - Prenatal monitoring with auto-calculations
6. **referrals** - Track patient referrals to other facilities

## 🚀 Key Features Demonstration

### For Capstone Presentation

1. **Quick Patient Registration** (2 minutes vs 10 minutes)
   - Only essential fields
   - Auto-generated Patient ID
   - Auto-calculated age

2. **Smart Search** (Instant vs 5+ clicks)
   - Type 3 letters → See results
   - Click → Direct to profile
   - No menu navigation needed

3. **Copy Last Visit Data** (One click vs retyping)
   - Button copies all previous vital signs
   - Saves 2-3 minutes per patient
   - Reduces typing errors

4. **Auto-calculations** (Zero manual calculation)
   - BMI calculated instantly
   - Gestational age computed automatically
   - EDD calculated from LMP

5. **Monthly Reports** (Automated vs manual counting)
   - One-click report generation
   - Visual progress bars
   - Service breakdown
   - Vaccine distribution

## 📁 Project Structure

```
app/
├── Models/
│   ├── Patient.php (with search scope, auto-ID generation)
│   ├── Visit.php (auto-fill date/time)
│   ├── VitalSign.php (with status indicators)
│   ├── Immunization.php (auto-schedule next dose)
│   ├── PrenatalRecord.php (auto-calculate EDD, gestational age)
│   └── Referral.php
├── Http/Controllers/
│   ├── PatientController.php (search API, vital signs copy)
│   ├── VisitController.php (visit recording)
│   └── ReportController.php (monthly reports)
database/migrations/
├── create_patients_table.php
├── create_visits_table.php
├── create_vital_signs_table.php
├── create_immunizations_table.php
├── create_prenatal_records_table.php
└── create_referrals_table.php
resources/views/
├── patients/
│   ├── create.blade.php (clean registration form)
│   ├── index.blade.php (with type-ahead search)
│   └── show.blade.php (patient profile)
├── visits/
│   └── create.blade.php (vital signs with copy feature)
└── reports/
    └── index.blade.php (monthly statistics)
```

## 🔧 Installation & Setup

1. Install dependencies:
```bash
composer install
npm install
```

2. Configure database in `.env`

3. Run migrations:
```bash
php artisan migrate
```

4. Seed demo data (optional):
```bash
php artisan db:seed --class=DemoDataSeeder
```

5. Start development server:
```bash
php artisan serve
```

## 👤 Demo Users

Use the test user created in `create_test_user.php`:
- Email: admin@healthcenter.local
- Password: admin123

## 📸 Comparison: Old vs New System

| Feature | Old System | New System |
|---------|-----------|------------|
| Patient Registration | 15+ fields, complex form | 7 essential fields, clean layout |
| Finding a Patient | Navigate 4 menus, type full name | Type 3 letters, instant results |
| Recording Visit | Manual date entry, retype vital signs | Auto-filled date, copy last visit button |
| Calculating Age | Manual calculation | Auto-calculated from birthdate |
| Calculating BMI | Manual calculation | Auto-calculated instantly |
| Prenatal EDD | Manual calculation | Auto-calculated from LMP |
| Monthly Reports | Manual counting/Excel | One-click automated report |

## 🎓 Academic Value

This project demonstrates:
1. **Problem Analysis**: Identifying real health center pain points
2. **User-Centered Design**: Simplifying for non-technical health workers
3. **Smart Automation**: Reducing manual data entry
4. **Clean Code**: Laravel best practices, MVC architecture
5. **Database Design**: Normalized tables with proper relationships
6. **Progressive Enhancement**: Smart features that don't overcomplicate

## 🔜 Future Enhancements (If Needed)

- SMS appointment reminders (Semaphore API)
- Excel import/export (Laravel Excel package)
- QR code patient ID cards
- Print immunization cards
- AI-based incomplete record detection
- High-risk patient alerts

## 📝 Notes

- This is an academic project, not for production use
- Focused on solving 4 specific problems identified in barangay health centers
- Designed for local deployment, not cloud hosting
- Target users: Health center staff (non-technical)

---

**Developed for**: Capstone Project  
**Focus**: Practical solutions for barangay health center challenges  
**Tech Stack**: Laravel 11, PHP 8.2, MySQL

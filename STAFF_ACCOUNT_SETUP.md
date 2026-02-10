# Staff Account Setup Instructions

## Step 1: Run Migration to Add Staff Role

Open your terminal in the capstone directory and run:

```bash
php artisan migrate
```

This will update the users table to include the 'staff' role option.

## Step 2: Create Staff User Account

Run the seeder to create the staff account:

```bash
php artisan db:seed --class=StaffUserSeeder
```

## Staff Login Credentials

After running the seeder, you can login with:

- **Username**: `staff`
- **Password**: `staff123`
- **Email**: `staff@healthcenter.com`

## Role Permissions

The system now has three user roles:

1. **Admin** - Full system access including user management
2. **Staff** - Standard access for appointment booking, patient management, etc.
3. **Healthcare Provider** - Standard healthcare worker access

## Available Helper Methods

The User model now includes these helper methods:

```php
$user->isAdmin()              // Check if user is admin
$user->isStaff()              // Check if user is staff
$user->isHealthcareProvider() // Check if user is healthcare provider
$user->hasStaffAccess()       // Check if user is admin OR staff
```

## Security Note

**IMPORTANT**: After your first login, please change the default password to something secure!

You can change it in your profile settings once logged in.

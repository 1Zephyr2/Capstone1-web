# XAMPP Setup Guide for CareSync

**Complete beginner-friendly guide to set up CareSync with XAMPP for offline demos**

## What You'll Need
- XAMPP (already installed on your computer)
- Your CareSync project folder
- About 15 minutes

## Why Use XAMPP?
- **Works offline** - Perfect for demos without internet
- **Shows database** - You can see data being saved in real-time
- **Professional setup** - More like real web hosting
- **Easy to reset** - Quick demo data cleanup between presentations

---

## Step-by-Step Setup

### **Step 1: Start XAMPP** 
1. **Find XAMPP Control Panel** on your desktop or Start menu
2. **Click to open** the XAMPP Control Panel
3. You'll see a window with several services listed

   ![XAMPP Control Panel](https://via.placeholder.com/500x200/f0f0f0/333333?text=XAMPP+Control+Panel)

4. **Click "Start"** next to **Apache** 
   - Wait for it to turn **green** and show "Running"
5. **Click "Start"** next to **MySQL**
   - Wait for it to turn **green** and show "Running"

**Success**: Both Apache and MySQL should show green "Running" status

### **Step 2: Create Your Database**
1. **Open your web browser**
2. **Type in address bar**: `http://localhost/phpmyadmin`
3. **Press Enter** - You'll see phpMyAdmin interface
4. **Click "New"** in the left sidebar
5. **Type database name**: `caresync_db`
6. **Click "Create"** button

**Success**: You should see "caresync_db" in the left sidebar

### **Step 3: Move Your Project to XAMPP**
1. **Open File Explorer**
2. **Navigate to**: `C:\xampp\htdocs\`
3. **Copy your entire CareSync project folder** into this directory
4. **Rename the folder** to `caresync`
5. **Final path should be**: `C:\xampp\htdocs\caresync\`

### **Step 4: Configure CareSync for XAMPP**
1. **Open your project folder**: `C:\xampp\htdocs\caresync\`
2. **Find the file**: `.env`
3. **Open `.env` with Notepad**
4. **Find these lines and change them**:

   **BEFORE** (original):
   ```
   DB_CONNECTION=sqlite
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=laravel
   # DB_USERNAME=root
   # DB_PASSWORD=
   ```

   **AFTER** (change to this):
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=caresync_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Save the file** (Ctrl+S)

### **Step 5: Set Up Database Tables**
1. **Open Command Prompt** or PowerShell
2. **Navigate to your project**:
   ```
   cd C:\xampp\htdocs\caresync
   ```
3. **Run these commands one by one**:
   ```
   php artisan config:clear
   ```
   ```
   php artisan migrate
   ```
4. **Wait for each command to finish** before running the next

**Success**: You should see "Migration completed successfully" or similar message

### **Step 6: Test Everything Works**
1. **Open your web browser**
2. **Type in address bar**: `http://localhost/caresync/public`
3. **Press Enter**
4. **You should see the CareSync login page**

**Congratulations! XAMPP setup is complete!**

---

## Login and Test

### **Test Login**
- **Username**: `admin`
- **Password**: `admin123`

### **What to Check**
1. Login works
2. Dashboard loads
3. Can create new patients
4. Can book appointments

---

## Demo Day Workflow

### **Before Your Demo**
1. **Start XAMPP** (Apache + MySQL)
2. **Check**: `http://localhost/caresync/public` loads
3. **Prepare demo data** if needed

### **During Demo**
1. **Show the application**: `http://localhost/caresync/public`
2. **Login and demonstrate features**
3. **Show database** (optional): `http://localhost/phpmyadmin`
   - Click "caresync_db" to see tables
   - Click table names to see data

### **After Demo**
1. **Keep XAMPP running** if doing multiple demos
2. **Stop XAMPP** when done (click "Stop" for Apache and MySQL)

---

## Troubleshooting

### **Problem: Can't access localhost/caresync/public**
**Solution**:
1. Check XAMPP - Apache should be green/running
2. Verify folder is at `C:\xampp\htdocs\caresync\`
3. Try: `http://localhost/caresync/public/index.php`

### **Problem: Database connection error**
**Solution**:
1. Check XAMPP - MySQL should be green/running
2. Verify `.env` file has correct database settings
3. Run: `php artisan config:clear`

### **Problem: Login doesn't work**
**Solution**:
1. Check if migrations ran: `php artisan migrate:status`
2. If no users exist, create admin manually:
   ```bash
   php artisan tinker
   ```
   Then type:
   ```php
   User::create(['name' => 'Administrator', 'username' => 'admin', 'email' => 'admin@test.com', 'password' => Hash::make('admin123'), 'role' => 'admin']);
   exit
   ```

### **Problem: Pages look broken (no styling)**
**Solution**:
1. Try: `http://localhost/caresync/public` (include `/public`)
2. Or run: `php artisan storage:link`

---

## Pro Tips for Demos

### **Quick Demo Reset**
1. Go to: `http://localhost/phpmyadmin`
2. Click "caresync_db"
3. Select tables with demo data
4. Click "Empty" to clear data
5. Run: `php artisan db:seed` to add fresh data

### **Show Database During Demo**
1. Open two browser tabs:
   - Tab 1: Your application (`localhost/caresync/public`)
   - Tab 2: phpMyAdmin (`localhost/phpmyadmin`)
2. Create a patient in Tab 1
3. Switch to Tab 2, refresh, show the data was saved!

### **Professional URLs**
- Instead of saying "localhost", say "our local server"
- Point out this works completely offline
- Mention this is how real web applications work

---

## Checklist Before Demo

- [ ] XAMPP is started (Apache + MySQL green)
- [ ] Can access: `http://localhost/caresync/public`
- [ ] Can login with admin/admin123
- [ ] Can create a test patient/appointment
- [ ] phpMyAdmin accessible at `http://localhost/phpmyadmin`
- [ ] Have explained that this works completely offline

**You're ready to wow your audience!**
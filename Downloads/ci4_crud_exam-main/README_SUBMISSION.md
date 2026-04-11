# Student Profile Page - Submission README

## 📋 Project Information

**Student Name:** [YOUR NAME HERE]  
**Course:** Web Systems & Technologies  
**Activity:** Student Profile Page Programming Activity  
**Date Submitted:** [DATE]

---

## 🗄️ Database Information

**Database Name:** `ci4_crud_exam` (or `starterpanel`)  
**Database File:** `database_export.sql` (included in this submission)

### Database Credentials for Testing:
- **Host:** localhost
- **Username:** root
- **Password:** (empty) or [YOUR PASSWORD]
- **Port:** 3306

---

## 👤 Test User Credentials

### Login Credentials:
- **Username:** [YOUR USERNAME]
- **Password:** [YOUR PASSWORD]

*Note: Use these credentials to login and test the profile feature*

---

## 🚀 How to Run This Project

### Step 1: Extract the ZIP file
Extract `LASTNAME_FIRSTNAME_ProfileActivity.zip` to your web server directory:
- XAMPP: `C:\xampp\htdocs\`
- WAMP: `C:\wamp64\www\`
- Laragon: `C:\laragon\www\`

### Step 2: Import the Database
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create a new database (if needed) or select existing database
3. Click "Import" tab
4. Choose the `database_export.sql` file
5. Click "Go"

### Step 3: Configure Environment
1. Copy `env` to `.env` (if not already done)
2. Update database settings in `.env`:
   ```
   database.default.hostname = localhost
   database.default.database = ci4_crud_exam
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

### Step 4: Start the Server
Open terminal/command prompt in project folder and run:
```bash
php spark serve
```

### Step 5: Access the Application
Open browser and go to: `http://localhost:8080`

---

## ✨ Features Implemented

### 1. Profile Display Page (`/profile`)
- ✅ Shows user profile photo or placeholder
- ✅ Displays all student information
- ✅ Shows student ID, course, year level, section
- ✅ Displays phone number and address
- ✅ Shows account creation and update timestamps
- ✅ "Edit Profile" button

### 2. Profile Edit Page (`/profile/edit`)
- ✅ Pre-populated form with current user data
- ✅ File upload for profile image
- ✅ Live image preview using JavaScript
- ✅ All fields editable
- ✅ Validation with error messages
- ✅ Bootstrap styling

### 3. Profile Update Functionality
- ✅ Server-side validation
- ✅ Image upload with security checks
- ✅ File type validation (JPG, PNG, WEBP)
- ✅ File size limit (2MB)
- ✅ Old image deletion when replaced
- ✅ Unique filename generation
- ✅ Session update after changes
- ✅ Success message display

---

## 📁 Files Created/Modified

### New Files Created:
1. `profile_migration.sql` - Database migration
2. `app/Models/UserModel.php` - User model
3. `app/Controllers/ProfileController.php` - Profile controller
4. `app/Views/profile/show.php` - Profile display view
5. `app/Views/profile/edit.php` - Profile edit view
6. `public/uploads/profiles/` - Image upload directory

### Modified Files:
1. `app/Config/Routes.php` - Added profile routes
2. `app/Views/layouts/header.php` - Updated profile link

### Database Changes:
Added 7 columns to `users` table:
- `student_id` VARCHAR(20)
- `course` VARCHAR(100)
- `year_level` TINYINT
- `section` VARCHAR(50)
- `phone` VARCHAR(20)
- `address` TEXT
- `profile_image` VARCHAR(255)

---

## 🧪 Testing Instructions

### Test 1: View Profile
1. Login with provided credentials
2. Click on your name in the header
3. Select "Profile" from dropdown
4. Verify all information displays correctly

### Test 2: Edit Profile
1. From profile page, click "Edit Profile"
2. Verify form is pre-populated
3. Change some information
4. Click "Update Profile"
5. Verify changes are saved

### Test 3: Upload Profile Photo
1. Go to "Edit Profile"
2. Click "Choose File"
3. Select an image (JPG, PNG, or WEBP)
4. Verify live preview appears
5. Click "Update Profile"
6. Verify image appears on profile page

### Test 4: Validation
1. Go to "Edit Profile"
2. Clear required fields (name, username)
3. Click "Update Profile"
4. Verify error messages appear
5. Verify old input is preserved

---

## 🔐 Security Features

- ✅ Authentication required for all profile routes
- ✅ CSRF protection on forms
- ✅ Server-side input validation
- ✅ File upload validation (type, size, MIME)
- ✅ SQL injection prevention via Model
- ✅ XSS prevention with esc() function
- ✅ Unique filename generation
- ✅ Old file cleanup

---

## 📊 Routes Implemented

```php
GET  /profile              - Display user profile
GET  /profile/edit         - Show edit form
POST /profile/update       - Process form submission
```

---

## 💾 Database Schema

### users table (updated):
```sql
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(5) UNSIGNED NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year_level` tinyint(4) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

---

## 📸 Screenshots Location

Profile images are stored in:
```
public/uploads/profiles/
```

Image naming convention:
```
avatar_{userId}_{timestamp}.{extension}
```

Example: `avatar_1_1234567890.jpg`

---

## 🛠️ Technology Stack

- **Framework:** CodeIgniter 4.6.1
- **PHP Version:** 8.4
- **Database:** MySQL/MariaDB
- **Frontend:** Bootstrap 5
- **JavaScript:** Vanilla JS (FileReader API)

---

## 📝 Notes

- All profile images are stored in `public/uploads/profiles/`
- Database only stores the filename, not binary data
- Maximum image size: 2MB
- Supported formats: JPG, JPEG, PNG, WEBP
- Old images are automatically deleted when replaced
- Session is updated immediately after profile update

---

## ✅ Submission Checklist

- [x] Database migration executed
- [x] All files created and modified
- [x] Profile display page working
- [x] Profile edit page working
- [x] Image upload working
- [x] Validation working
- [x] Database exported
- [x] README created
- [x] Project zipped

---

## 🎯 Learning Objectives Achieved

✅ **Session-aware queries** - Profile tied to logged-in user  
✅ **HTTP file uploads** - Secure image upload handling  
✅ **Database persistence** - File references stored in database  
✅ **Full-stack development** - Backend + Frontend integration  
✅ **Security best practices** - Validation, sanitization, protection  

---

## 📞 Contact Information

**Student:** [YOUR NAME]  
**Email:** [YOUR EMAIL]  
**Student ID:** [YOUR STUDENT ID]

---

**Thank you for reviewing my submission!** 🎓

*This project demonstrates a complete implementation of a Student Profile Page with secure file upload, validation, and session management in CodeIgniter 4.*

# Student Profile Page Implementation Guide

## Overview
This implementation adds a complete Student Profile Page feature to your CodeIgniter 4 application, allowing logged-in students to view and update their personal information including profile photos.

## Files Created/Modified

### Created Files:
1. `profile_migration.sql` - Database migration to add profile columns
2. `app/Models/UserModel.php` - New model for user operations
3. `app/Controllers/ProfileController.php` - Controller with show, edit, update methods
4. `app/Views/profile/show.php` - Profile display page
5. `app/Views/profile/edit.php` - Profile edit form with live image preview
6. `public/uploads/profiles/` - Directory for storing profile images

### Modified Files:
1. `app/Config/Routes.php` - Added profile routes
2. `app/Views/layouts/header.php` - Updated Profile link

## Installation Steps

### Step 1: Run Database Migration
Open your MySQL client (phpMyAdmin or terminal) and run:

```bash
mysql -u root -p ci4_crud_exam < profile_migration.sql
```

Or manually execute the SQL:
```sql
ALTER TABLE users
ADD COLUMN student_id VARCHAR(20) AFTER role,
ADD COLUMN course VARCHAR(100) AFTER student_id,
ADD COLUMN year_level TINYINT AFTER course,
ADD COLUMN section VARCHAR(50) AFTER year_level,
ADD COLUMN phone VARCHAR(20) AFTER section,
ADD COLUMN address TEXT AFTER phone,
ADD COLUMN profile_image VARCHAR(255) AFTER address;
```

### Step 2: Verify Directory Structure
Ensure the following directory exists with write permissions:
```
public/uploads/profiles/
```

### Step 3: Test the Application
1. Start your development server:
   ```bash
   php spark serve
   ```

2. Login to your application

3. Click on your user dropdown in the header and select "Profile"

4. You should see your profile page with all your information

5. Click "Edit Profile" to update your details and upload a profile photo

## Features Implemented

### 1. Profile Display (show.php)
- Displays user profile photo (or placeholder if none)
- Shows all student information in a clean layout
- Student ID, Course, Year Level, Section
- Phone number and address
- Account creation and last update timestamps
- "Edit Profile" button

### 2. Profile Edit Form (edit.php)
- Pre-populated form with current user data
- File upload for profile image with validation
- Live image preview using JavaScript FileReader
- Bootstrap validation styling
- All fields properly validated
- Maintains old input on validation errors

### 3. Profile Update (ProfileController::update)
- Server-side validation for all fields
- Image upload handling with security checks
- File type validation (JPG, PNG, WEBP)
- File size limit (2MB)
- Old image deletion when new image uploaded
- Unique filename generation
- Session update to reflect changes immediately
- Success message on update

## Security Features

1. **File Upload Security:**
   - File type validation (images only)
   - File size limit (2MB)
   - Unique filename generation
   - Files stored outside application root

2. **Input Validation:**
   - All inputs sanitized with esc()
   - CSRF protection enabled
   - Server-side validation rules
   - SQL injection prevention via Model

3. **Access Control:**
   - Routes protected by authentication
   - Users can only edit their own profile
   - Session validation

## Usage

### Accessing Profile:
- Click on user dropdown in header → "Profile"
- Or navigate to: `http://localhost:8080/profile`

### Editing Profile:
- From profile page, click "Edit Profile"
- Or navigate to: `http://localhost:8080/profile/edit`

### Uploading Profile Photo:
1. Click "Choose File" in the edit form
2. Select an image (JPG, PNG, or WEBP, max 2MB)
3. Preview appears immediately
4. Click "Update Profile" to save

## Database Schema

New columns added to `users` table:
- `student_id` VARCHAR(20) - Student identification number
- `course` VARCHAR(100) - Academic course (BSIT, BSCS, etc.)
- `year_level` TINYINT - Year level (1-5)
- `section` VARCHAR(50) - Class section
- `phone` VARCHAR(20) - Contact number
- `address` TEXT - Home address
- `profile_image` VARCHAR(255) - Filename of uploaded image

## Validation Rules

### Required Fields:
- Full Name (minimum 3 characters)
- Username (must be unique, excluding current user)

### Optional Fields:
- Student ID (max 20 characters)
- Course (max 100 characters)
- Year Level (1-5)
- Section (max 50 characters)
- Phone (max 20 characters)
- Address (text)

### Image Upload:
- File types: JPG, JPEG, PNG, WEBP
- Max size: 2MB (2048KB)
- Validated on server-side

## Troubleshooting

### Issue: Profile image not uploading
**Solution:** Ensure `public/uploads/profiles/` directory exists and has write permissions

### Issue: Validation errors not showing
**Solution:** Check that session is properly configured in `app/Config/Session.php`

### Issue: Old image not deleted
**Solution:** Verify file permissions on `public/uploads/profiles/` directory

### Issue: Routes not working
**Solution:** Clear route cache with `php spark cache:clear`

## Code Highlights

### Live Image Preview (JavaScript)
```javascript
document.getElementById('profile_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
```

### Unique Email Validation
```php
'username' => "required|is_unique[users.username,id,{$userId}]"
```
This ensures username is unique but excludes the current user from the check.

### Image Upload with Old File Deletion
```php
if (!empty($user['profile_image'])) {
    $oldImagePath = FCPATH . 'uploads/profiles/' . $user['profile_image'];
    if (file_exists($oldImagePath)) {
        unlink($oldImagePath);
    }
}
```

## Next Steps

Consider adding these enhancements:
1. Password change functionality
2. Email verification
3. Image cropping/resizing
4. Multiple image formats support
5. Profile completion percentage
6. Social media links
7. Privacy settings

## Support

For issues or questions:
1. Check CodeIgniter 4 documentation: https://codeigniter.com/user_guide/
2. Review validation rules: https://codeigniter.com/user_guide/libraries/validation.html
3. File upload guide: https://codeigniter.com/user_guide/libraries/uploaded_files.html

---
**Implementation Complete!** ✅

All files have been created and configured. Run the database migration and start testing your new Student Profile Page feature.

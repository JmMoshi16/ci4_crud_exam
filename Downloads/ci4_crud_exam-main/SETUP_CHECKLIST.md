# Student Profile Page - Quick Setup Checklist

## ✅ Files Created

- [x] `profile_migration.sql` - Database migration file
- [x] `app/Models/UserModel.php` - User model with profile fields
- [x] `app/Controllers/ProfileController.php` - Profile controller (show, edit, update)
- [x] `app/Views/profile/show.php` - Profile display page
- [x] `app/Views/profile/edit.php` - Profile edit form
- [x] `public/uploads/profiles/` - Image upload directory

## ✅ Files Modified

- [x] `app/Config/Routes.php` - Added 3 profile routes
- [x] `app/Views/layouts/header.php` - Updated Profile link

## 🚀 Setup Steps (DO THESE NOW)

### 1. Run Database Migration
```bash
# Option A: Using MySQL command line
mysql -u root -p ci4_crud_exam < profile_migration.sql

# Option B: Using phpMyAdmin
# - Open phpMyAdmin
# - Select your database (ci4_crud_exam)
# - Go to SQL tab
# - Copy and paste the contents of profile_migration.sql
# - Click "Go"
```

### 2. Verify Directory Permissions
```bash
# Make sure this directory is writable
public/uploads/profiles/
```

### 3. Start Development Server
```bash
php spark serve
```

### 4. Test the Feature
1. Navigate to: http://localhost:8080
2. Login with your credentials
3. Click on your name in the header → "Profile"
4. View your profile
5. Click "Edit Profile"
6. Update your information
7. Upload a profile photo
8. Click "Update Profile"

## 📋 Feature Checklist

### Profile Display Page (/profile)
- [ ] Shows profile photo or placeholder
- [ ] Displays student ID
- [ ] Shows course and year level
- [ ] Shows section
- [ ] Displays phone number
- [ ] Shows address
- [ ] Shows account creation date
- [ ] Shows last update date
- [ ] "Edit Profile" button works

### Profile Edit Page (/profile/edit)
- [ ] Form is pre-populated with current data
- [ ] All fields are editable
- [ ] File upload input present
- [ ] Live image preview works
- [ ] Validation errors display properly
- [ ] Old input is preserved on error
- [ ] Cancel button returns to profile

### Profile Update Functionality
- [ ] Form submits successfully
- [ ] Validation works (required fields)
- [ ] Image uploads successfully
- [ ] Old image is deleted when new one uploaded
- [ ] Success message appears
- [ ] Redirects to profile page
- [ ] Session updates with new data
- [ ] Header shows updated name

## 🔍 Testing Scenarios

### Test 1: View Profile
1. Login
2. Click Profile link
3. Verify all fields display correctly

### Test 2: Edit Without Image
1. Go to Edit Profile
2. Change name, course, etc.
3. Don't upload image
4. Submit form
5. Verify changes saved

### Test 3: Upload Profile Image
1. Go to Edit Profile
2. Click "Choose File"
3. Select an image
4. Verify preview appears
5. Submit form
6. Verify image appears on profile page

### Test 4: Replace Profile Image
1. Go to Edit Profile (with existing image)
2. Upload new image
3. Submit form
4. Verify old image deleted from server
5. Verify new image appears

### Test 5: Validation Errors
1. Go to Edit Profile
2. Clear required fields (name, username)
3. Submit form
4. Verify error messages appear
5. Verify old input preserved

### Test 6: Invalid Image Upload
1. Go to Edit Profile
2. Try uploading PDF or large file (>2MB)
3. Verify validation error

## 🐛 Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Routes not found | Run `php spark cache:clear` |
| Image not uploading | Check `public/uploads/profiles/` exists and is writable |
| Validation errors not showing | Verify session is configured properly |
| Old image not deleted | Check file permissions on uploads directory |
| Preview not working | Check browser console for JavaScript errors |

## 📁 File Structure

```
CI4-StarterPanel-Final/
├── app/
│   ├── Config/
│   │   └── Routes.php (modified)
│   ├── Controllers/
│   │   └── ProfileController.php (new)
│   ├── Models/
│   │   └── UserModel.php (new)
│   └── Views/
│       ├── layouts/
│       │   └── header.php (modified)
│       └── profile/
│           ├── show.php (new)
│           └── edit.php (new)
├── public/
│   └── uploads/
│       └── profiles/ (new)
│           └── index.html
└── profile_migration.sql (new)
```

## 🎯 Routes Added

```php
$routes->get('/profile', 'ProfileController::show');
$routes->get('/profile/edit', 'ProfileController::edit');
$routes->post('/profile/update', 'ProfileController::update');
```

## 💾 Database Columns Added

```sql
student_id VARCHAR(20)
course VARCHAR(100)
year_level TINYINT
section VARCHAR(50)
phone VARCHAR(20)
address TEXT
profile_image VARCHAR(255)
```

## ✨ Key Features

1. **Session-Aware Queries** - Profile tied to logged-in user
2. **Secure File Upload** - Validation, size limits, type checking
3. **Database Storage** - Only filename stored, not binary data
4. **Live Preview** - JavaScript FileReader for instant feedback
5. **Old File Cleanup** - Automatic deletion of replaced images
6. **Bootstrap Styling** - Clean, responsive UI
7. **Validation** - Server-side with error display
8. **CSRF Protection** - Built-in security

## 📝 Notes

- Profile images stored in: `public/uploads/profiles/`
- Max image size: 2MB
- Allowed formats: JPG, PNG, WEBP
- All routes protected by authentication
- Session automatically updated after profile update

---

**Ready to test!** Follow the setup steps above and start using your new Student Profile Page feature.

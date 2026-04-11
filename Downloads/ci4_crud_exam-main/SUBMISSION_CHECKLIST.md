# 📦 SUBMISSION CHECKLIST

## Before You Submit - Complete These Steps!

---

## ✅ STEP 1: Run the Database Migration

- [ ] Open phpMyAdmin (`http://localhost/phpmyadmin`)
- [ ] Select your database
- [ ] Go to SQL tab
- [ ] Copy and paste SQL from `profile_migration.sql`
- [ ] Click "Go"
- [ ] Verify 7 new columns added to `users` table

**OR run this command:**
```bash
mysql -u root -p ci4_crud_exam < profile_migration.sql
```

---

## ✅ STEP 2: Test All Features

### Test Profile Display:
- [ ] Login to the application
- [ ] Click your name in header → "Profile"
- [ ] Verify profile page loads
- [ ] Check all fields display correctly
- [ ] Verify "Edit Profile" button works

### Test Profile Edit:
- [ ] Click "Edit Profile"
- [ ] Verify form is pre-populated
- [ ] Verify all fields are editable
- [ ] Click "Cancel" - should return to profile

### Test Profile Update:
- [ ] Go to "Edit Profile"
- [ ] Change some information
- [ ] Click "Update Profile"
- [ ] Verify success message appears
- [ ] Verify changes are saved
- [ ] Verify header name updates

### Test Image Upload:
- [ ] Go to "Edit Profile"
- [ ] Click "Choose File"
- [ ] Select an image (JPG, PNG, or WEBP)
- [ ] Verify live preview appears
- [ ] Click "Update Profile"
- [ ] Verify image appears on profile page
- [ ] Check `public/uploads/profiles/` folder has the image

### Test Image Replace:
- [ ] Go to "Edit Profile" (with existing image)
- [ ] Upload a different image
- [ ] Click "Update Profile"
- [ ] Verify new image appears
- [ ] Verify old image was deleted from folder

### Test Validation:
- [ ] Go to "Edit Profile"
- [ ] Clear the "Full Name" field
- [ ] Click "Update Profile"
- [ ] Verify error message appears
- [ ] Verify form preserves other values

### Test Invalid File Upload:
- [ ] Go to "Edit Profile"
- [ ] Try uploading a PDF or TXT file
- [ ] Verify validation error appears
- [ ] Try uploading image larger than 2MB
- [ ] Verify size error appears

---

## ✅ STEP 3: Export Your Database

### Using phpMyAdmin:
- [ ] Open phpMyAdmin
- [ ] Click on your database name
- [ ] Click "Export" tab at the top
- [ ] Select "Quick" export method
- [ ] Format: SQL
- [ ] Click "Go"
- [ ] Save as `database_export.sql`
- [ ] Move file to project root folder

### Using Command Line:
```bash
mysqldump -u root -p ci4_crud_exam > database_export.sql
```

---

## ✅ STEP 4: Update README_SUBMISSION.md

- [ ] Open `README_SUBMISSION.md`
- [ ] Replace `[YOUR NAME HERE]` with your actual name
- [ ] Replace `[DATE]` with today's date
- [ ] Update database name if different
- [ ] Add your MySQL password if you have one
- [ ] Add test user credentials (username/password)
- [ ] Add your email and student ID at the bottom
- [ ] Save the file

---

## ✅ STEP 5: Verify All Files Are Present

### Required Files (Created):
- [ ] `profile_migration.sql`
- [ ] `app/Models/UserModel.php`
- [ ] `app/Controllers/ProfileController.php`
- [ ] `app/Views/profile/show.php`
- [ ] `app/Views/profile/edit.php`
- [ ] `public/uploads/profiles/` directory exists
- [ ] `database_export.sql` (your exported database)
- [ ] `README_SUBMISSION.md` (updated with your info)

### Modified Files:
- [ ] `app/Config/Routes.php` (has profile routes)
- [ ] `app/Views/layouts/header.php` (profile link updated)

### Optional Documentation (Helpful):
- [ ] `SETUP_CHECKLIST.md`
- [ ] `STUDENT_PROFILE_IMPLEMENTATION.md`
- [ ] `IMPLEMENTATION_COMPLETE.md`
- [ ] `FLOW_DIAGRAM.md`

---

## ✅ STEP 6: Clean Up (Optional but Recommended)

### Remove Unnecessary Files:
- [ ] Delete `writable/debugbar/*.json` files
- [ ] Delete `writable/logs/*.log` files (optional)
- [ ] Delete `writable/session/ci_session*` files
- [ ] Keep `writable/cache/` empty

### Check .env File:
- [ ] Verify `.env` file exists
- [ ] Check database credentials are correct
- [ ] Make sure `CI_ENVIRONMENT = production` or `development`

---

## ✅ STEP 7: Create the ZIP File

### What to Include:
- [ ] Entire project folder
- [ ] `database_export.sql` in root
- [ ] `README_SUBMISSION.md` in root
- [ ] All uploaded profile images in `public/uploads/profiles/`

### What to Exclude (Optional):
- [ ] `vendor/` folder (can be regenerated with `composer install`)
- [ ] `node_modules/` folder (if exists)
- [ ] `.git/` folder (if exists)

### Create ZIP:
1. [ ] Right-click on project folder
2. [ ] Select "Send to" → "Compressed (zipped) folder"
3. [ ] Rename to: `LASTNAME_FIRSTNAME_ProfileActivity.zip`

**Example:** `RICARO_DANNY_ProfileActivity.zip`

---

## ✅ STEP 8: Verify ZIP File

- [ ] Extract ZIP to a test location
- [ ] Verify all files are present
- [ ] Check `database_export.sql` is included
- [ ] Check `README_SUBMISSION.md` has your information
- [ ] Verify file size is reasonable (not too large)

---

## ✅ STEP 9: Final Checks

- [ ] Test login credentials work
- [ ] Profile page loads without errors
- [ ] Image upload works
- [ ] All validation works
- [ ] No PHP errors or warnings
- [ ] Database export is complete
- [ ] README has all required information

---

## ✅ STEP 10: Submit

- [ ] Go to class portal
- [ ] Upload `LASTNAME_FIRSTNAME_ProfileActivity.zip`
- [ ] Verify upload completed successfully
- [ ] Note submission time
- [ ] Keep a backup copy

---

## 🎯 Quick Verification Commands

### Check if migration ran:
```sql
DESCRIBE users;
-- Should show: student_id, course, year_level, section, phone, address, profile_image
```

### Check if routes work:
```bash
php spark routes
-- Should show: GET /profile, GET /profile/edit, POST /profile/update
```

### Check if uploads directory exists:
```bash
dir public\uploads\profiles
-- Should show directory contents
```

---

## 📋 Submission Requirements Summary

| Requirement | Status |
|-------------|--------|
| Entire CI4 project folder | [ ] |
| Named: LASTNAME_FIRSTNAME_ProfileActivity.zip | [ ] |
| Database exported as .sql file | [ ] |
| README with database name | [ ] |
| README with login credentials | [ ] |
| Uploaded to class portal | [ ] |
| Before end of session | [ ] |
| Ready to demonstrate live | [ ] |

---

## 🚨 Common Mistakes to Avoid

- ❌ Forgetting to run the database migration
- ❌ Not exporting the database
- ❌ Not updating README with your information
- ❌ Wrong ZIP file naming format
- ❌ Missing `database_export.sql` file
- ❌ Not testing before submission
- ❌ Submitting without profile images
- ❌ Forgetting to include `.env` file

---

## ✅ Pre-Submission Test

Run through this quick test:

1. [ ] Extract your ZIP to a new folder
2. [ ] Import `database_export.sql`
3. [ ] Update `.env` with database credentials
4. [ ] Run `php spark serve`
5. [ ] Login with credentials from README
6. [ ] Navigate to `/profile`
7. [ ] Click "Edit Profile"
8. [ ] Upload an image
9. [ ] Verify everything works

**If all steps pass, you're ready to submit!** ✅

---

## 📞 Need Help?

If you encounter issues:

1. Check `writable/logs/` for error messages
2. Verify database connection in `.env`
3. Make sure all files are present
4. Test in a fresh browser window
5. Clear browser cache if needed

---

## 🎓 Demonstration Preparation

Be ready to show:

1. **Profile Display Page**
   - Show your profile with all information
   - Point out profile image

2. **Profile Edit Page**
   - Show pre-populated form
   - Demonstrate live image preview

3. **Profile Update**
   - Change some information
   - Upload a new image
   - Show success message

4. **Validation**
   - Show error messages for invalid input
   - Show file upload validation

5. **Code Explanation**
   - Explain ProfileController methods
   - Explain image upload logic
   - Explain validation rules

---

## ✨ Final Checklist Before Upload

- [ ] All features tested and working
- [ ] Database exported and included
- [ ] README updated with your information
- [ ] ZIP file named correctly
- [ ] File size is reasonable
- [ ] No errors in application
- [ ] Ready to demonstrate
- [ ] Backup copy saved

---

**Once all items are checked, you're ready to submit!** 🎉

**Good luck with your submission!** 🚀

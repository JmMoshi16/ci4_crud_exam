# 🚀 QUICK START - Submission in 5 Minutes!

## Follow these steps IN ORDER:

---

## ⚡ STEP 1: Run Database Migration (1 minute)

### Option A - phpMyAdmin (Recommended):
1. Open: `http://localhost/phpmyadmin`
2. Click your database (left sidebar)
3. Click "SQL" tab
4. Copy this SQL and paste it:

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

5. Click "Go"
6. ✅ Done!

### Option B - Command Line:
```bash
cd "c:\Users\Danny Ricaro\Downloads\CI4-StarterPanel-Final"
mysql -u root -p ci4_crud_exam < profile_migration.sql
```

---

## ⚡ STEP 2: Test the Feature (2 minutes)

```bash
# Start server
php spark serve
```

1. Open: `http://localhost:8080`
2. Login
3. Click your name → "Profile"
4. Click "Edit Profile"
5. Upload a photo
6. Click "Update Profile"
7. ✅ Verify it works!

---

## ⚡ STEP 3: Export Database (30 seconds)

### Option A - Double-click the script:
1. Double-click `export_database.bat`
2. Enter database name (or press Enter for default)
3. Enter username (or press Enter for root)
4. Enter password
5. ✅ `database_export.sql` created!

### Option B - phpMyAdmin:
1. Open phpMyAdmin
2. Click your database
3. Click "Export" tab
4. Click "Go"
5. Save as `database_export.sql`
6. Move to project root folder

### Option C - Command Line:
```bash
mysqldump -u root -p ci4_crud_exam > database_export.sql
```

---

## ⚡ STEP 4: Update README (1 minute)

Open `README_SUBMISSION.md` and replace:

```
**Student Name:** [YOUR NAME HERE]  
**Date Submitted:** [DATE]

**Database Name:** ci4_crud_exam  
**Password:** (empty) or [YOUR PASSWORD]

### Login Credentials:
- **Username:** [YOUR USERNAME]
- **Password:** [YOUR PASSWORD]

**Student ID:** [YOUR STUDENT ID]
**Email:** [YOUR EMAIL]
```

Save the file!

---

## ⚡ STEP 5: Create ZIP (30 seconds)

1. Go to: `c:\Users\Danny Ricaro\Downloads\`
2. Right-click on `CI4-StarterPanel-Final` folder
3. Send to → Compressed (zipped) folder
4. Rename to: `LASTNAME_FIRSTNAME_ProfileActivity.zip`
   - Example: `RICARO_DANNY_ProfileActivity.zip`

---

## ⚡ STEP 6: Submit! (30 seconds)

1. Go to class portal
2. Upload your ZIP file
3. ✅ DONE!

---

## 📋 Quick Verification

Before submitting, verify:

- [ ] Database migration ran (check users table has new columns)
- [ ] Profile page works (`/profile`)
- [ ] Image upload works
- [ ] `database_export.sql` exists in project root
- [ ] `README_SUBMISSION.md` has your information
- [ ] ZIP file named correctly

---

## 🆘 Quick Troubleshooting

**Profile page not found?**
→ Clear cache: `php spark cache:clear`

**Image not uploading?**
→ Check `public/uploads/profiles/` exists

**Database export failed?**
→ Use phpMyAdmin Export instead

**ZIP too large?**
→ Delete `writable/debugbar/*.json` files first

---

## 📁 Files That MUST Be in Your ZIP

```
CI4-StarterPanel-Final/
├── database_export.sql ← MUST HAVE
├── README_SUBMISSION.md ← MUST HAVE (with your info)
├── profile_migration.sql
├── app/
│   ├── Controllers/
│   │   └── ProfileController.php
│   ├── Models/
│   │   └── UserModel.php
│   └── Views/
│       └── profile/
│           ├── show.php
│           └── edit.php
└── public/
    └── uploads/
        └── profiles/
            └── (your uploaded images)
```

---

## ✅ Final Check

Run this quick test:

```bash
# 1. Check database
mysql -u root -p -e "DESCRIBE ci4_crud_exam.users;"
# Should show: student_id, course, year_level, section, phone, address, profile_image

# 2. Check routes
php spark routes | findstr profile
# Should show: GET /profile, GET /profile/edit, POST /profile/update

# 3. Check files
dir app\Controllers\ProfileController.php
dir app\Models\UserModel.php
dir app\Views\profile\show.php
dir app\Views\profile\edit.php
dir database_export.sql
```

If all commands succeed, you're ready! ✅

---

## 🎯 Submission Format

**File Name Format:**
```
LASTNAME_FIRSTNAME_ProfileActivity.zip
```

**Examples:**
- ✅ `SMITH_JOHN_ProfileActivity.zip`
- ✅ `GARCIA_MARIA_ProfileActivity.zip`
- ❌ `profile.zip` (wrong)
- ❌ `John_Smith.zip` (wrong)
- ❌ `ProfileActivity.zip` (wrong)

---

## 🎓 Ready to Demonstrate?

Be prepared to show:

1. **Login** → Show credentials work
2. **Profile Page** → Show all your info
3. **Edit Profile** → Show form
4. **Upload Image** → Show live preview
5. **Update** → Show success message
6. **Validation** → Show error handling

---

## ⏰ Time Estimate

- Database Migration: 1 minute
- Testing: 2 minutes
- Export Database: 30 seconds
- Update README: 1 minute
- Create ZIP: 30 seconds
- **Total: ~5 minutes**

---

## 🚀 YOU'RE READY!

Once you complete all 6 steps above, you're done!

**Good luck with your submission!** 🎉

---

**Need help? Check these files:**
- `SUBMISSION_CHECKLIST.md` - Detailed checklist
- `STUDENT_PROFILE_IMPLEMENTATION.md` - Full documentation
- `SETUP_CHECKLIST.md` - Setup guide

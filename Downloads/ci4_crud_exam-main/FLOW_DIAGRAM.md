# Student Profile Page - Flow Diagram

## 🔄 Application Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                         USER JOURNEY                             │
└─────────────────────────────────────────────────────────────────┘

1. LOGIN
   │
   ├─→ Dashboard
   │
   └─→ Click Profile (in header dropdown)
       │
       ├─→ /profile (ProfileController::show)
       │   │
       │   ├─→ Get user ID from session
       │   ├─→ Fetch user data from database
       │   ├─→ Display profile/show.php
       │   │   │
       │   │   ├─→ Show profile photo or placeholder
       │   │   ├─→ Display all student info
       │   │   └─→ "Edit Profile" button
       │   │
       │   └─→ Click "Edit Profile"
       │       │
       │       └─→ /profile/edit (ProfileController::edit)
       │           │
       │           ├─→ Get user ID from session
       │           ├─→ Fetch user data
       │           ├─→ Display profile/edit.php
       │           │   │
       │           │   ├─→ Pre-populate form
       │           │   ├─→ Show current photo
       │           │   └─→ File upload input
       │           │
       │           └─→ User makes changes
       │               │
       │               ├─→ Select new image (optional)
       │               │   └─→ Live preview appears
       │               │
       │               └─→ Click "Update Profile"
       │                   │
       │                   └─→ POST /profile/update
       │                       │
       │                       ├─→ Validate input
       │                       │   ├─→ If invalid: redirect back with errors
       │                       │   └─→ If valid: continue
       │                       │
       │                       ├─→ Handle image upload
       │                       │   ├─→ Validate file
       │                       │   ├─→ Delete old image
       │                       │   ├─→ Generate unique name
       │                       │   └─→ Move to uploads/profiles/
       │                       │
       │                       ├─→ Update database
       │                       ├─→ Update session
       │                       └─→ Redirect to /profile with success message
```

---

## 🗂️ File Structure & Relationships

```
┌─────────────────────────────────────────────────────────────────┐
│                      FILE ARCHITECTURE                           │
└─────────────────────────────────────────────────────────────────┘

Routes.php
    │
    ├─→ GET /profile ──────────┐
    ├─→ GET /profile/edit ─────┤
    └─→ POST /profile/update ──┤
                                │
                                ▼
                    ProfileController.php
                                │
                    ┌───────────┼───────────┐
                    │           │           │
                    ▼           ▼           ▼
                show()      edit()      update()
                    │           │           │
                    │           │           ├─→ Validation
                    │           │           ├─→ File Upload
                    │           │           └─→ Database Update
                    │           │
                    ├───────────┴───────────┐
                    │                       │
                    ▼                       ▼
            UserModel.php           Session Data
                    │                       │
                    ▼                       │
            Database (users)                │
                    │                       │
                    └───────────────────────┘
                                │
                    ┌───────────┴───────────┐
                    │                       │
                    ▼                       ▼
            profile/show.php        profile/edit.php
                    │                       │
                    └───────────┬───────────┘
                                │
                                ▼
                        layouts/main.php
                                │
                    ┌───────────┼───────────┐
                    │           │           │
                    ▼           ▼           ▼
                header      sidebar     footer
```

---

## 💾 Database Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                      DATABASE OPERATIONS                         │
└─────────────────────────────────────────────────────────────────┘

profile_migration.sql
        │
        ▼
    ALTER TABLE users
        │
        ├─→ ADD student_id VARCHAR(20)
        ├─→ ADD course VARCHAR(100)
        ├─→ ADD year_level TINYINT
        ├─→ ADD section VARCHAR(50)
        ├─→ ADD phone VARCHAR(20)
        ├─→ ADD address TEXT
        └─→ ADD profile_image VARCHAR(255)
                │
                ▼
        users table structure:
        ┌──────────────────────────┐
        │ id (PK)                  │
        │ fullname                 │
        │ username                 │
        │ password                 │
        │ role (FK)                │
        │ student_id          ←NEW │
        │ course              ←NEW │
        │ year_level          ←NEW │
        │ section             ←NEW │
        │ phone               ←NEW │
        │ address             ←NEW │
        │ profile_image       ←NEW │
        │ created_at               │
        │ updated_at               │
        └──────────────────────────┘
```

---

## 📤 Image Upload Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                      IMAGE UPLOAD PROCESS                        │
└─────────────────────────────────────────────────────────────────┘

User selects image
        │
        ▼
JavaScript FileReader
        │
        ├─→ Read file as Data URL
        └─→ Display live preview
                │
                ▼
        User clicks "Update Profile"
                │
                ▼
        Form submits (multipart/form-data)
                │
                ▼
        ProfileController::update()
                │
                ├─→ Get file: $this->request->getFile('profile_image')
                │
                ├─→ Validate:
                │   ├─→ isValid() && !hasMoved()
                │   ├─→ is_image
                │   ├─→ mime_in (jpg/png/webp)
                │   └─→ max_size (2048KB)
                │
                ├─→ Delete old image:
                │   └─→ unlink(FCPATH . 'uploads/profiles/' . $oldImage)
                │
                ├─→ Generate unique name:
                │   └─→ 'avatar_' . $userId . '_' . time() . '.' . $ext
                │
                ├─→ Move file:
                │   └─→ $file->move(FCPATH . 'uploads/profiles/', $newName)
                │
                └─→ Save filename to database:
                    └─→ $updateData['profile_image'] = $newName

Result:
┌─────────────────────────────────────────────────────────────────┐
│ Database: profile_image = "avatar_1_1234567890.jpg"             │
│ Filesystem: public/uploads/profiles/avatar_1_1234567890.jpg     │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🔐 Security Layers

```
┌─────────────────────────────────────────────────────────────────┐
│                      SECURITY ARCHITECTURE                       │
└─────────────────────────────────────────────────────────────────┘

Request
    │
    ├─→ Layer 1: Authentication Filter
    │   └─→ Check if user is logged in
    │
    ├─→ Layer 2: CSRF Protection
    │   └─→ Validate CSRF token
    │
    ├─→ Layer 3: Input Validation
    │   ├─→ Required fields check
    │   ├─→ Data type validation
    │   ├─→ Length constraints
    │   └─→ Unique constraints
    │
    ├─→ Layer 4: File Upload Validation
    │   ├─→ File type check
    │   ├─→ File size check
    │   ├─→ MIME type validation
    │   └─→ Extension validation
    │
    ├─→ Layer 5: Database Operations
    │   ├─→ Prepared statements (Model)
    │   └─→ SQL injection prevention
    │
    └─→ Layer 6: Output Escaping
        └─→ esc() function on all output

Result: Secure, validated, sanitized data
```

---

## 🎯 Data Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                      DATA FLOW (UPDATE)                          │
└─────────────────────────────────────────────────────────────────┘

Browser Form
    │
    │ POST data + file
    │
    ▼
ProfileController::update()
    │
    ├─→ Extract POST data
    │   ├─→ fullname
    │   ├─→ username
    │   ├─→ student_id
    │   ├─→ course
    │   ├─→ year_level
    │   ├─→ section
    │   ├─→ phone
    │   └─→ address
    │
    ├─→ Extract FILE data
    │   └─→ profile_image
    │
    ├─→ Validate all data
    │   │
    │   ├─→ Valid? ──────┐
    │   │                │
    │   └─→ Invalid? ────┼─→ Redirect back with errors
    │                    │
    │                    ▼
    ├─→ Process image upload
    │   ├─→ Validate file
    │   ├─→ Delete old file
    │   ├─→ Save new file
    │   └─→ Get filename
    │
    ├─→ Build $updateData array
    │
    ├─→ UserModel::updateProfile($userId, $updateData)
    │   │
    │   └─→ Database UPDATE query
    │       │
    │       └─→ users table updated
    │
    ├─→ Fetch updated user data
    │
    ├─→ Update session
    │   └─→ session()->set('user', $updatedUser)
    │
    └─→ Redirect to /profile
        │
        └─→ Success message displayed
```

---

## 🖼️ View Rendering Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                      VIEW RENDERING                              │
└─────────────────────────────────────────────────────────────────┘

ProfileController::show()
    │
    ├─→ Fetch user data
    │
    └─→ return view('profile/show', ['user' => $user])
            │
            ▼
    profile/show.php
            │
            ├─→ $this->extend('layouts/main')
            │       │
            │       ├─→ Load header.php
            │       ├─→ Load sidebar.php
            │       ├─→ Render breadcrumb section
            │       ├─→ Render content section
            │       └─→ Load footer.php
            │
            ├─→ Display profile image
            │   │
            │   ├─→ if (!empty($user['profile_image']))
            │   │   └─→ <img src="uploads/profiles/filename.jpg">
            │   │
            │   └─→ else
            │       └─→ <div> placeholder icon </div>
            │
            └─→ Display user data
                ├─→ Student ID
                ├─→ Full Name
                ├─→ Username
                ├─→ Course
                ├─→ Year Level
                ├─→ Section
                ├─→ Phone
                ├─→ Address
                ├─→ Created At
                └─→ Updated At

Result: Fully rendered HTML page
```

---

## 🔄 Session Management

```
┌─────────────────────────────────────────────────────────────────┐
│                      SESSION FLOW                                │
└─────────────────────────────────────────────────────────────────┘

Login
    │
    └─→ session()->set('user', $userData)
            │
            ├─→ Stored in session:
            │   ├─→ id
            │   ├─→ fullname
            │   ├─→ username
            │   ├─→ role
            │   └─→ ... other fields
            │
            ▼
    Profile pages access session
            │
            ├─→ $userId = session('user')['id']
            │
            └─→ Used for:
                ├─→ Fetching user data
                ├─→ Authorization
                └─→ Display in header
                        │
                        ▼
    Profile Update
            │
            └─→ session()->set('user', $updatedUser)
                    │
                    └─→ Header name updates immediately
```

---

## 📊 Complete System Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                   STUDENT PROFILE SYSTEM                         │
└─────────────────────────────────────────────────────────────────┘

┌──────────────┐
│   Browser    │
└──────┬───────┘
       │
       ├─→ GET /profile
       ├─→ GET /profile/edit
       └─→ POST /profile/update
              │
              ▼
┌─────────────────────────┐
│   Routes.php            │
│   (URL Routing)         │
└──────────┬──────────────┘
           │
           ▼
┌─────────────────────────┐
│  ProfileController      │
│  ├─ show()              │
│  ├─ edit()              │
│  └─ update()            │
└──────────┬──────────────┘
           │
           ├─────────────────────┐
           │                     │
           ▼                     ▼
┌─────────────────┐   ┌──────────────────┐
│   UserModel     │   │   Session        │
│   ├─ find()     │   │   ├─ get()       │
│   └─ update()   │   │   └─ set()       │
└────────┬────────┘   └──────────────────┘
         │
         ▼
┌─────────────────────────┐
│   Database (users)      │
│   ├─ student_id         │
│   ├─ course             │
│   ├─ year_level         │
│   ├─ section            │
│   ├─ phone              │
│   ├─ address            │
│   └─ profile_image      │
└─────────────────────────┘
         │
         ▼
┌─────────────────────────┐
│   Views                 │
│   ├─ profile/show.php   │
│   └─ profile/edit.php   │
└─────────────────────────┘
         │
         ▼
┌─────────────────────────┐
│   Filesystem            │
│   public/uploads/       │
│   profiles/             │
│   └─ avatar_*.jpg       │
└─────────────────────────┘
```

---

## ✅ Implementation Checklist Flow

```
START
  │
  ├─→ [1] Run profile_migration.sql
  │       └─→ Database columns added ✓
  │
  ├─→ [2] Verify uploads/profiles/ directory
  │       └─→ Directory exists and writable ✓
  │
  ├─→ [3] Start server (php spark serve)
  │       └─→ Server running ✓
  │
  ├─→ [4] Login to application
  │       └─→ Authenticated ✓
  │
  ├─→ [5] Navigate to /profile
  │       └─→ Profile page loads ✓
  │
  ├─→ [6] Click "Edit Profile"
  │       └─→ Edit form loads ✓
  │
  ├─→ [7] Update information
  │       └─→ Form submits ✓
  │
  ├─→ [8] Upload profile image
  │       └─→ Image uploads ✓
  │
  └─→ [9] Verify changes saved
          └─→ Profile updated ✓

END - IMPLEMENTATION SUCCESSFUL! 🎉
```

---

**This diagram shows the complete flow of the Student Profile Page feature.**

Use this as a reference to understand how all components work together!

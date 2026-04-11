# AdminLTE 4 Integration - Implementation Guide

## Overview
The AdminLTE 4 design from index2.html has been successfully divided into modular PHP components for CodeIgniter 4.

## File Structure

### Layout Files (app/Views/layouts/)
1. **main.php** - Main layout wrapper with HTML structure, CSS/JS includes
2. **header.php** - Top navigation bar with search, messages, notifications, user menu
3. **sidebar.php** - Left sidebar with dynamic menu integration
4. **footer.php** - Footer section with copyright information

### Dashboard File (app/Views/pages/commons/)
1. **dashboard.php** - Main dashboard content with info boxes, charts, and tables

## Features Implemented

### Header (header.php)
- Sidebar toggle button
- Navigation links (Home, Contact)
- Search functionality
- Messages dropdown with badge counter
- Notifications dropdown with badge counter
- Fullscreen toggle
- User profile dropdown with logout

### Sidebar (sidebar.php)
- Brand logo and title
- Dynamic menu integration with existing menu system
- Support for nested menus (treeview)
- Active state highlighting
- Bootstrap Icons integration

### Main Layout (main.php)
- AdminLTE 4 CSS/JS includes
- Bootstrap 5.3.7
- Bootstrap Icons
- OverlayScrollbars
- ApexCharts for data visualization
- Breadcrumb section support
- Content section support
- JavaScript section support

### Dashboard (dashboard.php)
- Info boxes with statistics (CPU, Likes, Sales, Members)
- Monthly recap report card with sales chart
- Goal completion progress bars
- Revenue statistics footer
- Latest orders table with sparkline charts
- Colored info boxes (Inventory, Mentions, Downloads, Messages)

## How to Use

### 1. Access the Dashboard
```
http://localhost/CI4-StarterPanel-master/public/dashboard
```

### 2. Create New Pages
To create a new page using the AdminLTE layout:

```php
<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Page Title</h3></div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Page Title</li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Your content here -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<!-- Your custom JavaScript here -->
<?= $this->endSection() ?>
```

### 3. Controller Setup
Controllers should extend BaseController which provides:
- User data ($user)
- Menu categories ($MenuCategory)
- Current segment ($segment)
- Current subsegment ($subsegment)

Example:
```php
public function index(): string
{
    $data = array_merge($this->data, [
        'title' => 'Page Title'
    ]);
    return view('pages/your_page', $data);
}
```

## Assets Location

### CSS Files
- `/public/css/adminlte.css` - Main AdminLTE stylesheet
- Bootstrap Icons (CDN)
- OverlayScrollbars (CDN)
- ApexCharts (CDN)

### JavaScript Files
- `/public/js/adminlte.js` - Main AdminLTE JavaScript
- Bootstrap 5.3.7 (CDN)
- Popper.js (CDN)
- OverlayScrollbars (CDN)
- ApexCharts (CDN)

### Images
- `/public/assets/img/` - User avatars and images

## Routes
The dashboard is accessible via:
```php
$routes->get('dashboard', 'Home::index');
```

## Dynamic Menu Integration
The sidebar automatically loads menus from the database using:
- `getMenu()` helper function
- `getSubMenu()` helper function
- Menu categories from `$MenuCategory`
- User role-based access control

## Customization

### Change Brand Logo
Edit `app/Views/layouts/sidebar.php`:
```php
<img src="<?= base_url('assets/img/YourLogo.png') ?>" alt="Your Logo" class="brand-image opacity-75 shadow" />
<span class="brand-text fw-light">Your Brand</span>
```

### Change User Avatar
Edit `app/Views/layouts/header.php`:
```php
<img src="<?= base_url('assets/img/your-avatar.jpg') ?>" class="user-image rounded-circle shadow" alt="User Image" />
```

### Add Custom CSS
Add to `app/Views/layouts/main.php` before closing `</head>`:
```php
<link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" />
```

### Add Custom JavaScript
Add to your page's javascript section:
```php
<?= $this->section('javascript') ?>
<script>
// Your custom JavaScript
</script>
<?= $this->endSection() ?>
```

## Notes
- All AdminLTE 4 assets are already in the `/public` folder
- The design is fully responsive (mobile-friendly)
- Bootstrap Icons are used instead of Font Awesome
- The layout supports dark mode (can be configured)
- All existing menu functionality is preserved

## Troubleshooting

### CSS/JS Not Loading
Check base_url() in `app/Config/App.php`:
```php
public string $baseURL = 'http://localhost/CI4-StarterPanel-master/public/';
```

### Menu Not Showing
Ensure user is logged in and has proper role permissions in the database.

### Charts Not Rendering
Verify ApexCharts CDN is accessible and JavaScript section is properly defined.

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ── Public Routes (No Filter) ───────────────────────────────────────────────
$routes->get('/',             'Auth::index');
$routes->get('login',         'Auth::index');
$routes->post('login',        'Auth::index');
$routes->get('logout',        'Auth::logout');
$routes->get('register',      'Auth::register');
$routes->post('register',     'Auth::registration');
$routes->get('unauthorized',  'Auth::unauthorized'); // STEP 6: Uncontrolled Route

// ── Student Routes (filter: ['auth', 'student']) ────────────────────────────
$routes->group('', ['filter' => ['auth', 'student']], function ($routes) {
    $routes->get('student/dashboard', 'StudentController::dashboard');
});

// ── Profile Routes (filter: ['auth']) — accessible by all logged-in roles ───
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile',         'ProfileController::show');
    $routes->get('profile/edit',    'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');
});

// ── Teacher Routes (filter: ['auth', 'teacher']) ────────────────────────────
$routes->group('', ['filter' => ['auth', 'teacher']], function ($routes) {
    $routes->get('dashboard',                 'Home::index');
    $routes->get('students',                  'StudentManagementController::index');
    $routes->get('students/show/(:num)',      'StudentManagementController::show/$1');
    
    // Items CRUD (Assuming they map to existing endpoints or standard routes)
    $routes->post('student/store',            'Student::store');
    $routes->get('student/edit/(:num)',       'Student::edit/$1');
    $routes->post('student/update/(:num)',    'Student::update/$1');
    $routes->post('student/delete/(:num)',    'Student::delete/$1');
});

// ── API v1 — token-authenticated JSON endpoints ────────────────────────────
// POST /api/v1/auth/token  → issue token (public)
$routes->post('api/v1/auth/token', 'Api\AuthController::issueToken');

// Protected API routes (require Bearer token)
$routes->group('api/v1', ['filter' => 'api_auth'], function ($routes) {
    $routes->delete('auth/token',          'Api\AuthController::revokeToken');
    $routes->get('students',               'Api\StudentsController::index');
    $routes->get('students/(:num)',        'Api\StudentsController::show/$1');
    $routes->post('students',              'Api\StudentsController::create');
    $routes->put('students/(:num)',        'Api\StudentsController::update/$1');
    $routes->delete('students/(:num)',     'Api\StudentsController::delete/$1');
});

// ── Admin Routes (filter: ['auth', 'admin']) ────────────────────────────────
$routes->group('admin', ['filter' => ['auth', 'admin']], function ($routes) {
    // Role CRUD
    $routes->get('roles',                     'Admin\RoleController::index');
    $routes->get('roles/create',              'Admin\RoleController::create');
    $routes->post('roles/store',              'Admin\RoleController::store');
    $routes->get('roles/edit/(:num)',         'Admin\RoleController::edit/$1');
    $routes->post('roles/update/(:num)',      'Admin\RoleController::update/$1');
    $routes->get('roles/delete/(:num)',       'Admin\RoleController::delete/$1');

    // User Role Assignment
    $routes->get('users',                     'Admin\UserAdminController::index');
    $routes->post('users/assign-role/(:num)', 'Admin\UserAdminController::assignRole/$1');
});

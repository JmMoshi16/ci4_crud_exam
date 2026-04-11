# CodeIgniter 4 Starter Panel

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository is a starter kit for CodeIgniter 4. Using codeigniter version 4.6.1, PHP version 8.4 and bootstrap version 5.
### Documentation

The [User Guide](https://codeigniter.com/user_guide/) is the primary documentation for CodeIgniter 4.

## Installation

`git clone` or download this source code then run `composer install` whenever there is a new release of the framework.

## Setup

- Run `php spark db:create` to create a new database schema.
- Copy `env` to `.env` and tailor for your app, specifically the baseURL and any database settings.
- Run `php spark migrate` to running database migration
- Run the profile migration: `mysql -u root -p your_database_name < profile_migration.sql` (or execute via phpMyAdmin)
- Run `php spark db:seed Users` to seeding default database user
- Run `php spark key:generate` to create encrypter key
- Ensure `public/uploads/profiles/` directory exists and is writable
- Run `php spark serve` to launching the CodeIgniter PHP-Development Server

## Server Requirements

PHP version 8.4 is required, with the following extensions installed:
- curl
- fileinfo
- gd
- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- openssl

Additionally, make sure that the following extensions are enabled in your PHP:
- json (enabled by default - don't turn it off)
- xml (enabled by default - don't turn it off)

## Features

Features on this project:
- Authentication
- Authorization
- User Registration
- Menu Management with auto create controller and view file
- Student Profile Management
  - View personal profile information
  - Edit profile details (student ID, course, year level, section, phone, address)
  - Upload and manage profile photos
  - Live image preview before upload
  - Session-aware profile updates


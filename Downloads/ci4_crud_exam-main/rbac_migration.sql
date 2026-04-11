-- ============================================================
-- RBAC Migration — roles table + role_id on users + demo data
-- ============================================================

CREATE TABLE IF NOT EXISTS `roles` (
    `id`          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`        VARCHAR(50)  NOT NULL UNIQUE COMMENT 'slug: admin, teacher, student',
    `label`       VARCHAR(100) NOT NULL,
    `description` TEXT         NULL,
    `created_at`  DATETIME     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Core roles
INSERT INTO `roles` (`name`, `label`, `description`) VALUES
('admin',       'Administrator', 'Full system access'),
('teacher',     'Teacher',       'Access to students and items management'),
('student',     'Student',       'Access to own profile and student dashboard'),
('coordinator', 'Coordinator',   'Challenge role for CoordinatorFilter');

-- Add role_id FK to users (safe: only if column does not exist)
ALTER TABLE `users`
    ADD COLUMN IF NOT EXISTS `role_id` INT UNSIGNED NULL AFTER `role`,
    ADD CONSTRAINT `fk_users_role_id`
        FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE SET NULL;

-- Demo accounts (password = Password1)
INSERT INTO `users` (`fullname`, `username`, `password`, `role`, `role_id`, `created_at`) VALUES
('Admin User',    'admin@school.edu',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, (SELECT id FROM roles WHERE name='admin'),   NOW()),
('Teacher User',  'teacher@school.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, (SELECT id FROM roles WHERE name='teacher'), NOW()),
('Student User',  'student@school.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, (SELECT id FROM roles WHERE name='student'), NOW())
ON DUPLICATE KEY UPDATE `role_id` = VALUES(`role_id`);

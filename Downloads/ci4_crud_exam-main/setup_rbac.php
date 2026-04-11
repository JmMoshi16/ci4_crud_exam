<?php
// setup_rbac.php - Safe idempotent migration script
$host = 'localhost';
$db   = 'ci4_crud_exam';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Create Roles Table
    echo "Creating roles table...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `roles` (
          `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
          `name` varchar(50) NOT NULL,
          `label` varchar(100) NOT NULL,
          `description` text DEFAULT NULL,
          `created_at` datetime DEFAULT current_timestamp(),
          `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          PRIMARY KEY (`id`),
          UNIQUE KEY `name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // 2. Insert Core Roles (Ignore duplicates)
    echo "Inserting core roles...\n";
    $roles = [
        [1, 'admin', 'Administrator', 'Full system access'],
        [2, 'teacher', 'Teacher', 'Access to students and items management'],
        [3, 'student', 'Student', 'Access to own profile and student dashboard'],
        [4, 'coordinator', 'Coordinator', 'Challenge role']
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO `roles` (`id`, `name`, `label`, `description`) VALUES (?, ?, ?, ?)");
    foreach ($roles as $role) {
        $stmt->execute($role);
    }

    // 3. Alter users table to ensure role_id exists and has FK
    echo "Updating users table with role_id...\n";
    try {
        $pdo->exec("ALTER TABLE `users` ADD COLUMN `role_id` int(10) UNSIGNED DEFAULT NULL AFTER `role`");
    } catch (PDOException $e) { /* Column might already exist, ignore */ }
    
    try {
        // Drop existing constraint if it exists, otherwise ignore error
        $pdo->exec("ALTER TABLE `users` DROP FOREIGN KEY `fk_users_role_id`");
    } catch (PDOException $e) {}

    try {
        $pdo->exec("ALTER TABLE `users` ADD CONSTRAINT `fk_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL");
    } catch (PDOException $e) { /* Might already exist */ }

    // 4. Migrate existing users role integers to role_id
    // If old system used role 1 = user, we need to map them to student (role_id 3)
    echo "Migrating existing accounts...\n";
    $pdo->exec("UPDATE `users` SET `role_id` = 3 WHERE `role_id` IS NULL");

    // 5. Seed the 4 required demo accounts exactly as requested
    echo "Seeding demo accounts...\n";
    $passwordHash = password_hash('Password1', PASSWORD_DEFAULT);
    
    $demoUsers = [
        ['Admin User', 'admin', 'admin@school.edu', 1],
        ['Teacher User', 'teacher', 'teacher@school.edu', 2],
        ['Student User', 'student', 'student@school.edu', 3],
        ['Coordinator User', 'coordinator', 'coordinator@school.edu', 4]
    ];

    $userStmt = $pdo->prepare("INSERT IGNORE INTO `users` (`fullname`, `username`, `email`, `password`, `role`, `role_id`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, 1, ?, NOW(), NOW()) ON DUPLICATE KEY UPDATE `role_id` = VALUES(`role_id`), `password` = VALUES(`password`)");
    
    foreach ($demoUsers as $du) {
        $userStmt->execute([$du[0], $du[1], $du[2], $passwordHash, $du[3]]);
    }

    echo "RBAC Migration Step 1 Complete!\n";

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage() . "\n");
}

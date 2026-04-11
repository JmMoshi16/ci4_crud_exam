<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
require __DIR__ . DIRECTORY_SEPARATOR . 'app/Config/Paths.php';
$paths = new Config\Paths();
require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

$db = \Config\Database::connect();
$users = $db->table('users')->select('username, email, password')->get()->getResultArray();

echo "--- CURRENT USERS IN DB ---\n";
foreach ($users as $u) {
    echo "USER: " . ($u['username'] ?? $u['email']) . " | HASH: " . $u['password'] . "\n";
}

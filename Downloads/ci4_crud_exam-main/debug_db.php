<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=ci4_crud_exam', 'root', '');
    $stmt = $pdo->query("SELECT id, fullname, username, email, password, role FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $u) {
        echo "ID: {$u['id']} | Username: {$u['username']} | Email: " . ($u['email'] ?? 'N/A') . "\n";
        echo "Hash: {$u['password']}\n";
        echo "Match 'password123'? " . (password_verify('password123', $u['password']) ? 'YES' : 'NO') . "\n";
        echo "Match '123456'? " . (password_verify('123456', $u['password']) ? 'YES' : 'NO') . "\n";
        echo "--------------------------\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=ci4_crud_exam', 'root', '');
    $stmt = $pdo->query("SELECT * FROM users WHERE username IN ('teacher@school.edu', 'test99@example.com')");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($users);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

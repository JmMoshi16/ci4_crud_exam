<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * UserSeeder — 4 demo accounts, one per role.
 * Password for all: Password1
 * Run AFTER RoleSeeder: php spark db:seed UserSeeder
 *
 * | Role        | Email                  | Password  |
 * |-------------|------------------------|-----------|
 * | admin       | admin@school.edu       | Password1 |
 * | teacher     | teacher@school.edu     | Password1 |
 * | student     | student@school.edu     | Password1 |
 * | coordinator | coordinator@school.edu | Password1 |
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now  = date('Y-m-d H:i:s');
        $hash = password_hash('Password1', PASSWORD_DEFAULT);

        $getRoleId = function (string $slug): ?int {
            $row = $this->db->table('roles')->where('name', $slug)->get()->getRowArray();
            return $row ? (int) $row['id'] : null;
        };

        $this->db->table('users')->insertBatch([
            ['fullname' => 'Admin',       'username' => 'admin@school.edu',       'password' => $hash, 'role' => 1, 'role_id' => $getRoleId('admin'),       'created_at' => $now, 'updated_at' => $now],
            ['fullname' => 'Cruz',         'username' => 'teacher@school.edu',     'password' => $hash, 'role' => 1, 'role_id' => $getRoleId('teacher'),     'created_at' => $now, 'updated_at' => $now],
            ['fullname' => 'Reyes',        'username' => 'student@school.edu',     'password' => $hash, 'role' => 1, 'role_id' => $getRoleId('student'),     'created_at' => $now, 'updated_at' => $now],
            ['fullname' => 'Bautista',     'username' => 'coordinator@school.edu', 'password' => $hash, 'role' => 1, 'role_id' => $getRoleId('coordinator'), 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

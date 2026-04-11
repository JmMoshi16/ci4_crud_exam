<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * RoleSeeder — inserts 3 core roles + 1 challenge role.
 * Run: php spark db:seed RoleSeeder
 */
class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('roles')->insertBatch([
            ['name' => 'admin',       'label' => 'Administrator',        'description' => 'Full access to all modules including role management and user assignment.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'teacher',     'label' => 'Teacher',              'description' => 'Access to dashboard, student profiles, and items module.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'student',     'label' => 'Student',              'description' => 'Restricted access to own student dashboard and personal profile only.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'coordinator', 'label' => 'Department Coordinator','description' => 'CHALLENGE: Access to everything Teacher can, plus /coordinator/report. Requires CoordinatorFilter.php.', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: AddRoleIdToUsers
 * Adds role_id FK to users table.
 * Run: php spark migrate
 */
class AddRoleIdToUsers extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('users', [
            'role_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
                'after'      => 'role',
            ],
        ]);

        $this->db->query('
            ALTER TABLE users
            ADD CONSTRAINT fk_users_role_id
            FOREIGN KEY (role_id)
            REFERENCES roles(id)
            ON DELETE SET NULL
            ON UPDATE CASCADE
        ');
    }

    public function down(): void
    {
        $this->db->query('ALTER TABLE users DROP FOREIGN KEY fk_users_role_id');
        $this->forge->dropColumn('users', 'role_id');
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'   => 'John Doe',
                'email'  => 'john@example.com',
                'course' => 'Computer Science',
            ],
            [
                'name'   => 'Jane Smith',
                'email'  => 'jane@example.com',
                'course' => 'Information Technology',
            ],
            [
                'name'   => 'Alex Rivera',
                'email'  => 'alex@example.com',
                'course' => 'Data Science',
            ],
        ];

        $this->db->table('students')->insertBatch($data);
    }
}

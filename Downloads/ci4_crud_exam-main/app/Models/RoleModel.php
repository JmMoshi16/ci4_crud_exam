<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * RoleModel
 *
 * Manages the 'roles' table.
 * The 'name' column stores a slug (e.g. 'admin', 'teacher', 'student')
 * which is what Filters compare against session data.
 */
class RoleModel extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';

    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'label', 'description'];
    protected $returnType    = 'array';

    protected $validationRules = [
        'name'  => 'required|alpha_dash|min_length[2]|max_length[50]|is_unique[roles.name]',
        'label' => 'required|min_length[2]|max_length[100]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Role slug is required.',
            'alpha_dash' => 'Role slug may only contain letters, numbers, hyphens, and underscores.',
            'is_unique'  => 'That role slug already exists.',
        ],
        'label' => ['required' => 'A display label is required.'],
    ];

    /** Return all roles as id => label map for <select> dropdowns. */
    public function getDropdown(): array
    {
        $map = [];
        foreach ($this->findAll() as $row) {
            $map[$row['id']] = $row['label'];
        }
        return $map;
    }

    /** Find a role by its slug name. */
    public function findByName(string $name): ?array
    {
        return $this->where('name', $name)->first();
    }

    /** Return all roles with user count per role. */
    public function withUserCount(): array
    {
        return $this->db->table('roles r')
            ->select('r.*, COUNT(u.id) AS user_count')
            ->join('users u', 'u.role_id = r.id', 'left')
            ->groupBy('r.id')
            ->orderBy('r.id', 'ASC')
            ->get()->getResultArray();
    }
}

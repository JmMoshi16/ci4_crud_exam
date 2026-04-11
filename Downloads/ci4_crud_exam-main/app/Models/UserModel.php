<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useTimestamps  = true;
    protected $useSoftDeletes = false; // keep false — existing table may not have deleted_at
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';

    protected $allowedFields = [
        'fullname', 'username', 'password', 'role', 'role_id',
        'student_id', 'course', 'year_level', 'section',
        'phone', 'address', 'profile_image',
    ];

    protected $returnType = 'array';

    // ── Custom query methods ──────────────────────────────────

    /** Find a user by username/email. */
    public function findByEmail(string $email): ?array
    {
        return $this->where('username', $email)->first();
    }

    /**
     * Return a single user with their role name joined in.
     * Provides role_name and role_label alongside user data.
     */
    public function findWithRole(int $id): ?array
    {
        return $this->db->table('users u')
            ->select('u.*, r.name AS role_name, r.label AS role_label')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('u.id', $id)
            ->get()->getRowArray();
    }

    /**
     * Return all users with their role label joined in.
     * Used by admin user management and teacher student list.
     */
    public function getAllWithRoles(): array
    {
        return $this->db->table('users u')
            ->select('u.id, u.fullname AS name, u.username AS email, u.student_id,
                      u.course, u.year_level, u.section, u.profile_image,
                      u.role_id, u.created_at,
                      r.name AS role_name, r.label AS role_label')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->orderBy('u.fullname', 'ASC')
            ->get()->getResultArray();
    }

    /** Thin wrapper used by ProfileController. */
    public function updateProfile(int $userId, array $data): bool
    {
        return $this->update($userId, $data);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

/**
 * UserAdminController  (Admin\UserAdminController)
 *
 * Allows admin to view all users and assign/change their roles.
 * Protected by: ['auth', 'admin']
 */
class UserAdminController extends BaseController
{
    protected UserModel $userModel;
    protected RoleModel $roleModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    /** List all users with their current role and a dropdown to change it. */
    public function index()
    {
        return view('admin/users/index', array_merge($this->data, [
            'title' => 'User Role Assignment',
            'users' => $this->userModel->getAllWithRoles(),
            'roles' => $this->roleModel->getDropdown(), // id => label map for <select>
        ]));
    }

    /** Assign a role to a specific user (POST). */
    public function assignRole(int $userId)
    {
        $user   = $this->userModel->find($userId);
        $roleId = (int) $this->request->getPost('role_id');
        $role   = $this->roleModel->find($roleId);

        if (! $user || ! $role) {
            session()->setFlashdata('error', 'User or role not found.');
            return redirect()->to('/admin/users');
        }

        // Prevent admin from removing their own admin role
        if ($user['id'] === (session('user')['id'] ?? 0) && $role['name'] !== 'admin') {
            session()->setFlashdata('error', 'You cannot change your own admin role.');
            return redirect()->to('/admin/users');
        }

        $this->userModel->update($userId, ['role_id' => $roleId]);

        session()->setFlashdata('success',
            esc($user['fullname']) . ' has been assigned the role: ' . esc($role['label'])
        );
        return redirect()->to('/admin/users');
    }
}

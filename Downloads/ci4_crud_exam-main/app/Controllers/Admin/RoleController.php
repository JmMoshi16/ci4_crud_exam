<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\UserModel;

/**
 * RoleController  (Admin\RoleController)
 *
 * Full CRUD for the roles table.
 * Protected by: ['auth', 'admin']  (admin only via Routes.php)
 */
class RoleController extends BaseController
{
    protected RoleModel $roleModel;
    protected UserModel $userModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->roleModel = new RoleModel();
        $this->userModel = new UserModel();
    }

    // ── LIST ──────────────────────────────────────────────────
    public function index()
    {
        return view('admin/roles/index', array_merge($this->data, [
            'title' => 'Role Management',
            'roles' => $this->roleModel->withUserCount(),
        ]));
    }

    // ── CREATE form ───────────────────────────────────────────
    public function create()
    {
        return view('admin/roles/create', array_merge($this->data, ['title' => 'Create Role']));
    }

    // ── STORE ─────────────────────────────────────────────────
    public function store()
    {
        $data = [
            'name'        => strtolower(trim($this->request->getPost('name'))),
            'label'       => trim($this->request->getPost('label')),
            'description' => trim($this->request->getPost('description') ?? ''),
        ];

        if (! $this->roleModel->insert($data)) {
            return redirect()->back()->withInput()
                             ->with('errors', $this->roleModel->errors());
        }

        session()->setFlashdata('success', 'Role "' . esc($data['label']) . '" created successfully.');
        return redirect()->to('/admin/roles');
    }

    // ── EDIT form ─────────────────────────────────────────────
    public function edit(int $id)
    {
        $role = $this->roleModel->find($id);
        if (! $role) {
            session()->setFlashdata('error', 'Role not found.');
            return redirect()->to('/admin/roles');
        }

        return view('admin/roles/edit', array_merge($this->data, [
            'title' => 'Edit Role',
            'role'  => $role,
        ]));
    }

    // ── UPDATE ────────────────────────────────────────────────
    public function update(int $id)
    {
        $role = $this->roleModel->find($id);
        if (! $role) {
            session()->setFlashdata('error', 'Role not found.');
            return redirect()->to('/admin/roles');
        }

        $rules = [
            'name'  => "required|alpha_dash|min_length[2]|max_length[50]|is_unique[roles.name,id,{$id}]",
            'label' => 'required|min_length[2]|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'label'       => trim($this->request->getPost('label')),
            'description' => trim($this->request->getPost('description') ?? ''),
        ];

        // Lock slug for core roles
        if (! in_array($role['name'], ['admin', 'teacher', 'student'])) {
            $updateData['name'] = strtolower(trim($this->request->getPost('name')));
        }

        $this->roleModel->update($id, $updateData);
        session()->setFlashdata('success', 'Role updated successfully.');
        return redirect()->to('/admin/roles');
    }

    // ── DELETE ────────────────────────────────────────────────
    public function delete(int $id)
    {
        $role = $this->roleModel->find($id);
        if (! $role) {
            session()->setFlashdata('error', 'Role not found.');
            return redirect()->to('/admin/roles');
        }

        if ($role['name'] === 'admin') {
            session()->setFlashdata('error', 'The "admin" role cannot be deleted.');
            return redirect()->to('/admin/roles');
        }

        // Unassign users before deleting
        $this->db->table('users')->where('role_id', $id)->update(['role_id' => null]);
        $this->roleModel->delete($id);

        session()->setFlashdata('success', 'Role "' . esc($role['label']) . '" deleted. Affected users have been unassigned.');
        return redirect()->to('/admin/roles');
    }
}

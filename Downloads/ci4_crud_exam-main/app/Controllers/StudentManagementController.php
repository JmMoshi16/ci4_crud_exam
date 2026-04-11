<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * StudentManagementController
 *
 * Lists all student accounts for teacher/admin view.
 * Protected by: ['auth', 'teacher']
 */
class StudentManagementController extends BaseController
{
    protected UserModel $userModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
    }

    /** List all users whose role is 'student'. */
    public function index()
    {
        $students = $this->db->table('users u')
            ->select('u.id, u.fullname AS name, u.username AS email, u.student_id,
                      u.course, u.year_level, u.section, u.created_at, u.profile_image')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('r.name', 'student')
            ->orderBy('u.fullname', 'ASC')
            ->get()->getResultArray();

        return view('teacher/students', array_merge($this->data, [
            'title'    => 'Student Management',
            'students' => $students,
        ]));
    }

    /** Show a single student's profile (read-only for teachers). */
    public function show(int $id)
    {
        $student = $this->userModel->findWithRole($id);

        if (! $student || $student['role_name'] !== 'student') {
            session()->setFlashdata('notif_error', 'Student not found.');
            return redirect()->to('/students');
        }

        return view('teacher/student_show', array_merge($this->data, [
            'title'   => 'Student Profile',
            'student' => $student,
        ]));
    }
}

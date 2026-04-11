<?php

namespace App\Controllers\Api;

use App\Models\StudentModel;

/**
 * GET    /api/v1/students         → list all students
 * GET    /api/v1/students/{id}    → single student
 * POST   /api/v1/students         → create student
 * PUT    /api/v1/students/{id}    → update student
 * DELETE /api/v1/students/{id}    → delete student
 *
 * Requires: Bearer token (teacher or admin role)
 */
class StudentsController extends BaseApiController
{
    private StudentModel $model;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->model = new StudentModel();
    }

    public function index()
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can list students.');
        }
        return $this->ok($this->model->findAll());
    }

    public function show(int $id)
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can view students.');
        }
        $student = $this->model->find($id);
        return $student ? $this->ok($student) : $this->notFound("Student #{$id} not found.");
    }

    public function create()
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can create students.');
        }

        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        if (! $this->model->insert($data)) {
            return $this->badRequest('Validation failed.', $this->model->errors());
        }

        return $this->created($this->model->find($this->model->getInsertID()), 'Student created.');
    }

    public function update(int $id)
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can update students.');
        }

        if (! $this->model->find($id)) {
            return $this->notFound("Student #{$id} not found.");
        }

        $data = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if (! $this->model->update($id, $data)) {
            return $this->badRequest('Validation failed.', $this->model->errors());
        }

        return $this->ok($this->model->find($id), 'Student updated.');
    }

    public function delete(int $id)
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can delete students.');
        }

        if (! $this->model->find($id)) {
            return $this->notFound("Student #{$id} not found.");
        }

        $this->model->delete($id);
        return $this->ok(null, 'Student deleted.');
    }

    private function hasTeacherAccess(): bool
    {
        return $this->apiUser && in_array(
            strtolower($this->apiUser['role_name']),
            ['teacher', 'admin', 'developer'],
            true
        );
    }
}

<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (! str_starts_with($authHeader, 'Bearer ')) {
            return service('response')->setStatusCode(401)
                ->setJSON(['status' => 'error', 'message' => 'Missing or invalid Authorization header.']);
        }

        $token = trim(substr($authHeader, 7));
        $db    = db_connect();

        $row = $db->table('api_tokens t')
            ->select('t.*, u.id AS user_id, u.fullname, u.username, r.role_name')
            ->join('users u', 'u.id = t.user_id')
            ->join('user_role r', 'r.id = u.role', 'left')
            ->where('t.token', $token)
            ->get()->getRowArray();

        if (! $row) {
            return service('response')->setStatusCode(401)
                ->setJSON(['status' => 'error', 'message' => 'Invalid token.']);
        }

        if ($row['expires_at'] && strtotime($row['expires_at']) < time()) {
            $db->table('api_tokens')->where('token', $token)->delete();
            return service('response')->setStatusCode(401)
                ->setJSON(['status' => 'error', 'message' => 'Token has expired.']);
        }

        $request->apiUser = $row;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}

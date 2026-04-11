<?php

namespace App\Controllers\Api;

use App\Models\ApiTokenModel;
use App\Models\ApplicationModel;

/**
 * POST   /api/v1/auth/token   → exchange username+password for a Bearer token
 * DELETE /api/v1/auth/token   → revoke the current token
 */
class AuthController extends BaseApiController
{
    private const TOKEN_TTL = 86400; // 24 hours

    public function issueToken()
    {
        $email    = $this->request->getJsonVar('email')    ?? $this->request->getPost('email');
        $password = $this->request->getJsonVar('password') ?? $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return $this->badRequest('email and password are required.');
        }

        $appModel = new ApplicationModel();
        $user     = $appModel->getUser(username: $email);

        if (! $user || ! password_verify($password, $user['password'])) {
            return $this->response->setStatusCode(401)
                ->setJSON(['status' => 'error', 'message' => 'Invalid credentials.']);
        }

        $token     = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + self::TOKEN_TTL);

        (new ApiTokenModel())->createToken($user['userID'], $token, $expiresAt);

        return $this->created([
            'token'      => $token,
            'token_type' => 'Bearer',
            'expires_at' => $expiresAt,
            'user'       => [
                'id'    => $user['userID'],
                'name'  => $user['fullname'],
                'email' => $user['username'],
            ],
        ], 'Token issued.');
    }

    public function revokeToken()
    {
        $token = trim(substr($this->request->getHeaderLine('Authorization'), 7));
        (new ApiTokenModel())->deleteByToken($token);
        return $this->ok(null, 'Token revoked.');
    }
}

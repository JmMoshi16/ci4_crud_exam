<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['cookie', 'date', 'security', 'menu', 'useraccess'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session, $segment, $validation, $encrypter, $ApplicationModel, $db, $data = [];
    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session          = service('session');
        $this->segment          = service('uri');
        $this->validation       = \Config\Services::validation();
        $this->encrypter        = \Config\Services::encrypter();
        $this->ApplicationModel = new ApplicationModel();
        $this->db               = \Config\Database::connect();

        // Support both new RBAC session and legacy session
        $sessionUser = session('user');
        if ($sessionUser) {
            $user = $this->ApplicationModel->getUser(username: $sessionUser['username'] ?? $sessionUser['email'] ?? '');
            // Merge role from new session into user array
            if ($user && isset($sessionUser['role'])) {
                $user['role_slug'] = $sessionUser['role'];
            }
        } else {
            $user = $this->ApplicationModel->getUser(username: session()->get('username'));
        }

        $segment = $this->segment->getSegment(1);
        $subsegment = $segment ? $this->segment->getSegment(2) : '';

        $this->data = [
            'segment'      => $segment,
            'subsegment'   => $subsegment,
            'user'         => $user,
            'MenuCategory' => $this->ApplicationModel->getAccessMenuCategory(session()->get('role') ?? 1),
        ];
    }
}

<!doctype html>
<html lang="en" style="background-color: #09090b;">
<head>
    <meta charset="utf-8">
    <title>403 Unauthorized | EduPanel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/premium.css') ?>">
</head>
<body class="d-flex align-items-center justify-content-center vh-100" style="background-color: #09090b;">
    <div class="text-center">
        <div class="mb-4" style="color: #fb7185;">
            <i class="bi bi-shield-lock-fill" style="font-size: 5rem; filter: drop-shadow(0 0 20px rgba(251,113,133,0.4));"></i>
        </div>
        
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #f8fafc; letter-spacing: -0.03em; margin-bottom: 0.5rem;">403 Access Denied</h1>
        <p style="color: #9ca3af; font-size: 1.1rem; max-width: 450px; margin: 0 auto 2rem;">
            You are currently logged in as a <strong><span style="color: #6366f1; text-transform: uppercase; font-size: 0.9em; letter-spacing: 0.05em;"><?= esc(session('user')['role'] ?? 'Guest') ?></span></strong>. 
            This account does not have the necessary permissions to view this system segment.
        </p>

        <?php 
            $dashboardLink = base_url('login');
            if (session()->has('user')) {
                $role = session('user')['role'] ?? '';
                if ($role === 'student') $dashboardLink = base_url('student/dashboard');
                elseif (in_array($role, ['teacher', 'admin', 'coordinator'])) $dashboardLink = base_url('dashboard');
            }
        ?>

        <a href="<?= $dashboardLink ?>" class="clean-btn-primary d-inline-flex align-items-center justify-content-center text-decoration-none px-4 py-2" style="font-weight: 600;">
            <i class="bi bi-arrow-left me-2"></i> Return to Safety
        </a>
    </div>
</body>
</html>

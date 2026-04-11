<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — Jurado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', system-ui, sans-serif; background: #f4f6fa; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-wrapper { display: flex; width: 900px; max-width: 98vw; min-height: 560px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,.12); }
        .auth-brand { flex: 1; background: linear-gradient(135deg, #4f46e5, #312e81); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 40px; color: #fff; }
        .auth-brand .brand-icon { font-size: 72px; margin-bottom: 24px; opacity: .9; }
        .auth-brand h1 { font-size: 2rem; font-weight: 800; margin-bottom: 12px; letter-spacing: -0.5px; }
        .auth-brand p { opacity: .8; text-align: center; font-size: .95rem; line-height: 1.6; }
        .auth-brand .role-pills { display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; margin-top: 32px; }
        .role-pill { padding: 6px 16px; border-radius: 20px; font-size: .78rem; font-weight: 600; letter-spacing: .5px; }
        .pill-admin   { background: rgba(239,68,68,.25);  color: #fca5a5; border: 1px solid rgba(239,68,68,.4); }
        .pill-teacher { background: rgba(34,197,94,.25);  color: #86efac; border: 1px solid rgba(34,197,94,.4); }
        .pill-student { background: rgba(59,130,246,.25); color: #93c5fd; border: 1px solid rgba(59,130,246,.4); }
        .auth-form { flex: 1; background: #fff; display: flex; flex-direction: column; justify-content: center; padding: 48px 44px; }
        .auth-form h2 { font-size: 1.6rem; font-weight: 700; color: #1e1b4b; margin-bottom: 6px; }
        .auth-form .subtitle { color: #6b7280; font-size: .9rem; margin-bottom: 32px; }
        .form-floating label { color: #9ca3af; }
        .form-control { border: 2px solid #e5e7eb; border-radius: 12px; padding: 14px 16px; font-size: .95rem; transition: border-color .2s, box-shadow .2s; }
        .form-control:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,.12); }
        .btn-signin { background: linear-gradient(135deg, #4f46e5, #7c3aed); border: none; border-radius: 12px; padding: 14px; font-size: 1rem; font-weight: 600; color: #fff; width: 100%; transition: transform .2s, box-shadow .2s; }
        .btn-signin:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79,70,229,.4); color: #fff; }
        .divider { display: flex; align-items: center; gap: 12px; color: #d1d5db; font-size: .85rem; margin: 20px 0; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e5e7eb; }
        .alert-custom { border-radius: 12px; border: none; font-size: .875rem; }
        @media (max-width: 640px) { .auth-brand { display: none; } .auth-form { padding: 36px 28px; } }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-brand">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <h1>Jurado</h1>
        <p>A modern student information system built with CodeIgniter 4 and Bootstrap 5.</p>

    </div>
    <div class="auth-form">
        <h2>Welcome back</h2>
        <p class="subtitle">Sign in to your account to continue</p>

        <?php if (session()->getFlashdata('notif_error')): ?>
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= session()->getFlashdata('notif_error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('notif_success')): ?>
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?= session()->getFlashdata('notif_success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST" autocomplete="off">
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border:2px solid #e5e7eb;border-right:none;border-radius:12px 0 0 12px;"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" name="inputEmail" class="form-control border-start-0" style="border-radius:0 12px 12px 0;border-left:none;" placeholder="you@jurado.edu" autocomplete="off" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border:2px solid #e5e7eb;border-right:none;border-radius:12px 0 0 12px;"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" name="inputPassword" id="inputPassword" class="form-control border-start-0" style="border-radius:0 12px 12px 0;border-left:none;" placeholder="••••••••" autocomplete="new-password" required>
                    <button type="button" class="btn btn-outline-secondary border-start-0" style="border:2px solid #e5e7eb;border-left:none;border-radius:0 12px 12px 0;" onclick="togglePwd()"><i class="bi bi-eye" id="eyeIcon"></i></button>
                </div>
            </div>
            <button type="submit" class="btn btn-signin mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>
        </form>
        <div class="divider">or</div>
        <p class="text-center text-muted small mb-0">
            Don't have an account? <a href="<?= base_url('register') ?>" class="text-decoration-none fw-semibold" style="color:#4f46e5;">Create one</a>
        </p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
function togglePwd() {
    const inp = document.getElementById('inputPassword');
    const ico = document.getElementById('eyeIcon');
    if (inp.type === 'password') { inp.type = 'text'; ico.className = 'bi bi-eye-slash'; }
    else { inp.type = 'password'; ico.className = 'bi bi-eye'; }
}
</script>
</body>
</html>

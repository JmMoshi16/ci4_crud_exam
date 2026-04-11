<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — Jurado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Inter', system-ui, sans-serif; background: #f4f6fa; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-wrapper { display: flex; width: 900px; max-width: 98vw; min-height: 580px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,.12); }
        .auth-brand { flex: 1; background: linear-gradient(135deg, #4f46e5, #312e81); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 40px; color: #fff; }
        .auth-brand .brand-icon { font-size: 72px; margin-bottom: 24px; opacity: .9; }
        .auth-brand h1 { font-size: 2rem; font-weight: 800; margin-bottom: 12px; letter-spacing: -0.5px; }
        .auth-brand p { opacity: .8; text-align: center; font-size: .95rem; line-height: 1.6; }
        .auth-form { flex: 1; background: #fff; display: flex; flex-direction: column; justify-content: center; padding: 40px 44px; }
        .auth-form h2 { font-size: 1.6rem; font-weight: 700; color: #064e3b; margin-bottom: 6px; }
        .auth-form .subtitle { color: #6b7280; font-size: .9rem; margin-bottom: 24px; }
        .form-control { border: 2px solid #e5e7eb; border-radius: 12px; padding: 12px 16px; font-size: .95rem; transition: border-color .2s, box-shadow .2s; }
        .form-control:focus { border-color: #059669; box-shadow: 0 0 0 4px rgba(5,150,105,.12); }
        .btn-register { background: linear-gradient(135deg, #059669, #0d9488); border: none; border-radius: 12px; padding: 14px; font-size: 1rem; font-weight: 600; color: #fff; width: 100%; transition: transform .2s, box-shadow .2s; }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(5,150,105,.4); color: #fff; }
        .alert-custom { border-radius: 12px; border: none; font-size: .875rem; }
        @media (max-width: 640px) { .auth-brand { display: none; } .auth-form { padding: 36px 28px; } }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-brand">
        <div class="brand-icon"><i class="bi bi-person-plus-fill"></i></div>
        <h1>Join Jurado</h1>
        <p>Create your student account and start managing your academic profile today.</p>
    </div>
    <div class="auth-form">
        <h2>Create Account</h2>
        <p class="subtitle">Fill in your details to get started</p>

        <?php if (session()->getFlashdata('notif_error')): ?>
            <div class="alert alert-danger alert-custom alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= session()->getFlashdata('notif_error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('register') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Full Name</label>
                <input type="text" name="inputFullname" class="form-control" placeholder="Juan dela Cruz" value="<?= old('inputFullname') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Role</label>
                <select name="inputRole" id="inputRole" class="form-control" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="admin"       <?= old('inputRole') === 'admin'       ? 'selected' : '' ?>>Administrator</option>
                    <option value="teacher"     <?= old('inputRole') === 'teacher'     ? 'selected' : '' ?>>Teacher</option>
                    <option value="coordinator" <?= old('inputRole') === 'coordinator' ? 'selected' : '' ?>>Coordinator</option>
                    <option value="student"     <?= old('inputRole') === 'student'     ? 'selected' : '' ?>>Student</option>
                </select>
            </div>

            <!-- Verification field — shown/hidden by JS -->
            <div class="mb-3" id="verifyWrap" style="display:none;">
                <label class="form-label fw-semibold text-secondary small" id="verifyLabel">Verification</label>
                <input type="text" name="inputVerify" id="inputVerify" class="form-control" placeholder="" value="<?= old('inputVerify') ?>">
                <div id="verifyHint" class="form-text" style="font-size:.78rem;"></div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Email Address</label>
                <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Select a role first" value="<?= old('inputEmail') ?>" required>
                <div id="emailHint" class="form-text" style="font-size:.78rem;"></div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <label class="form-label fw-semibold text-secondary small">Password</label>
                    <input type="password" name="inputPassword" class="form-control" placeholder="Min. 6 chars" required>
                </div>
                <div class="col-6">
                    <label class="form-label fw-semibold text-secondary small">Confirm Password</label>
                    <input type="password" name="inputPassword2" class="form-control" placeholder="Repeat password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-register mb-3">
                <i class="bi bi-person-check me-2"></i>Create Account
            </button>
        </form>
        <p class="text-center text-muted small mb-0">
            Already have an account? <a href="<?= base_url('/') ?>" class="text-decoration-none fw-semibold" style="color:#059669;">Sign in</a>
        </p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
const config = {
    admin:       { placeholder: 'admin@jurado.edu',       hint: 'Use your admin institutional email.',       verifyLabel: 'Admin Secret Code',          verifyHint: 'Enter the admin registration code.',          verifyPlaceholder: 'e.g. ADMIN@JURADO2024' },
    teacher:     { placeholder: 'teacher@jurado.edu',     hint: 'Use your teacher institutional email.',     verifyLabel: 'Teacher ID Number',           verifyHint: 'Enter your assigned teacher ID.',             verifyPlaceholder: 'e.g. TCH-001' },
    coordinator: { placeholder: 'coordinator@jurado.edu', hint: 'Use your coordinator institutional email.', verifyLabel: 'Coordinator Secret Code',     verifyHint: 'Enter the coordinator registration code.',    verifyPlaceholder: 'e.g. COORD@JURADO2024' },
    student:     { placeholder: 'student@jurado.edu',     hint: 'Use your student institutional email.',     verifyLabel: 'Student ID Number',           verifyHint: 'Enter your 9-digit student ID (e.g. 423001937).',             verifyPlaceholder: 'e.g. 423001937' },
};

const roleSelect    = document.getElementById('inputRole');
const verifyWrap    = document.getElementById('verifyWrap');
const verifyLabel   = document.getElementById('verifyLabel');
const verifyInput   = document.getElementById('inputVerify');
const verifyHint    = document.getElementById('verifyHint');
const emailInput    = document.getElementById('inputEmail');
const emailHint     = document.getElementById('emailHint');

roleSelect.addEventListener('change', function () {
    const c = config[this.value];
    if (!c) { verifyWrap.style.display = 'none'; return; }

    emailInput.placeholder   = c.placeholder;
    emailHint.textContent    = c.hint;

    verifyLabel.textContent  = c.verifyLabel;
    verifyInput.placeholder  = c.verifyPlaceholder;
    verifyHint.textContent   = c.verifyHint;
    verifyWrap.style.display = 'block';
    verifyInput.required     = true;
});

// Re-apply on page load if old() value is set (validation failed)
if (roleSelect.value) roleSelect.dispatchEvent(new Event('change'));
</script>
</body>
</html>

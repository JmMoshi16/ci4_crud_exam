<?php 
$role = session('user')['role'] ?? 'guest'; 
$segment = service('uri')->getSegment(1); 
$subsegment = service('uri')->getSegment(2);
?>
<aside class="sidebar-wrapper" style="background-color: #000000; border-right: 1px solid rgba(255,255,255,0.05); border-radius: 0;">
    <a href="<?= base_url() ?>" class="d-flex align-items-center text-white text-decoration-none px-4 py-4 mb-2">
        <i class="bi bi-fan me-2" style="font-size: 1.25rem; color: #818cf8; animation: spin 4s linear infinite;"></i> 
        <span style="font-weight: 700; font-size: 1.15rem; letter-spacing: -0.02em;">Jurado</span>
    </a>
    
    <nav class="sidebar-nav px-3">

        <?php if ($role === 'admin'): ?>
        <div class="nav-group-title mt-2 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Main</div>
        <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= $segment === 'dashboard' ? 'active' : '' ?>">
            <i class="bi bi-grid-1x2<?= $segment === 'dashboard' ? '-fill' : '' ?>"></i> Dashboard
        </a>
        <a href="<?= base_url('students') ?>" class="nav-item-link <?= $segment === 'students' ? 'active' : '' ?>">
            <i class="bi bi-people<?= $segment === 'students' ? '-fill' : '' ?>"></i> Students
        </a>
        <a href="<?= base_url('student/dashboard') ?>" class="nav-item-link <?= $segment === 'student' ? 'active' : '' ?>">
            <i class="bi bi-house-door<?= $segment === 'student' ? '-fill' : '' ?>"></i> Student Dashboard
        </a>
        <a href="<?= base_url('profile') ?>" class="nav-item-link <?= ($segment === 'profile' && empty($subsegment)) ? 'active' : '' ?>">
            <i class="bi bi-person-vcard<?= ($segment === 'profile' && empty($subsegment)) ? '-fill' : '' ?>"></i> My Profile
        </a>
        <a href="<?= base_url('profile/edit') ?>" class="nav-item-link <?= ($segment === 'profile' && $subsegment === 'edit') ? 'active' : '' ?>">
            <i class="bi bi-sliders2"></i> Edit Profile
        </a>
        <div class="nav-group-title mt-4 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Admin Panel</div>
        <a href="<?= base_url('admin/roles') ?>" class="nav-item-link <?= ($segment === 'admin' && $subsegment === 'roles') ? 'active' : '' ?>">
            <i class="bi bi-shield-lock<?= ($segment === 'admin' && $subsegment === 'roles') ? '-fill' : '' ?>"></i> Role Management
        </a>
        <a href="<?= base_url('admin/users') ?>" class="nav-item-link <?= ($segment === 'admin' && $subsegment === 'users') ? 'active' : '' ?>">
            <i class="bi bi-person-bounding-box"></i> User Management
        </a>

        <?php elseif ($role === 'teacher'): ?>
        <div class="nav-group-title mt-2 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Main</div>
        <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= $segment === 'dashboard' ? 'active' : '' ?>">
            <i class="bi bi-grid-1x2<?= $segment === 'dashboard' ? '-fill' : '' ?>"></i> Dashboard
        </a>
        <a href="<?= base_url('students') ?>" class="nav-item-link <?= $segment === 'students' ? 'active' : '' ?>">
            <i class="bi bi-book<?= $segment === 'students' ? '-fill' : '' ?>"></i> Students
        </a>
        <a href="<?= base_url('profile') ?>" class="nav-item-link <?= ($segment === 'profile' && empty($subsegment)) ? 'active' : '' ?>">
            <i class="bi bi-person-vcard<?= ($segment === 'profile' && empty($subsegment)) ? '-fill' : '' ?>"></i> My Profile
        </a>
        <a href="<?= base_url('profile/edit') ?>" class="nav-item-link <?= ($segment === 'profile' && $subsegment === 'edit') ? 'active' : '' ?>">
            <i class="bi bi-sliders2"></i> Edit Profile
        </a>
        <div class="nav-group-title mt-4 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Restricted</div>
        <a href="<?= base_url('student/dashboard') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-house-door"></i> Student Dashboard <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <a href="<?= base_url('admin/roles') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-shield-lock"></i> Role Management <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <a href="<?= base_url('admin/users') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-person-bounding-box"></i> User Management <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>

        <?php elseif ($role === 'coordinator'): ?>
        <div class="nav-group-title mt-2 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Main</div>
        <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= $segment === 'dashboard' ? 'active' : '' ?>">
            <i class="bi bi-grid-1x2<?= $segment === 'dashboard' ? '-fill' : '' ?>"></i> Dashboard
        </a>
        <a href="<?= base_url('students') ?>" class="nav-item-link <?= $segment === 'students' ? 'active' : '' ?>">
            <i class="bi bi-people<?= $segment === 'students' ? '-fill' : '' ?>"></i> Students
        </a>
        <a href="<?= base_url('profile') ?>" class="nav-item-link <?= ($segment === 'profile' && empty($subsegment)) ? 'active' : '' ?>">
            <i class="bi bi-person-vcard<?= ($segment === 'profile' && empty($subsegment)) ? '-fill' : '' ?>"></i> My Profile
        </a>
        <a href="<?= base_url('profile/edit') ?>" class="nav-item-link <?= ($segment === 'profile' && $subsegment === 'edit') ? 'active' : '' ?>">
            <i class="bi bi-sliders2"></i> Edit Profile
        </a>
        <div class="nav-group-title mt-4 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Restricted</div>
        <a href="<?= base_url('student/dashboard') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-house-door"></i> Student Dashboard <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <a href="<?= base_url('admin/roles') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-shield-lock"></i> Role Management <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <a href="<?= base_url('admin/users') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-person-bounding-box"></i> User Management <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>

        <?php else: ?>
        <div class="nav-group-title mt-2 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Main</div>
        <a href="<?= base_url('student/dashboard') ?>" class="nav-item-link <?= $segment === 'student' ? 'active' : '' ?>">
            <i class="bi bi-house-door<?= $segment === 'student' ? '-fill' : '' ?>"></i> Dashboard
        </a>
        <a href="<?= base_url('profile') ?>" class="nav-item-link <?= ($segment === 'profile' && empty($subsegment)) ? 'active' : '' ?>">
            <i class="bi bi-person-vcard<?= ($segment === 'profile' && empty($subsegment)) ? '-fill' : '' ?>"></i> My Profile
        </a>
        <a href="<?= base_url('profile/edit') ?>" class="nav-item-link <?= ($segment === 'profile' && $subsegment === 'edit') ? 'active' : '' ?>">
            <i class="bi bi-sliders2"></i> Edit Profile
        </a>
        <div class="nav-group-title mt-4 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Restricted</div>
        <a href="<?= base_url('dashboard') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-grid-1x2"></i> Dashboard <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <a href="<?= base_url('students') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-people"></i> Students <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <a href="<?= base_url('admin/roles') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-shield-lock"></i> Role Management <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <a href="<?= base_url('admin/users') ?>" class="nav-item-link nav-item-locked">
            <i class="bi bi-person-bounding-box"></i> User Management <i class="bi bi-lock-fill ms-auto" style="font-size:0.7rem;"></i>
        </a>
        <?php endif; ?>

    </nav>
    
    <div class="p-3 mt-auto mx-2 mb-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="d-flex align-items-center gap-3 mb-3 px-2 py-2 rounded" style="background: rgba(255,255,255,0.03);">
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: rgba(99,102,241,0.1); border: 1px solid rgba(99,102,241,0.2); color: #818cf8;">
                <i class="bi bi-lightning-charge-fill" style="font-size: 0.85rem;"></i>
            </div>
            <div class="overflow-hidden">
                <div class="text-truncate" style="font-size: 0.8rem; font-weight: 600; color: #f8fafc; letter-spacing: -0.01em;"><?= esc(session('user')['fullname'] ?? 'Offline') ?></div>
                <div class="text-truncate" style="font-size: 0.65rem; font-weight: 700; color: #34d399; text-transform: uppercase; letter-spacing: 0.05em;"><span style="color: #10b981; margin-right: 4px;">●</span> <?= esc($role) ?></div>
            </div>
        </div>
        <a href="<?= base_url('logout') ?>" class="nav-item-link px-3 d-flex align-items-center gap-2 rounded" style="color: #a1a1aa;" onmouseover="this.style.color='#fb7185';" onmouseout="this.style.color='#a1a1aa';">
            <i class="bi bi-power"></i> Sign Out
        </a>
    </div>
</aside>
<style>
@keyframes spin { 100% { transform: rotate(360deg); } }
.nav-item-link {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.6rem 1rem; border-radius: 8px;
    font-size: 0.9rem; font-weight: 500;
    color: #a1a1aa;
    text-decoration: none;
    transition: all 0.2s;
    margin-bottom: 0.25rem;
}
.nav-item-link:hover {
    background: rgba(255,255,255,0.05); color: #fff !important;
}
.nav-item-link.active {
    background: rgba(99,102,241,0.1); color: #fff !important;
    box-shadow: inset 2px 0 0 #818cf8;
}
.nav-item-link.nav-item-locked {
    color: #6b7280 !important;
    opacity: 0.6;
    cursor: pointer;
}
.nav-item-link.nav-item-locked:hover {
    background: rgba(251,113,133,0.08);
    color: #fb7185 !important;
    opacity: 1;
}
</style>

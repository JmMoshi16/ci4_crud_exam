<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<!-- Handled by topbar -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
    <div>
        <h2 class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">Welcome back, <?= esc($user['fullname'] ?? 'Student') ?></h2>
        <p class="mb-0" style="font-size: 0.875rem; color: var(--text-secondary);">Here's an overview of your academic records and information.</p>
    </div>
    <a href="<?= base_url('profile/edit') ?>" class="clean-btn-primary text-decoration-none d-inline-block text-center shadow-sm-clean">Edit Profile</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="clean-card p-4 h-100 position-relative border-0 shadow-md-clean" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em;">Student ID</div>
                <div class="icon-shape bg-indigo-50 text-indigo-600"><i class="bi bi-person-badge"></i></div>
            </div>
            <div style="font-size: 1.25rem; font-weight: 600; font-family: monospace; color: var(--text-primary);"><?= esc($user['student_id'] ?? '—') ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="clean-card p-4 h-100 position-relative border-0 shadow-md-clean" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em;">Course Program</div>
                <div class="icon-shape bg-emerald-50 text-emerald-600"><i class="bi bi-book"></i></div>
            </div>
            <div style="font-size: 1.1rem; font-weight: 500; color: var(--text-primary);"><?= esc($user['course'] ?? '—') ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="clean-card p-4 h-100 position-relative border-0 shadow-md-clean" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em;">Year & Section</div>
                <div class="icon-shape bg-amber-50 text-amber-600"><i class="bi bi-calendar3"></i></div>
            </div>
            <div style="font-size: 1.1rem; font-weight: 500; color: var(--text-primary);"><?= esc($user['year_level'] ?? '-') ?> &mdash; <?= esc($user['section'] ?? '-') ?></div>
        </div>
    </div>
</div>

<div class="clean-card shadow-md-clean border-0" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);">
    <div class="px-4 py-3" style="background-color: rgba(255, 255, 255, 0.02); border-bottom: 1px solid var(--border-light);">
        <h5 class="mb-0" style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary);">Contact Details</h5>
    </div>
    <div class="p-0 table-responsive border-0">
        <table class="table mb-0 border-0" style="font-size: 0.875rem;">
            <tbody>
                <tr>
                    <td class="px-4 py-3 border-bottom text-muted" style="width: 250px; background: transparent; border-color: var(--border-light) !important;">Email Address</td>
                    <td class="px-4 py-3 border-bottom fw-medium text-dark" style="background: transparent; border-color: var(--border-light) !important;"><?= esc($user['email'] ?? '—') ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-3 border-bottom text-muted" style="background: transparent; border-color: var(--border-light) !important;">Phone Number</td>
                    <td class="px-4 py-3 border-bottom fw-medium text-dark" style="background: transparent; border-color: var(--border-light) !important;"><?= esc($user['phone'] ?? '—') ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-3 border-bottom-0 text-muted" style="background: transparent;">Home Address</td>
                    <td class="px-4 py-3 border-bottom-0 fw-medium text-dark" style="background: transparent;"><?= esc($user['address'] ?? '—') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

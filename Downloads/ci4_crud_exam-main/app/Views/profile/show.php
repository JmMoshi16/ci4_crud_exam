<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<!-- Handled by topbar -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row g-4 pb-4">
    <!-- Left Column: Quick Profile Info -->
    <div class="col-lg-4">
        <div class="clean-card mb-4 border-0 shadow-md-clean" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);">
            <div class="p-4 d-flex flex-column align-items-center text-center">
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" alt="Profile" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid var(--border-light); box-shadow: 0 8px 16px rgba(0,0,0,0.5); margin-bottom: 1.25rem;">
                <?php else: ?>
                    <div style="width: 120px; height: 120px; border-radius: 50%; background-color: rgba(255,255,255,0.05); color: var(--text-secondary); display: flex; justify-content: center; align-items: center; border: 4px solid var(--border-light); box-shadow: 0 8px 16px rgba(0,0,0,0.5); margin-bottom: 1.25rem; backdrop-filter: blur(10px);">
                        <i class="bi bi-person-fill" style="font-size: 3.5rem;"></i>
                    </div>
                <?php endif; ?>
                
                <h5 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.25rem; letter-spacing: -0.02em;"><?= esc($user['fullname']) ?></h5>
                <p style="font-size: 0.9rem; color: var(--accent-hover); font-weight: 500; margin-bottom: 1.25rem;">@<?= esc($user['username']) ?></p>
                <div class="px-3 py-1 mb-4" style="background: rgba(255,255,255,0.08); border-radius: 20px; font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase;">
                    <?= esc(session('user')['role'] ?? 'Student') ?>
                </div>
                
                <a href="<?= base_url('profile/edit') ?>" class="clean-btn-primary w-100 text-decoration-none text-center">Edit Profile</a>
            </div>
            
            <div class="border-top border-light p-4" style="background-color: rgba(0,0,0,0.2);">
                <div class="d-flex justify-content-between mb-3">
                    <span style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 500;">Joined Date</span>
                    <span style="font-size: 0.85rem; color: var(--text-primary); font-weight: 600;"><?= isset($user['created_at']) ? date('M Y', strtotime($user['created_at'])) : 'Unknown' ?></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 500;">Status</span>
                    <span class="text-emerald-600" style="font-size: 0.85rem; font-weight: 700;"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; text-shadow: 0 0 10px rgba(52, 211, 153, 0.8);"></i> Active</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Column: Data Tables -->
    <div class="col-lg-8">
        <div class="clean-card mb-4 border-0 shadow-md-clean" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);">
            <div class="p-4 border-bottom border-light" style="background-color: rgba(255, 255, 255, 0.02);">
                <h6 class="mb-0 text-emerald-600" style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;"><i class="bi bi-mortarboard me-2"></i>Academic Record</h6>
            </div>
            <div class="p-0 table-responsive border-0">
                <table class="table mb-0 border-0" style="font-size: 0.9rem;">
                    <tbody>
                        <tr>
                            <td class="px-4 py-3 border-bottom text-muted fw-medium" style="width: 30%; border-color: var(--border-light) !important; background: transparent;">Student ID</td>
                            <td class="px-4 py-3 border-bottom fw-bold text-dark" style="border-color: var(--border-light) !important; background: transparent;"><?= esc($user['student_id'] ?? 'Not Set') ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border-bottom text-muted fw-medium" style="border-color: var(--border-light) !important; background: transparent;">Course/Program</td>
                            <td class="px-4 py-3 border-bottom fw-bold text-dark" style="border-color: var(--border-light) !important; background: transparent;"><?= esc($user['course'] ?? 'Not Set') ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border-bottom text-muted fw-medium" style="border-color: var(--border-light) !important; background: transparent;">Year Level</td>
                            <td class="px-4 py-3 border-bottom fw-bold text-dark" style="border-color: var(--border-light) !important; background: transparent;"><?= esc($user['year_level'] ?? 'Not Set') ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border-bottom-0 text-muted fw-medium" style="background: transparent;">Section</td>
                            <td class="px-4 py-3 border-bottom-0 fw-bold text-dark" style="background: transparent;"><?= esc($user['section'] ?? 'Not Set') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="clean-card border-0 shadow-md-clean" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);">
            <div class="p-4 border-bottom border-light" style="background-color: rgba(255, 255, 255, 0.02);">
                <h6 class="mb-0 text-indigo-600" style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;"><i class="bi bi-person-vcard me-2"></i>Contact Details</h6>
            </div>
            <div class="p-0 table-responsive border-0">
                <table class="table mb-0 border-0" style="font-size: 0.9rem;">
                    <tbody>
                        <tr>
                            <td class="px-4 py-3 border-bottom text-muted fw-medium" style="width: 30%; border-color: var(--border-light) !important; background: transparent;">Email Address</td>
                            <td class="px-4 py-3 border-bottom fw-bold text-dark" style="border-color: var(--border-light) !important; background: transparent;"><?= esc($user['email']) ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border-bottom text-muted fw-medium" style="border-color: var(--border-light) !important; background: transparent;">Phone Number</td>
                            <td class="px-4 py-3 border-bottom fw-bold text-dark" style="border-color: var(--border-light) !important; background: transparent;"><?= esc($user['phone'] ?? 'Not Set') ?></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border-bottom-0 text-muted fw-medium" style="background: transparent;">Home Address</td>
                            <td class="px-4 py-3 border-bottom-0 fw-bold text-dark" style="background: transparent;"><?= nl2br(esc($user['address'] ?? 'Not Set')) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

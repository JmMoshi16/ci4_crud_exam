<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<!-- Handled by topbar -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
    <div>
        <h2 class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">User Identity & Access</h2>
        <p class="mb-0" style="font-size: 0.875rem; color: var(--text-secondary);">Manage system privileges and enforce RBAC topology.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="btn shadow-sm-clean d-inline-flex align-items-center" style="background: rgba(255,255,255,0.05); color: #f8fafc; border: 1px solid var(--border-light); font-weight: 500; font-size: 0.9rem; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
        <i class="bi bi-sliders2 me-2" style="color: #6366f1;"></i> Configure Roles
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success d-flex align-items-center mb-4" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #34d399; font-size: 0.875rem; border-radius: 8px;">
        <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" style="opacity: 0.5;"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger d-flex align-items-center mb-4" style="background: rgba(244,63,94,0.1); border: 1px solid rgba(244,63,94,0.2); color: #fb7185; font-size: 0.875rem; border-radius: 8px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" style="opacity: 0.5;"></button>
    </div>
<?php endif; ?>

<div class="alert d-flex align-items-start gap-3 mb-4" style="background: rgba(99,102,241,0.05); border: 1px solid rgba(99,102,241,0.2); color: #a5b4fc; border-radius: 8px;">
    <i class="bi bi-lightning-charge-fill fs-5 flex-shrink-0 mt-1" style="color: #818cf8; filter: drop-shadow(0 0 8px rgba(129,140,248,0.5));"></i>
    <div style="font-size: 0.875rem; line-height: 1.5;">
        <strong style="color: #c7d2fe;">Privilege Distribution Center</strong><br>
        Changes made here manipulate session tokens and take effect upon the target user's next authenticated login cycle.
    </div>
</div>

<div class="clean-card shadow-md-clean border-0" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.05);">
    <div class="px-4 py-3 border-bottom d-flex align-items-center" style="border-color: rgba(255,255,255,0.05) !important;">
        <h6 class="mb-0" style="color: var(--text-primary); font-size: 0.9rem; font-weight: 600;">System Identities</h6>
        <span class="ms-2 px-2 py-1 rounded-pill" style="background: rgba(255,255,255,0.05); color: #9ca3af; font-size: 0.7rem; font-weight: 600;"><?= count($users) ?> DETECTED</span>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0" style="color: var(--text-secondary); border-color: var(--border-light);">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-light); background: rgba(0,0,0,0.2);">
                        <th class="ps-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; border: none; width: 60px;">ID</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; border: none;">Identity Root</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; border: none;">Email Vector</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; border: none;">Clearance Level</th>
                        <th class="pe-4 py-3 text-uppercase text-end" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; border: none; width: 250px;">Topology Assignment</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    <?php foreach ($users as $i => $u): ?>
                    <?php
                        $isSelf = ($u['id'] == (session('user')['id'] ?? 0));
                        
                        $badgeBg = 'rgba(255,255,255,0.05)';
                        $badgeColor = '#9ca3af';
                        $badgeBorder = 'rgba(255,255,255,0.1)';
                        
                        if ($u['role_name'] === 'admin') {
                            $badgeBg = 'rgba(225,29,72,0.1)'; $badgeColor = '#fb7185'; $badgeBorder = 'rgba(225,29,72,0.2)';
                        } elseif ($u['role_name'] === 'teacher') {
                            $badgeBg = 'rgba(16,185,129,0.1)'; $badgeColor = '#34d399'; $badgeBorder = 'rgba(16,185,129,0.2)';
                        } elseif ($u['role_name'] === 'student') {
                            $badgeBg = 'rgba(59,130,246,0.1)'; $badgeColor = '#60a5fa'; $badgeBorder = 'rgba(59,130,246,0.2)';
                        }
                    ?>
                    <tr style="transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                        <td class="ps-4 py-3 text-muted" style="border-bottom: 1px solid var(--border-light); font-size: 0.85rem; font-family: monospace;">#<?= sprintf('%04d', $u['id']) ?></td>
                        <td class="py-3" style="border-bottom: 1px solid var(--border-light);">
                            <div class="d-flex align-items-center gap-3">
                                <?php if (!empty($u['profile_image'])): ?>
                                    <img src="<?= base_url('uploads/profiles/' . esc($u['profile_image'])) ?>"
                                         class="rounded-circle" style="width:40px;height:40px;object-fit:cover; border: 2px solid var(--border-light);" alt="">
                                <?php else: ?>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:40px;height:40px;flex-shrink:0; background: rgba(255,255,255,0.03); border: 1px solid var(--border-dark);">
                                        <i class="bi bi-person-fill" style="color: var(--text-secondary); font-size: 1.2rem;"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div style="font-weight: 600; color: var(--text-primary); font-size: 0.95rem; letter-spacing: -0.01em;"><?= esc($u['name']) ?></div>
                                    <?php if ($isSelf): ?>
                                        <div style="font-size: 0.7rem; font-weight: 700; color: #fbbf24; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 2px;">Active Unit (You)</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="py-3" style="border-bottom: 1px solid var(--border-light); font-size: 0.85rem; color: #a1a1aa; font-family: monospace;">
                            <?= esc($u['email']) ?>
                        </td>
                        <td class="py-3" style="border-bottom: 1px solid var(--border-light);">
                            <span class="px-2 py-1 rounded" style="background: <?= $badgeBg ?>; color: <?= $badgeColor ?>; border: 1px solid <?= $badgeBorder ?>; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                                <?= esc($u['role_label'] ?? 'UNASSIGNED') ?>
                            </span>
                        </td>
                        <td class="py-3 pe-4 text-end" style="border-bottom: 1px solid var(--border-light);">
                            <?php if ($isSelf): ?>
                                <span class="d-inline-flex align-items-center" style="color: #71717a; font-size: 0.8rem; font-weight: 500;">
                                    <i class="bi bi-shield-lock-fill me-2" style="font-size: 0.9rem;"></i> Self-modification locked
                                </span>
                            <?php else: ?>
                            <form action="<?= base_url('/admin/users/assign-role/' . $u['id']) ?>" method="POST" class="d-flex align-items-center justify-content-end gap-2 m-0">
                                <?= csrf_field() ?>
                                <select name="role_id" class="clean-input py-1 px-2 m-0" style="font-size: 0.8rem; height: 32px; width: auto; max-width: 130px; background: rgba(0,0,0,0.2);">
                                    <?php foreach ($roles as $roleId => $roleLabel): ?>
                                        <option value="<?= $roleId ?>" style="background: #18181b;" <?= $u['role_id'] == $roleId ? 'selected' : '' ?>>
                                            <?= esc($roleLabel) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-sm d-inline-flex align-items-center justify-content-center border-0 text-white shadow-sm" style="background: #4f46e5; height: 32px; font-weight: 600; font-size: 0.8rem; transition: background 0.2s;" onmouseover="this.style.background='#6366f1'" onmouseout="this.style.background='#4f46e5'">
                                    Commit
                                </button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

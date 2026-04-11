<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<!-- Handled by topbar -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $isCore = $role && in_array($role['name'], ['admin','teacher','student']); ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
    <div>
        <h2 class="mb-1 d-flex align-items-center" style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">Configuring Role <span class="badge ms-3 fs-6" style="background: rgba(255,255,255,0.05); color: #9ca3af; border: 1px solid var(--border-light); font-family: monospace; letter-spacing: 0.05em;">@<?= esc($role['name']) ?></span></h2>
        <p class="mb-0" style="font-size: 0.875rem; color: var(--text-secondary);">Modify the metadata parameters corresponding to this system clearance protocol.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="btn d-inline-flex align-items-center rounded-pill" style="font-size: 0.85rem; font-weight: 600; background: rgba(255,255,255,0.05); border: 1px solid var(--border-light); color: var(--text-secondary); transition: color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#9ca3af'">
        <i class="bi bi-arrow-left me-2"></i> Cancel Modification
    </a>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="clean-card shadow-lg border-0" style="background: rgba(24, 24, 27, 0.4); box-shadow: inset 0 1px 0 rgba(255,255,255,0.05);">
            <div class="card-body p-4 p-md-5">
                
                <?php if (session()->getFlashdata('errors') || session('errors')): ?>
                    <div class="alert d-flex mb-4" style="background: rgba(244,63,94,0.1); border: 1px solid rgba(244,63,94,0.2); color: #fb7185; font-size: 0.8rem; border-radius: 8px;">
                        <i class="bi bi-exclamation-square-fill fs-5 flex-shrink-0 mt-1 me-2"></i>
                        <div>
                            <?php foreach ((session('errors') ?? []) as $err): ?>
                                <div class="mb-1"><?= esc($err) ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/roles/update/' . $role['id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <label class="form-label" style="font-size: 0.8rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">Identifier Slug <span class="text-rose-500">*</span></label>
                        <div class="input-group" style="background: rgba(0,0,0,0.2); border: 1px solid var(--border-light); border-radius: 8px; overflow: hidden;">
                            <span class="input-group-text border-0" style="background: transparent; color: #a1a1aa; padding-right: 0;">@</span>
                            <input type="text" name="name" class="form-control border-0 shadow-none" value="<?= old('name', $role['name']) ?>" <?= $isCore ? 'readonly' : '' ?> style="background: transparent; color: <?= $isCore ? '#52525b' : '#f8fafc' ?>; font-family: monospace; font-size: 0.95rem;">
                            <?php if ($isCore): ?>
                                <span class="input-group-text border-0" style="background: transparent; color: #fbbf24;" title="Core Logic Locked"><i class="bi bi-lock-fill"></i></span>
                            <?php endif; ?>
                        </div>
                        <?php if ($isCore): ?>
                            <div class="form-text" style="color: #fbbf24; font-size: 0.75rem; margin-top: 0.5rem;"><i class="bi bi-shield-lock me-1"></i>Core routing identifier permanently locked against mutation.</div>
                        <?php else: ?>
                            <div class="form-text" style="color: #52525b; font-size: 0.75rem; margin-top: 0.5rem;">Modifying the slug requires pipeline realignment in CodeIgniter's router.</div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label" style="font-size: 0.8rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">Display Label <span class="text-rose-500">*</span></label>
                        <input type="text" name="label" class="clean-input w-100" value="<?= old('label', $role['label']) ?>" style="background: rgba(0,0,0,0.2);">
                    </div>
                    
                    <div class="mb-5">
                        <label class="form-label" style="font-size: 0.8rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">Function Description</label>
                        <textarea name="description" class="clean-input w-100" rows="3" style="background: rgba(0,0,0,0.2); resize: none;"><?= old('description', $role['description'] ?? '') ?></textarea>
                    </div>
                    
                    <button type="submit" class="clean-btn-primary w-100 d-flex justify-content-center align-items-center shadow-lg border-0 py-3" style="font-size: 0.95rem; letter-spacing: -0.01em; background: #fbbf24; color: #451a03;" onmouseover="this.style.background='#f59e0b'" onmouseout="this.style.background='#fbbf24'">
                        <i class="bi bi-lightning-charge-fill me-2 fs-5"></i> Overwrite Topology
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

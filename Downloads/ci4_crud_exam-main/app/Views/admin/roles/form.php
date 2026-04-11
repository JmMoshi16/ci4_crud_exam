<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-bold">
            <i class="bi bi-shield-<?= $role ? 'check' : 'plus' ?>-fill me-2 text-danger"></i>
            <?= $title ?>
        </h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/roles') ?>">Roles</a></li>
            <li class="breadcrumb-item active"><?= $role ? 'Edit' : 'Create' ?></li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $isCore = $role && in_array($role['name'], ['admin','teacher','student']); ?>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <?php if (session()->getFlashdata('errors') || session('errors')): ?>
                    <div class="alert alert-danger rounded-3">
                        <?php foreach ((session('errors') ?? []) as $err): ?>
                            <div><i class="bi bi-exclamation-circle me-1"></i><?= esc($err) ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= $role ? base_url('admin/roles/update/' . $role['id']) : base_url('admin/roles/store') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug (name) <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="<?= old('name', $role['name'] ?? '') ?>"
                               placeholder="e.g. coordinator"
                               <?= $isCore ? 'readonly' : '' ?>>
                        <?php if ($isCore): ?>
                            <div class="form-text text-warning"><i class="bi bi-lock me-1"></i>Core role slug is locked.</div>
                        <?php else: ?>
                            <div class="form-text">Lowercase letters, numbers, underscores only.</div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Label <span class="text-danger">*</span></label>
                        <input type="text" name="label" class="form-control"
                               value="<?= old('label', $role['label'] ?? '') ?>"
                               placeholder="e.g. Coordinator">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Optional description..."><?= old('description', $role['description'] ?? '') ?></textarea>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?= base_url('admin/roles') ?>" class="btn btn-light rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="bi bi-check-lg me-1"></i><?= $role ? 'Update Role' : 'Create Role' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

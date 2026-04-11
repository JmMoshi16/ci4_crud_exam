<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Jurado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/premium.css') ?>?v=<?= time() ?>" />
</head>
<body>
    <div class="layout-wrapper">
        <?= $this->include('layouts/sidebar') ?>
        
        <div class="main-wrapper">
            <?= $this->include('layouts/header') ?>
            
            <main class="content-wrapper">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success border-clean shadow-sm-clean mb-4 d-flex align-items-center" style="background: #ecfdf5; color: #065f46; font-size: 0.9rem;">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i><?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <?= $this->renderSection('javascript') ?>
</body>
</html>

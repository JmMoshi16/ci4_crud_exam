<?php
$alerts = [
    'notif_success' => ['success', 'check-circle-fill'],
    'notif_warning' => ['warning', 'exclamation-triangle-fill'],
    'notif_primary' => ['primary', 'info-circle-fill'],
    'notif_info'    => ['info',    'info-circle-fill'],
    'notif_error'   => ['danger',  'exclamation-triangle-fill'],
];
foreach ($alerts as $key => [$type, $icon]):
    $msg = session()->getFlashdata($key);
    if ($msg):
?>
<div class="alert alert-<?= $type ?> flash-alert alert-dismissible fade show shadow-sm mb-3" role="alert">
    <i class="bi bi-<?= $icon ?> me-2"></i><?= $msg ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; endforeach; ?>

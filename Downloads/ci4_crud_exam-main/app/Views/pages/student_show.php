<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Student Details</h2>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9"><?= esc($student['id']) ?></dd>
                        
                        <dt class="col-sm-3">Full Name:</dt>
                        <dd class="col-sm-9"><?= esc($student['name']) ?></dd>
                        
                        <dt class="col-sm-3">Email Address:</dt>
                        <dd class="col-sm-9"><?= esc($student['email']) ?></dd>
                        
                        <dt class="col-sm-3">Course:</dt>
                        <dd class="col-sm-9"><?= esc($student['course']) ?></dd>
                        
                        <dt class="col-sm-3">Created At:</dt>
                        <dd class="col-sm-9"><?= isset($student['created_at']) ? date('F d, Y h:i A', strtotime($student['created_at'])) : 'N/A' ?></dd>
                        
                        <dt class="col-sm-3">Updated At:</dt>
                        <dd class="col-sm-9"><?= isset($student['updated_at']) ? date('F d, Y h:i A', strtotime($student['updated_at'])) : 'N/A' ?></dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="/student/edit/<?= $student['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/students" class="btn btn-secondary">Back to List</a>
                    <form action="/student/delete/<?= $student['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Student Management System</h2>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= isset($student) ? 'Edit Student' : 'Add New Student' ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= isset($student) ? '/student/update/' . $student['id'] : '/student/store' ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?= isset($student) ? esc($student['name']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?= isset($student) ? esc($student['email']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" name="course" class="form-control" placeholder="Course (e.g., BSIT)" value="<?= isset($student) ? esc($student['course']) : '' ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= isset($student) ? 'Update Student' : 'Add Student' ?></button>
                        <?php if(isset($student)): ?>
                            <a href="/students" class="btn btn-secondary">Cancel</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Students</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($students)): foreach($students as $s): ?>
                            <tr>
                                <td><a href="/student/show/<?= $s['id'] ?>"><?= esc($s['name']) ?></a></td>
                                <td><?= esc($s['email']) ?></td>
                                <td><?= esc($s['course']) ?></td>
                                <td>
                                    <a href="/student/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="/student/delete/<?= $s['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No students found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if(!empty($students)): ?>
                <div class="card-footer clearfix">
                    <?= $pager->links() ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

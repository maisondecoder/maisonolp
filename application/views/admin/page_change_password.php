<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Change Password</h1>
    <?php echo '<div class="text-danger">' . validation_errors() . '</div>'; ?>
    <div class="card shadow mb-4 p-4 col-sm-12 col-md-12 col-lg-5">
        <?= $this->session->flashdata('admin_change_password'); ?>
        <form action="<?= base_url('admin/change_password') ?>" method="post">
            <div class="mb-3">
                <label for="pass-finput" class="form-label">New Password</label>
                <input name="pass-input" type="password" class="form-control" id="pass-finput" required>
            </div>
            <div class="mb-3">
                <label for="conpass-finput" class="form-label">Confirm New Password</label>
                <input name="conpass-input" type="password" class="form-control" id="conpass-finput" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary mt-4 form-control">Save</button>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
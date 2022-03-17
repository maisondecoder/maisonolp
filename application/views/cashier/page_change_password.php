<div class="container p-4 bg-dark">
    <h3 class="mt-2 mb-4 text-white">Change Password</h3>

    <?php echo '<div class="text-danger">' . validation_errors() . '</div>'; ?>
</div>
<div class="bg-white p-4" style="margin-top:-15px; margin-bottom:95px; border-radius: 16px">
    <?= $this->session->flashdata('cashier_change_password'); ?>
    <form action="<?= base_url('cashier/change_password'); ?>" method="post">
        <div class="row mb-3">
            <label for="inputNewPass" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
                <input type="password" name="pass-input" class="form-control" id="inputNewPass" placeholder="" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputConNewPass" class="col-sm-3 col-form-label">Confirm New Password</label>
            <div class="col-sm-9">
                <input type="password" name="conpass-input" class="form-control" id="inputConNewPass" placeholder="" required>
            </div>
        </div>
        <div class="row p-2">
            <input class="btn btn-large btn-primary" type="submit" value="Change My Password">
        </div>
    </form>
</div>
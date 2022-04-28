<div class="container p-4">
    <h3 class="mt-2 mb-2 text-white"><a href="<?= base_url('user'); ?>" class="me-3 text-white"><i class="fas fa-arrow-left"></i></a>Change Password</h3>
</div>
<div class="container bg-white p-4 mb-3" style="margin-bottom:100px !important; border-radius: 16px">
    <span class="text-danger"><?php echo validation_errors(); ?></span>
    <form action="<?= base_url('user/change_password/'); ?>" method="post">
        <div class="mb-4">
            <label for="pass-input" class="form-label">New Password</label>
            <input type="password" class="form-control mb-2" name="pass-input" id="pass-input" minlength="6" maxlength="60" aria-describedby="pass-input" placeholder="" required>

            <label for="conpass-input" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control mb-2" name="conpass-input" id="conpass-input" minlength="6" maxlength="60" aria-describedby="conpass-input" placeholder="" required>

        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn cus-dark-btn">Save New Password</button>
        </div>
    </form>
</div>
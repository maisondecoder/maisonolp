<div class="container p-4">
    <h3 class="text-white mt-2 mb-2">My Profile</h3>
</div>

<div class="bg-white p-4" style="border-radius: 16px 16px 0px 0px">
    <?= $this->session->flashdata('cashier_change_password'); ?>
    <h5>Details</h5>
    <div class="list-group mt-3 list-group-flush rounded-3">
        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
            <div class="row">
                <div class="col">Full Name</div>
                <div class="col text-end"><?= $cashier_data['cas_fullname']; ?></div>
            </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
            <div class="row">
                <div class="col">Email</div>
                <div class="col text-end"><?= $cashier_data['cas_email']; ?></div>
            </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
            <div class="row">
                <div class="col">Assigned Store</div>
                <div class="col text-end"><?= $cashier_data['store_name']; ?></div>
            </div>
        </a>
    </div>
</div>
<div class="bg-white p-4 mt-1" style="border-radius: 0px">
    <h5>Settings</h5>
    <div class="list-group mt-3 list-group-flush rounded-3">
        <a href="<?= base_url('cashier/change_password'); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-dark">Change Password<span class=""><i class="fas fa-chevron-right cus-icon-color"></i></span></a>
    </div>
</div>
<div class="bg-white px-4 p-3 mt-1" style="margin-bottom:98px; border-radius: 0px 0px 16px 16px">
    <div class="list-group list-group-flush rounded-3">
        <a href="<?= base_url('cashier/sign_out'); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger">Sign Out<span class=""><i class="fas fa-sign-out-alt text-danger"></i></span></a>
    </div>
</div>
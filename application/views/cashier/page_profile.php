<div class="container p-4 bg-dark">
    <h3 class="text-white mt-2 mb-4">Cashier Profile</h3>

</div>
<div class="bg-white p-4" style="margin-top:-15px; margin-bottom:95px; border-radius: 16px">
<?= $this->session->flashdata('cashier_change_password'); ?>
    <div class="mt-3">
        
        <h3 class="mt-3">Information</h3>
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
            <a href="<?= base_url('cashier/change_password'); ?>" class="list-group-item list-group-item-action">
                <div class="row">
                    <div class="col text-primary">Password</div>
                    <div class="col text-end">Change Password<i class="fas fa-chevron-right text-primary ms-2"></i></div>
                </div>
            </a>
        </div>
    </div>
    <div class="d-grid gap-2 mt-5 mb-4">
        <a href="<?= base_url('cashier/sign_out'); ?>" class="btn btn-outline-danger">Sign Out</a>
    </div>
</div>
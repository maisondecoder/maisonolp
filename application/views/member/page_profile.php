<div class="container p-4">
    <h3 class="text-white mt-2">Welcome!</h3>
    <div data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="card shadow mt-4 mb-4" style="max-height:250px; border-radius:16px;  max-width:500px; height:auto; background-image:url('<?= base_url('assets/card-bg.jpg'); ?>');background-size:fit; background-repeat:no-repeat; background-position: center center">
        <div class="card-body">
            <div class="container">
                <div class="row mt-3">
                    <div class="col text-light">
                        <img src="<?= base_url('user/get_qrid/') . $profile['cus_hash']; ?>" class="img-fluid rounded-3" alt="..." width="100%" style="max-width:100px"><br>
                        <span class="text-light fw-light fst-italic mt-1" style="font-size:10pt;">Tap to Enlarge</span>
                    </div>
                    <div id="member_since_text" class="col text-end text-light">
                        <p style="font-family:monospace">MEMBER SINCE<br><?= date('d/m/Y', $profile['date_created']); ?></p>
                    </div>
                </div>
                <div id="member_name_text" class="row mt-4">
                    <div class="col text-light">
                        <p style="font-family:monospace"><?= $profile_data['profile_first_name'].' '.$profile_data['profile_last_name']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white p-4" style="margin-top:-15px; margin-bottom:95px; border-radius: 16px">
    <div class="mt-3">
        <h3>Membership</h3>
        <div class="list-group mt-3 list-group-flush rounded-3">
            <a href="<?= base_url('user/transaction'); ?>" class="list-group-item list-group-item-action">
                <div class="row">
                    <div class="col text-primary">My Level</div>
                    <div class="col text-end"><?= $level; ?><i class="fas fa-chevron-right text-primary ms-2"></i></div>
                </div>
            </a>
            <a href="<?= base_url('user/point'); ?>" class="list-group-item list-group-item-action">
                <div class="row">
                    <div class="col text-primary">My M-Points</div>
                    <div class="col text-end"><?= number_format($total_pts, 1, ',', '.'); ?><i class="fas fa-chevron-right text-primary ms-2"></i></div>
                </div>
            </a>
            <a href="<?= base_url('user/transaction'); ?>" class="list-group-item list-group-item-action">
                <div class="row">
                    <div class="col text-primary">My Transactions</div>
                    <div class="col text-end"><?= number_format($total_trx, 0, ',', '.'); ?><i class="fas fa-chevron-right text-primary ms-2"></i></div>
                </div>
            </a>
            <a href="<?= base_url('user/voucher'); ?>" class="list-group-item list-group-item-action">
                <div class="row">
                    <div class="col text-primary">My Vouchers</div>
                    <div class="col text-end"><?= number_format($total_vcr, 0, ',', '.'); ?><i class="fas fa-chevron-right text-primary ms-2"></i></div>
                </div>
            </a>
        </div>
        <h3 class="mt-3">Personal Information</h3>
        <div class="list-group mt-3 list-group-flush rounded-3">
            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
                <div class="row">
                    <div class="col">Full Name</div>
                    <div class="col text-end"><?= $profile_data['profile_first_name'].' '.$profile_data['profile_last_name']; ?></div>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
                <div class="row">
                    <div class="col">Gender</div>
                    <div class="col text-end"><?= $profile_data['gender_label']; ?></div>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
                <div class="row">
                    <div class="col">Age Group</div>
                    <div class="col text-end"><?= $profile_data['age_label']; ?></div>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
                <div class="row">
                    <div class="col">Email</div>
                    <div class="col text-end"><?= $profile['cus_email']; ?></div>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
                <div class="row">
                    <div class="col">Phone</div>
                    <div class="col text-end">+<?= $profile['cus_phone']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="d-grid gap-2 mt-5 mb-4">
        <a href="<?= base_url('auth/clear_session'); ?>" class="btn btn-outline-danger">Sign Out</a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Scan to Cashier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('user/get_qrid/').$profile['cus_hash']; ?>" class="img-fluid rounded-3" alt="..." width="100%">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="card shadow mt-4 mb-4" style="border-radius:16px;max-width:500px; height:auto; background-image:url('<?= base_url('assets/card/bg-' . strtolower($level) . '.webp'); ?>');background-size:cover; background-position: left">
        <div class="card-body">
            <div class="container p-2s">
                <div class="row">
                    <div class="col text-light">
                        <img src="<?= base_url('assets/card/logo-m.webp'); ?>" class="img rounded-3" alt="..." height="60px">
                    </div>
                    <div id="member_since_text" class="col text-end text-light">
                        <p style="font-family:monospace">MEMBER SINCE<br><?= date('d/m/Y', $profile['date_created']); ?></p>
                        <p style="font-family:monospace"><?= $profile_data['profile_first_name'] . ' ' . $profile_data['profile_last_name']; ?></p>
                    </div>
                </div>
                <div id="member_name_text" class="row">
                    <div class="col text-light">
                        <img src="<?= base_url('assets/card/logo-maison.png'); ?>" class="img rounded-3" alt="..." height="30px" style="position:absolute;bottom:20px">
                    </div>
                    <div class="col text-light text-end">
                        <img src="<?= base_url('user/get_qrid/') . $profile['cus_hash']; ?>" class="img rounded-3 shadow" alt="..." width="60px" height="60px"><br>
                        <span style="font-size:9pt"><em>Tap to Enlarge</em></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col position-relative">
            <div class="bg-white p-3" style="border-radius: 16px">
                <div class="fs-6">Level <a href="<?= base_url('user/level'); ?>" class="stretched-link"><i class="fas fa-chevron-right cus-icon-color"></i></a></div>
                <div class="fw-bold"><i class="fas fa-medal"></i> <?= $level; ?></div>
            </div>
        </div>
        <div class="col position-relative">
            <div class="bg-white p-3" style="border-radius: 16px">
                <div class="fs-6">Point <a href="<?= base_url('user/point'); ?>" class="stretched-link"><i class="fas fa-chevron-right cus-icon-color"></i></a></div>
                <div class="fw-bold"><i class="fas fa-coins"></i> <?= number_format($total_pts, 1, ',', '.'); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="container mb-4">
    <div class="row">
        <div class="col position-relative">
            <div class="bg-white p-3" style="border-radius: 16px">
                <div class="fs-6">Transaction <a href="<?= base_url('user/transaction'); ?>" class="stretched-link"><i class="fas fa-chevron-right cus-icon-color"></i></a></div>
                <div class="fw-bold"><i class="fas fa-exchange-alt"></i> <?= number_format($total_trx, 0, ',', '.'); ?></div>
            </div>
        </div>
        <div class="col position-relative">
            <div class="bg-white p-3" style="border-radius: 16px">
                <div class="fs-6">Voucher <a href="<?= base_url('user/voucher'); ?>" class="stretched-link"><i class="fas fa-chevron-right cus-icon-color"></i></a></div>
                <div class="fw-bold"><i class="fas fa-ticket-alt"></i> <?= number_format($total_vcr, 0, ',', '.'); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white p-4" style="border-radius: 16px 16px 0px 0px">
    <h5>Details</h5>
    <div class="list-group mt-3 list-group-flush rounded-3">
        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
            <div class="row">
                <div class="col">Full Name</div>
                <div class="col text-end"><?= $profile_data['profile_first_name'] . ' ' . $profile_data['profile_last_name']; ?></div>
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
<div class="bg-white p-4 mt-1" style="border-radius: 0px">
    <h5>Settings</h5>
    <div class="list-group mt-3 list-group-flush rounded-3">
        <a href="<?= base_url('user/change_password'); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-dark">Change Password<span class=""><i class="fas fa-chevron-right cus-icon-color"></i></span></a>
    </div>
</div>
<div class="bg-white px-4 p-3 mt-1" style="margin-bottom:98px; border-radius: 0px 0px 16px 16px">
    <div class="list-group list-group-flush rounded-3">
        <a href="<?= base_url('auth/clear_session'); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger">Sign Out<span class=""><i class="fas fa-sign-out-alt text-danger"></i></span></a>
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
                <img src="<?= base_url('user/get_qrid/') . $profile['cus_hash']; ?>" class="img-fluid rounded-3" alt="..." width="100%">
            </div>
        </div>
    </div>
</div>
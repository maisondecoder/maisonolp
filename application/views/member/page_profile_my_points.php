<div class="container p-4">
    <h3 class="mt-2 text-white"><a href="<?= base_url('user'); ?>" class="me-3 text-white"><i class="fas fa-arrow-left"></i></a> My Points</h3>
</div>
<div class="container p-4 mb-3 text-center text-white" style="border-radius: 16px">
    <div class="fw-bold fs-1"><i class="fas fa-coins"></i> <?= number_format($total_pts, 1, ',', '.'); ?></div>
    <a href="<?= base_url('voucher'); ?>" class="position-relative btn btn-outline-light btn-sm mt-2">Redeem a reward here <i class="fas fa-chevron-right"></i></a>
</div>
<div class="container bg-white p-4 mb-3 text-center" style="border-radius: 16px">
    <div class="row">
        <div class="col position-relative">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6 <?php if ($state == 'total') { echo 'text-cus-brown'; } ?>">Total <a href="<?= base_url('user/point'); ?>" class="stretched-link"><i class="fas fa-chevron-right cus-icon-color"></i></a></div>
                <div class="fw-bold"><?= number_format(($total_trx + $total_pending), 0, ',', '.'); ?></div>
            </div>
        </div>
        <div class="col position-relative">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6 <?php if ($state == 'success') { echo 'text-cus-brown'; } ?>">Success <a href="<?= base_url('user/point/success'); ?>" class="stretched-link"><i class="fas fa-chevron-right cus-icon-color"></i></a></div>
                <div class="fw-bold"><?= number_format($total_trx, 0, ',', '.'); ?></div>
            </div>
        </div>
        <div class="col position-relative">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6 <?php if ($state == 'pending') { echo 'text-cus-brown'; } ?>">Pending <a href="<?= base_url('user/point/pending'); ?>" class="stretched-link"><i class="fas fa-chevron-right cus-icon-color"></i></a></div>
                <div class="fw-bold"><?= number_format($total_pending, 0, ',', '.'); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white p-4" style="margin-bottom:100px !important; border-radius: 16px">
    <div>
        <h3 class="mt-3 mb-3">Point History</h3>
        <div class="list-group list-group-flush rounded-3">
            <?php if ($list_pts) {
                $submitted_on_keys = array();
                foreach ($list_pts as $key => $list_pts) {
                    if (!in_array(date("d/m/Y", $list_pts['date_created']), $submitted_on_keys)) {
                        if (count($submitted_on_keys) >= 0) {
                            //It means we have already created <table> which needs to be closed.
                            echo "<div class='fw-bold text-secondary' style='font-size:10pt'>" . date('d/m/Y', $list_pts['date_created']) . "</div>";
                        }
                        $submitted_on_keys[] = date("d/m/Y", $list_pts['date_created']);
                    }
            ?>
                    <div class="list-group-item list-group-item-action">
                        <div class="row">
                            <div class="col"><?= $list_pts['pts_note']; ?></div>
                            <div class="col text-end <?php if ($list_pts['pts_type']) {
                                                            echo 'text-danger';
                                                        } else {
                                                            echo 'text-success';
                                                        } ?>"><?php if ($list_pts['pts_type']) {
                                                                    echo '-';
                                                                } else {
                                                                    echo '+';
                                                                } ?><?= number_format($list_pts['pts_nominal'], 1, ',', '.'); ?><?php if (!$list_pts['pts_status']) {
                                                                                                                                    echo '<i class="fas fa-hourglass-half mx-1 text-secondary"></i>';
                                                                                                                                } else {
                                                                                                                                    echo '<i class="far fa-check-circle mx-1 text-secondary"></i>';
                                                                                                                                } ?></div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <i class="fas fa-ghost text-center text-muted mb-3" style="font-size:36pt;"></i>
                <span class="text-center text-muted"><?= $text_no_data; ?></span>
            <?php } ?>
        </div>
    </div>
</div>
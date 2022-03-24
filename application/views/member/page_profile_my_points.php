<div class="container p-4">
    <h3 class="mt-2 text-white">My Points</h3>
</div>
<div class="container p-4 mb-3 text-center text-white" style="border-radius: 16px">
    <div class="fw-bold fs-1"><i class="fas fa-coins"></i> <?= number_format($total_pts, 1, ',', '.'); ?></div>
    <a href="<?= base_url('voucher'); ?>" class="position-relative btn btn-outline-light btn-sm mt-2">Redeem a reward here <i class="fas fa-chevron-right"></i></a>
</div>
<div class="container bg-white p-4 mb-3 text-center" style="border-radius: 16px">
    <div class="row">
        <div class="col">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6">Total</div>
                <div class="fw-bold"><?= number_format(($total_trx + $total_pending), 0, ',', '.'); ?></div>
            </div>
        </div>
        <div class="col">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6">Distributed</div>
                <div class="fw-bold"><?= number_format($total_trx, 0, ',', '.'); ?></div>
            </div>
        </div>
        <div class="col">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6">Waiting</div>
                <div class="fw-bold"><?= number_format($total_pending, 0, ',', '.'); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white p-4" style="margin-bottom:95px; border-radius: 16px">
    <div>
        <h3 class="mt-3">Point History</h3>
        <div class="mt-4 mb-3"><span class="badge bg-light text-dark"><i class="fas fa-hourglass-half fa-fw"></i> Waiting Approval</span> </div>
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
                                                                                                                                } ?></div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <i class="fas fa-ghost text-center text-muted mb-3" style="font-size:36pt;"></i>
                <span class="text-center text-muted">You don't have any point yet.</span>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container p-4">
    <h3 class="mt-2 mb-4 text-white"><a href="<?= base_url('voucher'); ?>" class="me-3 text-white"><i class="fas fa-arrow-left"></i></a> Voucher Program Details</h3>
</div>
<div class="bg-white p-4" style="margin-top:-15px; margin-bottom:100px !important; border-radius: 16px">
    <div>
        <h4 class="mt-2 mb-4"><?= $vp_details['vop_title'] ?></h4>
        <img src="<?= base_url('assets/voucher_program/') . $vp_details['vop_image'] ?>" class="img-fluid mb-4" width="100%" alt="">

        <p class="text-muted"><?= $vp_details['vop_desc'] ?></p>
        <table class="table mt-4">
            <tbody>
                <tr>
                    <th scope="row">Program Start Date</th>
                    <td><?= date('d M Y, H:i', $vp_details['date_start']); ?></td>
                </tr>
                <tr>
                    <th scope="row">Program End Date</th>
                    <td><?= date('d M Y, H:i', $vp_details['date_end']); ?></td>
                </tr>
                <tr>
                    <th scope="row">Total Voucher Quota</th>
                    <td><?= $vp_details['vop_maxquota'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Limit per Member</th>
                    <td><?= $vp_details['vop_maxpuser'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Redeem Price</th>
                    <td><?= number_format($vp_details['vop_pointprice'], 0, ',', '.'); ?> M-Points</td>
                </tr>
            </tbody>
        </table>
        <?php if ($vp_details['date_end'] >= now()) {
            if ($vp_details['date_start'] <= now()) { ?>
            <div class="d-grid gap-2 mt-4">
                <span class="text-secondary text-center"><i class="fas fa-ticket-alt"></i> <?= $remaining_vcr; ?> Voucher Quota Remaining</span>
                <?php if ($buttonbuy == 1) { ?>
                    <a href="<?= base_url('voucher/buy/' . $vp_details['vop_uniqueid']); ?>" class="btn btn-primary btn-lg">Redeem Voucher</a>
                <?php } elseif ($buttonbuy == 0 && $issoldout == 1) { ?>
                    <button class="btn btn-secondary btn-lg" disabled>Sold Out</button>
                <?php } elseif ($buttonbuy == 0 && $islimit == 1) { ?>
                    <button class="btn btn-secondary btn-lg" disabled>Redeem Limit Reached</button>
                <?php } elseif ($buttonbuy == 0 && $isnepts == 1) { ?>
                    <button class="btn btn-secondary btn-lg" disabled>Not Enough Point</button>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="d-grid gap-2 mt-4">
                <span class="text-secondary text-center"><i class="fas fa-ticket-alt"></i> <?= $remaining_vcr; ?> Voucher Quota Remaining</span>
                <button class="btn btn-secondary btn-lg" disabled>Upcoming</button>
            </div>
        <?php }}else{ ?>
            <div class="d-grid gap-2 mt-4">
                <button class="btn btn-secondary btn-lg" disabled>Program Has Ended</button>
            </div>
        <?php } ?>
    </div>
</div>
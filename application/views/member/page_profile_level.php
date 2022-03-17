<div class="container p-4 bg-dark">
    <h3 class="mt-2 mb-2 text-white">My Level</h3>
</div>
<div class="container bg-white p-4 mb-3" style="border-radius: 16px">
    <?php if ($total_spending < 750000000) { ?>
        <div>Your current level is <strong><?= $level; ?></strong></div>

        <div><strong>Rp <?= number_format($next_spend, 0, ',', '.'); ?></strong> more to Level Up!</div>

        <div class="progress mt-2">
            <div class="progress-bar" role="progressbar" style="width: <?= $percentage; ?>%" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    <?php } else { ?>
        <div class="text-center">
            <div class="fs-3">
                <strong>Congratulations!</strong>
            </div>
            You've reached the maximum level!
        </div>
    <?php } ?>
</div>

<div class="container bg-white p-4 mb-3  text-center" style="border-radius: 16px">
    <div class="row">
        <div class="col">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6">Spending</div>
                <div class="fw-bold">Rp <?= number_format($total_spending, 0, ',', '.'); ?></div>
            </div>
        </div>
        <div class="col">
            <div class="bg-white" style="border-radius: 16px">
                <div class="fs-6">Level</div>
                <div class="fw-bold"><i class="fas fa-medal"></i> <?= $level; ?></div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white p-4" style="margin-bottom:95px; border-radius: 16px">
    <h3>What's the Level Benefit?</h3>
    <ul class="list-group list-group-flush list-group-numbered">
        <li class="list-group-item">Free 50 Maison Points for Newcomers</li>
        <li class="list-group-item">Granted to access Maison Living Loyalty Program website for free</li>
        <li class="list-group-item">Cashback in Maison Points for every purchase on Maison Living Store</li>
        <li class="list-group-item">A lot of voucher rewards ready to be redeem using Maison Points balance</li>
        <li class="list-group-item">Special gifts for Loyal & Active Member</li>
    </ul>
</div>
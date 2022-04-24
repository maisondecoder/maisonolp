<div class="container p-4">
    <h3 class="mt-2 text-white"><a href="<?= base_url('user'); ?>" class="me-3 text-white"><i class="fas fa-arrow-left"></i></a> My Vouchers</h3>
</div>
<div class="bg-white p-4" style="margin-bottom:95px; border-radius: 16px">
    <div class="bg-white container p-2 rounded mb-3">
        <nav class="nav nav-pills nav-justified">
            <a class="flex-sm-fill text-sm-center nav-link <?php if ($state == 'active') {
                                                                echo 'bg-cus-brown';
                                                            } else {
                                                                echo 'text-secondary';
                                                            } ?>" aria-current="page" href="<?= base_url('user/voucher/active'); ?>">Active <i class="fas fa-chevron-right"></i></a>
            <a class="flex-sm-fill text-sm-center nav-link <?php if ($state == 'expired') {
                                                                echo 'bg-cus-brown';
                                                            } else {
                                                                echo 'text-secondary';
                                                            } ?>" href="<?= base_url('user/voucher/expired'); ?>">Expired <i class="fas fa-chevron-right"></i></a>
            <a class="flex-sm-fill text-sm-center nav-link <?php if ($state == 'used') {
                                                                echo 'bg-cus-brown';
                                                            } else {
                                                                echo 'text-secondary';
                                                            } ?>" href="<?= base_url('user/voucher/used'); ?>">Used <i class="fas fa-chevron-right"></i></a>
        </nav>
    </div>
    <div>
        <?php if ($list_vou) {
            $loop = count($list_vou);
            foreach ($list_vou as $key => $list_vou) { ?>
                <div>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0 px-2">
                            <div class="col-3">
                                <a href="<?= base_url('voucher/details/') . $list_vou['vop_uniqueid']; ?>" class="">
                                    <img src="<?= base_url('assets/voucher_program/') . $list_vou['vop_image']; ?>" class="card-img-top" alt="..." style="-webkit-filter: grayscale(<?= $filter_image; ?>%);filter: grayscale(<?= $filter_image; ?>%);">
                                </a>
                            </div>
                            <div class="col-9">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8 text-start">
                                            <span class="fs-6 fw-bold"><?= $list_vou['vop_title']; ?></span>
                                            <span class="" style="font-size:0.8rem;"><?= $list_vou['vou_reff']; ?></span>
                                            <?php if($state=="active"){ ?>
                                            <p class="card-text text-muted" style=""> <span class="badge bg-danger">Expired in <span id="expired<?= $key; ?>" data-expired="<?= $list_vou['date_expired']; ?>000"><?= date('d M Y, H:i', $list_vou['date_expired']); ?></span></span></p>
                                            <?php } ?>
                                        </div>
                                        <?php if($state=="active"){ ?>
                                        <div class="col-4 text-end"><img src="<?= base_url('user/get_qrid/') . $list_vou['vou_reff']; ?>" class="img-fluid rounded-3" alt="..." style=""></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="bg-white p-4" style=" border-radius: 16px">
                <div class="list-group list-group-flush rounded-3">
                    <i class="fas fa-ghost text-center text-muted mb-3" style="font-size:36pt;"></i>
                    <span class="text-center text-muted">You don't have any <?= $state; ?> voucher.</span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="<?= base_url('assets/js/'); ?>countdown.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    var exp = [];
    for (var i = 0; i < <?= $loop; ?>; i++) {
        var time = $('#expired' + i).data('expired');
        countdown.setLabels(
            'ms|s|m|hr|d|w|m|yrs|dc|c|ml',
            'ms|s|m|hr|d|w|m|yrs|dc|c|ml',
            ' ',
            ' ',
            ' ', );
        exp = countdown(new Date(time), null, countdown.DAYS | countdown.HOURS).toString();

        $('#expired' + i).html(exp);
    }
</script>
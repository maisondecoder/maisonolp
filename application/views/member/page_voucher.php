<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
<div class="container p-4">
    <h3 class="mt-2 text-white">Voucher Catalog</h3>
</div>
<div class="bg-white p-4" style="margin-bottom:100px !important; border-radius: 16px">
    <div class="mt-2">
        <?php if ($vp_details) { ?>
            <h5>Running Program</h5>
            <div class="row">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">

                            <?php foreach ($vp_details as $key => $vp_details) { ?>
                                <li class="splide__slide">
                                    <div class="col mt-3" style="margin-bottom:85px !important;">
                                        <div class="mb-4 pb-2">
                                            <a href="<?= base_url('voucher/details/') . $vp_details['vop_uniqueid']; ?>" class="stretched-link">
                                                <div style="z-index:1;">
                                                    <img src="<?= base_url('assets/voucher_program/') . $vp_details['vop_image']; ?>" class="card-img-top" alt="..." loading="lazy">
                                                </div>
                                                <div class="py-3 px-2 border-top bg-white shadow-sm" style="position:absolute; margin-top:-10px; z-index:99; border-radius:12px; width:100%;">
                                                    <div class="mb-2 text-dark"><?= $vp_details['vop_title']; ?></div>
                                                    <div class="badge bg-success text-light"><?= number_format($vp_details['vop_pointprice'], 0, ',', '.'); ?> Points</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($vp_details2) {
    $loop = count($vp_details2);
?>
    <div class="mt-3">
        <h5>Upcoming</h5>
        <div class="row">
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($vp_details2 as $key => $vp_details2) { ?>
                            <li class="splide__slide">
                                <div class="col mt-3" style="margin-bottom:85px !important;">
                                    <div class="mb-4 pb-2">
                                        <a href="<?= base_url('voucher/details/') . $vp_details2['vop_uniqueid']; ?>" class="stretched-link">
                                            <div style="z-index:1;">
                                                <img src="<?= base_url('assets/voucher_program/') . $vp_details2['vop_image']; ?>" class="card-img-top" alt="..." loading="lazy">
                                            </div>
                                            <div class="py-3 px-2 border-top bg-white shadow-sm" style="position:absolute; margin-top:-10px; z-index:99; border-radius:12px; width:100%;">
                                                <div class="mb-2 text-dark"><?= $vp_details2['vop_title']; ?></div>
                                                <p class="card-text text-muted" style=""><span class="badge bg-danger text-light">In <span id="start<?= $key; ?>" data-start="<?= $vp_details2['date_start'] ?>000"></span><span id="ago<?= $key; ?>"></span></span></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($vp_details3) {
?>
    <div class="mt-3">
        <h5>What You Missed</h5>
        <div class="row">
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($vp_details3 as $key => $vp_details3) { ?>
                            <li class="splide__slide">
                                <div class="col mt-3" style="margin-bottom:85px !important;">
                                    <div class="mb-4 pb-2">
                                        <a href="<?= base_url('voucher/details/') . $vp_details3['vop_uniqueid']; ?>" class="">
                                            <div style="z-index:1;">
                                                <img src="<?= base_url('assets/voucher_program/') . $vp_details3['vop_image']; ?>" class="card-img-top" alt="..." loading="lazy">
                                            </div>
                                            <div class="py-3 px-2 border-top bg-white shadow-sm" style="position:absolute; margin-top:-10px; z-index:99; border-radius:12px; width:100%">
                                                <div class="mb-2 text-dark"><?= $vp_details3['vop_title']; ?></div>
                                                <p class="card-text text-muted"><span class="badge bg-secondary text-light">End</span></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<script src="<?= base_url('assets/js/'); ?>countdown.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    var exp = [];
    for (var i = 0; i < <?= $loop; ?>; i++) {
        var time = $('#start' + i).data('start');

        var datenow = new Date();

        if (datenow.getTime() > time) {
            $('#startin' + i).html('Started ');
            $('#ago' + i).html(' ago');
        }

        countdown.setLabels(
            'ms|s|m|hr|d|w|m|yrs|dc|c|ml',
            'ms|s|m|hr|d|w|m|yrs|dc|c|ml',
            ' ',
            ' ',
            ' ', );
        exp = countdown(new Date(time), null, countdown.DAYS | countdown.HOURS | countdown.MINUTES).toString();
        $('#start' + i).html(exp);
    };
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var elms = document.getElementsByClassName('splide');

        for (var i = 0; i < elms.length; i++) {
            new Splide(elms[i], {
                type: 'slide',
                perPage: 2,
                gap: '1rem',
                padding: {
                    right: '6rem'
                },
                drag: 'free',
                arrows: true,
                pagination: false,
                flickPower: 200,
                breakpoints: {
                    640: {
                        arrows: false,
                    }
                }
            }).mount();
        }

    });
</script>
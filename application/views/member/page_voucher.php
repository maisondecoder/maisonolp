<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
<div class="container p-4 bg-dark">
    <h3 class="mt-2 text-white">Voucher Catalog</h3>
</div>
<div style="margin-bottom:95px; border-radius: 16px">
    <div class="bg-white p-4" style="margin-bottom:95px; border-radius: 16px">
        <div class="mt-2">
        <?php if ($vp_details) { ?>
            <h3>Running Program</h3>
            <div class="row">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">

                            <?php foreach ($vp_details as $key => $vp_details) { ?>
                                <li class="splide__slide">
                                    <div class="col mt-3">
                                        <div class="card mb-4 shadow-sm">
                                            <a href="<?= base_url('voucher/details/') . $vp_details['vop_uniqueid']; ?>" class="stretched-link">
                                                <img src="<?= base_url('assets/voucher_program/') . $vp_details['vop_image']; ?>" class="card-img-top" alt="..." loading="lazy">
                                            </a>
                                            <div class="p-2 border-top">
                                                <p class="card-text text-muted" style=""><span class="badge bg-success text-light"><?= number_format($vp_details['vop_pointprice'], 0, ',', '.'); ?> M-Points</span></p>
                                            </div>
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
            <div class="mt-2">
                <h3>Upcoming</h3>
                <div class="row">
                    <div class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($vp_details2 as $key => $vp_details2) { ?>
                                    <li class="splide__slide">
                                        <div class="col mt-3">
                                            <div class="card mb-4 shadow-sm">
                                                <a href="<?= base_url('voucher/details/') . $vp_details2['vop_uniqueid']; ?>" class="stretched-link">
                                                    <img src="<?= base_url('assets/voucher_program/') . $vp_details2['vop_image']; ?>" class="card-img-top" alt="...">
                                                </a>
                                                <div class="p-2 border-top">
                                                    <p class="card-text text-muted" style=""><span class="badge bg-danger text-light"><span id="startin<?= $key; ?>">Start in</span> <span id="start<?= $key; ?>" data-start="<?= $vp_details2['date_start'] ?>000"></span><span id="ago<?= $key; ?>"></span></span></p>
                                                </div>
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
            $loop = count($vp_details3);
        ?>
            <div class="mt-2">
                <h3>What You Missed</h3>
                <div class="row">
                    <div class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($vp_details3 as $key => $vp_details3) { ?>
                                    <li class="splide__slide">
                                        <div class="col mt-3">
                                            <div class="card mb-4 shadow-sm">
                                                <a href="<?= base_url('voucher/details/') . $vp_details3['vop_uniqueid']; ?>" class="stretched-link">
                                                    <img src="<?= base_url('assets/voucher_program/') . $vp_details3['vop_image']; ?>" class="card-img-top" alt="...">
                                                </a>
                                                <div class="p-2 border-top">
                                                    <p class="card-text text-muted"><span class="badge bg-secondary text-light">Program has ended</span></p>
                                                </div>
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
</div>
</div>
<script src="<?= base_url('assets/js/'); ?>countdown.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    setInterval(function() {
        
        
        var exp = [];
        for (var i = 0; i < <?= $loop; ?>; i++) {
            var time = $('#start' + i).data('start');

            var datenow = new Date();

            if(datenow.getTime() > time){
                $('#startin' + i).html('Started ');
                $('#ago' + i).html(' ago');
            }

            countdown.setLabels(
                'ms|s|m|hr|d|w|m|yrs|dc|c|ml',
                'ms|s|m|hr|d|w|m|yrs|dc|c|ml',
                ' ',
                ' ',
                ' ', );
            exp = countdown(new Date(time), null, countdown.HOURS | countdown.MINUTES | countdown.SECONDS).toString();
            $('#start' + i).html(exp);
        };
        
    }, 1000);
    
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var elms = document.getElementsByClassName('splide');

        for (var i = 0; i < elms.length; i++) {
            new Splide(elms[i], {
                type: 'slide',
                perPage: 1,
                gap: '1rem',
                padding: {
                    right: '6rem'
                },
                drag: 'free',
                arrows: false,
                pagination: false,
                flickPower: 200,
            }).mount();
        }

    });
</script>
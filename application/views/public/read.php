<div class="container p-4">
    <h3 class="mt-2 mb-4 text-white">Maison Living</h3>
</div>
<div class="bg-white p-4" style="margin-top:-15px; border-radius: 16px;">
    <div style="margin-bottom:140px">
        <h3 class="mt-2"><?= $read['pa_title']; ?></h3>
        <p class="fs-6 mb-3"><?= ucfirst($read['pa_category']); ?> - <?= date('d M Y, h:i', $read['date_publish']); ?> </p>
        <img class="rounded shadow-sm mb-3 img-fluid" src="<?= base_url('assets/post/images/').$read['pa_cover']; ?>" alt="Photo of <?= $read['pa_title']; ?>">
        <div id="post_body" class=""><?= $read['pa_body']; ?></div>
        <hr>
        <h4 class="mt-2 mb-4">Latest Post</h4>
        <div>
            <?php foreach ($latest as $key => $latest) { ?>
                <div class="row mb-3">
                    <div class="col" style="max-width:120px">  
                        <img class="rounded shadow-sm" src="<?= base_url('assets/post/images/').$latest['pa_cover']; ?>" alt="Photo of <?= $latest['pa_title']; ?>" style="height:54px; width:100px; object-fit:cover">
                    </div>
                    <div class="col d-flex align-items-center" style="max-width:350px">
                        <a href="<?= base_url('read/') . $latest['pa_slug']; ?>" class="text-decoration-none fw-bold text-muted"><?= $latest['pa_title']; ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script>
        $('#post_body img').addClass('img-fluid rounded shadow');
        $('#post_body img').css('margin-bottom', '16px');
    </script>
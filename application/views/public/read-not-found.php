<div class="container p-4">
    <h3 class="mt-2 mb-4 text-white">Maison Living</h3>
</div>
<div class="bg-white p-4" style="margin-top:-15px; border-radius: 16px;">
    <div style="margin-bottom:140px">
        <h3 class="mt-2">Oops, Article Not Found!</h3>
        <p>Sorry, the article you were looking for could not be found.</p>
        <hr class="mt-4">
        <h4 class="mt-2 mb-4">Articles You Might Like</h4>
        <div>
            <?php foreach ($latest as $key => $latest) { ?>
                <div class="row mb-3 d-flex position-relative">
                    <div class="col" style="max-width:120px">  
                        <img class="rounded shadow-sm" src="<?= base_url('assets/post/images/').$latest['pa_cover']; ?>" alt="Photo of <?= $latest['pa_title']; ?>" style="height:54px; width:100px; object-fit:cover">
                    </div>
                    <div class="col d-flex align-items-center" style="max-width:350px">
                        <a href="<?= base_url('read/') . $latest['pa_slug']; ?>" class="text-decoration-none fw-bold text-muted stretched-link"><?= $latest['pa_title']; ?></a>
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
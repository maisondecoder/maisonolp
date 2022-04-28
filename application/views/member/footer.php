<div class="fixed-bottom p-2 mb-2">
    <div class="container bg-white d-grid gap-2 shadow-lg p-2 border" style="max-width:480px; border-radius: 16px;">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <a href="<?= base_url('voucher'); ?>" class="btn text-<?php if($page=='voucher'){echo'cus-brown';}else{echo'secondary';} ?>"><i class="fas fa-ticket-alt"></i><br><span style="font-size:10pt">Reward</span></a>
            <a href="<?= base_url('user'); ?>" class="btn text-<?php if($page=='profile'){echo'cus-brown';}else{echo'secondary';} ?>"><i class="fas fa-user"></i><br><span style="font-size:10pt">Profile</span></a>
        </div>
    </div>
</div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= base_url('assets/external/'); ?>bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
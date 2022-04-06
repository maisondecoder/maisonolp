<div class="fixed-bottom p-2 mb-2">
    <div class="container bg-white d-grid gap-2 shadow-lg p-2" style="max-width:480px; border-radius: 16px;">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <a href="<?= base_url('cashier'); ?>" class="btn text-<?php if($page=='point'){echo'cus-brown';}else{echo'secondary';} ?>"><i class="fas fa-coins"></i><br><span style="font-size:10pt">Point</span></a>
            <a href="<?= base_url('cashier/voucher'); ?>" class="btn text-<?php if($page=='voucher'){echo'cus-brown';}else{echo'secondary';} ?>"><i class="fas fa-ticket-alt"></i><br><span style="font-size:10pt">Voucher</span></a>
            <a href="<?= base_url('cashier/profile'); ?>" class="btn text-<?php if($page=='profile'){echo'cus-brown';}else{echo'secondary';} ?>"><i class="fas fa-user"></i><br><span style="font-size:10pt">Profile</span></a>
        </div>
    </div>
</div>
</div>
    <!-- Optional JavaScript; choose one of the two! -->
     <script src="<?= base_url('assets/js/'); ?>jquery.number.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= base_url('assets/external/'); ?>bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>

</html>
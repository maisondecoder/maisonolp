<div class="container p-4 bg-dark">
    <h3 class="text-white mt-2 mb-4">Transaction Success</h3>
</div>
<div class="bg-white p-4" style="margin-top:-15px; margin-bottom:95px; border-radius: 16px">
    <div class="text-center fs-3"><i class="fas fa-award"></i></div>
    <h4 class="mt-2 mb-4 text-center">Congratulations! You Got:</h4>
    <h4 class="mt-2 mb-4 text-center"><span class="badge bg-primary">+<?= $pts_data; ?> M-Points</span></h4>
    <div class="mb-5">
        <p class="text-center">M-Points will be credited to Member's account after audited and approved.</p>
    </div>
    <hr>
    <div class="text-center">
        <a class="btn btn-outline-primary" href="<?= base_url('cashier'); ?>">Create New Transaction</a>
    </div>
</div>
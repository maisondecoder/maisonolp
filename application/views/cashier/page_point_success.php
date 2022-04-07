<div class="container p-4">
    <h3 class="text-white mt-2 mb-2">Transaction Success</h3>
</div>
<div class="bg-white p-4" style="margin-bottom:95px; border-radius: 16px">
    <div class="text-center fs-3"><i class="fas fa-award"></i></div>
    <h4 class="mt-2 mb-4 text-center"><span class="badge cus-dark-btn">+<?= $pts_data; ?> Points</span></h4>
    <h4 class="mt-2 mb-4 text-center">Congratulations!</h4>
    
    <div class="mb-5">
        <p class="text-center">
            Points will be distributed after going through the audit and approval process.</p>
    </div>
    <hr>
    <div class="text-center">
        <a class="btn btn-outline-secondary" href="<?= base_url('cashier'); ?>">Create New Transaction</a>
    </div>
</div>
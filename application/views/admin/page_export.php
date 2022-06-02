<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Export Data</h1>

    <div class="card shadow mb-2 p-4 col-sm-12 col-md-12 col-lg-5">
        <h4 class="h4 mb-4 text-gray-800">Member</h4>
        <form action="<?= base_url('admin/export_member/') ?>" method="post">
            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Day Celebrate</label>
                    <select type="text" class="form-control" name="memceleb">
                        <option value="all">All</option>
                        <option value="1">Not Celebrate</option>
                        <option value="2">Chinese New Year</option>
                        <option value="3">Christmas</option>
                        <option value="4">Eid Al-Fitr / Ramadhan</option>
                        <option value="5">Nyepi</option>
                        <option value="6">Vesak</option>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Level Start From</label>
                    <select type="text" class="form-control" name="spendstart">
                        <option value="0">All</option>
                        <option value="0">Classic</option>
                        <option value="10000000">Silver</option>
                        <option value="100000000">Gold</option>
                        <option value="300000000">Platinum</option>
                        <option value="750000000">Diamond</option>
                    </select>

                </div>

            </div>
            <button id="export-member" class="btn btn-primary mb-2">Export Member Data</button>
        </form>
    </div>

    <div class="card shadow mb-2 p-4 col-sm-12 col-md-12 col-lg-5">
        <h4 class="h4 mb-4 text-gray-800">Transaction</h4>
        <form action="<?= base_url('admin/export_trx/') ?>" method="post">
            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Min Date</label>
                    <input type="date" class="form-control" name="trxmin" value="<?= date('Y-m-d', now() - 2592000); ?>">
                </div>
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Max Date</label>
                    <input type="date" class="form-control" name="trxmax" max="<?= date('Y-m-d', now()); ?>" value="<?= date('Y-m-d', now()); ?>">
                </div>
            </div>

            <button id="export-trx" class="btn btn-primary mb-2">Export Transaction Data</button>
        </form>
    </div>

    <div class="card shadow mb-2 p-4 col-sm-12 col-md-12 col-lg-5">
        <h4 class="h4 mb-4 text-gray-800">Cashier</h4>
        <a class="btn btn-primary" href="<?= base_url('admin/export_cashier'); ?>">Export Cashier Data</a>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
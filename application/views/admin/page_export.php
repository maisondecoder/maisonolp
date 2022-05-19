<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Export Data</h1>

    <div class="card shadow mb-2 p-4 col-sm-12 col-md-12 col-lg-5">
        <h4 class="h4 mb-4 text-gray-800">Member</h4>
        <form action="">
            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Day Celebrate</label>
                    <select type="text" class="form-control" name="celebrate">
                        <option value="all">All</option>
                        <option value="1">Chinese New Year</option>
                        <option value="2">Christmas</option>
                        <option value="3">Eid Al-Fitr / Ramadhan</option>
                        <option value="4">Nyepi</option>
                        <option value="5">Vesak</option>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Level</label>
                    <select type="text" class="form-control" name="celebrate">
                        <option value="all">All</option>
                        <option value="1">Classic</option>
                        <option value="2">Silver</option>
                        <option value="3">Gold</option>
                        <option value="4">Platinum</option>
                        <option value="5">Diamond</option>
                    </select>

                </div>

            </div>
            <a class="btn btn-primary mb-2" href="<?= base_url('admin/export_member'); ?>">Export Member Data</a>
        </form>
    </div>

    <div class="card shadow mb-2 p-4 col-sm-12 col-md-12 col-lg-5">
        <h4 class="h4 mb-4 text-gray-800">Transaction</h4>
        <a class="btn btn-primary mb-2" href="<?= base_url('admin/export_trx'); ?>">Export Transaction Data</a>
    </div>

    <div class="card shadow mb-2 p-4 col-sm-12 col-md-12 col-lg-5">
        <h4 class="h4 mb-4 text-gray-800">Cashier</h4>
        <a class="btn btn-primary" href="<?= base_url('admin/export_cashier'); ?>">Export Cashier Data</a>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
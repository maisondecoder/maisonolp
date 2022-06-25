<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Cashier</h1>

    <div class="card shadow mb-4 p-4 col-sm-12 col-md-12 col-lg-8">
        <span class="text-danger"><?php echo validation_errors(); ?></span>
        <form action="<?= base_url('admin/add_cashier') ?>" method="post">
            <div class="row">
                <div class="col mb-3">
                    <label for="cas-fullname" class="form-label">Full Name</label>
                    <input name="cas-fullname" type="text" class="form-control" id="cas-fullname" placeholder="John Doe" value="" required>
                </div>

                <div class="col mb-3">
                    <label for="cas-email" class="form-label">Email</label>
                    <input name="cas-email" type="text" class="form-control" id="cas-email" placeholder="john@domain.com" value="" required>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="cas-store" class="form-label">Assigned Store</label>
                    <select name="cas-store" type="text" class="form-control" id="cas-store" placeholder="Choose a Store Branch" required>
                        <?php foreach ($stores as $key => $store) { ?>
                            <option value="<?= $store['store_id']; ?>"><?= $store['store_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="cas-password" class="form-label">Default Password</label>
                    <input name="cas-password" type="text" class="form-control" id="cas-password" value="Maisonliving123" readonly>
                </div>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary mt-4 form-control" value="Submit">
        </form>
    </div>

</div>
<!-- /.container-fluid -->
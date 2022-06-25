<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Cashier</h1>

    <div class="card shadow mb-4 p-4 col-sm-12 col-md-12 col-lg-8">
        <span class="text-danger"><?php echo validation_errors(); ?></span>
        <form action="<?= base_url('admin/edit_cashier/').$cashier['cas_id']; ?>" method="post">
            <div class="row">
                <div class="col mb-3">
                    <label for="cas-fullname" class="form-label">Full Name</label>
                    <input name="cas-fullname" type="text" class="form-control" id="cas-fullname" placeholder="John Doe" value="<?= $cashier['cas_fullname'] ?>" required>
                </div>

                <div class="col mb-3">
                    <label for="cas-store" class="form-label">Assigned Store</label>
                    <select name="cas-store" type="text" class="form-control" id="cas-store" placeholder="Choose a Store Branch" required>
                        <?php foreach ($stores as $key => $store) { ?>
                            <option value="<?= $store['store_id']; ?>" <?php if ($store['store_id'] == $cashier['store_id']) {
                                                                            echo 'selected';
                                                                        } ?>><?= $store['store_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label for="cas-status" class="form-label">Status</label>
                    <select name="cas-status" type="text" class="form-control" id="cas-status" placeholder="Choose a Status" required>
                        <option value="0" <?php if (0 == $cashier['cas_status']) {
                                                echo 'selected';
                                            } ?>>Inactive</option>
                        <option value="1" <?php if (1 == $cashier['cas_status']) {
                                                echo 'selected';
                                            } ?>>Active</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary mt-4 form-control" value="Submit">
        </form>
    </div>

</div>
<!-- /.container-fluid -->
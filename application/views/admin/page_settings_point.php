<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Point Settings</h1>

    <!-- DataTales Example -->
    <div class=" mb-4 col-sm-12 col-md-12 col-lg-5">
        Current Setting : <span class="badge rounded-pill bg-primary text-white">Rp <?=  number_format( $point['ps_point_per'],0,',','.' ); ?> / 1 Point</span> <span class="badge rounded-pill bg-primary text-white"><?= $point['ps_point_multiplier']; ?>x</span>
    </div>

    <div class="card shadow mb-4 p-4 col-sm-12 col-md-12 col-lg-5">
        <?= $this->session->flashdata('settings_point_change'); ?>
        <form action="<?= base_url('admin/settings_point') ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Rupiah per 1 Point</label>
                <input name="point-pair" type="number" class="form-control" id="exampleFormControlInput1" min="1000000" placeholder="ex: 1000" value="<?= $point['ps_point_per']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Point Multiplier</label>
                <input name="point-multi" type="number" class="form-control" id="exampleFormControlInput1" min="1" placeholder="ex: 1" value="<?= $point['ps_point_multiplier']; ?>" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary mt-4 form-control">Save</button>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
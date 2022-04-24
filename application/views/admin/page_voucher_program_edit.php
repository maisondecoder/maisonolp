<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Voucher Program</h1>

    <div class="card shadow mb-4 p-4 col-sm-12 col-md-12 col-lg-8">
        <?= $this->session->flashdata('settings_point_change'); ?>
        <form action="<?= base_url('admin/edit_voucher_program').'/'.$vp_data['vop_uniqueid'] ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Program Title</label>
                <input name="vp-title" type="text" class="form-control" id="vp-title" min="1000000" placeholder="ex: 1 Unit Luxurious Sofa" value="<?= $vp_data['vop_title']; ?>" required>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date Start</label>
                    <input name="vp-datestart" type="date" class="form-control" id="vp-datestart" min="1000000" placeholder="ex: 1000" value="<?= date("Y-m-d", $vp_data['date_start']); ?>" required>
                </div>

                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date End</label>
                    <input name="vp-dateend" type="date" class="form-control" id="vp-dateend" min="1000000" placeholder="ex: 1000" value="<?= date("Y-m-d", $vp_data['date_end']); ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Time Start</label>
                    <input name="vp-timestart" type="time" class="form-control" id="vp-timestart" min="1000000" placeholder="ex: 1000" value="<?= date("H:i", $vp_data['date_start']); ?>" required>
                </div>

                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Time End</label>
                    <input name="vp-timeend" type="time" class="form-control" id="vp-timeend" min="1000000" placeholder="ex: 1000" value="<?= date("H:i", $vp_data['date_end']); ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <textarea name="vp-desc" class="" id="vp-desc"><?= $vp_data['vop_desc']; ?></textarea>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Voucher Quota</label>
                    <input name="vp-quota" type="number" class="form-control" id="vp-quota" min="1" placeholder="ex: 10" value="<?= $vp_data['vop_maxquota']; ?>" required>
                </div>

                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Limit per User</label>
                    <input name="vp-limit" type="number" class="form-control" id="vp-limit" min="1" placeholder="ex: 1" value="<?= $vp_data['vop_maxpuser']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Point Required</label>
                    <input name="vp-price" type="number" class="form-control" id="vp-price" min="1" placeholder="ex: 520" value="<?= $vp_data['vop_pointprice']; ?>" required>
                </div>
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                    <input name="vp-image" type="text" class="form-control" id="vp-image" placeholder="ex: image_file_name.jpg" value="<?= $vp_data['vop_image']; ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary mt-4 form-control" value="Update">
                <a class="btn btn-outline-danger mt-4 form-control" href="<?= base_url('admin/delete_voucher_program/').$vp_data['vop_uniqueid']; ?>">Delete</a>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#vp-desc'), {

            toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList']
        })
        .catch(error => {
            console.error(error);
        });

    editor.execute('ckfinder');
</script>
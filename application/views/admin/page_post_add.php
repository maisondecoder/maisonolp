<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add New Post</h1>

    <div class="card shadow mb-4 p-4 col-sm-12 col-md-12 col-lg-8">
        <?= $this->session->flashdata('add_post'); ?>
        <form action="<?= base_url('admin/add_post') ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="vp-title" placeholder="Lorem ipsum dolor sit amet" value="" required>
            </div>


            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Body Content</label>
                <textarea name="body" class="" id="vp-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date Publish</label>
                    <input name="date" type="date" class="form-control" id="vp-datestart" value="" required>
                </div>

                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Time Publish</label>
                    <input name="time" type="time" class="form-control" id="vp-timeend" value="" required>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                    <select name="category" id="" class="form-control">
                        <option value="article">Article</option>
                        <option value="promotion">Promotion</option>
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tag</label>
                    <input name="tag" type="text" class="form-control" id="vp-limit" min="1" placeholder="Sofa,Tips,Care" value="" required>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Image Cover</label>
                    <input name="cover" type="text" class="form-control" id="vp-image" placeholder="file_name_here.jpg" value="" required>
                </div>
                <div class="col mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary mt-4 form-control" value="Submit">
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script src="<?= base_url('vendor') ?>/ckfinder/ckfinder.js"></script>
<script>

    ClassicEditor
        .create(document.querySelector('#vp-desc'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'link', 'ImageUpload','ckfinder'],
            ckfinder: {
                uploadUrl: '<?= base_url('vendor') ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json',
                options: {
                    resourceType: 'Images'
                },
                openerMethod: 'popup'
            }

        })
        .catch(error => {
            console.error(error);
        });

</script>
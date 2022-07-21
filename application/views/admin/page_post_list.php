<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Post Data</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'all') {
                                        echo 'active';
                                    } ?>" aria-current="page" href="<?= base_url('admin/post/') ?>">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'junk') {
                                        echo 'active';
                                    } ?>" aria-current="page" href="<?= base_url('admin/post/junk') ?>">Junk</a>
            </li>
        </ul>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="ss" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Date Publish</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list as $key => $post) {
                            if ($post['pa_status'] == '0') {
                                $status = '<i class="fas fa-times text-danger" title="Inactive"></i>';
                            } else {
                                $status = '<i class="fas fa-check text-success" title="Active"></i>';
                            }
                        ?>
                            <tr id="<?= $post['pa_id']; ?>">
                                <td><?= $key + 1 ?></td>
                                <td><img class="rounded shadow-sm mb-3 img-fluid" src="<?= base_url('assets/post/images/') . $post['pa_cover']; ?>" alt="Photo of <?= $post['pa_title']; ?>" style="height:54px; width:100px; object-fit:cover"></td>
                                <td><?= $post['pa_title']; ?></td>
                                <td><?= date('d-m-Y, h:i', $post['date_publish']); ?></td>
                                <td><?= ucfirst($post['pa_category']); ?></td>
                                <td><?= $status; ?></td>
                                <?php if ($state_tab == 'junk') { ?>
                                    <td><a class="btn btn-success" title="Preview" href="<?= base_url('read/') . $post['pa_slug'] ?>?preview=1" target="_blank"><i class="fas fa-eye"></i></a> <a class="btn btn-outline-info" title="Restore" href="<?= base_url('admin/restore_post/') . $post['pa_id'] ?>"><i class="fas fa-trash-restore"></i></td>
                                <?php } else { ?>
                                    <td><a class="btn btn-success" title="Preview" href="<?= base_url('read/') . $post['pa_slug'] ?>?preview=1" target="_blank"><i class="fas fa-eye"></i></a> <a class="btn btn-info" title="Edit" href="<?= base_url('admin/edit_post/') . $post['pa_id'] ?>"><i class="fas fa-edit"></i></a> <a class="btn btn-outline-danger" title="Junk" href="<?= base_url('admin/delete_post/') . $post['pa_id'] ?>"><i class="fas fa-trash"></i></a></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {

    });
</script>
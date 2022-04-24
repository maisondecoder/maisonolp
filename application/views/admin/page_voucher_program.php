<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Voucher Program Data</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="ss" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Program Name</th>
                            <th>Status</th>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($voucher_program as $key => $vop) { ?>
                            <tr id="<?= $vop['vop_id']; ?>">
                                <td><?= $key+1; ?></td>
                                <td><?= $vop['vop_title']; ?></td>
                                <td><?php if($vop['date_start'] > now()){ echo '<span class="badge bg-danger text-white">Upcoming</span>'; }else{if($vop['date_end'] > now()){ echo '<span class="badge bg-success text-white">Running</span>';}else{echo '<span class="badge bg-secondary text-white">End</span>';}} ?></td>
                                <td><?= date('d-m-Y H:i:s', $vop['date_start']); ?></td>
                                <td><?= date('d-m-Y H:i:s', $vop['date_end']); ?></td>
                                <td><a class="btn btn-info" href="<?= base_url('admin/edit_voucher_program/').$vop['vop_uniqueid'];; ?>">Edit</a></td>
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

</script>
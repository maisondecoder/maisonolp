<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Member Data</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'active') {
                                        echo 'active';
                                    } ?>" aria-current="page" href="<?= base_url('admin/members/active') ?>">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'inactive') {
                                        echo 'active';
                                    } ?>" href="<?= base_url('admin/members/inactive') ?>">Inactive</a>
            </li>
        </ul>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="ss" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($member_list as $key => $member) { ?>
                            <tr id="<?= $member['cus_id']; ?>">
                                <td><?= $key+1 ?></td>
                                <td><?= $member['cus_fullname']; ?></td>
                                <td><?= $member['cus_email']; ?></td>
                                <td><?= $member['cus_phone']; ?></td>
                                <td><?= date('d-m-Y H:i:s', $member['date_created']); ?></td>
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
        $('.approval').click(function() {
            var id = $(this).data('trx-id');
            var reff = $(this).data('trx-reff');
            //alert(id+reff);
            $.post("<?= base_url('admin/frag_approve/'); ?>" + id + "/" + reff, function() {
                    $('#' + reff).fadeOut();
                })
                .fail(function() {
                    alert("error");
                });
        });

    });
</script>
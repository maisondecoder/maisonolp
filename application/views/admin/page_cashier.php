<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Cashier Data</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'active') {
                                        echo 'active';
                                    } ?>" aria-current="page" href="<?= base_url('admin/cashiers/active') ?>">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'inactive') {
                                        echo 'active';
                                    } ?>" href="<?= base_url('admin/cashiers/inactive') ?>">Inactive</a>
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
                            <th>Assigned Store</th>
                            <th>Date Created</th>
                            <th>Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($member_list as $key => $member) { ?>
                            <tr id="<?= $member['cas_id']; ?>">
                                <td><?= $key + 1 ?></td>
                                <td><?= $member['cas_fullname']; ?></td>
                                <td><?= $member['cas_email']; ?></td>
                                <td><?= $member['store_branch']; ?></td>
                                <td><?= date('d-m-Y H:i:s', $member['date_created']); ?></td>
                                <td><?= date('d-m-Y H:i:s', $member['date_last_login']); ?></td>
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
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Member Data</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'all') {
                                        echo 'active';
                                    } ?>" aria-current="page" href="<?= base_url('admin/members/all') ?>">All</a>
            </li>
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
            <li class="nav-item">
                <a class="nav-link <?php if ($state_tab == 'suspend') {
                                        echo 'active';
                                    } ?>" href="<?= base_url('admin/members/suspend') ?>">Suspend</a>
            </li>
        </ul>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="ss" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Celebrate</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($member_list as $key => $member) {
                            $spending = $this->customer_model->get_total_spending($member['cus_id']);
                            $level = $this->customer_model->get_level($spending);
                            if ($member['cus_status'] == 0) {
                                $status_label = '<span class="badge bg-secondary text-white">Inactive</span>';
                            } elseif ($member['cus_status'] == 1) {
                                $status_label = '<span class="badge bg-success text-white">Active</span>';
                            } elseif ($member['cus_status'] == 2) {
                                $status_label = '<span class="badge bg-warning text-white">Suspend</span>';
                            }
                        ?>
                            <tr id="<?= $member['cus_id']; ?>">
                                <td><?= $key + 1 ?></td>
                                <td><?= $member['profile_first_name'] . ' ' . $member['profile_last_name']; ?></td>
                                <td><?= $level['ml_name']; ?></td>
                                <td><?= $member['cus_email']; ?></td>
                                <td><?= $member['cus_phone']; ?></td>
                                <td><?= $member['celebrate_label']; ?></td>
                                <td><?= date('d-m-Y H:i:s', $member['date_created']); ?></td>
                                <td><?= $status_label; ?></td>
                                <td>
                                    <div class="btn btn-info member-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-cusid="<?= $member['cus_id']; ?>" data-status="<?= $member['cus_status']; ?>" data-reason="<?= $member['suspend_reason']; ?>"><i class="fas fa-edit"></i></div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>

                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label">Member Status</label>
                        <select class="form-control" name="cus-stat" id="cus-stat">
                            <option value="0" selected>Inactive</option>
                            <option value="1">Active</option>
                            <option value="2">Suspend</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label">Reason of Suspend</label>
                        <select class="form-control" name="suspend-reason" id="suspend-reason">
                            <option value="0" selected>None</option>
                            <option value="1">Multiple Accounts</option>
                            <option value="2">System Abuse</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button id="save-edit" data-cusid="0" data-cus-status="0" data-reason="" type="button" class="btn btn-outline-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('.member-edit').click(function() {
            var cusid = $(this).data('cusid');
            var status = $(this).data('status');
            var reason = $(this).data('reason');

            $('#save-edit').data('cusid', cusid);
            $('#save-edit').data('reason', reason);
            $('#cus-stat').val(status);
            $('#suspend-reason').val(reason);
        });

        $('#save-edit').click(function() {

            var selected_status = $('#cus-stat').val();
            var selected_reason = $('#suspend-reason').val();
            var selected_cusid = $(this).data('cusid');

            alert(selected_cusid + ' - ' + selected_status + ' - ' + selected_reason);
            $.post("<?= base_url('admin/frag_edit_member/'); ?>" + selected_cusid + "/" + selected_status + "/" + selected_reason, function() {

                })
                .done(function(data) {
                    $('#editModal').modal('hide');
                })
                .fail(function() {
                    alert("Error While Saving");
                });
        });
    });
</script>
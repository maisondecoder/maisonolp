<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div>
        <h1 class="h3 mb-4 text-gray-800">Transaction Data</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link <?php if ($state_trx == 'pending') {
                                        echo 'active';
                                    } ?>" aria-current="page" href="<?= base_url('admin/transactions/pending') ?>">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($state_trx == 'approved') {
                                        echo 'active';
                                    } ?>" href="<?= base_url('admin/transactions/approved') ?>">Approved</a>
            </li>
        </ul>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="ss" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <?php if ($state_trx == 'approved') { ?>
                                <th>Date Approved</th>
                                <th>Admin</th>
                            <?php } else { ?>
                                <th>Date Created</th>
                            <?php } ?>
                            <th>Store</th>
                            <th>Jurnal ID</th>

                            <th>Customer</th>
                            <th>Cashier</th>
                            <th>IDR</th>
                            <th>M-Points</th>
                            <?php if ($state_trx == 'pending') { ?>
                                <th>Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_trx as $key => $pending) { ?>
                            <tr id="<?= $pending['trx_reff']; ?>">
                                <td><?= $key + 1; ?></td>
                                <?php if ($state_trx == 'approved') { ?>
                                    <td><?= date('d-m-Y H:i:s', $pending['date_approved']); ?></td>
                                    <td><?= $pending['admin_name']; ?></td>
                                <?php } else { ?>
                                    <td><?= date('d-m-Y H:i:s', $pending['date_created']); ?></td>
                                <?php } ?>
                                <td><?= $pending['store_branch']; ?></td>
                                <td><?= $pending['jurnal_id']; ?></td>

                                <td><?= $pending['cus_fullname']; ?></td>
                                <td><?= $pending['cas_fullname']; ?></td>
                                <td><span id="trx-idr-<?= $pending['trx_reff']; ?>"><?= number_format($pending['trx_nominal'], 0, ',', '.'); ?></span></td>
                                <td><span id="trx-pts-<?= $pending['trx_reff']; ?>"><?= number_format($pending['pts_nominal'], 1, ',', '.'); ?></span> <span class="badge bg-dark text-light rounded-pill"><?= $pending['pts_multiplier']; ?>x</span></td>
                                <?php if ($state_trx == 'pending') { ?>
                                    <td><span class="btn btn-success approval" data-trx-id="<?= $pending['trx_id']; ?>" data-trx-reff="<?= $pending['trx_reff']; ?>" title="Approve"><i class="fas fa-thumbs-up"></i></span> <span id="edit-trx-<?= $pending['trx_reff']; ?>" class="btn btn-info edit-trx" data-trx-pts="<?= $pending['pts_nominal']; ?>" data-trx-id="<?= $pending['trx_id']; ?>" data-trx-reff="<?= $pending['trx_reff']; ?>" data-trx-idr="<?= $pending['trx_nominal']; ?>" data-trx-mlt="<?= $pending['pts_multiplier']; ?>" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></span></td>
                                <?php } ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Transaction</h5>

                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="form-label">IDR Value</label>
                        <input type="number" class="form-control" id="edit-idr-input" placeholder="Just number" min="0" required>
                    </div>
                    <span class="badge bg-dark text-white">Changes Preview</span>
                    <table>
                        <tr>
                            <td>Nominal</td>
                            <td>: Rp <span id="summ-idr">1.000.000</span></td>
                        </tr>
                        <tr>
                            <td>Points </td>
                            <td>: <span id="summ-pts">1</span> <span id="summ-mlt" class="badge rounded-pill bg-dark text-white">1x</span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button id="save-trx" data-trx-reff="0" data-trx-mlt="0" type="button" class="btn btn-outline-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="<?= base_url('assets/js/'); ?>jquery.number.min.js"></script>
<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
        $('.edit-trx').click(function() {
            var id = $(this).data('trx-id');
            var reff = $(this).data('trx-reff');
            var idr = $(this).data('trx-idr');
            var multi = $(this).data('trx-mlt');
            var pts = $(this).data('trx-pts');

            $('#save-trx').data('trx-reff', reff);
            $('#save-trx').data('trx-mlt', multi);

            $("#edit-idr-input").val(idr);
            $('#summ-idr').text($.number(idr, 0, ',', '.'));
            $('#summ-mlt').text(multi + 'x');
            $('#summ-pts').text($.number(pts, 1, ',', '.'));
        });
        $("#edit-idr-input").on('keyup', function() {
            var pts_recalc = $(this).val() / <?= $point_setting['ps_point_per'] ?> * $('#save-trx').data('trx-mlt');
            $('#summ-idr').text($.number($(this).val(), 0, ',', '.'));
            $('#summ-pts').text($.number(pts_recalc, 1, ',', '.'));

        });

        $('#save-trx').click(function() {
            var pts_recalc = $("#edit-idr-input").val() / <?= $point_setting['ps_point_per'] ?> * $(this).data('trx-mlt');
            $.post("<?= base_url('admin/frag_trx_data/'); ?>", {
                    nominal_input: "" + $('#edit-idr-input').val(),
                    reff_input: "" + $(this).data('trx-reff')
                })
                .done(function(data) {
                    $('#trx-idr-' + $('#save-trx').data('trx-reff')).text($.number($("#edit-idr-input").val(), 0, ',', '.'));
                    $('#trx-pts-' + $('#save-trx').data('trx-reff')).text($.number(pts_recalc, 1, ',', '.'));
                    $('#edit-trx-' + $('#save-trx').data('trx-reff')).data('trx-idr', $("#edit-idr-input").val());
                    $('#edit-trx-' + $('#save-trx').data('trx-reff')).data('trx-pts', pts_recalc);
                    $('#editModal').modal('hide')
                })
                .fail(function() {
                    alert("Error While Saving");
                });
        });

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
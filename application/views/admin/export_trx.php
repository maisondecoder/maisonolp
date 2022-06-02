<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Transactions Data</title>
</head>

<body>
    <table class="table table-hover" id="ss" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Date Created</th>
                <th>Date Approved</th>
                <th>Admin</th>
                <th>Store</th>
                <th>Jurnal ID</th>
                <th>Customer</th>
                <th>Cashier</th>
                <th>IDR</th>
                <th>M-Points</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pending_trx as $key => $pending) { ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= date('d-m-Y H:i:s', $pending['date_created']); ?></td>
                    <td><?php if($pending['date_approved'] > 0){ echo date('d-m-Y H:i:s', $pending['date_approved']); }else{echo '-';} ?></td>
                    <td><?= $pending['admin_name']; ?></td>
                    <td><?= $pending['store_branch']; ?></td>
                    <td><?= $pending['jurnal_id']; ?></td>
                    <td><?= $pending['profile_first_name'].' '.$member['profile_last_name']; ?></td>
                    <td><?= $pending['cas_fullname']; ?></td>
                    <td><?= $pending['trx_nominal']; ?></td>
                    <td><?= $pending['pts_nominal']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
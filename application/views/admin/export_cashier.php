<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Cashier Data</title>
</head>

<body>
    <table class="table table-hover" id="ss" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Cashier Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Date Last Login</th>
                <th>Days Ago</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cashier_list as $key => $cashier) { ?>
                <tr id="<?= $cashier['cas_id']; ?>">
                    <td><?= $key + 1 ?></td>
                    <td><?= $cashier['cas_fullname']; ?></td>
                    <td><?= $cashier['cas_email']; ?></td>
                    <td><?= date('d-m-Y H:i:s', $cashier['date_created']); ?></td>
                    <td><?= date('d-m-Y H:i:s', $cashier['date_last_login']); ?></td>
                    <td><?= round(abs($cashier['date_last_login'] - now())/86400); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
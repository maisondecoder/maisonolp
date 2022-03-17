<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Members Data</title>
</head>

<body>
    <table class="table table-hover" id="ss" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Member Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($member_list as $key => $member) { ?>
                <tr id="<?= $member['cus_id']; ?>">
                    <td><?= $key + 1 ?></td>
                    <td><?= $member['cus_fullname']; ?></td>
                    <td><?= $member['cus_email']; ?></td>
                    <td><?= $member['cus_phone']; ?></td>
                    <td><?= date('d-m-Y H:i:s', $member['date_created']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
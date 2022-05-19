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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Total Spending</th>
                <th>Level</th>
                <th>Day Celebrate</th>
                <th>Date of Birth</th>
                <th>Date Created</th>
                <th>Last Login</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($member_list as $key => $member) { 
                $spending = $this->customer_model->get_total_spending($member['cus_id']);
                $level = $this->customer_model->get_level($spending);    
            ?>
                <tr id="<?= $member['cus_id']; ?>">
                    <td><?= $key + 1 ?></td>
                    <td><?= $member['profile_first_name']; ?></td>
                    <td><?= $member['profile_last_name']; ?></td>
                    <td><?= $member['cus_email']; ?></td>
                    <td><?= $member['cus_phone']; ?></td>
                    <td><?= $spending; ?></td>
                    <td><?= $level['ml_name']; ?></td>
                    <td><?= $member['celebrate_label']; ?></td>
                    <td><?= $member['date_of_birth']; ?></td>
                    <td><?= date('Y-m-d', $member['date_created']); ?></td>
                    <td><?= date('Y-m-d', $member['date_last_login']); ?> (<?= floor(abs($member['date_last_login'] - now())/86400); ?> day ago)</td>
                    <td></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
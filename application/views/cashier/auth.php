<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name=”robots” content=”noindex,nofollow”>
    <link rel="stylesheet" href="<?= base_url('assets/external/'); ?>all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/external/'); ?>bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-192x192.jpg" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-180x180.jpg" />
    <meta name="msapplication-TileImage" content="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-270x270.jpg" />
    <title>Cashier Login | Maison Living</title>
</head>

<body class="bg-dark">
    <div class="mx-auto" style="max-width:500px">
        <div class="container p-4 bg-dark">
            <h3 class="mt-2 mb-4 text-white">Cashier Login</h3>

            <?php echo '<div class="text-danger">' . validation_errors() . '</div>'; ?>
        </div>
        <div class="bg-white p-4" style="margin-top:-15px; margin-bottom:95px; border-radius: 16px">
            <?= $this->session->flashdata('cashier_login'); ?>
            <form action="<?= base_url('cashier/auth'); ?>" method="post">
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email-input" class="form-control" id="inputEmail" placeholder="ex: name@maisonliving.id" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPass" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="pass-input" class="form-control" id="inputPass" placeholder="Your Password" required>
                    </div>
                </div>
                <div class="row p-2">
                    <input class="btn btn-large btn-primary" type="submit" value="Sign in">
                </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="<?= base_url('assets/external/'); ?>jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/'); ?>jquery.number.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= base_url('assets/external/'); ?>bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
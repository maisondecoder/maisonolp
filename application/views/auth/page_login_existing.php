<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name=”robots” content=”noindex,nofollow”>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url('assets/css/'); ?>custom-color.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-192x192.jpg" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-180x180.jpg" />
    <meta name="msapplication-TileImage" content="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-270x270.jpg" />
    <title>Existing Member | Maison Living</title>
</head>

<body class="cus-dark-bg">
    <div class="container p-4" style="max-width:500px">
        <div class="card">
            <div class="card-body">
                <h2>Existing Member</h2>
                <?= $this->session->flashdata('login_password'); ?>
                <span class="text-danger"><?php echo validation_errors(); ?></span>
                <form action="<?= base_url('auth/signin/'); ?>" method="post">
                    <div class="mb-4">
                        <label for="phone-input" class="form-label">Whatsapp Number</label>
                        <input type="text" class="form-control mb-2" name="phone-input" id="phone-input" aria-describedby="phone-input" placeholder="6281234567890" value="<?= $ses_phone; ?>" required>
                        
                        <label for="pass-input" class="form-label">Password</label>
                        <input type="password" class="form-control mb-2" name="pass-input" id="pass-input" max="9999" aria-describedby="pass-input" placeholder="*****" required>
                        <div id="otpHelp" class="form-text"><a href="#">Forgot Password</a></div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn cus-dark-btn">Sign In</button>
                        <a href="<?= base_url('auth/clear_session'); ?>" class="btn btn-link text-secondary mx-auto mt-4">Change Number</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
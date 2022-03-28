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
    <title>Introduce Yourself | Maison Living</title>
</head>

<body class="cus-dark-bg">
    <div class="container p-4" style="max-width:500px">
        <div class="card">
            <div class="card-body">
            <span class="text-secondary">Registration Step 3 of 3</span>
                <h2>Please Introduce Yourself.</h2>
                <span class="text-danger"><?php echo validation_errors(); ?></span>
                <form action="<?= base_url('auth/create_profile'); ?>" method="post">
                    <div class="mb-4">
                        <label for="first-input" class="form-label">First Name</label>
                        <input type="text" class="form-control mb-2" name="first-input" id="first-input" minlength="3" maxlength="32"  placeholder="John" required>

                        <label for="last-input" class="form-label">Last Name</label>
                        <input type="text" class="form-control mb-2" name="last-input" id="last-input" minlength="3" maxlength="32" placeholder="Doe" required>

                        <label for="gender-input" class="form-label">Gender</label>
                        <select class="form-select mb-2" name="gender-input">
                            <option value="1" selected>Female</option>
                            <option value="2">Male</option>
                        </select>

                        <label for="age-input" class="form-label">Age Group</label>
                        <select class="form-select mb-2" name="age-input">
                            <option value="1" selected>18-24</option>
                            <option value="2">25-34</option>
                            <option value="3">35-44</option>
                            <option value="4">45-54</option>
                            <option value="5">55+</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn cus-dark-btn">Save My Profile</button>
                        <a href="<?= base_url('auth/clear_session'); ?>" class="btn btn-link text-danger mx-auto mt-4">Sign Out</a>
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
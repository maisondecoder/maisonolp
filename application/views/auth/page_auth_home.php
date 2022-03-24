<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name=”robots” content=”noindex,nofollow”>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/external/'); ?>bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url('assets/css/'); ?>custom-color.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-192x192.jpg" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-180x180.jpg" />
    <meta name="msapplication-TileImage" content="https://maisonliving.id/wp-content/uploads/2021/11/cropped-logo-tab1-270x270.jpg" />
    <title>Online Loyalty Program | Maison Living</title>
</head>

<body class="cus-dark-bg mx-auto vh-100" style="max-width:500px; background-image:url('<?= base_url('assets/papadatos-sofa.jpg'); ?>');background-size:cover; background-repeat:no-repeat; background-position: left center">

    <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 11">
        <img class="img " src="<?= base_url('assets/maison-logo.png'); ?>" alt="Logo Maison" style="margin-top:5em" width="400px">
    </div>

    <div class="container">



        <div class="fixed-bottom mb-3 mx-auto p-3" style="max-width:500px; background:#0000009e">
            <h3 class="text-light">Member Area</h3>
            <span class="text-warning"><?php echo validation_errors(); ?></span>

            <?php echo form_open('auth'); ?>
            <div class="d-grid gap-2">
                <label for="nomor-wa" class="form-label text-light">Sign up with your Whatsapp Number</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="number" class="form-control" name="nomor-wa" id="nomor-wa" aria-describedby="nomor-wa" placeholder="81222444555" required>
                </div>
                <button type="submit" class="btn mb-3 cus-dark-btn">Sign Up</button>
                <a href="<?= base_url('auth/signin'); ?>" class="btn btn-link text-white">I Already Have an Account</button>
            </div>
            </form>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= base_url('assets/external/'); ?>bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl)
        })
        toastList.forEach(toast => toast.show())
    </script>
</body>

</html>
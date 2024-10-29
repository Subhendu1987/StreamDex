
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title><?= esc(aboutdetails()['sitedetails']['Name']) ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('public/assets/favicon/apple-icon-57x57.png') ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('public/assets/favicon/apple-icon-60x60.png') ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('public/assets/favicon/apple-icon-72x72.png') ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('public/assets/favicon/apple-icon-76x76.png') ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('public/assets/favicon/apple-icon-114x114.png') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('public/assets/favicon/apple-icon-120x120.png') ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('public/assets/favicon/apple-icon-144x144.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('public/assets/favicon/apple-icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/assets/favicon/apple-icon-180x180.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('public/assets/favicon/android-icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/assets/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('public/assets/favicon/favicon-96x96.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/assets/favicon/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('public/assets/favicon/manifest.json') ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url('public/assets/favicon/ms-icon-144x144.png') ?>">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="<?= base_url('public/vendors/simplebar/css/simplebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/vendors/simplebar.css') ?>">
    <!-- Main styles for this application-->
    <link href="<?= base_url('public/css/style.css') ?>" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="<?= base_url('public/css/examples.css') ?>" rel="stylesheet">
    <script src="<?= base_url('public/js/config.js') ?>"></script>   
    <script src="<?= base_url('public/js/color-modes.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="bg-body-tertiary min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">






            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                  <h1>Login</h1>
                  <p class="text-body-secondary">Sign In to your account</p>
                  <form action="<?= base_url() ?>" method="post">
                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') ?>"></use>
                      </svg></span>
                    <input class="form-control" type="text" name="username" placeholder="Username"  value="">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="<?= base_url('public/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') ?>"></use>
                      </svg></span>
                    <input class="form-control" type="password" name="password" placeholder="Password"  value="">
                  </div>
                  <div class="row">
                  <div class="input-group mb-4">
                    <button class="form-control btn btn-primary" type="submit">Login</button>
                  </div>
                  </div>
                  </form>
                </div>
              </div>
              <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                  <div>
                    <h2><?= esc(aboutdetails()['sitedetails']['Name']) ?></h2>
                    <div class="mb-4"><strong>Welcome to <?= esc(aboutdetails()['sitedetails']['Name']) ?>, your all-in-one platform for managing and streaming media effortlessly. </strong>   </div>                    
                    <div class="mb-4"><p>Log in to access your personalized dashboard, track playlists, and manage your content with ease. Stay connected and stream like a pro with <?= esc(aboutdetails()['sitedetails']['Name']) ?>.</p></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    


  </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= session()->getFlashdata('success'); ?>',
            timer: 2000,
            showConfirmButton: false
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= session()->getFlashdata('error'); ?>',
            timer: 2000,
            showConfirmButton: false
        });
    <?php endif; ?>
</script>
<?php
$firstRunMessage = checkFirstRun();
if ($firstRunMessage) {
?>
<script>
  Swal.fire({
      title: '<?= esc(aboutdetails()['sitedetails']['Name']) ?>',
      html: '<?= addslashes($firstRunMessage); ?>',
      showConfirmButton: false,
      timer: 5000
  });
</script>
<?php
}
?>

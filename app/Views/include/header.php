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
    <title><?= esc($page_title) ?></title>
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
    <link href="<?= base_url('public/css/docs.css') ?>" rel="stylesheet">
    <link rel="manifest" href="<?= base_url('public/assets/favicon/manifest.json') ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url('public/assets/favicon/ms-icon-144x144.png') ?>">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="<?= base_url('public/vendors/simplebar/css/simplebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/vendors/simplebar.css') ?>">
    <!-- jQuery UI CSS (for styling) -->
    <link rel="stylesheet" href="<?= base_url('public/jquery/jquery-ui.css') ?>">
    <!-- Main styles for this application-->     
    <link href="<?= base_url('public/css/style.css') ?>" rel="stylesheet">
    <link rel='stylesheet' href='<?= base_url('public/videojs/video-js.css') ?>'>
    <script src="<?= base_url('public/videojs/video.js') ?>"></script>
    <script src="<?= base_url('public/videojs/videojs-contrib-hls.js') ?>"></script>
    
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        overflow-x: hidden;
        margin: 0;
        }
        .hairline-border {
          border-right: 0.5px solid #323a49;
        }
    </style>

    <script src="<?= base_url('public/js/config.js') ?>"></script>
    <script src="<?= base_url('public/js/color-modes.js') ?>"></script>
    <script src="<?= base_url('public/jquery/sweetalert2@11') ?>"></script>
  </head>
  <body>

        <?php include('sidebar.php'); ?>
    <div class="wrapper d-flex flex-column min-vh-100">
      <header class="header header-sticky p-0 mb-4">
        <?php include('topbar.php'); ?>
    
      </header>

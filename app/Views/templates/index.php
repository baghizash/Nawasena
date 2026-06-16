<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title><?= $title; ?></title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>/backend/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>/backend/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/backend/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/backend/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/backend/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/backend/vendors/styles/style.css" />

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/backend/vendors/datatables/dataTables.bootstrap4.min.css">

    <!-- Toaster - Alert -->
    <link rel="stylesheet" href="<?= base_url(); ?>/backend/vendors/jquery-toast/jquery.toast.css">
</head>

<body>

    <?= $this->include('templates/header'); ?>
    <?= $this->include('templates/right-sidebar'); ?>
    <?= $this->include('templates/left-sidebar'); ?>

    <div class="mobile-menu-overlay"></div>

    <?= $this->renderSection('page-content'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <script src="<?= base_url(); ?>/backend/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/backend/vendors/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Main JavaScript -->
    <script src="<?= base_url(); ?>/backend/vendors/scripts/core.js"></script>
    <script src="<?= base_url(); ?>/backend/vendors/scripts/script.min.js"></script>
    <script src="<?= base_url(); ?>/backend/vendors/scripts/process.js"></script>
    <script src="<?= base_url(); ?>/backend/vendors/scripts/layout-settings.js"></script>
    <script src="<?= base_url(); ?>/backend/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="<?= base_url(); ?>/backend/vendors/jquery-easing/jquery.easing.min.js"></script>

    <!-- Moment.js -->
    <script src="<?= base_url(); ?>/backend/vendors/moment.js/moment-with-locales.min.js"></script>

    <!-- Toaster - Alert -->
    <script src="<?= base_url(); ?>/backend/vendors/jquery-toast/jquery.toast.js"></script>

    <?= $this->renderSection('additional-js'); ?>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>


</html>
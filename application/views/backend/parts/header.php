<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT. Kemala Cipta Selaras | Admin</title>

  <!-- Favicon -->
  <link rel="icon" href="<?php echo base_url(); ?>assets/img/logo1.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/plugins/sweetalert2/sweetalert2.min.css">

  <link rel="stylesheet" href="<?= base_url('assets/backend'); ?>/plugins/datatables/datatables.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <style>
    .ui-autocomplete {
      position: absolute;
      z-index: 1000;
      cursor: default;
      padding: 0;
      margin-top: 2px;
      list-style: none;
      background-color: #ffffff;
      border: 1px solid #ccc;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .ui-autocomplete>li {
      padding: 3px 20px;
    }

    .ui-autocomplete>li.ui-state-focus {
      background-color: #DDD;
    }

    .ui-helper-hidden-accessible {
      display: none;
    }

    .ui-menu {}

    .ui-menu-item:hover {
      color: #fff;
      background: #007FFF;
    }

    .ui-front {
      z-index: 9999;
    }
  </style>
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <link rel="stylesheet" href="<? //= base_url('assets/backend');
                                    ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="<? //= base_url('assets/backend');
                                    ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->


</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url(); ?>assets/img/logo2.png" alt="Logo" height="100" width="100">
    </div>
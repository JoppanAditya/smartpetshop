<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equive="X-UA-Compatible" content="IE-edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title; ?></title>
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png'); ?>">
  <link href="<?= base_url('assets/'); ?>css/logreg.css" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body style="
			background: url('<?= base_url('assets/'); ?>img/background.png') no-repeat;
		">

  <!-- Element untuk menampilkan pesan alert -->
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>" data-flashdatastatus="<?= $this->session->flashdata('status'); ?>"></div>
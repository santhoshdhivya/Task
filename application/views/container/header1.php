<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/jvectormap/jquery-jvectormap.css">
   <!-- daterange picker -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/sweetalert/css/sweetalert.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/iCheck/all.css">
   <!-- fullCalendar -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/select2/dist/css/select2.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <!-- bootstrap slider -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/bootstrap-slider/slider.css">
  <!-- Dashboard Common Style -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>css/dashboard.css">
  <!-- Developer Style -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>css/developer.css">
  <!-- Video Player Style -->
  <link rel="stylesheet" href="<?= LAYOUT_URL; ?>plugins/video-player/css/video_player.css">
  <script>
    var tmp_base_url='<?= base_url(); ?>';
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition <?= $this->session->userdata('user_theme_color'); ?> sidebar-mini <?= $this->session->userdata('user_menu_style'); ?> fixed">
<div class="wrapper">

  <header class="main-header">
  
    
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
     

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <li class="dropdown user user-menu">
            <a href="<?= base_url('login'); ?>" >Login</a>
            
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="<?= base_url('register'); ?>" >Register</a>
            
          </li>
          
        </ul>
      </div>
    </nav>
  </header> 
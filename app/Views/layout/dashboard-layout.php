
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GrupoPetromar</title>
  <base href="/public/">
  <link rel="icon" href="<?php echo base_url(); ?>/public/dist/img/favicon.ico" type="image/gif">  
   <!-- Css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <script type="text/javascript" src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
  
  <!-- DataTable -->
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/datetime/1.3.1/js/dataTables.dateTime.min.js"></script>
  <!-- DATA TABLE -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
   
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.3.1/css/dataTables.dateTime.min.css">
  
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">  
  <script type="text/javascript" src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="..<?= route_to('home');?>" class="nav-link">Home</a>
      </li>     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">         
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="..<?= route_to('home');?>" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" >
      <span class="brand-text font-weight-light">GrupoPetromar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="..<?= route_to('home');?>" class="d-block">
            <?= session('username') ?>
          </a>
        </div>
      </div>

   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->  
          <li class="nav-item">
            <a href="..<?= route_to('home');?>" class="nav-link <?= (current_url() == base_url('home')) ? 'active' : '';?>">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <?php if(session('tipo') == 1){?>
            <li class="nav-item">
              <a href="..<?= route_to('usuario');?>" class="nav-link <?= (current_url() == base_url('usuario')) ? 'active' : '';?>">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>Usuario</p>
              </a>
            </li>
          <?php }?>
            <li class="nav-item">
              <a href="..<?= route_to('empleados');?>" class="nav-link <?= (current_url() == base_url('empleados')) ? 'active' : '';?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Empleados</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="..<?= route_to('empleadosBaja');?>" class="nav-link <?= (current_url() == base_url('empleadosBaja')) ? 'active' : '';?>">
                <i class="nav-icon fa fa-user-times"></i>
                <p>Bajas</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="..<?= route_to('uniformes');?>" class="nav-link <?= (current_url() == base_url('uniformes')) ? 'active' : '';?>">
                <i class="nav-icon 	fas fa-tshirt"></i>                
                <p>Uniformes</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="..<?= route_to('hijos');?>" class="nav-link <?= (current_url() == base_url('hijos')) ? 'active' : '';?>">
                <i class="nav-icon 	fas fa-baby-carriage"></i>                
                <p>Hijos</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="..<?= route_to('candidatos');?>" class="nav-link <?= (current_url() == base_url('candidatos')) ? 'active' : '';?>">
                <i class="nav-icon 	fa fa-address-book"></i>                
                <p>Candidatos</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="..<?= route_to('actividades');?>" class="nav-link <?= (current_url() == base_url('actividades')) ? 'active' : '';?>">
                <i class="nav-icon 	fas fa-sync"></i>                
                <p>Actividades</p>
              </a>
            </li>

          <li class="nav-item">
            <a onclick="cerrarSesion();" class="nav-link">
              <i class="fas fa-sign-out-alt text-danger"></i>
              <p>Salir</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->


  
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= (isset($pageTitle)) ? $pageTitle : 'GrupoPetromar'; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="..<?= route_to('home'); ?>">Home</a></li>
              <li class="breadcrumb-item active"><?= (isset($pageTitle)) ? $pageTitle : 'GrupoPetromar'; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <?php $this->renderSection('content');?>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="<?= base_url();?>">GrupoPetromar</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- FUNCIONES EXTRAS -->
<script type="text/javascript">

  function  cerrarSesion(){
    Swal.fire({
      title:'Desea salir?',
      text:'La sesión terminará!',
      icon:'warning',
      showCancelButton:true,
      cancelButtonColor: '#d33',
      confirmButtonText:'Si, salir'
    }).then((result) =>{
      if(result.isConfirmed){
        window.location.href = "<?php echo base_url('/CerrarSesion');?>"
      }
    });
  }
</script>

</body>
</html>

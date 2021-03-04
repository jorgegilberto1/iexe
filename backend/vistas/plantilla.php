<?php
session_start();
if (isset($_SESSION['email'])) {
 ?>

  <!DOCTYPE html>
  <!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>I|EXE</title>
  <!-- Select2 -->
    <link rel="stylesheet" href="vistas/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="vistas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
      <!-- daterange picker -->
    <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
      <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="vistas/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
    <!--toast alert-->
    <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">
    
    <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user-circle"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="vistas/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?php echo $_SESSION['nombre']; ?>
                    <span class="float-right text-sm text-success"><i class="fas fa-circle"></i></span>
                  </h3>
                  <p class="text-sm">Mi perfil</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> En linea</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="controladores/login.php?opcion=logout" class="dropdown-item dropdown-footer">Cerrar sesión</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="vistas/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">IEXE</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="vistas/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['nombre'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <?php if ((isset($_GET['pagina']))){
                if ($_GET['pagina']=='verproyectosdealumnos'||
                $_GET['pagina']=='veralumnos'||
                $_GET['pagina']=='agregarproyecto'||
                $_GET['pagina']=='verproyectos') { 
                  if ($_SESSION['nivel']==1) { ?>
                    <!-- =========== primer modulo perfil de empresa catalogo administrar usuarios administrar ocnsultores =====-->
                    <li class="nav-item has-treeview menu-open">
                      <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                          Administrar proyectos
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <?php if ($_GET['pagina']=='verproyectosdealumnos'): ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=verproyectosdealumnos" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proyectos de Alumnos</p>
                              </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=verproyectosdealumnos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proyectos de Alumnos</p>
                              </a>
                            </li>
                        <?php endif ?>
                        <?php if ($_GET['pagina']=='veralumnos'): ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=veralumnos" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alumnos</p>
                              </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=veralumnos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alumnos</p>
                              </a>
                            </li>
                        <?php endif ?>
                      </ul>
                    </li>
                  <?php } else {?>
                    <li class="nav-item has-treeview menu-open">
                      <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                          Administrar Poyectos
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <?php if ($_GET['pagina']=='agregarproyecto'): ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=agregarproyecto" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Agregar Proyecto</p>
                              </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=agregarproyecto" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Agregar Proyecto</p>
                              </a>
                            </li>
                        <?php endif ?>
                        <?php if ($_GET['pagina']=='verproyectos'): ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=verproyectos" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver proyectos</p>
                              </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                              <a href="index.php?pagina=verproyectos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver proyectos</p>
                              </a>
                            </li>
                        <?php endif ?>
                      </ul>
                    </li>
              <!-- =========== end primer modulo  =====-->
              <?php  }   
              }

            } else { 
              if($_SESSION['nivel']==1) {//vista del administrador cuango no hay solicitud get?>
            <!--============= estilo por defecto barra lateral izquierda sin get============= -->
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Administrar proyectos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?pagina=verproyectosdealumnos" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Proyectos de Alumnos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?pagina=veralumnos" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Alumnos</p>
                    </a>
                  </li>
                </ul>
              </li>
              <?php } else {?>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Administrar proyectos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?pagina=agregarproyecto" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Agregar proyecto</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?pagina=verproyectos" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ver Proyectos</p>
                    </a>
                  </li>
                </ul>
              </li>
              <?php } ?>
              <!--============= end estilo por defecto barra lateral izquierda sin get============= -->
           <?php } ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- módulos (contenido de las páginas) -->
      <?php
        if (isset($_GET['pagina'])) {
          if ($_GET['pagina']=='verproyectosdealumnos'||
              $_GET['pagina']=='veralumnos'||
              $_GET['pagina']=='agregarproyecto'||
              $_GET['pagina']=='verproyectos'||
              $_GET['pagina']=='consultores'||
              $_GET['pagina']=='datastage') {
                include "paginas/".$_GET['pagina'].".php";
          } else {
              include "paginas/error404.php";
          }
          
        } else {
          include "paginas/verproyectosdealumnos.php";
        }
        
      ?>
      <!-- /.módulos (contenido de las páginas)  -->
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
        
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2019-2020 <a href="#"> IEXE</a>.</strong> Todos los derechos.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="vistas/plugins/select2/js/select2.full.min.js"></script>
  <!-- Toastr -->
  <script src="vistas/plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <script src="vistas/plugins/datatables/jquery.dataTables.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="vistas/plugins/moment/moment.min.js"></script>
  <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="vistas/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="js/glosa.js"></script>
  </body>
  </html>
<?php } else {
    header('Location: ../');
    exit;
  } ?>
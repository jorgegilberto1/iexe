<?php
session_start();
if (!isset($_SESSION['email'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="backend/vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="backend/vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="backend/vistas/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>S</b>istema</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div id="loginusuario" class="card-body login-card-body">
      <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>

      <form id="form-login" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Usuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordar usuario
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#" class="forgotpasword">Olvide mi contraseña</a>
      </p>
      <p class="mb-0">
        <a href="#" class="text-center userregister">Registrar un nuevo usuario</a>
      </p>
    </div>
    <!--recuperar contraseña-->
    <div style="display:none" id="restorepasword" class="card-body login-card-body">
      <p class="login-box-msg">Ingresa tu usuario para reestablecer tu contraseña</p>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block newpassword">Enviar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a class="gotologin" href="#">Iniciar sesión</a>
      </p>
      <p class="mb-0">
        <a href="#" class="text-center userregister">Registrar un nuevo usuario</a>
      </p>
    </div>
    <!--./recuperar contraseña-->

    <!--registro de usuarios eliminado -->
    <div id="registeruser" style="display:none" class="card-body register-card-body">
      <p class="login-box-msg">Registrar un nuevo usuario</p>

      <a class="gotologin" href="#" class="text-center">Ya estoy inscrito</a>
    </div>
    <!-- /.registro de usuarios -->

    <!--ingresar nueva contraseña-->
    <div style="display: none;" id="inputnewpassword" class="card-body login-card-body">
      <p class="login-box-msg">iNGRESA TU NUEVA CONTRASEÑA</p>

      <form action="login.html" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirma tu contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="#" class="gotologin">Login</a>
      </p>
    </div>
    <!-- /.ingresar nueva contraseña -->
  <!-- /.login-card -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="backend/vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="backend/vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="backend/vistas/dist/js/adminlte.min.js"></script>
<script src="script.js"></script>

</body>
</html>
<?php } else {
    header('Location: backend');
    exit;
  } ?>

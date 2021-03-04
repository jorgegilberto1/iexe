    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Alumnos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">INICIO</a></li>
              <li class="breadcrumb-item active">Ver Alumnos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">      
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
              <h3 class="card-title">Registrar Alumnos</h3>
              </div>
              <form role="form" id="form-registrar-alumno" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del alumno</label>
                        <input type="text" class="form-control" name="nombre_alumno" id="exampleInputEmail1" placeholder="Ingrese el nombre del alumno">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Correo Electrónico</label>
                        <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="Ingrese el correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="contrasena1">Contraseña</label>
                        <input type="password" class="form-control" name="contrasena1" id="contrasena1" placeholder="Ingrese la contraseña">
                    </div>
                    <div class="form-group">
                        <label for="contrasena2">Confirmar Contraseña</label>
                        <input type="password" class="form-control" name="contrasena2" id="contrasena2" placeholder="Ingrese la contraseña">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Listado de Alumnos</h3>
              </div>
              <div class="card-body">
              <table id="lista_alumnos" class="table table-bordered table-striped">
                    <thead>
                        <th>NOMBRE DEL ALUMNO</th>
                        <th>EMAIL</th>
                        <th>FECHA INSCRITO</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
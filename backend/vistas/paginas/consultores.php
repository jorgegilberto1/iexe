    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar Consultores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li id="muestraempresa" class="breadcrumb-item"><a href="#">Empresa</a></li>
              <li id="muestrarfc" class="breadcrumb-item active"></li>
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
                <div class="row">
                  <div class="col-lg-3">
                    <button type="button" class="btn btn-block bg-gradient-secondary" data-toggle="modal" data-target="#modal-form-consultor">REGISTRAR CONSULTOR</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="listadodeconsultores" class="table table-bordered table-striped">
                    <thead>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>ESTATUS</th>
                        <th>ACCIONES</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
              </div>
            <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="modal-form-consultor">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registrar consultor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form name="form-registrar-consultor" id="form-registrar-consultor" method="POST">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="user" placeholder="Nombre completo" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
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
                <div class="input-group mb-3">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Repetir Contraseña" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block saveuser">Registrar</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </div>
    <!-- /.content -->
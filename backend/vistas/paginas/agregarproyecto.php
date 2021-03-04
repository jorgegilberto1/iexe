    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Agregar Proyectos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">INICIO</a></li>
              <li class="breadcrumb-item active">Agregar proyectos</li>
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
                <h3 class="card-title">Ingresar los datos del proyecto</h3>
              </div>
              <form role="form" id="form-agregar-proyecto" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del proyecto</label>
                        <input type="text" class="form-control" name="nombre_proyecto" id="exampleInputEmail1" placeholder="Nombre o descripción del proyecto" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tecnologías usadas</label>
                        <input type="text" class="form-control" name="tecnologia_usada" id="exampleInputPassword1" placeholder="Que tecnologías utilizó" required>
                    </div>
                    <div class="form-group">
                        <label for="asignatura1">Asignatura para la que se desarrolló</label>
                        <input type="text" class="form-control" name="asignatura_desarrollo" id="asignatura1" placeholder="Asignatura para la que se desarrolló" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de inicio y fecha final del proyecto:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                            </div>
                            <input type="text" class="form-control float-right" name="fechaini_fechafin" id="reservation" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Listado de habilidades adquiridas al desarrollar el proyecto</label>
                        <textarea class="form-control" rows="3" name="listado_habilidades" placeholder="Enter ..." required></textarea>
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
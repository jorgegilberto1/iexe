    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Carga de Data stage</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li id="muestraempresa" class="breadcrumb-item"><a href="#">Empresa</a></li>
              <li id="muestrarfc" class="breadcrumb-item active">Página de inicio</li>
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
                <h5 class="m-0">Subir Data Stage</h5>
              </div>
              <div class="card-body">
                <form name="formulario" id="datastage-contact-form" role="form" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleFormControlFile1">Seleccione los archivos DS</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="datastage[]" multiple required>
                  </div>
                  <div style="display:none" class="progress">
                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      <span class="mensajeprogreso"></span>
                    </div>
                  </div>
                  <br>
                  <button id="" type="submit" class="btn btn-primary actualizar">Subir</button>
                </form>
                <button style="display:none" type="button" class="btn btn-success toastrDefaultSuccess">
                  Launch Success Toast
                </button>
                <button style="display:none" type="button" class="btn btn-danger toastrDefaultError">
                  Launch Error Toast
                </button>
                <button style="display:none" type="button" class="btn btn-warning toastrDefaultWarning">
                  Launch Warning Toast
                </button>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
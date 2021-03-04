    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Descargar DataStage</h1>
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
        

            <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 id="titulofechas" class="card-title">Fechas de almacenamiento DataStage</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="">
                  <p id="fechamesesglosa"></p>
                  <table id="listadofechasdatas" class="table table-striped">
  <thead>
      <th>Año</th>
      <th>Enero</th>
      <th>Febrero</th>
      <th>Marzo</th>
      <th>Abril</th>
      <th>Mayo</th>
      <th>Junio</th>
      <th>Julio</th>
      <th>Agosto</th>
      <th>Septiembre</th>
      <th>Octubre</th>
      <th>Noviembre</th>
      <th>Diciembre</th>
  </thead>
  <tbody id="fechaslineas">
    
  </tbody>
</table>
                  
                </div>
           
              </div>
            </div>
            </div>

            
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Seleccione un rango de fechas para descargar DataStage</h3>
              </div>
              <div class="card-body">
                <form id="form-descargar-glosa" method="POST">
                  <div class="row">
                    <div class="col-sm-3 col-lg-4">
                      <div class="form-group">
                        <label for="fecha">Fecha inicial</label>
                        <input type="month" name="fechainicial" id="fecha" class="form-control" value="2020-01">
                      </div>
                    </div>
                    <div class="col-sm-3 col-lg-4">
                      <div class="form-group">
                        <label for="fecha">Fecha final</label>
                        <input type="month" name="fechafinal" id="fecha" class="form-control" value="2020-07">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm save-btn">Cargar Glosa</button>
                  <a style=display:none id="descargarglosa" href="controladores/glosa/glosa.zip" target="_blank">Descargar Glosa</a>
                </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
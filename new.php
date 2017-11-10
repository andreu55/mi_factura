<!DOCTYPE html>
<html lang="es">
<head>
  <title>Mi factura</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Inserta nuevo gasto" />
  <meta name="author" content="Andreu garcía" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <style media="screen">
    .btn-epic {
      padding: .75rem 2.5rem;
      color: #fff;
      text-shadow: 1px 1px 2px #333;
      /*border-color: ;*/
      border: 2px solid #fff;
      background: linear-gradient(60deg, #f79533, #f37055, #ef4e7b, #a166ab, #5073b8, #1098ad, #07b39b, #6fba82);
      transition: all 2.5s;
    }
    .btn-epic:hover {
      text-shadow: 1px 1px 3px #999;
      /*border-color: #000;*/
      border: 2px solid #333;
      cursor: pointer;
      /*background:linear-gradient(60deg, #f37055, #ef4e7b, #a166ab, #5073b8, #1098ad, #07b39b, #6fba82, #f79533);*/
      transition: all 0.5s;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="mt-3 mb-4">
          <a href="/" class="btn btn-info">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          <span style="vertical-align:middle">
            Hola, Andreu
          </span>
        </h2>

    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-gasto-tab" data-toggle="pill" href="#pills-gasto" role="tab" aria-controls="pills-gasto" aria-selected="true">Gasto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-ingreso-tab" data-toggle="pill" href="#pills-ingreso" role="tab" aria-controls="pills-ingreso" aria-selected="false">Ingreso</a>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-gasto" role="tabpanel" aria-labelledby="pills-gasto-tab">

        <form action="functions/guarda_gasto.php" method="post">
          <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" step='0.01' placeholder="Enter cantidad">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label for="tipo">Tipo</label>
                <select class="form-control" id="tipo" name="tipo">
                  <option value="restaurantes" data-iva="0.10">Restaurantes</option>
                  <option value="servicios" data-iva="0.21">Servicios</option>
                  <option value="hardware" data-iva="0.21">Hardware</option>
                  <option value="baile" data-iva="0.21">Baile</option>
                </select>
              </div>
              <div class="col">
                <label for="iva">IVA <small class="text-muted">% desgravado</small></label>
                <input type="text" class="form-control" id="iva" name="iva" value="0.10">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="<?= date('Y-m-d') ?>">
          </div>
          <div class="form-group">
            <label for="concepto">Concepto</label>
            <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Enter concepto">
          </div>
          <button type="submit" class="btn btn-primary btn-lg btn-block mb-4 mt-4">Guardar</button>
        </form>
      </div>
      <div class="tab-pane fade" id="pills-ingreso" role="tabpanel" aria-labelledby="pills-ingreso-tab">
        <div class="text-center">
          <br>Vacío de momento!
        </div>
      </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>
</html>

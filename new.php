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
  .fw-200 { font-weight: 200; }
  </style>
  <?php require_once('config/helper.php'); ?>
</head>
<body>
  <div id="block_final" style="display:none">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <div class="col">
          <h1 class="display-3">Gasto guardado!</h1>
          <p class="lead">Enhorabuena! molas mogollón y aqui un Lorem ipsum dolor sit amet, a deserunt mollit anim id est laborum para rellenar</p>
          <hr class="my-4">
          <p>
            <p>¿Quieres introducir otro pago?</p>
            <button class="btn btn-primary btn-lg btn-block" id="refresh" role="button">
              <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
              Oh yeah!
            </button>
          </p>
          <p>
            <p>Ir a todos los pagos</p>
            <a href="<?= url('/ver.php') ?>" class="btn btn-warning btn-lg btn-block">
              <i class="fa fa-fw fa-list" aria-hidden="true"></i>
              Gestionar
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div id="block_inicial" class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="mt-3 mb-4">
          <a href="/" class="btn btn-info">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          <span class="fw-200" style="vertical-align:middle">
            Hola, Andreu
          </span>
          <a href="<?= url('/ver.php') ?>" class="btn btn-lg btn-warning pull-right">
            <i class="fa fa-list" aria-hidden="true"></i>
          </a>
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

            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <div class="input-group">
                <input type="number" class="form-control" id="cantidad" step='0.01' placeholder="100.95" required>
                <span class="input-group-addon"><b>€</b></span>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="tipo">Tipo</label>
                  <select class="form-control" id="tipo">
                    <option value="restaurantes" data-iva="0.10">Restaurantes</option>
                    <option value="servicios" data-iva="0.21">Servicios</option>
                    <option value="hardware" data-iva="0.21">Hardware</option>
                    <option value="baile" data-iva="0.21">Baile</option>
                  </select>
                </div>
                <div class="col">
                  <label for="iva">IVA <small class="text-muted">% desgravado</small></label>
                  <input type="text" class="form-control" id="iva" value="0.10" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="fecha">Fecha</label>
              <input type="date" class="form-control" id="fecha" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="form-group">
              <label for="concepto">Concepto</label>
              <input type="text" class="form-control" id="concepto" placeholder="Cafetería" required>
            </div>
            <button id="guarda-gasto" class="btn btn-epic btn-block mb-3 mt-4">Guardar</button>

            <div id="alert_block">

            </div>

          </div>
          <div class="tab-pane fade" id="pills-ingreso" role="tabpanel" aria-labelledby="pills-ingreso-tab">
            <div class="text-center">
              <br>Vacío de momento!
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <script>

  $("#guarda-gasto").click(function(){

    $(this).html('<i class="fa fa-refresh fa-spin fa-fw"></i>');

    $.post("functions/guarda_gasto.php",
    {
      cantidad: $('#cantidad').val(),
      tipo: $('#tipo').val(),
      iva: $('#iva').val(),
      fecha: $('#fecha').val(),
      concepto: $('#concepto').val()
    },
    function(data, status){

      $("#guarda-gasto").html('Guardar');

      if (status == "success") {
        var obj = JSON.parse(data);

        if (obj.res == '200') {
          $('#block_inicial').slideUp();
          $('#block_final').slideDown();
        } else {
          $('#alert_block').html('<div class="alert alert-warning fade show" role="alert">' +
          '<strong>Holy guacamole!</strong> Server says: ' + obj.msj +
          '</div>')
        }
      }
    });
  });

  $("#refresh").click(function(){

    $('#alert_block').html("");
    $('#cantidad').val("");
    $('#concepto').val("");

    $('#block_final').slideUp();
    $('#block_inicial').slideDown();
  });

  $("#tipo").change(function() {
    var iva = $("#tipo option:selected").data('iva');
    $("#iva").hide().val(iva).fadeIn();
  });


  </script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Mi factura</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Ver mis gastos" />
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
  .lafecha { font-size: 13px; }
  .fw-200 { font-weight: 200; }
  </style>

  <?php include 'facturas.php'; ?>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="mt-3 mb-4">
          <a href="/" class="btn btn-info">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          <span class="fw-200" style="vertical-align:middle">
            Últimos pagos
          </span>
          <a href="<?= url('/new.php') ?>" class="btn btn-lg btn-warning pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
        </h2>

        <?php if (isset($gastos) && $gastos): ?>
          <?php foreach ($gastos as $key => $g): ?>

            <?php
              // Sacamos la base sabiendo el iva y el total
              $base = round(($g->cantidad / (1 + $g->iva)), 2);
              // Con esa base, sacamos el iva del gasto
              $iva = round(($base * $g->iva), 2);



              $fecha = DateTime::createFromFormat('d/m/Y', $g->fecha)->format('Y-m-d H:i:s');
            ?>

            <div class="card mb-2" id="gasto<?=$g->id?>">
              <div class="card-body">
                <h4 class="card-title">
                  <?=$g->concepto?>
                  <em class="text-muted lafecha fw-200"><?=$g->fecha?></em>
                  <button class="btn btn-danger pull-right borra-gasto" data-id="<?=$g->id?>"><i class="fa fa-fw fa-times"></i></button>
                </h4>
                <p class="card-text">
                  <b><?=number_format($g->cantidad, 2)?>€</b> =
                  <span class="text-danger"><?=number_format($base, 2)?></span>
                  <i class="fa fa-fw fa-arrow-right"></i>
                  <b class="text-success"><?=number_format($iva, 2)?></b>
                  <small>(<?=$g->iva?>%)</small>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>

  $(".borra-gasto").click(function(){

    $(this).html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
    var id = $(this).data('id');

    $.post("functions/borra_gasto.php",
    {
      id: id
    },
    function(data, status){

      if (status == "success") {

        var obj = JSON.parse(data);

        if (obj.res == '200') {
          $('#gasto'+id).slideUp();
        }
      }
    });
  });

  </script>

</body>
</html>

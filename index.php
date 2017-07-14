<!DOCTYPE html>

<html lang="es">

<head>
  <title>Mi factura</title>
  <meta charset="UTF-8">
  <meta name="description" content="For generating PDF documents on the fly" />
  <meta name="author" content="Andreu garcía" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

  <?php include 'facturas.php'; ?>

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12">

        <br>
        <h1>Hola, Andreu</h1>
        <br>

        <?php

        $base_total = $iva_total = $irpf_total = $total_total = 0;
        $base_total_pend = $iva_total_pend = $irpf_total_pend = $total_total_pend = 0;

        ?>

        <table id="tabla_facturas" class="display" cellspacing="0" width="100%">
          <thead><tr>
            <th>Fac.</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Horas</th>
            <th>Base</th>
            <th>IVA</th>
            <th>IRPF</th>
            <th>Importe</th>
          </tr></thead>
          <tbody>
            <?php foreach ($facturas as $key => $f): ?>

              <?php

                // Si es persona física, no le retenemos IRPF
                if ($f->persona_fisica) { $ret_irpf = 0; }
                else { $ret_irpf = 7; }

                // Si hemos especificado horas, calculamos el importe
                if ($f->horas) {
                  $base = round($f->horas * $f->precio, 2);
                }
                // Sino, suponemos que lo que pone en precio es el precio final
                else {
                  $base = round($f->precio, 2);
                }

                $iva = round(($base * 0.21), 2);
                $irpf = round(($base*$ret_irpf)/100, 2);
                $total = round($iva + $base - $irpf, 2);

                if ($f->pagada) {
                  $base_total += $base;
                  $iva_total += $iva;
                  $irpf_total += $irpf;
                  $total_total += $total;
                } else {
                  $base_total_pend += $base;
                  $iva_total_pend += $iva;
                  $irpf_total_pend += $irpf;
                  $total_total_pend += $total;
                }
              ?>

              <tr style="background-color:<?= $f->pagada ? "#dff0d8" : "#FFE5E5" ?>">
                <td><?=$f->id?></td>
                <td><?=$f->cliente?></td>
                <td><?=$f->fecha?></td>
                <td><?=$f->horas?> <small><em>x <?=$f->precio?></em></small></td>
                <td><?= $base ?></td>
                <td>+<?= $iva ?></td>
                <td>-<?= $irpf ?></td>
                <td><?= $total ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th><span class="text-success"><?=$base_total?></span> / <span class="text-danger"><?=$base_total_pend?></span></th>
              <th><span class="text-warning"><?=$iva_total?></span> / <span class="text-danger"><?=$iva_total_pend?></span></th>
              <th><span class="text-info"><?=$irpf_total?></span> / <span class="text-danger"><?=$irpf_total_pend?></span></th>
              <th><span class="text-default"><?=$total_total?></span> / <span class="text-danger"><?=$total_total_pend?></span></th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>

    <br><br>

    <div class="row">
      <div class="col-8">
        <h3>Gastos</h3>
        <table class="table table-sm">
          <thead><tr>
            <th>Fecha</th>
            <th>Cantidad</th>
            <th>Base</th>
            <th>IVA</th>
            <th>Concepto</th>
          </tr></thead>
          <tbody>

            <?php
              $cantidad_total = $iva_total_gastos = $base_total_gastos = 0;
              $cant_tipos_gasto = $suma_tipos_gasto = [];
            ?>

            <?php foreach ($gastos as $key => $g): ?>

              <?php

                // Sumamos los tipos de gasto
                if (!isset($cant_tipos_gasto[$g->tipo])) {
                  $cant_tipos_gasto[$g->tipo] = 1;
                  $suma_tipos_gasto[$g->tipo] = $g->cantidad;
                }
                else {
                  $cant_tipos_gasto[$g->tipo]++;
                  $suma_tipos_gasto[$g->tipo] += $g->cantidad;
                }


                // Sacamos la base sabiendo el iva y el total
                $base = round(($g->cantidad / (1 + $g->iva)), 2);
                // Con esa base, sacamos el iva del gasto
                $iva = round(($base * $g->iva), 2);

                $cantidad_total += $g->cantidad;
                $base_total_gastos += $base;
                $iva_total_gastos += $iva;
              ?>

              <tr>
                <th scope="row"><small><?=$g->fecha?></small></th>
                <td><?=number_format($g->cantidad, 2)?></td>
                <td><?=number_format($base, 2)?></td>
                <td><?=number_format($iva, 2)?> <small class="text-muted">(<?=$g->iva?>)</small></td>
                <td><small><?=$g->concepto?></small></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th></th>
              <th><span class="text-info"><?=$cantidad_total?></span></th>
              <th><span class="text-warning"><?=$base_total_gastos?></span></th>
              <th><span class="text-success"><?=$iva_total_gastos?></span></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-4">
        <h3>Overview</h3>

        <ul class="list-group">
          <li class="list-group-item justify-content-between">
            IVA recibido
            <span class="badge badge-info badge-pill"><?=number_format($iva_total, 2, ".", "")?> €</span>
          </li>
          <li class="list-group-item justify-content-between">
            IVA desgrable
            <span class="badge badge-success badge-pill"><?=number_format($iva_total_gastos, 2, ".", "")?> €</span>
          </li>
          <li class="list-group-item justify-content-between">
            IVA Total
            <span class="badge badge-danger badge-pill"><?= number_format(($iva_total - $iva_total_gastos), 2, ".", "") ?> €</span>
          </li>
        </ul>
      </div>
    </div>

    <br><br>

    <!-- Graficas -->
    <div class="row">
      <div class="col-6">
        <div id="chart_div"></div>
      </div>
      <div class="col-6">
        <div id="chart_div2"></div>
      </div>
    </div>
    <br>

    <h3>Genera factura</h3>
    <br>
    <form action="examples/fac.php" method="post">
      <div class="row">
        <div class="col-9">
          <div class="form-group row">
            <label for="id" class="col-2 col-form-label">ID factura</label>
            <div class="col-10">
              <input class="form-control" type="text" value="<?= count($facturas) + 1 ?>" name="id">
            </div>
          </div>
          <div class="form-group row">
            <label for="horas" class="col-2 col-form-label">
              Horas
              <i class="fa fa-fw fa-question-circle text-muted" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Dejar a 0 para consierar el precio como valor final"></i>
            </label>
            <div class="col-10">
              <input class="form-control" type="number" step="0.01" value="100" name="horas">
            </div>
          </div>
          <div class="form-group row">
            <label for="horas" class="col-2 col-form-label">Precio</label>
            <div class="col-10">
              <input class="form-control" type="number" step="0.01" value="15" name="precio">
            </div>
          </div>
          <div class="form-group row">
            <label for="fecha" class="col-2 col-form-label">Fecha</label>
            <div class="col-10">
              <input class="form-control" type="date" value="<?=date('Y-m-d')?>" name="fecha">
            </div>
          </div>
          <div class="form-group row">
            <label for="id" class="col-2 col-form-label">Concepto</label>
            <div class="col-10">
              <input class="form-control" type="text" value="Desarrollo web" name="concepto">
            </div>
          </div>
        </div>
        <div class="col-3">

          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="cliente" value="1" checked>O'Clock Digital
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="cliente" value="2">TAXO Valoración, S.L.
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="cliente" value="3">Nemesis media S.L
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="cliente" value="4">Jose Ángel Rodriguez
            </label>
          </div>

          <button type="submit" class="btn btn-primary" title="Genera pdf" target="_blank">Genera PDF</button>
        </div>
      </div>
    </form>

    <br>
    <br>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/javascript">

    function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        <?php foreach ($cant_tipos_gasto as $tipo => $num): ?>
          ['<?=$tipo?>', <?=$num?>],
        <?php endforeach; ?>
      ]);

      // Set chart options
      var options = {title:'Cantidad de pagos',
                     pieSliceText:'value',
                     pieHole: 0.45,
                     height:300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

    function drawChart2() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        <?php foreach ($suma_tipos_gasto as $tipo => $num): ?>
          ['<?=$tipo?>', <?=$num?>],
        <?php endforeach; ?>
      ]);

      // Set chart options
      var options = {title:'Total €/Tipo',
                     pieSliceText:'value',
                     height:300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
      chart.draw(data, options);
    }

    $(document).ready(function() {

      // Inicializamos la datatable
      $('#tabla_facturas').DataTable({
          "order": [[ 0, "desc" ]]
      });


      // Cargamos los tooltips
      $('[data-toggle="tooltip"]').tooltip();


      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

    });
  </script>

</body>
</html>

<!DOCTYPE html>

<html lang="es">

<head>
  <title>Mi factura</title>
  <meta charset="UTF-8">
  <meta name="description" content="For generating PDF documents on the fly" />
  <meta name="author" content="Andreu garcía" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12">
        
        <br>
        <h1>Hola, Andreu</h1>
        <br>
        
        <form class="" action="examples/fac.php" method="post">
          
          <div class="row">
            <div class="col-9">
              <div class="form-group row">
                <label for="id" class="col-2 col-form-label">ID factura</label>
                <div class="col-10">
                  <input class="form-control" type="text" value="1" name="id">
                </div>
              </div>
              <div class="form-group row">
                <label for="horas" class="col-2 col-form-label">Horas</label>
                <div class="col-10">
                  <input class="form-control" type="number" step="0.01" value="100" name="horas">
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha" class="col-2 col-form-label">Fecha</label>
                <div class="col-10">
                  <input class="form-control" type="date" value="<?=date('Y-m-d')?>" name="fecha">
                </div>
              </div>
            </div>
            <div class="col-3">
              
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="cliente" value="1" checked>
                  O'Clock Digital
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="cliente" value="2">
                  TAXO Valoración, S.L.
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="cliente" value="3">
                  Nemesis media S.L
                </label>
              </div>
              
              <button type="submit" class="btn btn-primary" title="Genera pdf" target="_blank">Genera PDF</button>
            </div>
          </div>
        </form>

        <br>
        <br>
        
        <?php include 'facturas.php'; ?>
        
        <?php
        
        $base_total = 0;
        $iva_total = 0;
        $irpf_total = 0;
        $total_total = 0;
        
        ?>
        
        <table id="tabla_facturas" class="display" cellspacing="0" width="100%">
          <thead><tr><th>Fac.</th><th>Cliente</th><th>Fecha</th><th>Horas</th><th>Base</th><th>IVA</th><th>IRPF</th><th>Importe</th></tr></thead>
          <tbody>
            <?php foreach ($facturas as $key => $f): ?>
              <tr style="background-color:<?= $f[5] ? "#dff0d8" : "#FFE5E5" ?>">
                <td><?=$f[0]?></td>
                <td><?=$f[1]?></td>
                <td><?=$f[2]?></td>
                <td><?=$f[3]?></td>
                <td><?= $base = round($f[3] * $f[4], 2); $base_total += $base; ?></td>
                <td>+<?= $iva = round(($base * 0.21), 2); $iva_total += $iva; ?></td>
                <td>-<?= $irpf = round(($base * 0.07), 2); $irpf_total += $irpf; ?></td>
                <td><?= $total = round($iva + $base - $irpf, 2); $total_total += $total; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th><?= $base_total ?> €</th>
              <th class="text-danger"><?= $iva_total ?></th>
              <th class="text-info"><?= $irpf_total ?></th>
              <th><?= $total_total ?> €</th>
            </tr>
          </tfoot>
        </table>
        
      </div>
    </div>
  </div>
  
  
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function() {
    $('#tabla_facturas').DataTable();
  });
  </script>
  
</body>
</html>

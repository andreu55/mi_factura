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
        
        <form class="" action="examples/andreu_test.php" method="post">
          
          <div class="row">
            <div class="col-10">
              <div class="form-group row">
                <label for="id" class="col-2 col-form-label">ID factura</label>
                <div class="col-10">
                  <input class="form-control" type="text" value="1" name="id">
                </div>
              </div>
              <div class="form-group row">
                <label for="horas" class="col-2 col-form-label">Horas</label>
                <div class="col-10">
                  <input class="form-control" type="number" step="0.01" value="108.25" name="horas">
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha" class="col-2 col-form-label">Fecha</label>
                <div class="col-10">
                  <input class="form-control" type="date" value="<?=date('Y-m-d')?>" name="fecha">
                </div>
              </div>
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-primary" title="Genera pdf" target="_blank">Genera PDF</button>
            </div>
          </div>
        </form>

        <br>
        <br>
        
        <?php
        
        $facturas = [];
        
        $facturas[0] = new stdClass();
        $facturas[0]->cliente = "Tiger Nixon";
        $facturas[0]->horas = "system architect";
        $facturas[0]->date = "2011/03/23";
        $facturas[0]->iva = "61";
        $facturas[0]->irpf = "edinburgh";
        $facturas[0]->importe = "$320,800";
        
        $facturas[1] = new stdClass();
        $facturas[1]->cliente = "tiger nixon2";
        $facturas[1]->horas = "system architect2";
        $facturas[1]->date = "2010/04/25";
        $facturas[1]->iva = "612";
        $facturas[1]->irpf = "edinburgh2";
        $facturas[1]->importe = "$320,8002";
        
        ?>
        
        <table id="tabla_facturas" class="display" cellspacing="0" width="100%">
          <thead><tr><th>Cliente</th><th>Horas</th><th>Date</th><th>IVA</th><th>IRPF</th><th>Importe</th></tr></thead>
          <!-- <tfoot><tr><th>Cliente</th><th>Horas</th><th>Date</th><th>IVA</th><th>IRPF</th><th>Importe</th></tr></tfoot> -->
          <tbody>
            <?php foreach ($facturas as $key => $fac): ?>
              <tr>
                <td><?= $fac->cliente ?></td>
                <td><?= $fac->horas ?></td>
                <td><?= $fac->date ?></td>
                <td><?= $fac->iva ?></td>
                <td><?= $fac->irpf ?></td>
                <td><?= $fac->importe ?></td>
              </tr>  
            <?php endforeach; ?>
          </tbody>
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

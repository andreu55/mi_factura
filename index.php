<!DOCTYPE html>

<html lang="es">

<head>
  <title>Mi factura</title>
  <meta charset="UTF-8">
  <meta name="description" content="For generating PDF documents on the fly" />
  <meta name="author" content="Andreu garcía" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12">

        <br>
        <h1>Hola, Andreu</h1>
        <br>

        <form class="" action="examples/andreu_test.php" method="post">

          <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">ID factura</label>
            <div class="col-10">
              <input class="form-control" type="text" value="1" name="id">
            </div>
          </div>
          <div class="form-group row">
            <label for="example-number-input" class="col-2 col-form-label">Horas</label>
            <div class="col-10">
              <input class="form-control" type="number" step="0.01" value="108.25" name="horas">
            </div>
          </div>
          <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">Fecha</label>
            <div class="col-10">
              <input class="form-control" type="date" value="<?=date('Y-m-d')?>" name="fecha">
            </div>
          </div>
          <!-- <div class="form-group row">
            <label for="example-color-input" class="col-2 col-form-label">Color</label>
            <div class="col-10">
              <input class="form-control" type="color" value="#563d7c" name="example-color-input">
            </div>
          </div> -->


          <button type="submit" class="btn btn-primary" title="Genera pdf" target="_blank">Genera PDF</button>
        </form>

      </div>
    </div>
  </div>



  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>

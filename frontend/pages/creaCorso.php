<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Diario | CreaCorso</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">
</head>

<body>
  <?php require_once(__DIR__ . '\navbar.php'); ?>

  <?php
  include_once dirname(__FILE__) . '\..\function\quadrimestre.php';
  $list_quad = getArchiveQuadrimestre();
  ?>

  <div class="container">
    <div class="row mt-5">
      <h2>Crea corso:</h2>
    </div>
    <div class="row mt-5">
      <form class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Tipologia del corso:</label>
          <select class="form-select" aria-label="Default select example" name="tipologia" required>
            <option selected disabled>Tipologia del corso:</option>
            <option value="A">C</option>
            <option value="B">B</option>
            <option value="C">A</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Quadrimestre:</label>
          <select class="form-select" aria-label="Default select example" name="tipologia" required>
            <option selected disabled>Quadrimestre:</option>
            <?php foreach ($list_quad as $row) : ?>
              <option value="<?php echo $row['id'] ?>"><?php echo ($row['data_inizio'] . " " . $row['data_fine']) ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label">Address</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
        </div>
        <div class="col-12">
          <label for="inputAddress2" class="form-label">Address 2</label>
          <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">City</label>
          <input type="text" class="form-control" id="inputCity">
        </div>
        <div class="col-md-4">
          <label for="inputState" class="form-label">State</label>
          <select id="inputState" class="form-select">
            <option selected>Choose...</option>
            <option>...</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="inputZip" class="form-label">Zip</label>
          <input type="text" class="form-control" id="inputZip">
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              Check me out
            </label>
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();
?>

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
  include_once dirname(__FILE__) . '\..\function\docente.php';
  $list_quad = getArchiveQuadrimestre();
  $list_doc = getArchieveDocente();
  ?>

  <div class="container">
    <div class="row mt-5">
      <h2>Crea corso:</h2>
    </div>
    <div class="row mt-1">
      <form class="row g-3" method="post">
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
          <select class="form-select" aria-label="Default select example" name="id_quadrimestre" required>
            <option selected disabled>Quadrimestre:</option>
            <?php foreach ($list_quad as $row) : ?>
              <option value="<?php echo $row['id'] ?>"><?php echo ($row['data_inizio'] . " " . $row['data_fine']) ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Docente:</label>
          <select class="form-select" aria-label="Default select example" name="id_docente" required>
            <option selected disabled>Docente:</option>
            <?php foreach ($list_doc as $row) : ?>
              <option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Tutor:</label>
          <select class="form-select" aria-label="Default select example" name="id_tutor" required>
            <option selected disabled>Tutor:</option>
            <?php foreach ($list_doc as $row) : ?>
              <option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-2">
          <label for="inputCity" class="form-label">Materia:</label>
          <input type="text" class="form-control" id="inputCity" name="materia">
        </div>
        <div class="col-md-5">
          <label for="inputState" class="form-label">Data di inizio:</label>
          <input type="date" class="form-control" id="inputCity" name="data_inizio">
        </div>
        <div class="col-md-5">
          <label for="inputZip" class="form-label">Data di fine:</label>
          <input type="date" class="form-control" id="inputCity" name="data_fine">
        </div>
        <div class="col-12">
          <label class="form-label">Sede:</label>
          <select class="form-select" aria-label="Default select example" name="sede" required>
            <option selected disabled>Sede:</option>
            <option value="ITIS Ferruccio Viola">ITIS Ferruccio Viola</option>
            <option value="IPSIA">IPSIA</option>
            <option value="Agrario">Agrario</option>
            <option value="Geometri">Geometri</option>
          </select>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-secondary">Invia</button>
        </div>
      </form>

      <?php
      include_once dirname(__FILE__) . '\..\function\corsi.php';
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $count = countCorsoByType($_POST['tipologia']);
        $count = $count + 1;
        if ($count != -1) {
          $nome_corso = "Corso_" . $_POST['tipologia'] . "_" . $count;      //creo il nome del corso unendo la tipologia con il numero del corso
          $data = array(
            "tipologia" => $_POST['tipologia'],
            "id_quadrimestre" => $_POST['id_quadrimestre'],
            "id_docente" => $_POST['id_docente'],
            "id_tutor" => $_POST['id_tutor'],
            "materia" => $_POST['materia'],
            "data_inizio" => $_POST['data_inizio'],
            "data_fine" => $_POST['data_fine'],
            "nome_corso" => $nome_corso,
            "sede" => $_POST['sede'],
          );
          $res = addCorso($data);
          if ($res == 1) {
            echo ('<p class="text-success"><b>Corso aggiunto nel database</b></p>');
            session_destroy();
          }
          if ($res == -1) {
            echo ('<p class="text-danger"><b>Errore!</b></p>');
          }
        } else {
          echo ('<p class="text-danger"><b>Errore!</b></p>');
        }
      }
      ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
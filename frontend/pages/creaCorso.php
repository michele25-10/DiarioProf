<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Diario | CreaCorso</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
  <?php require_once(__DIR__ . '\navbar.php'); ?>

  <?php
  include_once dirname(__FILE__) . '\..\function\quadrimestre.php';
  include_once dirname(__FILE__) . '\..\function\docente.php';
  include_once dirname(__FILE__) . '\..\function\alunno.php';
  $list_quad = getArchiveQuadrimestre();
  $list_doc = getArchieveDocente();
  $list_al = getArchieveAlunni();
  ?>

  <?php
  include_once dirname(__FILE__) . '\..\function\corsi.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $count = countCorsoByType($_POST['tipologia']);
    if ($count != -1) {
      $count = $count + 1;
      if ($count < 10) {
        $nome_corso = "Corso_" . $_POST['tipologia'] . "_00" . $count;      //creo il nome del corso unendo la tipologia con il numero del corso
      } elseif ($count > 9 && $count < 100) {
        $nome_corso = "Corso_" . $_POST['tipologia'] . "_0" . $count;      //creo il nome del corso unendo la tipologia con il numero del corso
      } elseif ($count > 99) {
        $nome_corso = "Corso_" . $_POST['tipologia'] . "_" . $count;      //creo il nome del corso unendo la tipologia con il numero del corso
      }

      if ($_POST['tipologia'] == 'A' || $_POST['tipologia'] == 'B') {
        $data = array(
          "tipologia" => $_POST['tipologia'],
          "id_quadrimestre" => $_POST['id_quadrimestre'],
          "id_docente" => $_POST['id_docente'],
          "id_tutor" => "-1",
          "materia" => $_POST['materia'],
          "data_inizio" => $_POST['data_inizio'],
          "data_fine" => $_POST['data_fine'],
          "nome_corso" => $nome_corso,
          "sede" => $_POST['sede'],
        );
      }
      if ($_POST['tipologia'] == 'C') {
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
      }
      $res = addCorso($data);
      if ($res == 1) {
      }
      if ($res == -1) {
        echo ('<p class="text-danger"><b>Errore!</b></p>');
      }
    } else {
      echo ('<p class="text-danger"><b>Errore!</b></p>');
    }
  }
  ?>

  <div class="container mt-5">
    <div class="progress mb-5">
      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <form id="regiration_form" novalidate action="action.php" method="post">
      <fieldset>
        <h2>Corso: </h2>
        <div class="row mt-1">
          <div class="col-md-6">
            <label class="form-label">Tipologia del corso:</label>
            <select class="form-select" aria-label="Default select example" name="tipologia" id="tipologia" required>
              <option selected disabled>Tipologia del corso:</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
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
          <div class="col-md-6" id="tutor">

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
        </div>
        <input type="button" name="password" class="next btn btn-primary mt-3" value="Next" />
      </fieldset>

      <fieldset>
        <h2> Incontri:</h2>
        <div class="row mt-1">
          <div class="col-md-12 mb-3">
            <label class="form-label">Primo incontro</label>
            <input type="datetime-local" class="form-control" name="incontro1" id="fName">
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Secondo incontro</label>
            <input type="datetime-local" class="form-control" name="incontro2" id="fName">
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Terzo incontro</label>
            <input type="datetime-local" class="form-control" name="incontro3" id="fName">
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Quarto incontro</label>
            <input type="datetime-local" class="form-control" name="incontro4" id="fName">
          </div>
          <div class="col-md-12 mb-3" id="form-typeA">
            <!--Solo se la tipologia del corso è una A allora comparirà il quinto incontro-->
          </div>
        </div>
        <input type="button" name="previous" class="previous btn btn-secondary" value="Previous" />
        <input type="button" name="next" class="next btn btn-primary" value="Next" />
      </fieldset>

      <fieldset>
        <h2>Iscritti:</h2>
        <div class="row mt-1 mb-3">
          <div class="col-md-6 mb-3">
            <label class="form-label">Alunno:</label>
            <select class="form-select" aria-label="Default select example" name="alunno1" required>
              <option selected disabled>Alunni:</option>
              <?php foreach ($list_al as $row) : ?>
                <option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option>
              <?php endforeach ?>
          </div>
          <div id="alunni-typeB">

          </div>
          <div id="alunni-typeC">

          </div>
        </div>
        <input type="button" name="previous" class="previous btn btn-secondary" value="Previous" />
        <input type="submit" name="submit" class="submit btn btn-primary" value="Submit" />
      </fieldset>
    </form>
  </div>

  <script>
    //Prende i valori che vengono selezionati nella tipologia del corso, per effettuare controlli in seguito.
    $("#tipologia")
      .change(function() {
        $("#tipologia option:selected").each(function() {
          var str = $(this).text();
          //Se la tipologia del corso è la C allora faccio apparire il select del tutor altrimenti lo rimuovo
          switch (str) {
            case "A":
              $("#html").remove();
              $('#form-typeA').html('<div id="typeA"><label class="form-label">Quinto incontro</label><input type="datetime-local" class="form-control" name="incontro5" id="fName"></div>');
              $("#form-alunni-typeB").remove();
              break;

            case "B":
              $("#html").remove();
              $("#typeA").remove();
              $('#alunni-typeB').html('<div id="form-alunni-typeB"><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno2" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno3" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno4" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno5" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno6" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></div></div>');
              break;

            case "C":
              $('#tutor').html('<div id="html"> <label class = "form-label" > Tutor: </label> <select class = "form-select" aria - label = "Default select example" name = "id_tutor" required > <option selected disabled > Tutor: </option> <?php foreach ($list_doc as $row) : ?> <option value = "<?php echo $row['CF'] ?>"> <?php echo ($row['nome'] . " " . $row['cognome']) ?> </option> <?php endforeach ?> </select> </div>');
              $("#typeA").remove();
              $("#form-alunni-typeB").remove();
              break;
          }
        });
      });

    $(document).ready(function() {
      var current = 1,
        current_step, next_step, steps;
      steps = $("fieldset").length;
      $(".next").click(function() {
        current_step = $(this).parent();
        next_step = $(this).parent().next();
        next_step.show();
        current_step.hide();
        setProgressBar(++current);
      });
      $(".previous").click(function() {
        current_step = $(this).parent();
        next_step = $(this).parent().prev();
        next_step.show();
        current_step.hide();
        setProgressBar(--current);
      });
      setProgressBar(current);
      // Change progress bar action
      function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
          .css("width", percent + "%")
          .html(percent + "%");
      }
    });
  </script>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>

<style type="text/css">
  #regiration_form fieldset:not(:first-of-type) {
    display: none;
  }
</style>
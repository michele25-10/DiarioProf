<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diario | Aggiungi docente</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>
    <div class="container">
        <div class="row mt-5">
            <h2>Inserisci dati docente</h2>
            <form method="post">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Codice Fiscale</label>
            <input class="form-control" type="text" onkeyup="this.value = this.value.toUpperCase();" id=" CF"
                placeholder="CF" name="CF" maxlength="50" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome docente</label>
            <input class="form-control" type="text" id="nome" placeholder="nome" name="nome" maxlength="50" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Cognome docente</label>
            <input class="form-control" type="text" id="cognome" placeholder="cognome" name="cognome" maxlength="50"
                required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Telefono docente</label>
            <input class="form-control" type="number" id="telefono" placeholder="telefono" name="telefono"
                maxlength="50" required>
        </div>
        <button type="submit" class="btn btn-success" name="login">Conferma</button>

        <?php

    include_once dirname(__FILE__) . '/../function/docente.php';

    $err = "";

    //stringa di identificazione del server, quando premi button il metodo diventa post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data = array(
        "CF" => $_POST['CF'],
        "nome" => $_POST['nome'],
        "cognome" => $_POST['cognome'],
        "telefono" => $_POST['telefono'],
      );
      $response = addDocente($data);
      if ($response == 1) {
        echo ('<p class="text-success fw-bold mt-3 ms-3">aggiunto</p>');
      } elseif ($response == -1) {
        echo ('<p class="text-danger fw-bold mt-3 ms-3">errore</p>');
      }
    }
    ?>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
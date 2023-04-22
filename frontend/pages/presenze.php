<?php
if (empty($_GET['id_incontro'])) {
    header('location: ../index.php');
}
if (empty($_GET['nome_corso'])) {
    header('location: ../index.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presenze corso</title>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/../function/alunno.php';
    $id_incontro = $_GET['id_incontro'];
    $nome_corso = $_GET['nome_corso'];
    $list_studenti = getStudentByCorsoName($nome_corso);
    ?>

    <div class="container mt-5">
        <?php echo ('<br>
    <h2>Informazioni di ' . ($_GET['nome_corso']) . '</h2>');
        ?>
        <form method="post" id="form">
            <table class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome e cognome</th>

                        <th>
                            <div class="d-flex justify-content-center">Assente?</div>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($list_studenti as $row) : ?>
                        <?php $i = 0 ?>
                        <tr>
                            <td><?php echo $row['nome'] . " " . $row['cognome'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <input type="checkbox" name="<?php echo $i++ ?>" value="<?php echo $row['CF'] ?>"></input>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="table-group-divider">
                        <td></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mt-3 p-2">Invia</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
    }
    ?>


    <script>

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
<style type="text/css">
    input[type='checkbox'] {
        -webkit-appearance: none;
        width: 25px;
        height: 25px;
        background: green;
    }

    input[type='checkbox']:checked {
        background: red;
    }
</style>
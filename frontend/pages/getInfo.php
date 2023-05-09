<?php
if (empty($_GET['id'])) {
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
    <title>Informazione Corso</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/../function/corsi.php';
    $id = $_GET['id'];
    $list_corsi = getInfoCorsoDate($id);
    $list_studenti = getInfoCorsoStudent($id);
    ?>

    <div class="container mt-5">
        <?php echo ('<br>
    <h2>Informazioni di ' . ($_GET['nome_corso']) . '</h2>');
        ?>
        <?php if ($list_corsi != -1) : ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Note</th>
                    <th>Aula</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_corsi as $row) : ?>
                <tr>
                    <td><?php echo $row['data_inizio'] ?></td>
                    <td><?php echo $row['note'] ?></td>
                    <td><?php echo $row['aula'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php endif ?>
    </div>

    <div class="container mt-5 mb-5">
        <?php if ($list_studenti != -1) : ?>
        <table id="example2" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>CF</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_studenti as $row) : ?>
                <tr>
                    <td><?php echo $row['nome'] ?></td>
                    <td><?php echo $row['cognome'] ?></td>
                    <td><?php echo $row['CF'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php endif ?>
    </div>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({});
    });
    </script>


    <script>
    $(document).ready(function() {
        $('#example2').DataTable({});
    });
    </script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
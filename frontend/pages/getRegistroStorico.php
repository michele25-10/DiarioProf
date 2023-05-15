<?php
include_once dirname(__FILE__) . '/../function/presenze.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>

    <?php
    $list = getPresenzeByIncontro($_GET['id_incontro']);
    ?>
    <div class="container mt-5">
        <?php echo ('<br>
    <h2>Registro di ' . ($_GET['nome_corso']) . '</h2>');
        ?>
        <div class="container mt-5 mb-5">
            <?php if ($list != -1) : ?>
            <table id="example" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $row) : ?>
                    <tr>
                        <td><i class="bi bi-person-badge-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    style="color: <?php
                                                                                                                                            if ($row['status'] == "Presente") {
                                                                                                                                                echo 'green';
                                                                                                                                            } else {
                                                                                                                                                echo 'red';
                                                                                                                                            }
                                                                                                                                            ?>"
                                    class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z" />
                                </svg>
                            </i></td>
                        <td><?php echo $row['nome'] ?></td>
                        <td><?php echo $row['cognome'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td>

                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php endif ?>
        </div>
    </div>
</body>

</html>
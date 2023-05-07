<?php
include_once dirname(__FILE__) . '/../function/presenze.php';
if (empty($_GET['id_incontro'])) {
    header('location: ../index.php');
}
if (empty($_GET['nome_corso'])) {
    header('location: ../index.php');
}
if (checkRegistro($_GET['id_incontro']) == "false") {
    header('location: listIncontri.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit presenze</title>
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/../function/presenze.php';
    $list = getPresenzeByIncontro($_GET['id_incontro']);
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
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $row) : ?>
                        <tr>
                            <td><i class="bi bi-person-badge-fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color: <?php
                                                                                                                                        if ($row['status'] == "Presente") {
                                                                                                                                            echo 'green';
                                                                                                                                        } else {
                                                                                                                                            echo 'red';
                                                                                                                                        }
                                                                                                                                        ?>" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z" />
                                    </svg>
                                </i></td>
                            <td><?php echo $row['nome'] ?></td>
                            <td><?php echo $row['cognome'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td>
                                <button id="edit" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="onClick(<?php echo ($row['id']) ?>)">Edit</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>

    <div class=" modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="alunno"></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Stato:</label>
                            <select class="form-select" aria-label="Default select example" id="<?php echo "alunno" . $i ?>" name="alunno" required>
                                <option id="presente" selected>Presente</option>
                                <option id="assente">Assente</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="id" name="id">Invia</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function onClick(id) {
            let endpoint = 'http://localhost/diarioProf/backend/API/presenze/getPresenzeById.php?id=' + id;
            $.get(endpoint, function(data, status) {
                console.log();
                //Viene inserito negli input del form i contenuti degli incontri con quell'ID
                $('#alunno').text(data['nome'] + " " + data['cognome']);
                $('#presente').val(id + " 0 " + data['CF'] + " " + data['id_incontro']);
                $('#assente').val(id + " 1 " + data['CF'] + " " + data['id_incontro']);
            })
        };
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST["alunno"])) {
            $value = explode(" ", $_POST["alunno"]);
            $data = array(
                "id" => $value[0],
                "id_alunno" => $value[2],
                "status" => $value[1],
                "id_incontro" => $value[3],
            );

            $res = updatePresenze($data);

            if ($res == 1) {
                unset($_POST['alunno']);
                $url = "http://localhost/DiarioProf/frontend/pages/editPresenze.php?id_incontro=" . $_GET['id_incontro'] . "&nome_corso=" . $_GET['nome_corso'];
                echo '<script>window . location . replace(
                        ' . $url . '
                    );</script>';
            }
        }
    }

    ?>

    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
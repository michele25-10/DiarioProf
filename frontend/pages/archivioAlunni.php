<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('location: ../index.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diario | Aggiungi docente</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php');
    include_once dirname(__FILE__) . '\..\function\alunno.php';
    $list = getArchieveAlunni();
    ?>


    <div class="container mt-5">
        <h2>Archivio degli alunni:</h2>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>SIDI</th>
                    <th>Telefono</th>
                    <th>Opzioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $row) : ?>
                    <tr>
                        <td><?php echo ($row['nome']) ?></td>
                        <td><?php echo ($row['cognome']) ?></td>
                        <td><?php echo ($row['SIDI']) ?></td>
                        <td><?php echo ($row['telefono']) ?></td>
                        <td>
                            <button id="edit" class="btn btn-primary me-1 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="onClick(<?php echo $row['CF'] ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>SIDI</th>
                    <th>Telefono</th>
                    <th>Opzioni</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class=" modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Modifica alunno</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cognome:</label>
                            <input type="text" id="cognome" name="cognome" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SIDI:</label>
                            <input type="text" id="SIDI" name="SIDI" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefono:</label>
                            <input type="text" id="telefono" name="telefono" class="form-control"></input>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="id" name="id">Invia</button>
                </div>
                </form>
            </div>
        </div>

        <script>
            function onClick(CF) {
                let endpoint = 'http://localhost/diarioProf/backend/API/alunno/getAlunnoByCF.php?CF=' + CF
                $.get(endpoint, function(data, status) {
                    $('#nome').val(data[0][
                        'nome'
                    ]);
                    $('#cognome').val(data[0][
                        'cognome'
                    ]);
                    $('#SIDI').val(data[0][
                        'SIDI'
                    ]);
                    $('#telefono').val(data[0][
                        'telefono'
                    ]);
                    $('#id').val(data[0][
                        'CF'
                    ]);
                })
            }

            $(document).ready(function() {
                // Setup - add a text input to each footer cell
                $('#example tfoot th').each(function() {
                    var title = $(this).text();
                    if (title != "Opzioni") {
                        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                    }
                });

                // DataTable
                var table = $('#example').DataTable({
                    initComplete: function() {
                        // Apply the search
                        this.api()
                            .columns()
                            .every(function() {
                                var that = this;

                                $('input', this.footer()).on('keyup change clear',
                                    function() {
                                        if (that.search() !== this.value) {
                                            that.search(this.value).draw();
                                        }
                                    });
                            });
                    },
                });
            });
        </script>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                "id" => $_POST["id"],
                "nome" => $_POST['nome'],
                "cognome" => $_POST['cognome'],
                "SIDI" => $_POST['SIDI'],
                "telefono" => $_POST['telefono'],
            );

            $res = updateAlunno($data);

            if ($res == 1) {
                echo '<script>window . location . replace(
            "http://localhost/DiarioProf/frontend/pages/archivioAlunni.php"
            );</script>';
            }
        }
        ?>

        <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>
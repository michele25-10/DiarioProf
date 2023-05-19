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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
                        <button id="edit" class="btn btn-primary me-1 mb-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" onclick="onClick(<?php echo $row['id'] ?>)">Edit</button>
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

    <div class=" modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="nome_corso"></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form">
                        <div class="mb-3">
                            <label class="form-label">Quadrimestre:</label>
                            <select class="form-select" aria-label="Default select example" id="quadrimestre"
                                name="quadrimestre" required>
                                <option selected disabled>Quadrimestre:</option>
                                <?php foreach ($list_quad as $row) : ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo ($row['data_inizio'] . " " . $row['data_fine']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Docente:</label>
                            <select class="form-select" aria-label="Default select example" id="docente" name="docente"
                                required>
                                <option selected disabled>Docente:</option>
                                <?php foreach ($list_doc as $row) : ?>
                                <option value="<?php echo $row['CF'] ?>">
                                    <?php echo ($row['nome'] . " " . $row['cognome']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3" id="inputTutor">
                            <label class="form-label">Tutor:</label>
                            <select class="form-select" aria-label="Default select example" id="tutor" name="tutor"
                                required>
                                <option selected disabled>Tutor:</option>
                                <?php foreach ($list_doc as $row) : ?>
                                <option value="<?php echo $row['CF'] ?>">
                                    <?php echo ($row['nome'] . " " . $row['cognome']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data di inizio:</label>
                            <input type="date" id="data_inizio" name="data_inizio" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data di fine:</label>
                            <input type="date" id="data_fine" name="data_fine" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Materia:</label>
                            <input type="text" id="materia" name="materia" class="form-control"
                                placeholder="Materia"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sede:</label>
                            <select class="form-select" aria-label="Default select example" id="sede" name="sede"
                                required>
                                <option selected disabled>Sede:</option>
                                <option value="ITIS Ferruccio Viola">ITIS Ferruccio Viola</option>
                                <option value="IPSIA">IPSIA</option>
                                <option value="Agrario">Agrario</option>
                                <option value="Geometri">Geometri</option>
                            </select>
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
        function getStudentByCF(id) {
            let endpoint = 'http://localhost/diarioProf/backend/API/alunno/getAlunnoByCF.php?id_corso=' + id
            $.get(endpoint, function(data, status) {

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

        <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>
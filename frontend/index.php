<?php error_reporting(0) ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Archivio Corsi</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<body>

    <?php require_once(__DIR__ . '/pages/navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/function/corsi.php';
    include_once dirname(__FILE__) . '/function/docente.php';
    include_once dirname(__FILE__) . '/function/quadrimestre.php';


    $list_corsi = getArchiveCorsi();
    $list_doc = getArchieveDocente();
    $list_quad = getArchiveQuadrimestre();
    ?>

    <div class="container mt-5">
        <h2 class="mb-4">I corsi attivi nella nostra scuola:</h2>
        <?php if ($list_corsi != -1) : ?>
            <div style="overflow: auto; overflow-y: hidden ">
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>Tipologia</th>
                            <th>Nome Corso</th>
                            <th>Sede</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                            <th>Docente</th>
                            <th>Tutor</th>
                            <th>Materia</th>
                            <th>View More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_corsi as $row) : ?>
                            <tr>
                                <td>
                                    <?php echo $row['tipologia'] ?>
                                </td>
                                <td>
                                    <?php echo $row['nome_corso'] ?>
                                </td>
                                <td>
                                    <?php echo $row['sede'] ?>
                                </td>
                                <td>
                                    <?php echo $row['data_inizio'] ?>
                                </td>
                                <td>
                                    <?php echo $row['data_fine'] ?>
                                </td>
                                <td>
                                    <?php echo $row['id_docente'] ?>
                                </td>
                                <td>
                                    <?php echo $row['id_tutor'] ?>
                                </td>
                                <td>
                                    <?php echo $row['materia'] ?>
                                </td>
                                <td>
                                    <button id="edit" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="onClick(<?php echo $row['id'] ?>)">Edit</button>
                                    <button id="delete" type="button" data-bs-toggle="modal" data-bs-target="#elimina<?php echo $row['id']; ?>" class="btn btn-danger me-3">
                                        <svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                        </svg>
                                    </button>
                                    <div class="modal fade" id="elimina<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Premendo questo tasto si eliminerà il corso.
                                                    Se accetta non si potrà tornare indietro.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger" onclick="eliminaCorso(<?php echo $row['id'] ?>)">Accetto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="pages/getInfo.php?id=<?php echo $row['id'] ?>&nome_corso=<?php echo $row['nome_corso'] ?>">
                                        <button class="btn btn-secondary me-3">
                                            <svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                            </svg>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Tipologia</th>
                            <th>Nome Corso</th>
                            <th>Sede</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                            <th>Insegnante</th>
                            <th>Tutor</th>
                            <th>Materia</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif ?>
    </div>



    <div class=" modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
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
                            <select class="form-select" aria-label="Default select example" id="quadrimestre" name="quadrimestre" required>
                                <option selected disabled>Quadrimestre:</option>
                                <?php foreach ($list_quad as $row) : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo ($row['data_inizio'] . " " . $row['data_fine']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Docente:</label>
                            <select class="form-select" aria-label="Default select example" id="docente" name="docente" required>
                                <option selected disabled>Docente:</option>
                                <?php foreach ($list_doc as $row) : ?>
                                    <option value="<?php echo $row['CF'] ?>">
                                        <?php echo ($row['nome'] . " " . $row['cognome']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3" id="inputTutor">
                            <label class="form-label">Tutor:</label>
                            <select class="form-select" aria-label="Default select example" id="tutor" name="tutor" required>
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
                            <input type="text" id="materia" name="materia" class="form-control" placeholder="Materia"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sede:</label>
                            <select class="form-select" aria-label="Default select example" id="sede" name="sede" required>
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
            function eliminaCorso(id) {
                let endpoint = 'https://dispersione.violamarchesini.it/API/corso/eliminaCorso.php?id_corso=' + id
                $.get(endpoint, function(data, status) {
                    window.location.replace(
                        "https://dispersione.violamarchesini.it/index.php");
                });
            }
        </script>

        <script>
            function onClick(id) {
                let endpoint = 'https://dispersione.violamarchesini.it/API/corso/getCorsoById.php?id_corso=' + id
                $.get(endpoint, function(data, status) {
                    //Viene inserito negli input del form i contenuti degli incontri con quell'ID
                    $('#nome_corso').text(data[0][
                        'nome_corso'
                    ]);
                    $('#quadrimestre option[value=' + data[0]['id_quadrimestre'] + ']').prop('selected', true);
                    $('#docente option[value=' + data[0]['id_docente'] + ']').prop('selected', true);

                    if (data[0]['tipologia'] == 'A' || data[0]['tipologia'] == 'B') {
                        $('#tutor').attr('disabled', true);
                        $('#inputTutor').hover(function() {
                            $('#tutor').css('background', 'red');
                            $('#tutor').css('color', 'white');
                        }, function() {
                            $('#tutor').css('background', '#BEBFC5');
                            $('#tutor').css('color', 'black');
                        });
                    }

                    $('#data_inizio').val(data[0][
                        'data_inizio'
                    ]);
                    $('#data_fine').val(data[0][
                        'data_fine'
                    ]);
                    $('#materia').val(data[0][
                        'materia'
                    ]);
                    $('#sede').val(data[0][
                        'sede'
                    ]);
                    $('#id').val(data[0][
                        'id'
                    ]);
                });
            };
        </script>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($_POST['docente'])) {
                $_POST['docente'] = "-1";
            }
            if (empty($_POST['tutor'])) {
                $_POST['tutor'] = "-1";
            }

            $data = array(
                "id" => $_POST["id"],
                "id_quadrimestre" => $_POST["quadrimestre"],
                "id_docente" => $_POST['docente'],
                "id_tutor" => $_POST['tutor'],
                "data_inizio" => $_POST['data_inizio'],
                "data_fine" => $_POST['data_fine'],
                "materia" => $_POST['materia'],
                "sede" => $_POST['sede'],
            );

            $res = updateCorso($data);

            if ($res == 1) {
                echo '<script>window . location . replace("https://dispersione.violamarchesini.it/index.php");</script>';
            }
        }
        ?>

        <script>
            $(document).ready(function() {
                $('#example').DataTable({});
            });
        </script>

        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
</body>

</html>
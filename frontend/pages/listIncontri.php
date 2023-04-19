<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Corsi per tipologia</title>
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>

    <?php
    session_start();
    include_once dirname(__FILE__) . '/../function/incontro.php';
    $list_incontri = getArchieveIncontri();
    ?>

    <div class="container mt-5">
        <?php if ($list_incontri != -1) : ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nome corso</th>
                    <th>Data Inizio</th>
                    <th>Note</th>
                    <th>View More</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_incontri as $row) : ?>
                <tr>
                    <td><?php echo $row['id_corso'] ?></td>
                    <td><?php echo $row['data_inizio'] ?></td>
                    <td><?php echo $row['note'] ?></td>
                    <td>
                        <button id="edit" class="btn btn-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" onclick="onClick(<?php echo $row['id'] ?>)">Edit</button>
                        <a href="#">
                            <button class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                </svg>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome corso</th>
                    <th>Data Inizio</th>
                    <th>Note</th>
                    <th>View More</th>
                </tr>
            </tfoot>
        </table>
        <?php endif ?>
    </div>

    <div class=" modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Data inizio:</label>
                            <input type="datetime-local" class="form-control" id="data_inizio" name="data_inizio">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
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
    $(document).ready(function() {
        $('#example').DataTable({});
    });

    function onClick(id) {
        let endpoint = 'http://localhost/diarioProf/backend/API/incontro/getIncontriById.php?id=' + id;
        $.get(endpoint, function(data, status) {
            //Viene inserito negli input del form i contenuti degli incontri con quell'ID
            $('#data_inizio').val(data[0][
                'data_inizio'
            ]);
            $('#note').val(data[0][
                'note'
            ]);
            $('#id').val(data[0][
                'id'
            ]);
        });
    };

    $("#form").validate({
        rules: {
            'data_inizio': {
                required: true,
            },
        },
        messages: {
            'data_inizio': {
                required: "Il campo è obbligatorio",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    </script>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array(
            "id" => $_POST["id"],
            "data_inizio" => $_POST['data_inizio'],
            "note" => $_POST['note'],
        );

        $res = updateIncontro($data);

        if ($res == 1) {
            session_destroy();
            header("location: http://localhost/DiarioProf/frontend/pages/listIncontri.php");
        } else {
            echo ('<p>Errore</p>');
        }
    }
    ?>

    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
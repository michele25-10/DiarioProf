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
    <?php require_once(__DIR__ . '/navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/../function/incontro.php';
    include_once dirname(__FILE__) . '/../function/presenze.php';
    include_once dirname(__FILE__) . '/../function/aula.php';

    $list_aule = getArchieveAule();
    $list_incontri = getArchieveIncontri();
    ?>

    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Lista di tutti gli incontri</h2>
        <?php if ($list_incontri != -1) : ?>
        <div style="overflow: auto; overflow-y: hidden">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome corso</th>
                        <th>Data Inizio</th>
                        <th>Note</th>
                        <th>Aula</th>
                        <th>View More</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_incontri as $row) : ?>
                    <tr>
                        <td><?php echo $row['id_corso'] ?></td>
                        <td><?php echo $row['data_inizio'] ?></td>
                        <td><?php echo $row['note'] ?></td>
                        <td><?php echo $row['aula'] ?> </td>
                        <td>
                            <button id="edit" class="btn btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" onclick="onClick(<?php echo $row['id'] ?>)">Edit</button>
                            <button class="btn btn-secondary me-3"
                                onclick="window.location.href='presenze.php?id_incontro=<?php echo $row['id'] ?>&nome_corso=<?php echo $row['id_corso'] ?>';">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
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
        </div>
        <?php endif ?>
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
                            <label for="recipient-name" class="col-form-label">Data inizio:</label>
                            <input type="datetime-local" class="form-control" id="data_inizio" name="data_inizio">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="note" name="note" maxlength="199"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Aula:</label>
                            <select class="form-select" aria-label="Default select example" id="aula" name="aula"
                                required>
                                <option selected disabled>Aula:</option>
                                <?php foreach ($list_aule as $row) : ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo ($row['nome'] . " --> " . $row['nomeBreve']) ?></option>
                                <?php endforeach ?>
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
    $(document).ready(function() {
        $('#example').DataTable({});
    });

    function onClick(id) {
        let endpoint = 'https://dispersione.violamarchesini.it/API/incontro/getIncontriById.php?id=' + id;
        $.get(endpoint, function(data, status) {
            console.log(data[0]);
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
            $('#nome_corso').text(data[0][
                'id_corso'
            ]);
            $('#aula option[value=' + data[0]['id_aula'] + ']').prop('selected', true);
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
            "id_aula" => $_POST['aula'],
        );
        $res = updateIncontro($data);

        if ($res == 1) {
            echo '<script>window . location . replace(
                " https://dispersione.violamarchesini.it/pages/listIncontri.php"
            );</script>';
        }
    }
    ?>

    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
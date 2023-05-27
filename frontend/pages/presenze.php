<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('location: ../index.php');
}

include_once dirname(__FILE__) . '/../function/presenze.php';
include_once dirname(__FILE__) . '/../function/alunno.php';

if (empty($_GET['id_incontro'])) {
    header('location: ../index.php');
}
if (empty($_GET['nome_corso'])) {
    header('location: ../index.php');
}
if (getStudentByCorsoName($_GET['nome_corso']) == -1) {
    header('location: ../index.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presenze corso</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>

    <?php if (checkRegistro($_GET['id_incontro']) == "false") : ?>
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
            <div style="overflow: auto; overflow-y: hidden">
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
                        <?php $i = 0 ?>
                        <?php foreach ($list_studenti as $row) : ?>
                        <tr>
                            <td><?php echo $row['nome'] . " " . $row['cognome'] ?></td>
                            <td>
                                <?php $i++; ?>
                                <select class="form-select" aria-label="Default select example"
                                    id="<?php echo "alunno" . $i; ?>" id=" <?php echo "alunno" . $i ?>"
                                    name="<?php echo "alunno" . $i ?>" required>
                                    <option id="presente" value="<?php echo $row['CF'] . " 0" ?>" selected>Presente
                                    </option>
                                    <option id="assente" value="<?php echo $row['CF'] . " 1" ?>">Assente</option>
                                </select>
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
            </div>
        </form>
    </div>

    <script>
    $("#alunno1")
        .change(function() {
            $("#alunno1 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno1').css('background', 'red');
                        $('#alunno1').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno1').css('background', 'green');
                        $('#alunno1').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno2")
        .change(function() {
            $("#alunno2 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno2').css('background', 'red');
                        $('#alunno2').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno2').css('background', 'green');
                        $('#alunno2').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno3")
        .change(function() {
            $("#alunno3 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno3').css('background', 'red');
                        $('#alunno3').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno3').css('background', 'green');
                        $('#alunno3').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno4")
        .change(function() {
            $("#alunno4 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno4').css('background', 'red');
                        $('#alunno4').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno4').css('background', 'green');
                        $('#alunno4').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno5")
        .change(function() {
            $("#alunno5 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno5').css('background', 'red');
                        $('#alunno5').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno5').css('background', 'green');
                        $('#alunno5').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno6")
        .change(function() {
            $("#alunno6 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno6').css('background', 'red');
                        $('#alunno6').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno6').css('background', 'green');
                        $('#alunno6').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno7")
        .change(function() {
            $("#alunno7 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno7').css('background', 'red');
                        $('#alunno7').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno7').css('background', 'green');
                        $('#alunno7').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno8")
        .change(function() {
            $("#alunno8 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno8').css('background', 'red');
                        $('#alunno8').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno8').css('background', 'green');
                        $('#alunno8').css('color', 'white');
                        break;
                }
            })
        });
    $("#alunno9")
        .change(function() {
            $("#alunno9 option:selected").each(function() {
                var str = $(this).text();
                switch (str) {
                    case "Assente":
                        $('#alunno9').css('background', 'red');
                        $('#alunno9').css('color', 'white');
                        break;
                    case "Presente":
                        $('#alunno9').css('background', 'green');
                        $('#alunno9').css('color', 'white');
                        break;
                }
            })
        });
    </script>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array();
            $indice = 0;
            for ($j = 0; $j < $i; $j++) {
                $indice++;
                $value = explode(" ", $_POST["alunno" . $indice]);
                $array = array(
                    "id_incontro" => $id_incontro,
                    "status" => $value[1],
                    "id_alunno" => $value[0],
                );
                array_push($data, $array);
            }

            $res = addPresenze($data);
            if ($res == true) {
                echo '<script>window . location . replace(
                " http://localhost/DiarioProf/frontend/pages/homepage.php"
            );</script>';
            }
        }
        ?>
    <?php endif ?>


    <?php if (checkRegistro($_GET['id_incontro']) == "true") : ?>
    <?php
        $list = getPresenzeByIncontro($_GET['id_incontro']);
        ?>
    <div class="container mt-5">
        <?php echo ('<br>
    <h2>Registro di ' . ($_GET['nome_corso']) . '</h2>');
            ?>
        <div class="container mt-5 mb-5">
            <?php if ($list != -1) : ?>
            <div style="overflow: auto; overflow-y: hidden">
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
                                <button id="edit" class="btn btn-primary me-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    onclick="<?php
                                                                                                                                                            if ($row['status'] == 'Assente') {
                                                                                                                                                                $status = 1;
                                                                                                                                                            }
                                                                                                                                                            if ($row['status'] == 'Presente') {
                                                                                                                                                                $status = 0;
                                                                                                                                                            }
                                                                                                                                                            echo ("onClick(" . $row['id'] . ", " . $status . ")") ?>">Edit</button>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <?php endif ?>
        </div>

        <div class=" modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
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
                                <select class="form-select" id="alunno" name="alunno" required>
                                    <option id="editpresente">Presente</option>
                                    <option id="editassente">Assente</option>
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
        function onClick(id, check) {
            let endpoint = 'http://localhost/diarioProf/backend/API/presenze/getPresenzeById.php?id=' + id;
            $.get(endpoint, function(data, status) {
                console.log(check);
                $('#alunno').text(data['nome'] + " " + data['cognome']);
                if (check == 0) {
                    $('#editpresente').val(id + " 0 " + data['CF'] + " " + data['id_incontro']).attr('disabled',
                        true);
                    $('#editassente').val(id + " 1 " + data['CF'] + " " + data['id_incontro']);
                }
                if (check == 1) {
                    $('#editpresente').val(id + " 0 " + data['CF'] + " " + data['id_incontro']);
                    $('#editassente').val(id + " 1 " + data['CF'] + " " + data['id_incontro']).attr('disabled',
                        true);
                }
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
                        $url = "http://localhost/DiarioProf/frontend/pages/Presenze.php?id_incontro=" . $_GET['id_incontro'] . "&nome_corso=" . $_GET['nome_corso'];
                        echo '<script>
                    window . location . replace(
                        "' . $url . '"
                    );</script>';
                    }
                }
            }

            ?>
        <?php endif ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
</body>
<style>
#alunno1 {
    background-color: green;
    color: white;
}

#alunno2 {
    background-color: green;
    color: white;
}

#alunno3 {
    background-color: green;
    color: white;
}

#alunno4 {
    background-color: green;
    color: white;
}

#alunno5 {
    background-color: green;
    color: white;
}

#alunno6 {
    background-color: green;
    color: white;
}

#alunno7 {
    background-color: green;
    color: white;
}

#alunno8 {
    background-color: green;
    color: white;
}

#alunno9 {
    background-color: green;
    color: white;
}

option {
    background-color: white;
    color: black;
}
</style>

</html>
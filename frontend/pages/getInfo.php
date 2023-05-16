<?php
if (empty($_GET['id'])) {
    header('location: ../index.php');
}
if (empty($_GET['nome_corso'])) {
    header('location: ../index.php');
}
error_reporting(0);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informazione Corso</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '/navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/../function/incontro.php';
    include_once dirname(__FILE__) . '/../function/corsi.php';
    include_once dirname(__FILE__) . '/../function/aula.php';

    $list_aule = getArchieveAule();
    $id = $_GET['id'];
    $list_corsi = getInfoCorsoDate($id);
    $list_studenti = getInfoCorsoStudent($id);
    ?>

    <div class="container mt-3">
        <?php echo ('<br>
    <h2>Informazioni di ' . ($_GET['nome_corso']) . '</h2>');
        ?>
        <?php if ($list_corsi != -1) : ?>
            <div style="overflow: auto; overflow-y: hidden ">
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Note</th>
                            <th>Aula</th>
                            <th>View More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_corsi as $row) : ?>
                            <tr>
                                <td><?php echo $row['data_inizio'] ?></td>
                                <td><?php echo $row['note'] ?></td>
                                <td><?php echo $row['aula'] ?></td>
                                <td>
                                    <button id="edit" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="onClick(<?php echo $row['id_incontro'] ?>)">Edit</button>
                                    <button class="btn btn-secondary me-3" onclick="window.location.href='presenze.php?id_incontro=<?php echo $row['id_incontro'] ?>&nome_corso=<?php echo $_GET['nome_corso'] ?>';" <?php if ($list_studenti == -1) {
                                                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                                                        } ?>>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z" />
                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </div>

    <div class="container mt-5 mb-5">
        <?php if ($list_studenti == -1) : ?>
            <?php
            include_once dirname(__FILE__) . '/../function/alunno.php';

            $list_al = getArchieveAlunni();
            ?>
            <form method="post" action="../function/postAlunni.php">
                <fieldset>
                    <h2>Iscritti:</h2>
                    <div class="row mt-1 mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alunno:</label>
                            <select class="form-select" aria-label="Default select example" name="alunno1" required>
                                <option selected disabled>Alunni:</option>
                                <?php foreach ($list_al as $row) :
                                ?>
                                    <option value="<?php echo $row['CF']
                                                    ?>">
                                        <?php echo ($row['nome'] . " " . $row['cognome'])
                                        ?></option>
                                <?php endforeach
                                ?>
                            </select>
                        </div>
                        <div id="alunni-typeB">

                        </div>
                        <div id="alunni-typeC">

                        </div>
                    </div>
                    <input type="button" data-bs-toggle="modal" data-bs-target="#inviaCorso" class="btn btn-primary mb-5" value="Invia" />
                    <div class="modal fade" id="inviaCorso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Premendo questo tasto si inseriranno gli alunni all'interno del database.
                                    Una volta inseriti non sarà possibile modificarli.
                                    Inserite gli alunni quando avrete la certezza che tutti quanti possano partecipare.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-danger" value="<?php echo $_GET['id'] . " " . $_GET['nome_corso'] ?>">Accetto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <script type="text/javascript">
                //Se la tipologia del corso è la C allora faccio apparire il select del tutor altrimenti lo rimuovo
                var stringa = '<?php echo $_GET['nome_corso']; ?>';
                var split = stringa.split('_');
                var tipologia = split[1];
                console.log(tipologia);
                switch (tipologia) {
                    case "A":
                        $("#form-alunni-typeB").remove();
                        $("#form-alunni-typeC").remove();
                        break;

                    case "B":
                        $('#alunni-typeB').html(
                            '<div id="form-alunni-typeB"><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno2" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno3" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno4" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno5" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno6" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div></div>'
                        );
                        $("#form-alunni-typeC").remove();
                        break;

                    case "C":
                        $("#form-alunni-typeB").remove();
                        $('#alunni-typeC').html(
                            '<div id="form-alunni-typeC"><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno2" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno3" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno4" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno5" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno6" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno7" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno8" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div><div class="col-md-6 mb-3"><label class="form-label">Alunno:</label><select class="form-select" aria-label="Default select example" name="alunno9" required><option selected disabled>Alunni:</option><?php foreach ($list_al as $row) : ?><option value="<?php echo $row['CF'] ?>"><?php echo ($row['nome'] . " " . $row['cognome']) ?></option><?php endforeach ?></select></div></div>'
                        );
                        break;
                };
            </script>
        <?php elseif ($list_studenti != -1) : ?>
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
    </div>

    <div class="container mb-5">
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container mb-5">
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#terminaCorso">Termina corso</button>
    </div>
    <div class="modal fade" id="terminaCorso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Premendo questo tasto si farà concludere il corso.
                    Se accetta non si potrà tornare indietro.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="terminaCorso(<?php echo $id ?>)">Accetto</button>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<script>
    const ctx = document.getElementById('myChart');

    let endpoint = 'https://dispersione.violamarchesini.it/API/iscrizione/getNumeroPresenze.php?id_corso=' +
        <?php echo $_GET['id']; ?>;
    $.get(endpoint, function(data, status) {
        const stringa_x = new Array();
        const stringa_y = new Array();
        const color = new Array();
        const border_color = new Array();
        var i = 0;
        var stringa_corso = <?php echo "'" . $_GET['nome_corso'] . "'"; ?>;
        var stringa_scomposta = stringa_corso.split('_');
        var tipologia = stringa_scomposta[1];

        data.forEach(Element => {
            stringa_x[i] = data[i]['nome'] + " " + data[i]['cognome']
            stringa_y[i] = data[i]['numero_presenze'];
            if (tipologia == 'A') {
                if (stringa_y[i] < 5) {
                    color[i] = "rgba(230, 0, 38, 0.5)";
                    border_color[i] = "rgb(230, 0, 38)";
                } else {
                    color[i] = "rgba(3, 192, 60, 0.6)";
                    border_color[i] = "rgb(3, 192, 60)";
                }
            } else {
                if (stringa_y[i] < 4) {
                    color[i] = "rgba(230, 0, 38, 0.5)";
                    border_color[i] = "rgb(230, 0, 38)";
                } else {
                    color[i] = "rgba(3, 192, 60, 0.6)";
                    border_color[i] = "rgb(3, 192, 60)";
                }
            }
            i++;
        });
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: stringa_x.map(row => row),
                datasets: [{
                    label: '#Numero di presenze',
                    data: stringa_y.map(row => row),
                    backgroundColor: color.map(row => row),
                    borderWidth: border_color.map(row => row),
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    });
</script>

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
                        <label for="recipient-name" class="col-form-label">Data inizio:</label>
                        <input type="datetime-local" class="form-control" id="data_inizio" name="data_inizio">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Note:</label>
                        <textarea class="form-control" id="note" name="note" maxlength="199"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Aula:</label>
                        <select class="form-select" aria-label="Default select example" id="aula" name="aula" required>
                            <option selected disabled>Aula:</option>
                            <?php foreach ($list_aule as $row) : ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo ($row['nome'] . " --> " . $row['nomeBreve']) ?></option>
                            <?php endforeach ?>
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
        function terminaCorso(id) {
            let endpoint = 'https://dispersione.violamarchesini.it/API/corso/terminaCorso.php?id_corso=' + id
            $.get(endpoint, function(data, status) {
                window.location.replace(
                    "https://dispersione.violamarchesini.it/");
            });
        }

        function onClick(id) {
            let endpoint = 'https://dispersione.violamarchesini.it/API/incontro/getIncontriById.php?id=' + id
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
                "https://dispersione.violamarchesini.it/pages/getInfo.php?id=' . $_GET["id"] . '&nome_corso=' . $_GET["nome_corso"] . '"
    );</script>';
        }
    }
    ?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
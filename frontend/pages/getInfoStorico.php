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
    <title>Registro Storico</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script>
        function stampa_id(ele_id) {
            var nw = window.open();
            nw.document.write(document.getElementById(ele_id).innerHTML);
            nw.print();
            nw.close();
        }
    </script>

</head>

<body>
    <?php
    include_once dirname(__FILE__) . '/../function/incontro.php';
    include_once dirname(__FILE__) . '/../function/corsi.php';
    include_once dirname(__FILE__) . '\..\function\aula.php';

    $id = $_GET['id'];
    $list_corsi = getInfoCorsoDate($id);
    $list_studenti = getStudentPresenze($id);
    ?>
    <div id="da_stampare">
        <?php require_once(__DIR__ . '\navbar.php'); ?>

        <div class="container mt-3">
            <?php echo ('<br><h2>Informazioni di ' . ($_GET['nome_corso']) . '</h2>');
            ?>
            <?php if ($list_corsi != -1) : ?>
                <table id="example" class="table table-responsive" style="width:100%">
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
                                <td> <button class="btn btn-secondary me-3" onclick="window.location.href='getRegistroStorico.php?id_incontro=<?php echo $row['id_incontro'] ?>&nome_corso=<?php echo $_GET['nome_corso'] ?>';">
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
            <?php endif ?>
        </div>

        <div class="container mt-5 mb-5">
            <?php if ($list_studenti != -1) : ?>
                <table id="example2" class="table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>CF</th>
                            <th>Numero presenze</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_studenti as $row) : ?>
                            <tr>
                                <td><?php echo $row['nome'] ?></td>
                                <td><?php echo $row['cognome'] ?></td>
                                <td><?php echo $row['CF'] ?></td>
                                <td><?php echo $row['numero_presenze'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
    <div class="container mb-5">
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        let endpoint = 'http://localhost/diarioProf/backend/API/iscrizione/getNumeroPresenze.php?id_corso=' +
            <?php echo $_GET['id']; ?>;
        $.get(endpoint, function(data, status) {
            const stringa_x = new Array();
            const stringa_y = new Array();
            const color = new Array();
            const border_color = new Array();
            var i = 0;

            console.log(data);

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
                        console.log("aaaaaaaaaaaa");
                        color[i] = "rgba(230, 0, 38, 0.5)";
                        border_color[i] = "rgb(230, 0, 38)";
                    } else {
                        color[i] = "rgba(3, 192, 60, 0.6)";
                        border_color[i] = "rgb(3, 192, 60)";
                    }
                }
                i++;
            });
            console.log(stringa_x);
            console.log(stringa_y);
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

    <div class="container">
        <button class="btn btn-secondary mb-5" onclick="stampa_id('da_stampare');">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
            </svg>
        </button>
    </div>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
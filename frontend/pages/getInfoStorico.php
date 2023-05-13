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
    <title>Informazione Corso</title>
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
                <table id="example" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Note</th>
                            <th>Aula</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_corsi as $row) : ?>
                            <tr>
                                <td><?php echo $row['data_inizio'] ?></td>
                                <td><?php echo $row['note'] ?></td>
                                <td><?php echo $row['aula'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>

        <div class="container mt-5 mb-5">
            <?php if ($list_studenti != -1) : ?>
                <table id="example2" class="table table-hover" style="width:100%">
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
            Stampa la pagina
        </button>
    </div>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
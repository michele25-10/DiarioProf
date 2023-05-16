<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conta Studenti</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require_once(__DIR__ . '/navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/../function/incontro.php';
    $list_incontri = countIncontro();
    ?>

    <div class="container mt-5">
        <?php echo ('<br>
    <h2>Studenti che partecipano ai corsi dei prossimi 15 giorni:</h2>
    <br>');
        ?>
        <?php if ($list_incontri != -1): ?>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Numero Studenti</th>
                        <th> Info </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_incontri as $row): ?>
                        <tr>
                            <td>
                                <?php echo $row['data'] ?>
                            </td>
                            <td>
                                <?php echo $row['partecipanti'] ?>
                            </td>
                            <td>
                            <a href="getInfoStudenti.php?data=<?php echo $row['data'] ?>&nome_corso=<?php echo $row['nome_corso']?>">
                                    <button class="btn btn-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
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
                        <th>Data</th>
                        <th>Studenti</th>
                        <th>Info</th>
                    </tr>
                </tfoot>
            </table>
        <?php endif ?>
        <?php if ($list_incontri == -1): ?>
            <h2 class="text-danger">Non ci sono incontri per i prossimi 15 giorni!</h2>
        <?php endif ?>
    </div>

        <script>
            function filterGlobal() {
                $('#example')
                    .DataTable()
                    .search($('#global_filter').val(), $('#global_regex').prop('checked'), $('#global_smart').prop('checked'))
                    .draw();
            }

            function filterColumn(i) {
                $('#example')
                    .DataTable()
                    .column(i)
                    .search(
                        $('#col' + i + '_filter').val(),
                        $('#col' + i + '_regex').prop('checked'),
                        $('#col' + i + '_smart').prop('checked')
                    )
                    .draw();
            }

            $(document).ready(function () {
                $('#example').DataTable();

                $('input.global_filter').on('keyup click', function () {
                    filterGlobal();
                });

                $('input.column_filter').on('keyup click', function () {
                    filterColumn($(this).parents('tr').attr('data-column'));
                });
            });
        </script>

        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
            </script>
</body>

</html>
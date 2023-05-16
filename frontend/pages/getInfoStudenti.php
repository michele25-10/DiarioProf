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
    ?>

    <div class="container mt-5"
        ?>
        <?php
         $date = $_GET['data'];
         $newDate = str_replace(" ", "%20", $date);
         $list_partecipanti = getStudentsIncontro($newDate);
        $nome = $_GET['nome_corso'];
         echo ('<br>
        <h2>Studenti che partecipano al corso '. $nome.' in data '.$date.':</h2>
        <br>');
        if ($list_partecipanti != -1): ?>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_partecipanti as $row): ?>
                        <tr>
                            <td>
                                <?php echo $row['nome'] ?>
                            </td>
                            <td>
                                <?php echo $row['cognome'] ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                    </tr>
                </tfoot>
            </table>
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
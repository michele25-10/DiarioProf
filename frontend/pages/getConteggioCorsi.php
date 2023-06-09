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
    <title>Diario | ConteggioCorsi</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php');
    include_once dirname(__FILE__) . '\..\function\corsi.php';
    $A = countCorsoByType("A");
    $B = countCorsoByType("B");
    $C = countCorsoByType("C");
    ?>


    <div class="container mt-5">
        <h2>Conteggio dei corsi:</h2>
        <table id="example" class="table mt-4" style="width:100%">
            <thead>
                <tr>
                    <th>Tipologia</th>
                    <th>Numero</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> A</td>
                    <td> <?php echo "<b>" . $A . "</b>"; ?>/120
                    </td>
                </tr>
                <tr>
                    <td>B</td>
                    <td> <?php echo "<b>" . $B . "</b>"; ?>/43
                    </td>
                </tr>
                <tr>
                    <td>C</td>
                    <td> <?php echo "<b>" . $C . "</b>"; ?>/16
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
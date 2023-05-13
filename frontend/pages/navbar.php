<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">
</head>
<nav class="navbar navbar-expand-lg" style='background-color: #D4020D'>
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="http://localhost/DiarioProf/frontend/">Calendario Corsi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold text-white-50" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Visualizza corsi
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/getCorsiByTipologia.php?type=A">Visualizza corsi A</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/getCorsiByTipologia.php?type=B">Visualizza corsi B</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/getCorsiByTipologia.php?type=C">Visualizza corsi C</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold text-white-50" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Aggiungi
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/addDocente.php">Aggiungi docente</a></li>
          <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/creaCorso.php">Aggiungi Corso</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold text-white-50" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Visualizza incontri 
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/getIncontriToday.php">Incontri di oggi</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/getIncontriTomorrow.php">Incontri di domani</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/getIncontriNext15Days.php">Incontri dei prossimi 15 giorni</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/listIncontri.php">Visualizza tutti gli incontri</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="http://localhost/DiarioProf/frontend/pages/countIncontro.php">Visualizza i partecipanti dei corsi dei prossimi 15 giorni</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
        
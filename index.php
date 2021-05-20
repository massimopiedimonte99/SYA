<?php include 'header.php' ?>

<!-- CARICA OPERA -->
<?php
  if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo '<div class="jumbotron">
            <h1 class="display-4">Bentornato '.$username.'</h1>
            <p class="lead">Hai qualcosa da condividere con la community di SYA? Comincia subito a caricare i tuoi lavori!</p>
            <hr class="my-4">
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="carica_opera.php" role="button">Carica una foto o un disegno</a>
            </p>
          </div>';
  }
?>

<!-- LAVORI PIÙ RECENTI -->
<section class="sya-cards">
  <h3 class="sya-cards-title">Lavori più recenti</h3>
  <?php
    include 'connessione_db.php';

    $query = "SELECT o.Filepath, o.Titolo, o.Licenza, u.Username FROM opera AS o INNER JOIN utenti AS u ON o.Autore=u.ID";
    $rows = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($rows)) {
      echo '<div class="sya-cards-card card">
              <div class="sya-cards-card-wrapper">
                <a href="'.$row['Filepath'].'" target="_blank">
                  <img class="card-img-top" src="'.$row['Filepath'].'">
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title">'.$row['Titolo'].'</h5>
                <p class="card-text">Pubblicato da <a href="utente.php?username='.$row['Username'].'">@'.$row['Username'].'</a></p>
                <p class="card-text">Licenza: '.$row['Licenza'].'</p>
              </div>
            </div>';
    }
  ?>
</section>

<?php include 'footer.php' ?>
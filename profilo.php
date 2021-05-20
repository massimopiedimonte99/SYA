<?php include 'header.php' ?>

<section class="sya-cards">
  <?php
    // se siamo loggati
    if(isset($_SESSION['username'])) {
      include 'connessione_db.php';
      
      $username = mysqli_real_escape_string($conn, $_SESSION['username']);
      $query = "SELECT o.Filepath, o.Titolo, o.Licenza, u.Username FROM opera AS o INNER JOIN utenti AS u ON o.Autore=u.ID WHERE u.Username='$username'";
      $rows = mysqli_query($conn, $query);
      if(mysqli_num_rows($rows) == 0) {
        echo "Non hai ancora lavori pubblicati, <a href='carica_opera.php'>pubblicane subito uno!</a>";
      }
      else {
        echo '<h3 class="sya-cards-title">I tuoi lavori</h3>';
        while($row = mysqli_fetch_assoc($rows)) {
          echo '<div class="sya-cards-card card">
                  <div class="sya-cards-card-wrapper">
                    <a href="'.$row['Filepath'].'" target="_blank">
                      <img class="card-img-top" src="'.$row['Filepath'].'">
                    </a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">'.$row['Titolo'].'</h5>
                    <p class="card-text">Licenza: '.$row['Licenza'].'</p>
                  </div>
                </div>';
        }
      }
    } else header("Location: index.php")
  ?>
</section>

<?php include 'footer.php' ?>
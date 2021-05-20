<?php include 'header.php' ?>

<?php
  // se siamo loggati
  if(isset($_SESSION['username'])) {
    include 'connessione_db.php';
    $username = $_SESSION['username'];

    if(isset($_POST['invia-opera'])) {
      $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
      $opera = isset($_POST['opera']) ? mysqli_real_escape_string($conn, $_POST['opera']) : "";
      $licenza = isset($_POST['licenza']) ? mysqli_real_escape_string($conn, $_POST['licenza']) : "";
      
      
      //controlla se ci sono campi vuoti
      if($titolo != "" && $opera != "" && $licenza != "") {
        //gestione del file
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileErr = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
  
        //controllo estensioni
        $tmp_ext = explode('.', $fileName);
        $extension = strtolower(end($tmp_ext));
        $allowed_extensions = array("jpg", "jpeg", "png");
  
        if(in_array($extension, $allowed_extensions) && !$fileErr) {
          $fn = uniqid('', true).".".$extension; 
          $fileDest = "uploads/$fn";
          move_uploaded_file($fileTmpName, $fileDest);
          
          // ottenere l'ID dell'autore
          $query = "SELECT ID from utenti WHERE Username='$username'";
          $rows = mysqli_query($conn, $query);
          $id = mysqli_fetch_assoc($rows)['ID'];
  
          // caricamento nel db
          $query = "INSERT INTO opera(Titolo, DataPubblicazione, Autore, Tipo, Licenza, Filepath) 
                    VALUES('$titolo', now(), '$id', '$opera', '$licenza', '$fileDest')";
          $rows = mysqli_query($conn, $query);
          echo mysqli_error($conn);
          header("Location: index.php");
        } else header("Location: carica_opera.php?err=true");
      } else header("Location: carica_opera.php?err=true");
    }
  }
  
?>

<section class="sya-cards">
  <form action="carica_opera.php" method="POST" enctype="multipart/form-data">
    <?php
      if(isset($_GET['err'])) {
        $err = mysqli_real_escape_string($conn, $_GET['err']);
        if($err == "true") echo "<p class='error'>Non siamo riusciti a caricare il tuo file<br>Assicurati di caricare un immagine in formato .jpg, .jpeg o .png</p>";
      }
    ?>
    <div class="form-group">
      <label for="titolo">*Titolo</label>
      <input type="text" class="form-control" name="titolo" id="titolo" placeholder="Inserisci il titolo del tuo lavoro">
    </div>
    <div class="form-group">
      <label>*Specifica se si tratta di una foto o di un disegno</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="opera" id="Foto" value="Foto" checked>
        <label class="form-check-label" for="Foto">
          Foto
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="opera" id="Disegno" value="Disegno">
        <label class="form-check-label" for="Disegno">
        Disegno
        </label>
      </div>
    </div>
    <div class="form-group">
      <label>*Specificare il tipo di licenza</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="licenza" id="CC0" value="CC0" checked>
        <label class="form-check-label" for="CC0"> CC0 </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="licenza" id="CC BY-NC-ND" value="CC BY-NC-ND">
        <label class="form-check-label" for="CC BY-NC-ND"> CC BY-NC-ND </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="licenza" id="CC BY-NC-SA" value="CC BY-NC-SA">
        <label class="form-check-label" for="CC BY-NC-SA"> CC BY-NC-SA </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="licenza" id="CC BY-SA" value="CC BY-SA">
        <label class="form-check-label" for="CC BY-SA"> CC BY-SA </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="licenza" id="CC BY-ND" value="CC BY-ND">
        <label class="form-check-label" for="CC BY-ND"> CC BY-ND </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="licenza" id="CC BY-NC" value="CC BY-NC">
        <label class="form-check-label" for="CC BY-NC"> CC BY-NC </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="licenza" id="CC BY" value="CC BY">
        <label class="form-check-label" for="CC BY"> CC BY </label>
      </div>
    </div>
    <div class="form-group">
      <label for="file">Carica qui il tuo file</label>
      <input type="file" class="form-control" name="file" id="file">
    </div>
    <button type="submit" name="invia-opera" class="btn btn-primary">Invia</button>
  </form>
</section>

<?php include 'footer.php' ?>
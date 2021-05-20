<?php include 'header.php' ?>

<?php
  include 'connessione_db.php';

  if(isset($_POST['invia-registrazione'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if($nome != "" && $cognome != "" && $username != "" && $password != "") {
      if((strlen($password) >= 8 && strlen($password) < 50) && strlen($username) < 20) {
        // controllo se username non esiste già
        $query = "SELECT Username FROM utenti WHERE Username='$username'";
        $rows = mysqli_query($conn, $query);
        if(mysqli_num_rows($rows) == 0) {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          mysqli_query($conn, "INSERT INTO utenti(Nome, Cognome, Username, Pass) VALUES('$nome', '$cognome', '$username', '$hashed_password')");
          $_SESSION['username'] = $username;
          header("Location: index.php");
        } else header("Location: registrazione.php?err=true");
      } else header("Location: registrazione.php?err=true");
    } else header("Location: registrazione.php?err=true");
  }
?>

<section class="sya-cards">
  <form action="registrazione.php" method="POST">
    <?php
      if(isset($_GET['err'])) {
        $err = mysqli_real_escape_string($conn, $_GET['err']);
        if($err == "true") echo "<p class='error'>Qualcosa è andato storto!</p>";
      }
    ?>
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" placeholder="Inserisci nome">
    </div>
    <div class="form-group">
      <label for="cognome">Cognome</label>
      <input type="text" class="form-control" name="cognome" id="cognome" placeholder="Inserisci cognome">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" id="username" placeholder="Inserisci un nome utente (eg. mariorossi99)">
      <small id="passwordHelp" class="form-text text-muted">Lo username non può superare i 20 caratteri.</small>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp"  placeholder="Inserisci password">
      <small id="passwordHelp" class="form-text text-muted">La lunghezza della password dev'essere compresa tra 8 caratteri e 50 caratteri.</small>
    </div>
    <button type="submit" name="invia-registrazione" class="btn btn-primary">Invia</button>
  </form>
</section>

<?php include 'footer.php' ?>
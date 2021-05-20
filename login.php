<?php include 'header.php' ?>

<?php
  include 'connessione_db.php';

  if(isset($_POST['invia-login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    if($username != "" && $password != "") {
      $query = "SELECT Username, Pass FROM utenti WHERE Username='$username'";
      $rows = mysqli_query($conn, $query);
      if(mysqli_num_rows($rows) == 1) {
        $row = mysqli_fetch_assoc($rows);
        if(password_verify($password, $row['Pass'])) {
          $_SESSION['username'] = $username;
          header("Location: index.php");
        } else header("Location: login.php?err=true");
      } else header("Location: login.php?err=true");
    } else header("Location: login.php?err=true");
  }
?>

<section class="sya-cards">
  <form action="login.php" method="POST">
    <?php
      if(isset($_GET['err'])) {
        $err = mysqli_real_escape_string($conn, $_GET['err']);
        if($err == "true") echo "<p class='error'>Credenziali errate!</p>";
      }
    ?>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" id="username" placeholder="Inserisci il tuo nome utente">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp"  placeholder="Inserisci la tua password">
    </div>
    <button type="submit" name="invia-login" class="btn btn-primary">Invia</button>
  </form>
</section>

<?php include 'footer.php' ?>
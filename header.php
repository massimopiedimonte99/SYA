<!--  
  autore: Massimo Piedimonte
  data: 03/05/2021
-->

<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>SYA - Share Your Art</title>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="sya-navbar navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
      <img src="assets/logo.png" alt="Share Your Art" class="logo"> 
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto"></ul>
      <form class="form-inline my-2 my-lg-0">
      <?php
        if(!isset($_SESSION['username']))
          echo '<a class="btn btn-primary mr-sm-2" href="login.php">Login</a>
                <a class="btn btn-success my-2 my-sm-0" href="registrazione.php">Registrati</a>';
        else
          echo '<a class="btn btn-primary mr-sm-2" href="profilo.php">Profilo</a>
                <a class="btn btn-success my-2 my-sm-0" href="logout.php">Esci</a>';
      ?>
        
      </form>
    </div>
  </nav>
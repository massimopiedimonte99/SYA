<?php

$host = "";
$username = "";
$password = "";
$db_name = "sya";

$conn = mysqli_connect($host, $username, $password, $db_name);
if(!$conn) die("Non siamo riusciti a connetterci al database.\nRiprova tra 5 minuti.");
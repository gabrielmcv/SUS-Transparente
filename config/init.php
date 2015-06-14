
<?php

$server = "localhost";
$username="root";
$password="password";
$database="sisreg_trans";

// Opens a connection to a MySQL server
$connection = new mysqli ($server, $username, $password, $database);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

?>
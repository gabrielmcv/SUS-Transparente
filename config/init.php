<?php

$server = "192.168.0.7";
$username="sisreg_trans";
$password="EP4JXDEfLZKc3RKh";
$database="sisreg_trans";

// Opens a connection to a MySQL server
$connection = new mysqli ($server, $username, $password, $database);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

?>
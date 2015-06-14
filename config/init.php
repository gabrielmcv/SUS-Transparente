
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

<?php

# FileName="Connection_php_mysql.htm"

# Type="MYSQL"

# HTTP="true"

$hostname_conexao = "localhost";

$database_conexao = "sisreg_trans";

$username_conexao = "root";

$password_conexao = "password";

$conexao = mysql_pconnect($hostname_conexao, $username_conexao, $password_conexao) or trigger_error(mysql_error(),E_USER_ERROR); 

?>

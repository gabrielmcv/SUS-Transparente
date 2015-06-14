<?php

require_once("config/init.php");

//  Configurações do Script
// ==============================
$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?

$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.

$_SG['servidor'] = $server;    // Servidor MySQL
$_SG['usuario'] = $username;          // Usuário MySQL
$_SG['senha'] = $password;                // Senha MySQL
$_SG['banco'] = $database;            // Banco de dados MySQL

$_SG['paginaLogin'] = 'index.php'; // Página de login

$_SG['tabela'] = 'fila_procedimentos';       // Nome da tabela onde os usuários são salvos
// ==============================

// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================

// Verifica se precisa fazer a conexão com o MySQL
if ($_SG['conectaServidor'] == true) {
  $_SG['link'] = new mysqli($_SG['servidor'], $_SG['usuario'], $_SG['senha'], $_SG['banco']) or die("Não foi possível conectar-se ao servidor.");
}

// Verifica se precisa iniciar a sessão
if ($_SG['abreSessao'] == true){
	session_start();
		if(isset($_GET["logout"])){
		session_destroy();
		session_unset();
		expulsaVisitante();	
		}
}
/**
* Função que valida um usuário e senha
*
* @param string $usuario - O usuário a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuário foi validado ou não (true/false)
*/
function validaUsuario($usuario, $senha) {
  global $_SG;

  // Usa a função addslashes para escapar as aspas
  $nusuario = strtoupper(addslashes($usuario));
  $nsenha = addslashes($senha);
  
  // Monta uma consulta SQL (query) para procurar um usuário
  $sql = "SELECT `id`, `nome`, `tipo`  FROM `".$_SG['tabela']."` WHERE ".$cS." `id_sisreg` = '".$nusuario."' AND `user_pass` = '".$nsenha."' LIMIT 1";

  $query = $_SG['link']->query($sql);
  $resultado = mysqli_fetch_assoc($query);

  // Verifica se encontrou algum registro
  if (empty($resultado)) {
    // Nenhum registro foi encontrado => o usuário é inválido
	$_SG['paginaLogin'] .= '?error=1'; // Exibe erro de login
    return false;
  } else {
    // Definimos dois valores na sessão com os dados do usuário
    $_SESSION['id'] = $resultado['user_id']; // Pega o valor da coluna 'id do registro encontrado no MySQL
    $_SESSION['user_nick'] = $resultado['nome']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
	$_SESSION['logged_in'] = true;	

    // Verifica a opção se sempre validar o login
    if ($_SG['validaSempre'] == true) {
      // Definimos dois valores na sessão com os dados do login
      $_SESSION['usuarioLogin'] = $usuario;
      $_SESSION['usuarioSenha'] = $senha;
	  $_SESSION['logged_in'] = true;
    }

	$_SG['link']->close();
    return true;
  }
}

/**
* Função que protege uma página
*/
function protegePagina() {
  global $_SG;

  if (!isset($_SESSION['id']) OR !isset($_SESSION['user_nick'])) {
    // Não há usuário logado, manda pra página de login
    expulsaVisitante();
  } else if (!isset($_SESSION['id']) OR !isset($_SESSION['user_nick'])) {
    // Há usuário logado, verifica se precisa validar o login novamente
    if ($_SG['validaSempre'] == true) {
      // Verifica se os dados salvos na sessão batem com os dados do banco de dados
      if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
        // Os dados não batem, manda pra tela de login
        expulsaVisitante();
      }
    }
  }
}

/**
* Função para expulsar um visitante
*/
function expulsaVisitante() {
  global $_SG;

  // Remove as variáveis da sessão (caso elas existam)
  unset($_SESSION['user_id'], $_SESSION['user_nick'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);

  // Manda pra tela de login
  header("Location: ".$_SG['paginaLogin']);
}
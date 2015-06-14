<?php

require_once("config/init.php");

$nome = $_SESSION['user_id'];

mysql_select_db($database_conexao, $conexao);

			$qryval = "SELECT * FROM `fila_procedimentos` WHERE (id = '$user_id') LIMIT 1";
            $exe_usuariosval = mysql_query($qryval) or die(mysql_error());
            $rowval = mysql_fetch_array($exe_usuariosval, MYSQL_ASSOC);

$tipo = $rowval['tipo'];
$nome = $rowval['nome'];
$data_entrada = $rowval['dt_entrada'];

			if($tipo == 0){
				$idtipo = $rowval['id_especialidade'];
				$qrynew = "SELECT * FROM `especialidades` WHERE (id = '$idtipo') LIMIT 1";
					$qrycount = "SELECT count(*) as total FROM `fila_procedimentos` WHERE id_especialidade = 1 and dt_entrada < '$data_entrada'";
					$data=mysql_fetch_assoc($result);
					$data = $data['total']+1;
			} else if($tipo == 1){
				$idtipo = $rowval['id_exame'];			
				$qrynew = "SELECT * FROM `exames` WHERE (id = '$idtipo') LIMIT 1";
					$qrycount = "SELECT count(*) as total FROM `fila_procedimentos` WHERE id_exame = 1 and dt_entrada < '$data_entrada'";
					$data=mysql_fetch_assoc($result)+1;
					$data = $data['total']+1;
			}
				$exe_new = mysql_query($qrynew) or die(mysql_error());
				$rowfin = mysql_fetch_array($exe_new, MYSQL_ASSOC);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!--FONT-->
        <link rel="stylesheet" type="text/css" href="css/font.css">    
		<!-- BASICS -->
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SUS Transparente - Dados públicos sobre consultas e exames</title>
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		
		<!-- CSS -->	
	<link rel="stylesheet" type="text/css" href="css/isotope.css" media="screen" />	
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="css/stylesheet.css" />		
	<link rel="stylesheet" type="text/css" href="css/animate.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/material-design-iconic-font.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/style-index.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />	
		<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
	
		<!-- Scripts -->
			<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>	
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
		    <script src="js/typeahead.min.js"></script>
			<script src="js/interact-1.2.4.min.js"></script>
			<script src="js/scripts.js"></script>			
    </head>
<body>

<div id="main">  
<div class="container">
		<div class="col-md-12 column text-center">
			<div class="ca-presentation">
			<div class="animated zoomInLeft"></div>
			<span class="ca-presentation-find type-one">Você é o <?php echo $data; ?>º na fila.</span>		
			</div>
			</div>
		</div>
		<div class="col-md-8 column hidden-sm hidden-xs">
			<div id="ca-container" class="ca-container">
				<div id="features" class="ca-wrapper">
			
				</div>
			</div>
		</div>
		<div class="col-md-4 column reghandle">
			<div id="registry-box">
			<div class="box"><div class="logo"></div>Digite o código de seu procedimento e sua senha<?php include_once("login.php"); ?></div>
			</div>
		</div>
</div>
</div>

<!--	<div class="footer">
           			<div class="input-wrap">
					<form method="get" action="search/">
					<input type="text" name="q" class="typeahead tt-query" autocomplete="on" placeholder="O que você está procurando?" spellcheck="true" value="<?php echo $question ?>" required>
					<input type="submit" class="ShoutButton" value="" /></form>
					</div>
	</div> -->
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>	
  </body>
</html>

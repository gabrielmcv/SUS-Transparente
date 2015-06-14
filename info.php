<?php

require_once("config/init.php");
	include("security.php");
	protegePagina();

$user_id = $_SESSION['id'];

			$qryval = "SELECT * FROM `fila_procedimentos` WHERE (id = '$user_id') LIMIT 1";
            $exe_usuariosval = $connection->query($qryval);
            $rowval = mysqli_fetch_array($exe_usuariosval, MYSQL_ASSOC);

$tipo = $rowval['tipo'];
$nome = $rowval['nome'];
$data = $rowval['dt_entrada'];

if($data == "0000-00-00 00:00:00"){
	$marcado = 0;
} else {
	$marcado = 1;
}

			if($tipo == 0){
				$idtipo = $rowval['id_especialidade'];
				$qrynew = "SELECT * FROM `especialidades` WHERE (id = '$idtipo') LIMIT 1";
					if($marcado == 0){
						$qrycount = "SELECT count(*) as total FROM `fila_procedimentos` WHERE id_especialidade = 1 and dt_entrada < '$data'";
						$qry_table = "SELECT * FROM fila_procedimentos WHERE id_especialidade = 1 ORDER BY dt_entrada DESC LIMIT 10";
						$result = $connection->query($qrycount);
						$pos_fila = mysqli_fetch_assoc($result);
						$pos_fila = $pos_fila['total']+1;						
						}
					$nometipo = "consulta";
			} else if($tipo == 1){
				$idtipo = $rowval['id_exame'];			
				$qrynew = "SELECT * FROM `exames` WHERE (id = '$idtipo') LIMIT 1";
					if($marcado == 0){
						$qrycount = "SELECT count(*) as total FROM `fila_procedimentos` WHERE id_exame = 1 and dt_entrada < '$data'";
						$qry_table = "SELECT * FROM fila_procedimentos WHERE id_exame = 1 ORDER BY dt_entrada DESC LIMIT 10";						
						$result = $connection->query($qrycount);
						$pos_fila = mysqli_fetch_assoc($result);
						$pos_fila = $pos_fila['total']+1;
						}
					$nometipo = "exame";					
			}
				$exe_new = $connection->query($qrynew);
				$rowfin = mysqli_fetch_array($exe_new, MYSQL_ASSOC);
			
			if($marcado == 0){
				$message = "Seu procedimento ainda não foi marcado, mas você é o <strong>".$pos_fila."º</strong> da fila.";
			} else {
				$data_atendimento = date_create($rowval['dt_atendimento']);
				$data_atendimento = date_format($data_atendimento,'d/m/Y \à\s H:i:s');
				$message = "Seu procedimento está marcado para o dia: ".$data_atendimento;			
			}

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
		<link rel="stylesheet" type="text/css" href="css/style-info.css" />
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
			<div class="animated fadeIn"><img src="img/logo.svg" width="300px" /></div>
			<div class="ca-presentation-find type-one">Olá <strong><?php echo $nome; ?></strong>,<br /></span>			
			<span class="ca-presentation-find type-one"><?php echo $message; ?></span>
			</div>
		</div>
<?php 	if($marcado == 0){ 
            $result_cat = $connection->query($qry_table);
?>
		<div class="col-md-12 column">
			<div class="animated fadeIn">			
				<table class="table table-bordered">
				  <tr>
					<th width="10%">Posição</th>
					<th width="45%">Paciente</th>
					<th width="45%%">Data de entrada</th>
				  </tr>
<?php
				$i = 1;
				
				while ($row_table = mysqli_fetch_assoc($result_cat)){
				
				$nome_pac = strtoupper(substr($row_table["id_sisreg"],3));
				$data_entrada = date_create($row_table['dt_entrada']);
				$data_entrada = date_format($data_entrada,'d/m/Y \à\s H:i:s');
				
				echo "<tr><td>".$i."</td>";				
				echo "<td>XXX".$nome_pac."</td>";
				echo "<td>".$data_entrada."</td>";
				
				$i++;
				}
?>
				  </tr>
				</table>						
			</div>
		</div>
<?php } ?>
<div id="fechar" class="text-center"><input type="button" name="close" class="btn btn-primary btnmod" id="fechar" value="Fechar" onclick="window.close()"></div>
</div>
</div>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>	
  </body>
</html>

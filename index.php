<?php

require("config/init.php");

if(isset($_GET["q"])){ 
$question = $_GET["q"]; 
} else { 
$question = NULL; 
}

if(isset($_GET["error"])){ 
$error = $_GET["error"];
} else { 
$error = 0; 
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
		<link rel="stylesheet" type="text/css" href="css/style-index.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />	
		<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
	
		<!-- Scripts -->
			<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>	
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
		    <script src="js/typeahead.min.js"></script>
			<script src="js/interact-1.2.4.min.js"></script>
			<script src="js/scripts.js"></script>
			<script src="js/Chart.min.js"></script>
    <script type="text/javascript">
        var randomnb = function(){ return Math.round(Math.random()*300)};
    </script> 			
    </head>
<body>

<div id="main">  
<div class="container">
		<div class="col-md-8 column hidden-sm hidden-xs">		
			<div id="ca-container" class="ca-container">
			<div class="ca-presentation">
			<div class="animated zoomInLeft"><img src="img/logo.svg" width="300px" />
			</div>
			<span class="ca-presentation-find type-one animated fadeIn">Dados transparentes, </span><span class="ca-presentation-find type-two animated fadeIn">de <strong>consultas</strong> e <strong>exames</strong>.</span>		
	</div>					
				<div id="features" class="ca-wrapper">
<ul class="nav navbar-nav">
        <li class="dropdown">
<?php

			$qry_cat = "SELECT * FROM especialidades";
            $result_cat = $connection->query($qry_cat);

?>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Escolha uma especialidade <span class="fa fa-chevron-down fa-md pull-right"></span></a>
        <ul class="dropdown-menu">
		  <?php
					
						$cat_number = mysqli_num_rows($result_cat);				
						$i = 0;
						
						while ($row_cat = mysqli_fetch_assoc($result_cat)){ 
						
						echo "<li><a href='?sp=a&cat=a&cat_n=a'>".$row_cat['nome']."<span class='glyphicon glyphicon-cog pull-right'></span></a></li>";
						$i++;						
						
						if ($i != $cat_number){
							echo "<li class='divider'></li>";
						}
						
						}
						?>			
		</ul>
			</li>
</ul>

            <canvas id="GraficoBarra" style="width:100%;"></canvas>

            <script type="text/javascript">                                        

                var options = {
                    responsive:true
                };

                var data = {
                    labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                    datasets: [
                        {
                            label: "Dados primários",
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: [randomnb(), randomnb(), randomnb(), randomnb(), randomnb(), randomnb(), randomnb(), randomnb(), randomnb(), randomnb(), randomnb(), randomnb()]
                        },
                        {
                            label: "Dados secundários",
                            fillColor: "rgba(151,187,205,0.5)",
                            strokeColor: "rgba(151,187,205,0.8)",
                            highlightFill: "rgba(151,187,205,0.75)",
                            highlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90, randomnb(), randomnb(), randomnb(), randomnb(), randomnb()]
                        }
                    ]
                };                

                window.onload = function(){
                    var ctx = document.getElementById("GraficoBarra").getContext("2d");
                    var BarChart = new Chart(ctx).Bar(data, options);
                }           
            </script>
			
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

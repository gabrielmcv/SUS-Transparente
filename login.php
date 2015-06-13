<form id="shLog" action="valid.php" method="post">
		<div id="slider" class="form">
		<div id="form-box">
					<input type="text" id="cod" name="shcod" maxlength="255" class="form-control" data-msg="Digite um código válido." placeholder="ex: EX8AF" required> 
		</div>
		<div id="form-box">
					<input type="password" id="password" maxlength="18" name="shpass" class="form-control" data-msg="Digite uma senha válida." placeholder="Senha" required>									
		</div>		
				<div class="form-group">
				<input type="submit" name="signin" class="btn btn-primary btnmod" id="register" value="Buscar código">
				</div>
			<div id="validation_msg"><?php if($error == 1){ echo '<p class="alert alert-danger jf_error">E-mail ou senha incorretos</p>'; } ?></div>
		</div>
    </form>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="<?php echo BASE; ?>/assets/css/login.css" rel="stylesheet" />
	</head>
	<body>
		<div class="loginarea">
			<div>
				<h2 class="loginwelcome">Bem Vindo</h2>
			</div>
			<form method="POST">
				<input type="email" name="email" placeholder="Digite seu e-mail" />

				<input type="password" name="password" placeholder="Digite sua senha" />

				<input type="submit" value="Entrar" /><br/>

				<?php if(isset($error) && !empty($error)): ?>
				<div class="warning"><?php echo $error; ?></div>
				<?php endif; ?>
			</form>
			<a role="button" onclick="return modalEsqueciSenha(this)" class="login-esquecisenha">Esqueci minha senha!</a>
		</div>



		<div id="exampleModal" class="modal" tabindex="-1" role="dialog">
		 	<div class="modal-dialog" role="document">
				<div class="modal-content">
				  	<div class="modal-header">
		                <h5 class="modal-title" id="exampleModalLabel">Recuperação de senha</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true">×</span>
		                </button>
		            </div>
		            <div class="modal-body" id="form">
		                <form id="form-recuperar-senha">
		                    <div class="form-group">
		                        <label for="recipient-name" class="col-form-label">Email</label>
		                        <input type="text" class="form-control" name="emailRecuperacao" placeholder="Informe seu email...">
		                    </div>
		                </form>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		                <button onclick="return enviarEmailRecuperacao(this)" type="button" class="btn btn-primary">Enviar email</button>
		            </div>
				</div>
		  	</div>
		</div>
	</body>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/login.js"></script>
	<script type="text/javascript">
		const BASE_URL = "<?php echo BASE_URL; ?>"
	</script>
</html>
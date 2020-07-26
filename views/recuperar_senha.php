<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="<?php echo BASE; ?>/assets/css/login.css" rel="stylesheet" />
	</head>
	<body>
		<div class="loginarea recuperarsenhaarea">
			<div>
				<h2 class="loginwelcome recuperarsenhawelcome">Recuperação de Senha</h2>
			</div>
			<form method="POST" action="<?php echo BASE_URL.'/recuperarsenha/put/'.$IAM_recuperar_senha['codigo']; ?>">
				<input type="email" name="email" value="<?php echo $usuario['email'] ?>" placeholder="Digite seu e-mail" readonly="true" />

				<input type="password" name="password" placeholder="Digite sua senha" />
				<input type="password" name="passwordconfirmar" placeholder="Digite sua senha" />

				<input type="submit" value="Atualizar" /><br/>

			</form>
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
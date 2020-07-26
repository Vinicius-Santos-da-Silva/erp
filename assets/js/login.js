function modalEsqueciSenha(_this)
{
	$("#exampleModal").modal("show")
}

function enviarEmailRecuperacao(_this)
{
	let email = $("[name=emailRecuperacao]").val();
	
	$.ajax({
		url:BASE_URL+'/recuperarSenha/index',
		type:'POST',
		data:{email:email},
		success:function(json) {
			alert('Email de recuperação enviado com sucesso.');
			$("#exampleModal").modal("hide")
		}

	});
}
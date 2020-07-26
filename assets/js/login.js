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
		// dataType:'json',
		success:function(json) {
			console.log(json)
		}

	});
}
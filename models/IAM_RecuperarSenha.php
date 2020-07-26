<?php
class IAM_RecuperarSenha extends model {

	public function novaRecuperacao($usuario)
	{
		$rand1 = rand(0,9999999);
		$rand2 = rand(0,9999999);
		$time = time();
		$random = md5("$rand1$time$rand2");

		$sql = $this->db->prepare("INSERT INTO iam_recuperacao_senha 
					SET codigo = :codigo, 
						IAM_usuario_id = :IAM_usuario_id, 
						datahora_cadastro = NOW()"
					);

		$sql->bindValue(":codigo", $random);
		$sql->bindValue(":IAM_usuario_id", $usuario['id']);
		$sql->execute();

		$ses = new AWSSES();
		return $ses->send($usuario['email']);
	}

	public function validaCodigo($codigo)
	{
		$sql = $this->db->prepare("SELECT * FROM iam_recuperacao_senha WHERE codigo = :codigo;");
		$sql->bindValue(":codigo", $codigo);
		$sql->execute();

		if($sql->rowCount() == 0) {
			return false;			
		} 

		return  $sql->fetch();
	}
}
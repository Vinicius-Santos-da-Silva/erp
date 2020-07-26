<?php
class recuperarsenhaController extends controller {
	
	public function __construct() {
        parent::__construct();
    }

	public function index()
    {
    	$usuario = new Users();
    	
    	$status = $usuario->recuperarSenha($_POST['email']);

    	$responseHTTP = array(
    		'status' => $status,
    		'mensagem' => 'Confira sua caixa de emails!'
    	);

    	echo json_encode($responseHTTP);
    }

    public function get($codigo)
    {
        $IAM_RecSenha = new IAM_RecuperarSenha();

        $codigo = $IAM_RecSenha->validaCodigo($codigo);

        if(!$codigo){
            die('Código inválido.');
        }

        $userModel = new Users();
        $usuario = $userModel->getById($codigo['IAM_usuario_id']);

        $data = array(
            'usuario' => $usuario,
            'IAM_recuperar_senha' => $codigo,
        );

        $this->loadView('recuperar_senha', $data);
    }

    public function put($codigo)
    {

        $IAM_RecSenha = new IAM_RecuperarSenha();

        $codigo = $IAM_RecSenha->validaCodigo($codigo);

        if(!$codigo){
            die('Código inválido.');
        }

        $userModel = new Users();
        $usuario = $userModel->getById($codigo['IAM_usuario_id']);

        if (!$usuario) {
            die('Usuário inválido.');
        }

        if ($_POST['password'] != $_POST['passwordconfirmar']) {
            die('senhas diferentes.');
        }

        $novaSenha = md5($_POST['password']);

        $userModel->editPassword($usuario['id'] , $novaSenha);
        
        header("Location: ".BASE_URL."/login");
        exit;
    }
}
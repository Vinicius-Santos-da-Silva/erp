<?php
class despesasController extends controller {

	public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
        	header("Location: ".BASE_URL."/login");
        	exit;
        }
    }

    public function index() 
	{
	  	$data = array(
	  		'compras' => array()
	  	);
        $u = new Users();
        $u->setLoggedUser();
        $compras = new Compra();
        $data['compras'] = $compras->getAll();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('report_view')) {
			$this->loadTemplate('despesas', $data);
        } else {
          header("Location: ".BASE_URL);
        }
	}

    public function adicionar()
    {
        $data = array(
            'compras' => array()
        );

        $u = new Users();
        $compras = new Compra();
        $company = new Companies($u->getCompany());

        $u->setLoggedUser();
        $data['compras']        = $compras->getAll();
        $data['company_name']   = $company->getName();
        $data['user_email']     = $u->getEmail();

        if (!$this->validadeFormAdd()) {
            $despesa = new Despesa();

            $valor          = $_POST['valor'];
            $loja           = $_POST['loja'];
            $produto        = $_POST['produto'];
            $num_parcelas   = $_POST['num_parcelas'];
            $tipo_pgto      = $_POST['tipo_pgto'];
            $tipo_compra    = $_POST['tipo_compra'];
            $status         = $_POST['status'];

            $array = array(
                'valor'             => $valor,
                'numero_parcelas'   => $num_parcelas ,
                'valor_parcela'     => ($valor / $num_parcelas) ,
                'tipo_pgto'         => $tipo_pgto,
                'compra_tipo'       => $tipo_compra,
                'loja'              => $loja ,
                'status'            => $status ,
                'produto'           => $produto , 
            );

            $id_insert = $despesa->add($array);
            if ($id_insert) {
                header("Location: ".BASE_URL."/despesas");
            }else{

            }
        }

        $this->loadTemplate('despesas_add',$data);

    }

    private function validadeFormAdd(){
        $return = true;

        $valor          = boolval(isset($_POST['valor'])        && !empty($_POST['valor']));
        $loja           = boolval(isset($_POST['loja'])         && !empty($_POST['loja']));
        $produto        = boolval(isset($_POST['produto'])      && !empty($_POST['produto']));
        $num_parcelas   = boolval(isset($_POST['num_parcelas']) && !empty($_POST['num_parcelas']));
        $tipo_pgto      = boolval(isset($_POST['tipo_pgto'])    && !empty($_POST['tipo_pgto']));
        $tipo_compra    = boolval(isset($_POST['tipo_compra'])  && !empty($_POST['tipo_compra']));
        $status         = boolval(isset($_POST['status'])       && !empty($_POST['status']));

        print_r($valor);
        print_r($loja);
        print_r($produto);
        print_r($num_parcelas);
        print_r($tipo_pgto);
        print_r($tipo_compra);
        print_r($status);

        $boll = boolval(($valor && $loja && $produto && $num_parcelas && $tipo_pgto && $tipo_compra && $status));
        //print_r($boll);die();

        if ($boll) {
            $return = false;
        }

        return $return;
    }


    public function editar($id)
    {
        $data = array();
        
        $u = new Users();
        $u->setLoggedUser();
        $despesa = new Despesa();
        $company = new Companies($u->getCompany());
        
        $data['company_name']   = $company->getName();
        $data['user_email']     = $u->getEmail();
        
        $data['compra']         = $despesa->getById($id);


        $this->loadTemplate('despesas_edit', $data);   
    }

    public function atualizar($id){

        $data = array();

        $u = new Users();
        $company = new Companies($u->getCompany());

        $u->setLoggedUser();
        $data['company_name']   = $company->getName();
        $data['user_email']     = $u->getEmail();

        if ($this->validadeFormAdd()) {
            $despesa = new Despesa();

            $valor          = $_POST['valor'];
            $loja           = $_POST['loja'];
            $produto        = $_POST['produto'];
            $num_parcelas   = $_POST['num_parcelas'];
            $tipo_pgto      = $_POST['tipo_pgto'];
            $tipo_compra    = $_POST['tipo_compra'];
            $status         = $_POST['status'];

            $array = array(
                'valor'             => $valor,
                'numero_parcelas'   => $num_parcelas ,
                'valor_parcela'     => ($valor / $num_parcelas) ,
                'tipo_pgto'         => $tipo_pgto,
                'compra_tipo'       => $tipo_compra,
                'loja'              => $loja ,
                'status'            => $status ,
                'produto'           => $produto , 
            );

            $status_update = $despesa->update($array , $id);
            //print_r(!!$status_update);PHP_EOL;die();

            if ($status_update) {
                header("Location: ".BASE_URL."/despesas");
            }else{
                header("Location: ".BASE_URL."/despesas");

            }
        }else{
            print_r($_POST);PHP_EOL;
            header("Location: ".BASE_URL."/despesas");

        }

    }
}
<?php

//include '../vendor/autoload.php';
require __DIR__.'/../vendor/autoload.php';


class reportController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
            header("Location: ".BASE_URL."/login");
            exit;
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('report_view')) {
            $this->loadTemplate("report", $data);
        } else {
          header("Location: ".BASE_URL);
        }
    }

    public function sales() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['statuses'] = array(
            '0'=>'Aguardando Pgto.',
            '1'=>'Pago',
            '2'=>'Cancelado'
        );

        if($u->hasPermission('report_view')) {


            $this->loadTemplate("report_sales", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function sales_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $data['statuses'] = array(
            '0'=>'Aguardando Pgto.',
            '1'=>'Pago',
            '2'=>'Cancelado'
        );

        if($u->hasPermission('report_view')) {
            $client_id = addslashes($_GET['client_id']);
            $period1 = addslashes($_GET['period1']);
            $period2 = addslashes($_GET['period2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);
            // print_r($_GET);die();

            $s = new Sales();
            $data['sales_list'] = $s->getSalesFiltered($client_id, $period1, $period2, $status, $order, $u->getCompany());

            $data['filters'] = $_GET;


            $this->loadLibrary('FPDF');
            $this->loadLibrary('debug');

            $pdf = new FPDF();
            $pdf->AddPage();

            $pdf->SetFont('Arial', '', 12);

            $pdf->SetTopMargin(10);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);


            /* --- Cell --- */
            $pdf->SetXY(10, 15);
            $pdf->SetFont('', 'B', 28);
            $pdf->Cell(0, 10, 'Relatorio de Vendas', 0, 1, 'C');
            //$pdf->Line(35,25,175,25);




            $pdf->Rect( 14,  35,  180,  13);
            
            $pdf->SetFontSize(8);
            $pdf->Text( 16,  40, 'Emitido por: ');
            $pdf->Text( 36,  40, 'Vinicius Santos da Silva');

            $pdf->Text( 16,  45, utf8_decode('Data Emissão: '));
            $pdf->Text( 46,  45, date('d-m-Y H:m'));


            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(14, 76, 'Nome Cliente');
            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(67, 76, 'Data');
            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(113, 76, 'Status');
            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(162, 76, 'Valor');

            $pdf->SetFontSize(8);

            $line = 86;
            foreach ($data['sales_list'] as $key => $value) {

                if ($value['total_price']) {
                    
                    $pdf->Text(14, $line, $value['name']);
                    $pdf->Text(67, $line, $value['date_sale']);
                    $pdf->Text(113,$line, $data['statuses'][$value['status']]);
                    $pdf->Text(162,$line, $value['total_price']);
                    
                    $line = $line + 10;
                }

                
            }

            $pdf->Output('created_pdf.pdf','I');

        } else {
            header("Location: ".BASE_URL);
        }        
    }

    public function inventory() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        //debug('$pdf',1);


        if($u->hasPermission('report_view')) {

            $this->loadTemplate("report_inventory", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inventory_pdf() {
        $this->loadLibrary('debug');

        $data = array();
        $u = new Users();
        $u->setLoggedUser();


        if($u->hasPermission('report_view')) {
            $i = new Inventory();

            //debug($u);
            
            $id_company = $u->getCompany();
            
            $data['inventory_list'] = $i->getInventoryFiltered($id_company);
            
            $company = new Companies($id_company);

            $data['filters'] = $_GET;

            $this->loadLibrary('FPDF');
            //debug(($company),1);

            $pdf = new FPDF();
            $pdf->AddPage();

            
            $pdf->SetFont('Arial', '', 12);

            $pdf->SetTopMargin(10);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);


            /* --- Cell --- */
            $pdf->SetXY(10, 15);
            $pdf->SetFont('', 'B', 28);
            $pdf->Cell(0, 10, 'Relatorio de Vendas', 0, 1, 'C');
            //$pdf->Line(35,25,175,25);




            $pdf->Rect( 14,  35,  180,  13);
            
            $pdf->SetFontSize(8);
            $pdf->Text( 16,  40, 'Emitido por: ');
            $pdf->Text( 36,  40, utf8_decode($u->getEmail()));

            $pdf->Text( 16,  45, utf8_decode('Data Emissão: '));
            $pdf->Text( 36,  45, date('d-m-Y H:m'));


            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(14, 76, 'Nome');
            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(52, 76, utf8_decode('Preço'));
            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(93, 76, 'Quant');
            /* --- Text --- */
            $pdf->SetFontSize(10);
            $pdf->Text(132, 76, 'Quant min.');

            $pdf->SetFontSize(10);
            $pdf->Text(172, 76, utf8_decode('Diferença'));

            $pdf->SetFontSize(8);

            $line = 86;
            foreach ($data['inventory_list'] as $key => $value) {

                    
                $pdf->Text(14, $line, $value['name']);
                $pdf->Text(55, $line, $value['price']);
                $pdf->Text(96,$line,  $value['quant']);
                $pdf->Text(138,$line, $value['min_quant']);
                $pdf->Text(172,$line, $value['quant'] - $value['min_quant']);

                $line = $line + 10;
                

                
            }

            $pdf->Output('created_pdf.pdf','I');


        } else {
            header("Location: ".BASE_URL);
        }        
    }

}
















<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel - <?php echo $viewData['company_name']; ?></title>
        <link href="<?php echo BASE; ?>/assets/css/template.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>
        <script type="text/javascript" src="<?php echo BASE; ?>/assets/js/script.js"></script>
    </head>
    <body>
    	<div class="leftmenu">
    		<div class="company_image">
                <!-- <img src="https://cdn.icon-icons.com/icons2/79/PNG/128/apple_15250.png" class="ml-4"> -->
            </div>
            <div class="company_name">
    			<?php echo $viewData['company_name']; ?>
    		</div>
            <div class="menuarea">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/permissions">Permissões</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/users">Usuários</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/clients">Clientes</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/inventory">Estoque</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/sales">Vendas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/purchases">Compras</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/report">Relatórios</a></li>
                    <li disabled><a href="<?php echo BASE_URL; ?>/report">Rendimentos</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/despesas">Despesas</a></li>
                </ul>
            </div>
    	</div>
    	<div class="container-fluid px-0">
    		<div class="top">
    			<div class="top_right"><a href="<?php echo BASE_URL.'/login/logout'; ?>">Sair</a></div>
    			<div class="top_right"><?php echo $viewData['user_email']; ?></div>    			
    		</div>
            <div class="ml-13 area">
                <?php $this->loadViewInTemplate($viewName, $viewData); ?>
            </div> 
    	</div>
    </body>
</html>

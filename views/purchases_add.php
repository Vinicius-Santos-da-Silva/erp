<h1>Compras - Adicionar</h1>

<form method="POST">
	<h2 for="unidade_price">Empresa : Micro Tech SA</h2>
	<h4 for="unidade_price">Usuário: Vinicius Santos</h4>

	<br/><br/>


	<label for="procut_name">Produto</label><br/>
	<input type="text" name="product_name"  /><br/><br/>

	<label for="unidade_price">Preço Unidade</label><br/>
	<input type="text" name="unidade_price"  /><br/><br/>

	<label for="unidade_price">Quantidade</label><br/>
	<input type="number" name="quant" min='1' value="1" /><br/><br/>
	

	<input type="submit" value="Adicionar Compra" />
</form>
<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/script_sales_add.js"></script>
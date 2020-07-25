<h1>Relatório de Vendas</h1>
<form method="GET" onsubmit="return openPopup(this)">

	<div class="report-grid-4">
		Nome do Cliente:<br/>
		<select class="js-data-clients-ajax" name="client_id"></select>
	</div>
	<div class="report-grid-4">
		Período:<br/>

		<input type="date" name="period1" /><br/>
		até<br/>
		<input type="date" name="period2" />
	</div>
	<div class="report-grid-4">
		Status da Venda:<br/>
		<select name="status">
			<option value="">Todos os status</option>
			<?php foreach($statuses as $statusKey => $statusValue): ?>
			<option value="<?php echo $statusKey; ?>"><?php echo $statusValue; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="report-grid-4">
		Ordenação:<br/>
		<select name="order">
			<option value="date_desc">Mais Recente</option>
			<option value="date_asc">Mais Antigo</option>
			<option value="status">Status da Venda</option>
		</select>
	</div>

	<div style="clear:both"></div>

	<div style="text-align:center">
		<input type="submit" value="Gerar Relatório" />
	</div>
</form>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/report_sales.js"></script>

<script type="text/javascript">
	$('.js-data-clients-ajax').select2({
	 	ajax: {
	    	url: BASE_URL+'/ajax/search_clients',
	    	dataType: 'json',
	    	processResults:(usuarios , params)=>{
	    		
	    		let results = usuarios.map( (usuario) => {
	    			return {id:usuario.id , text:usuario.name}
	    		});


	    		return {
			        results: results,
			        pagination: {
			            more: false
			        }
			    };
	    	}
	 	}
	});
</script>
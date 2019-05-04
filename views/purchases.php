<h1>Compras</h1>

<div class="button"><a href="<?php echo BASE_URL; ?>/purchases/add">Adicionar Compra</a></div>

<table border="0" width="100%">
	<tr>
		<th>Email</th>
		<th>Data</th>
		<th>Company</th>
		<th>Valor</th>
	</tr>
	<?php foreach($purchases_list as $purchase_item): ?>
	<tr>
		<td><?php echo $purchase_item['email']; ?></td>
		<td><?php echo date('d/m/Y', strtotime($purchase_item['date_purchase'])); ?></td>
		<td><?php echo $purchase_item['name']; ?></td>
		<td>R$ <?php echo number_format($purchase_item['total_price'], 2, ',', '.'); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
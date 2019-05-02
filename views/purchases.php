<h1>Compras</h1>

<div class="button"><a href="<?php echo BASE_URL; ?>/purchases/add">Adicionar Compra</a></div>

<table border="0" width="100%">
	<tr>
		<th>Email</th>
		<th>Data</th>
		<th>Company</th>
		<th>Valor</th>
		<th>Ações</th>
	</tr>
	<?php foreach($purchases_list as $purchase_item): ?>
	<tr>
		<td><?php echo $purchase_item['email']; ?></td>
		<td><?php echo date('d/m/Y', strtotime($purchase_item['date_purchase'])); ?></td>
		<td><?php echo $purchase_item['name']; ?></td>
		<td>R$ <?php echo number_format($purchase_item['total_price'], 2, ',', '.'); ?></td>
		<td>
			<div class="button button_small"><a href="<?php echo BASE_URL; ?>/sales/edit/<?php echo $purchase_item['id']; ?>">Editar</a></div>
			<?php if(!empty($purchase_item['nfe_key'])): ?>
				<div class="button button_small"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/view_nfe/<?php echo $purchase_item['nfe_key']; ?>">Visualizar NF-e</a></div>
			<?php else: ?>
				<div class="button button_small"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/generate_nfe/<?php echo $purchase_item['id']; ?>">Emitir NF-e</a></div>
			<?php endif; ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
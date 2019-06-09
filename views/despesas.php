<h1 class="text-uppercase">Despesas</h1>
<?php #print_r($viewData);PHP_EOL;  ?>

<div class="btn-group btn-block" role="group" aria-label="Basic example">
  <a href="<?php echo BASE_URL; ?>/despesas/adicionar/" type="button" class="btn btn-dark">Adicionar</a>
  <a href="#" type="button" class="btn btn-dark">Editar</a>
  <a href="#" type="button" class="btn btn-dark">Relatório</a>
</div>

<table class="table table-hover table-dark mt-2">
  <thead>
    <tr>
      <th scope="col">Loja</th>
      <th scope="col">Data</th>
      <th scope="col">Valor</th>
      <th scope="col">Tipo</th>
      <th scope="col">Nº Parcelas</th>
      <th scope="col">Status</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach ($viewData['compras'] as $compra) :  ?>
    <?php  
		$newDate = date("m-d-Y", strtotime($compra['data_compra']));
    ?>
    <tr>
      <th scope="row"><?=utf8_encode($compra['loja'])?></th>
      <td><?= $newDate ?></td>
      <td>R$ <?=$compra['valor']?></td>
      <td><?=utf8_encode($compra['tipo_pgto'])?></td>
      <td><?=$compra['numero_parcelas']?></td>
      <td><?=$compra['status']?></td>
      <td>
      	<a href="<?php echo BASE_URL; ?>/despesas/editar/<?=$compra['id']?>"  class="btn btn-outline-light">
      		Editar
      	</a>
      </td>
    </tr>

  	<?php endforeach;  ?>
  </tbody>
</table>
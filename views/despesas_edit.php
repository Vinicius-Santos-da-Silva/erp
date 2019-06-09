<?php #print_r($viewData['compra'][0]['loja']);PHP_EOL; ?>

<?php foreach ($viewData['compra'] as $compra): ?>

  <div class="d-flex mt-3">
    <i class="fas fa-cart-plus pt-2"></i>
    <h3 class="ml-3">Despesas - Adicionar</h3>
  </div>
  <form class="needs-validation p-5" method="POST" action="<?php echo BASE_URL; ?>/despesas/atualizar/<?=$compra['id']?>" novalidate>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="validationCustom03">Loja</label>
        <div class="input-group">
          <input type="text" class="form-control" id="loja" value="<?=$compra['loja']?>" name="loja" placeholder="Loja" aria-describedby="inputGroupPrepend" required>
        </div>
      </div>


      <div class="col-md-3 mb-3">
        <label for="validationCustom04">Valor</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend">R$</span>
          </div>
          <input  type="number" class="form-control" id="valor" value="<?=$compra['valor']?>" name="valor" placeholder="Valor Compra" aria-describedby="inputGroupPrepend" required>
        </div>
      </div>


      <div class="col-md-3 mb-3">
        <label for="validationCustom05">Nº Parcelas</label>
        <input type="number" class="form-control" id="num_parcelas" name="num_parcelas" min="1" max="12" value="<?=$compra['numero_parcelas']?>" placeholder="Zip" required>
        <div class="invalid-feedback">
          Por Favor, preencha este campo.
        </div>
      </div>
    </div>

    <div class="input-group flex-nowrap mb-4">
      <input type="text" class="form-control" placeholder="Nome do Produto" value="<?=$compra['produto']?>" name="produto" aria-label="Nome do Produto" aria-describedby="addon-wrapping">
    </div>


    <div class="form-row">
      <div class="col-md-4 mb-3">
        <div class="form-group">
          <select class="custom-select" selected="<?=$compra['tipo_pgto']?>" name="tipo_pgto" required >
            <option value="">Selecione o Tipo de Pagamento</option>
            <?php if ($compra['tipo_pgto'] == 'CREDITO'){ ?>
              <option value="CREDITO" selected>CREDITO</option>
            <?php } else {  ?>
              <option value="Á VISTA">CREDITO</option>

            <?php } ?>

            <?php if ($compra['tipo_pgto'] == 'Á VISTA'){ ?>
              <option value="Á VISTA" selected>Á VISTA</option>
            <?php } else {  ?>
              <option value="Á VISTA">Á VISTA</option>
            <?php }  ?>

          </select>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="form-group">
          <select class="custom-select" name="tipo_compra" required>
            <option value="">Selecione o Tipo de Compra</option>
             <?php if ($compra['compra_tipo'] == 'DINHEIRO'){ ?>
                <option value="DINHEIRO">DINHEIRO</option>
            <?php } else {  ?>
                <option value="DINHEIRO">DINHEIRO</option>
              

            <?php } ?>

            <?php if ($compra['compra_tipo'] == 'CARTÃO'){ ?>
            <option selected value="CARTÃO">CARTÃO</option>
              
            <?php } else {  ?>
              <option value="CARTÃO">CARTÃO</option>
            <?php }  ?>
          </select>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="form-group">
          <select class="custom-select" name="status"  required>
            <option value="">Status da Compra</option>
              <?php if ($compra['status'] == 'PAGO'){ ?>
                <option value="PAGO" selected=>PAGO</option>
              <?php } else {?>
                <option value="PAGO">PAGO</option>
              <?php } ?>

              <?php if ($compra['status'] == 'EM ABERTO'){ ?>
                <option value="EM ABERTO" selected=>EM ABERTO</option>
              <?php } else {?>
                <option value="EM ABERTO">EM ABERTO</option>
              <?php } ?>
          </select>
        </div>
      </div>

    </div>
    <button class="btn btn-primary" type="submit">Adicionar</button>
  </form>
<?php endforeach; ?>

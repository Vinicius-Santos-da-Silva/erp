<div class="d-flex mt-3">
  <i class="fas fa-cart-plus pt-2"></i>
  <h3 class="ml-3">Despesas - Adicionar</h3>
</div>
<form class="needs-validation p-5" method="POST" novalidate>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Loja</label>
      <div class="input-group">
        <input type="text" class="form-control" id="loja" name="loja" placeholder="Loja" aria-describedby="inputGroupPrepend" required>
      </div>
    </div>


    <div class="col-md-3 mb-3">
      <label for="validationCustom04">Valor</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">R$</span>
        </div>
        <input  type="number" class="form-control" id="valor" name="valor" placeholder="Valor Compra" aria-describedby="inputGroupPrepend" required>
      </div>
    </div>


    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Nº Parcelas</label>
      <input type="number" class="form-control" id="num_parcelas" name="num_parcelas" min="1" max="12" value="1" placeholder="Zip" required>
      <div class="invalid-feedback">
        Por Favor, preencha este campo.
      </div>
    </div>
  </div>

  <div class="input-group flex-nowrap mb-4">
    <input type="text" class="form-control" placeholder="Nome do Produto" name="produto" aria-label="Nome do Produto" aria-describedby="addon-wrapping">
  </div>


  <div class="form-row">
    <div class="col-md-4 mb-3">
      <div class="form-group">
        <select class="custom-select" name="tipo_pgto"required>
          <option value="">Selecione o Tipo de Pagamento</option>
          <option value="CREDITO">CREDITO</option>
          <option value="Á VISTA">Á VISTA</option>
        </select>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="form-group">
        <select class="custom-select" name="tipo_compra" required>
          <option value="">Selecione o Tipo de Compra</option>
          <option value="DINHEIRO">DINHEIRO</option>
          <option value="CARTÃO">CARTÃO</option>
        </select>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="form-group">
        <select class="custom-select" name="status"  required>
          <option value="">Status da Compra</option>
          <option value="PAGO">PAGO</option>
          <option value="EM ABERTO">EM ABERTO</option>
        </select>
      </div>
    </div>

  </div>
  <button class="btn btn-primary" type="submit">Adicionar</button>
</form>
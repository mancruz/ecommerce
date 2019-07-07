<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="content">

    <div class="col-md-12">
      <form role="form" action="/admin/manutencao/<?php echo htmlspecialchars( $ID_MANUTENCE, ENT_COMPAT, 'UTF-8', FALSE ); ?>/item" method="post">
        <input type="hidden" id="ID_MANUTENCE" name="ID_MANUTENCE" value = "<?php echo htmlspecialchars( $ID_MANUTENCE, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <!-- card personal data -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">add_shopping_cart</i>
            </div>
            <h4 class="card-title">Adicionar Ítem
            </h4>
          </div>
          <div class="card-body">            
            <!-- first line -->
            <div class="row">
                <!-- Dates -->
                <div class="col-md-4">
                    <div class="form-group bmd-form-group">
                        Ítem
                        <input
                        id      ="ITEM"
                        name    ="ITEM"
                        type    ="text"
                        class   ="form-control"
                        required="true"
                        >
                      </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                      Descrição
                      <input
                      id      ="DESCRICAO"
                      name    ="DESCRICAO"
                      type    ="text"
                      class   ="form-control"
                      >
                    </div>
              </div>
              <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    Fornecedor
                    <select
                      class="form-control selectpicker"
                      data-style="btn btn-link"
                      id="COD_CLI_FORN"
                      name="COD_CLI_FORN"
                      required="true"
                      >
                      <option value ="">Selecione o veículo</option>
                        <?php $counter1=-1;  if( isset($fornecedores) && ( is_array($fornecedores) || $fornecedores instanceof Traversable ) && sizeof($fornecedores) ) foreach( $fornecedores as $key1 => $value1 ){ $counter1++; ?>
                          <option value="<?php echo htmlspecialchars( $value1["COD_CLI_FORN"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["RAZAO_SOCIAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["CNPJ"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>
                    </select>
                </div>
              </div>
            </div><!-- close row -->
            <div class="row"><!-- open row -->
              <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    Qtd
                    <input
                    id      ="QTD"
                    name    ="QTD"
                    type    ="text"
                    class   ="form-control maskPercent"
                    onkeyup="calcular()"
                    required="true"
                    >
                  </div>
              </div>
              <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    Valor Unit
                    <input
                    id      ="VALOR"
                    name    ="VALOR"
                    type    ="text"
                    class   ="form-control inputNumberDec"                    
                    onkeyup="calcular()"
                    required="true"
                    >
                  </div>
              </div>


              <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    Valor Unit
                    <input
                    id      ="SUBTOTAL"
                    name    ="SUBTOTAL"
                    type    ="text"
                    class   ="form-control maskMoney"
                    disabled
                    >
                  </div>
              </div>   
              <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    Garantia (Meses)
                    <input
                    id      ="GARANTIA_DIAS"
                    name    ="GARANTIA_DIAS"
                    type    ="text"
                    class   ="form-control inputNumber"

                    >
                  </div>
              </div>   
                     
            </div><!-- close row -->
            <br>
            <div class="row">
              <!-- button back -->
              <div class="col-md-6 text-left">
                <a class="btn" href="/admin/manutencao">
                  <i class="material-icons">undo</i>
                  <span class="sidebar-normal"> Voltar a lista de manutenções</span>
                </a>
              </div>
              <!-- button save -->
              <div class="col-md-6 text-right">
                <button class="btn btn-large btn-warning pull-right">
                  <span class="btn-label">
                    <i class="material-icons">add</i>
                  </span>
                  Cadastrar
                </button>                     
              </div>
            </div> 
          </div>
          <br>
        </div>

        <!-- card de cadastro de Observações -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">receipt</i>
            </div>
            <h4 class="card-title">Ítens Cadastrados
            </h4>
          </div>
          <div class="card-body">            
            <!-- card de cadastro de valores -->
            <div class="row">
              <div class="form-group col-md-12">
                <table class="table table-bordered table-striped col-" style="table-layout: responsive">
                  <tbody>
                    <tr>
                      <th>Ítem</th>
                      <th>Descrição</th>
                      <th>Fornecedor</th>
                      <th class="text-center">Qtd</th>
                      <th class="text-center">Valor Unit</th>
                      <th class="text-center">Sub Total</th>
                      <th colspan="2" align="center"></th>
                    </tr>
                    <tr>
                    <?php $counter1=-1;  if( isset($manutencaoItens) && ( is_array($manutencaoItens) || $manutencaoItens instanceof Traversable ) && sizeof($manutencaoItens) ) foreach( $manutencaoItens as $key1 => $value1 ){ $counter1++; ?>
                      <td><?php echo htmlspecialchars( $value1["ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["DESCRICAO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["RAZAO_SOCIAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td align="center"><?php echo htmlspecialchars( $value1["QTD"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td class="text-center"><?php echo formatPrice($value1["VALOR"]); ?></td>
                      <td class="text-center"><?php echo formatPrice($value1["SUBTOTAL"]); ?></td>
                      <td align="center">
                        <a href="/admin/manutencao/<?php echo htmlspecialchars( $value1["COD_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $ID_MANUTENCE, ENT_COMPAT, 'UTF-8', FALSE ); ?>/item/cancel" onclick="confirmDelete2('74')" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i>
                        </a>
                      </td>
                    </tr>
                    <?php $calcular = $calcular + $value1["SUBTOTAL"]; ?>
                    <?php } ?>
             
                    <tr>
                      <th scope="row" colspan="5">Totais</th>
                      <th class="text-center"><?php echo formatPrice($calcular); ?></th>
                      <th scope="row" colspan="3"></th>

                    </tr>              
                  </tbody>
                </table>
              </div>

            </div> 
          </div>                       
        </div>
        </div>
      </form>
    </div>
  
  
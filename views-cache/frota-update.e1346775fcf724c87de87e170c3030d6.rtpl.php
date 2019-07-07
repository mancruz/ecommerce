<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="content">

  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary card-header-icon">
        <div class="card-icon">
          <i class="material-icons">event_seat</i>
        </div>
        <h4 class="card-title">Dados do Veículo
        </h4>
      </div>
      <div class="card-body">
        <form role="form" action="/admin/frota/create" method="post">
          <input type="hidden" id="COD_VEICULO" name="COD_VEICULO" value = "<?php echo htmlspecialchars( $frota["COD_VEICULO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          <!-- first level -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Fabricante</label>
                <input
                  id      ="FABRICANTE"
                  name    ="FABRICANTE"
                  type    ="text"
                  class   ="form-control"
                  value="<?php echo htmlspecialchars( $frota["FABRICANTE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                  required
                  autofocus
                  
                >
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Modelo</label>
                <input
                  id      ="MODELO"
                  name    ="MODELO"
                  type    ="text"
                  class   ="form-control"
                  value="<?php echo htmlspecialchars( $frota["MODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                  required
                >
              </div>
            </div>
          </div>
          <!-- end first level -->
          <!-- second level -->
          <div class="row">
            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Ano Modelo</label>
                <input
                  id      ="ANOMODELO"
                  name    ="ANOMODELO"
                  type    ="text"
                  class   ="form-control maskYearModel"
                  value="<?php echo htmlspecialchars( $frota["ANOMODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                  required
                >
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Placa</label>
                <input
                  id      ="PLACA"
                  name    ="PLACA"
                  type    ="text"
                  class   ="form-control maskPlacaCar caixa_alta caixa_alta"
                  value="<?php echo htmlspecialchars( $frota["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                  required
                >
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Renavam</label>
                <input
                  id      ="RENAVAM"
                  name    ="RENAVAM"
                  type    ="text"
                  class   ="form-control"
                  value="<?php echo htmlspecialchars( $frota["RENAVAM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                >
              </div>
            </div>

            <div class="form-group col-md-2">
              <select id="COMBUSTIVEL" name="COMBUSTIVEL" class="form-control" required="true">
                <option selected="<?php echo htmlspecialchars( $frota["COMBUSTIVEL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $frota["COMBUSTIVEL"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <option value="">Combustível...</option>
                <option value="DIESEL">DIESEL</option>
                <option value="ETANOL">ETANOL</option>
                <option value="GASOLINA">GASOLINA</option>
                <option value="GÁS NATURAL">GÁS NATURAL (GNV)</option>
                <option value="FLÉX">FLÉX</option>
              </select>
            </div>

            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Tipo</label>
                <input
                  id      ="TIPO"
                  name    ="TIPO"
                  type    ="text"
                  class   ="form-control"
                  value="<?php echo htmlspecialchars( $frota["TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                >
              </div>
            </div>
          </div>
          <!-- end second level -->
          <!-- third level -->
          <div class="row">
            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Valor de Compra</label>
                <input
                  id      ="VALOR_COMPRA"
                  name    ="VALOR_COMPRA"
                  type    ="text"
                  class   ="form-control  maskMoney"
                  value="<?php echo htmlspecialchars( $frota["VALOR_COMPRA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                  required
                >
              </div>
            </div>
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label bmd-label-floating"> Data da Aquisição</label>
                    <input
                    id      ="DTAQUISICAO"
                    name    ="DTAQUISICAO"
                    type    ="text"
                    class   ="form-control maskData"
                    value   = <?php echo convertDatasHorasBR($frota["DTAQUISICAO"]); ?>
                    >
                  </div>
            </div>

            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Valor de Venda</label>
                <input
                  id      ="VALOR_REVENDA"
                  name    ="VALOR_REVENDA"
                  type    ="text"
                  class   ="form-control maskMoney"
                  value="<?php echo htmlspecialchars( $frota["VALOR_REVENDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                >
              </div>
            </div>
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label bmd-label-floating"> Data de Venda</label>
                    <input
                    id      ="DTVENDA"
                    name    ="DTVENDA"
                    type    ="text"
                    class   ="form-control maskData"
                    value   = <?php echo convertDatasHorasBR($frota["DTVENDA"]); ?>
                    >
                  </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-2">
              Status do Veículo
              <select id="STATUS_VEICULO" name="STATUS_VEICULO" class="form-control" required="true">
                <option selected="<?php echo htmlspecialchars( $frota["COMBUSTIVEL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $frota["STATUS_VEICULO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <option value="">Selecione...</option>
                <option value="DISPONÍVEL">DISPONÍVEL</option>
                <option value="EM PERCURSO">EM PERCURSO</option>
                <option value="EM MANUTENÇÃO">EM MANUTENÇÃO</option>
                <option value="INTERDITADO">INTERDITADO</option>
                <option value="VENDIDO">VENDIDO</option>
              </select>
            </div>
          </div>
          <!-- end third level -->

          <br>
          <h3>Caçamba / Carroceria</h3>
          <br>
          <!-- fourth level -->
          <div class="row">
            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Caçamba 1</label>
                <input
                  id      ="CACAMBA1"
                  name    ="CACAMBA1"
                  type    ="text"
                  class   ="form-control maskPlacaCar caixa_alta"
                  value="<?php echo htmlspecialchars( $frota["CACAMBA1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                >
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating"> Caçamba 2</label>
                <input
                  id      ="CACAMBA2"
                  name    ="CACAMBA2"
                  type    ="text"
                  class   ="form-control maskPlacaCar caixa_alta"
                  value="<?php echo htmlspecialchars( $frota["CACAMBA2"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                >
              </div>
            </div>

          </div>
          <!-- end fourth level -->
          <!-- fifth level -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Observações</label>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating"></label>
                  <textarea id="OBS" name="OBS" class="form-control" rows="5"><?php echo htmlspecialchars( $frota["OBS"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <!-- fifth level -->
          <!-- sixth level -->
          <div class="row">
            <div class="col-md-6 text-left">
              <a class="btn" href="/admin/frota">
                <i class="material-icons">undo</i>
                <span class="sidebar-normal"> Voltar a lista de cliente</span>
              </a>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-success pull-right">
                <span class="btn-label">
                  <i class="material-icons">check</i>
                </span>
              Salvar
              </button>                     
            </div>
          </div>
          <!-- end sixth level -->

        </form>
      </div>
    </div>
  </div>
</div>

  
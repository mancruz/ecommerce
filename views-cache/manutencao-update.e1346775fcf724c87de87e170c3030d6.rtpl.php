<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["18"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<div class="content">

    <div class="col-md-12">
      <form role="form" action="/admin/manutencao/create" method="post">
        <input type="hidden" id="ID_MANUTENCE" name="ID_MANUTENCE" value = "<?php echo htmlspecialchars( $ID_MANUTENCE, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <!-- card personal data -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">perm_identity</i>
            </div>
            <h4 class="card-title">Dados
            </h4>
          </div>
          <div class="card-body">            
            <!-- first line -->
            <div class="row">
                <!-- Dates -->
                <div class="col-md-2">
                    <div class="form-group bmd-form-group">
                        Data Início
                        <input
                        id      ="DATE_MANUTENCE_START"
                        name    ="DATE_MANUTENCE_START"
                        type    ="text"
                        class   ="form-control maskData"
                        value   = <?php echo convertDatasHorasBR($manutencaoCavalo["DATE_MANUTENCE_START"]); ?>                        
                        required="true"
                        >
                      </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group bmd-form-group">
                      Data Fim
                      <input
                      id      ="DATE_MANUTENCE_FINISH"
                      name    ="DATE_MANUTENCE_FINISH"
                      type    ="text"
                      class   ="form-control maskData"
                      value   = <?php echo convertDatasHorasBR($manutencaoCavalo["DATE_MANUTENCE_FINISH"]); ?>
                      >
                    </div>
              </div>
              <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    Cavalo
                    <select
                      class="form-control selectpicker"
                      data-style="btn btn-link"
                      id="COD_VEICULO"
                      name="COD_VEICULO"
                      required
                      >
                      <option value ="">Selecione o veículo</option>
                      <?php $counter1=-1;  if( isset($listaVeiculos) && ( is_array($listaVeiculos) || $listaVeiculos instanceof Traversable ) && sizeof($listaVeiculos) ) foreach( $listaVeiculos as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1["COD_VEICULO"] == $manutencaoCavalo["COD_VEICULO"] ){ ?>
                          <option value="<?php echo htmlspecialchars( $value1["COD_VEICULO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["FABRICANTE"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["MODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php }else{ ?>
                          <option value="<?php echo htmlspecialchars( $value1["COD_VEICULO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["FABRICANTE"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["MODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>

                      <?php } ?>

                    </select>
                </div>
              </div>
              <div class="form-group col-md-2">
                Tipo de Manutenção
                <select
                  class="form-control selectpicker"
                  data-style="btn btn-link"
                  id="TIPO_MANUTENCAO"
                  name="TIPO_MANUTENCAO"
                  required="true"
                  >
                  <option value ="">Tipo de manutenção...</option>
                  <?php if( $manutencaoCavalo["TIPO_MANUTENCAO"] == 'CORRETIVA' ){ ?>
                    <option value="CORRETIVA" selected>CORRETIVA</option>
                    <option value="PREVENTIVA">PREVENTIVA</option>
                  <?php }else{ ?>
                    <option value="PREVENTIVA" selected>PREVENTIVA</option>
                    <option value="CORRETIVA">CORRETIVA</option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    KM Atual
                    <input
                    id      ="KM_ATUAL"
                    name    ="KM_ATUAL"
                    type    ="text"
                    class   ="form-control inputNumber"
                    required="true"
                    value   = "<?php echo htmlspecialchars( $manutencaoCavalo["KM_ATUAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    >
                  </div>
              </div>
            </div><!-- close row -->
            <div class="row"><!-- open row -->
              <div class="col-md-8">
                <div class="form-group bmd-form-group">
                    Estabelecimento
                    <input
                    id      ="LOCAL_MANUTENCAO"
                    name    ="LOCAL_MANUTENCAO"
                    type    ="text"
                    class   ="form-control"
                    value   = "<?php echo htmlspecialchars( $manutencaoCavalo["LOCAL_MANUTENCAO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    required="true"
                    >
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    Mecânico Responsável
                    <input
                    id      ="MECANICO_RESPONSAVEL"
                    name    ="MECANICO_RESPONSAVEL"
                    type    ="text"
                    class   ="form-control"
                    required="true"
                    value   = "<?php echo htmlspecialchars( $manutencaoCavalo["MECANICO_RESPONSAVEL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                    >
                  </div>
              </div>             
            </div><!-- close row -->
          </div>
          <br>
        </div>

        <!-- card de cadastro de Observações -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">attach_money</i>
            </div>
            <h4 class="card-title">Descrição da Manutenção
            </h4>
          </div>
          <div class="card-body">            
            <!-- card de cadastro de valores -->
            <div class="row">
              <div class="form-group col-md-3">
                <label for="STATUS">Status</label>
                <select
                  class="form-control selectpicker"
                  data-style="btn btn-link"
                  id="STATUS"
                  name="STATUS"
                  required="true"
                  >
                  <option value ="">Status da Manutenção...</option>
                  <?php if( $manutencaoCavalo["STATUS"] == 'Em Aberto' ){ ?>
                    <option value="Em Aberto" selected>Em Aberto</option>
                    <option value="Concluído">Concluído</option>
                  <?php }else{ ?>
                    <option value="Em Aberto">Em Aberto</option>
                    <option value="Concluído" selected>Concluído</option>
                  <?php } ?>
                </select>
              </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Descrição</label>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating"></label>
                  <textarea id="DESCRICAO_SERVICO" name="DESCRICAO_SERVICO" class="form-control" rows="5"><?php echo htmlspecialchars( $manutencaoCavalo["DESCRICAO_SERVICO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                </div>
              </div>
            </div>
          </div>
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
                <button class="btn btn-success pull-right">
                  <span class="btn-label">
                    <i class="material-icons">check</i>
                  </span>
                  Salvar
                </button>                     
                <a href="/admin/manutencao/<?php echo htmlspecialchars( $ID_MANUTENCE, ENT_COMPAT, 'UTF-8', FALSE ); ?>/item" class="btn btn-large btn-warning">
                  <i class="material-icons">assignment</i>&nbsp; Incluir Ítens
                </a>
              </div>
            </div>  
            </div>                       
          </div>
          <br>
        </div>
      </form>
    </div>
  
  </div>
  <?php } ?>
  
  
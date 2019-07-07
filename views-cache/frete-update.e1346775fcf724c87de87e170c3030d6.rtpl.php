<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["3"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<div class="content">

    <div class="col-md-12">
      <form role="form" action="/admin/frete/create" method="post">
        <input type="hidden" id="COD_FRETE" name="COD_FRETE" value = "<?php echo htmlspecialchars( $frete["COD_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
              <div class="col-md-6">
                  <label for="COD_FUNC">Motorista</label>
                  <select
                    class="form-control selectpicker"
                    data-style="btn btn-link"
                    id="COD_FUNC"
                    name="COD_FUNC"
                    required
                    >

                      <?php $counter1=-1;  if( isset($driver) && ( is_array($driver) || $driver instanceof Traversable ) && sizeof($driver) ) foreach( $driver as $key1 => $value1 ){ $counter1++; ?>
                         
                        <?php if( $value1["cod_func"] == $frete["COD_FUNC"] ){ ?>

                          <option value="<?php echo htmlspecialchars( $value1["cod_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        
                        <?php }else{ ?>
                        
                          <option value="<?php echo htmlspecialchars( $value1["cod_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        
                        <?php } ?>
                        
                      <?php } ?>

                  </select>
              </div>
              <!-- name of costumer-->
              <div class="col-md-6">
                  <label for="cod_func">Cliente</label>
                  <select
                    class="form-control selectpicker"
                    data-style="btn btn-link"
                    id="COD_CLI_FORN"
                    name="COD_CLI_FORN"
                    required
                    >
                      <?php $counter1=-1;  if( isset($clienteFrete) && ( is_array($clienteFrete) || $clienteFrete instanceof Traversable ) && sizeof($clienteFrete) ) foreach( $clienteFrete as $key1 => $value1 ){ $counter1++; ?>

                        <?php if( $value1["COD_CLI_FORN"] == $frete["COD_CLI_FORN"] ){ ?>
                          <option value="<?php echo htmlspecialchars( $value1["COD_CLI_FORN"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $value1["NOME"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php }else{ ?>
                          <option value="<?php echo htmlspecialchars( $value1["COD_CLI_FORN"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["NOME"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                        <?php } ?>
                      <?php } ?>
                  </select>
              </div>
            </div>
            <br>
            <!-- twenc line of first card-->
            <div class="row">
                <!-- KM going-->
                <div class="col-md-2">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label bmd-label-floating"> KM Sáida *</label>
                        <input  
                        id      = "KM_SAIDA"
                        name    = "KM_SAIDA"
                        type    = "text"
                        class   = "form-control inputNumber"
                        value   = "<?php echo htmlspecialchars( $frete["KM_SAIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                        required
                        
                        >
                      </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label bmd-label-floating"> KM Chegada *</label>
                        <input
                        id      ="KM_CHEGADA"
                        name    ="KM_CHEGADA"
                        type    ="text"
                        class   ="form-control inputNumber"
                        required
                        value   = "<?php echo htmlspecialchars( $frete["KM_CHEGADA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                        >
                      </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label bmd-label-floating"> Deslocamento</label>
                        <input
                        id      ="DESLOCAMENTO"
                        name    ="DESLOCAMENTO"
                        type    ="text"
                        class   ="form-control inputNumber"
                        disabled
                        value   = "<?php echo htmlspecialchars( $frete["DESLOCAMENTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                        >
                      </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label bmd-label-floating"> Peso Saída *</label>
                        <input
                        id      ="PESO_SAIDA"
                        name    ="PESO_SAIDA"
                        type    ="text"
                        class   ="form-control maskPeso"
                        required="true"
                        value   = <?php echo formatPeso($frete["PESO_SAIDA"]); ?>
                        >
                      </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label bmd-label-floating"> Peso Chegada *</label>
                        <input
                        id      ="PESO_CHEGADA"
                        name    ="PESO_CHEGADA"
                        type    ="text"
                        class   ="form-control maskPeso"
                        required="true"
                        value   = <?php echo formatPeso($frete["PESO_CHEGADA"]); ?>
                        >
                      </div>
                </div>

            </div>
            
          </div>
          <br>
        </div>
  
        <!-- card work data -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">event_seat</i>
            </div>
            <h4 class="card-title">Transporte
            </h4>
          </div>
          <div class="card-body">            
            <!-- first line -->
            <div class="row">
              <div class="col-md-4">
                <div class="form-group bmd-form-group">
                    Cavalo
                    <select
                      class="form-control selectpicker"
                      data-style="btn btn-link"
                      id="PLACA_CAVALO"
                      name="PLACA_CAVALO"
                      required
                      >

                        <?php $counter1=-1;  if( isset($freteCavalo) && ( is_array($freteCavalo) || $freteCavalo instanceof Traversable ) && sizeof($freteCavalo) ) foreach( $freteCavalo as $key1 => $value1 ){ $counter1++; ?>
                          <?php if( $value1["PLACA"] == $frete["PLACA_CAVALO"] ){ ?>
                            <option value="<?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["FABRICANTE"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["MODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                          <?php }else{ ?>
                            <option value="<?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["FABRICANTE"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["MODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                          <?php } ?>
                        <?php } ?>
                    </select>
                </div>
              </div>

              <div class="col-md-2">
                  <div class="form-group bmd-form-group">
                      Placa da Caçamba
                      <input
                      id      ="CACAMBA"
                      name    ="CACAMBA"
                      type    ="text"
                      class   ="form-control maskPlacaCar caixa_alta"
                      value   = "<?php echo htmlspecialchars( $frete["CACAMBA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                      >
                    </div>
              </div>
              
              <div class="col-md-2">
                  <div class="form-group bmd-form-group">
                      Data Carregamento
                      <input
                      id      ="DATA_CARREGAMENTO"
                      name    ="DATA_CARREGAMENTO"
                      type    ="text"
                      class   ="form-control maskData"
                      required
                      value   = <?php echo convertDatasHorasBR($frete["DATA_CARREGAMENTO"]); ?>
                      >
                    </div>
              </div>

              <div class="col-md-2">
                  <div class="form-group bmd-form-group">
                      Tipo de Frete
                      <input
                      id      ="TIPO_FRETE"
                      name    ="TIPO_FRETE"
                      type    ="text"
                      class   ="form-control"
                      value   = "<?php echo htmlspecialchars( $frete["TIPO_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                      >
                    </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group bmd-form-group">
                      CRTC
                      <input
                      id      ="CRTC"
                      name    ="CRTC"
                      type    ="text"
                      class   ="form-control"
                      value   = "<?php echo htmlspecialchars( $frete["CRTC"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                      >
                    </div>
              </div>


            </div>           
          </div>
          <br>
        </div>
  
        <!-- adreess data-->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">device_hub</i>
            </div>
            <h4 class="card-title">Endereço
            </h4>
          </div>
          <div class="card-body">
  
            <!-- first nivel -->
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                      <label class="bmd-label bmd-label-floating"> Local de Saída *</label>
                      <input
                      id      ="LOCAL_SAIDA"
                      name    ="LOCAL_SAIDA"
                      type    ="text"
                      class   ="form-control"
                      required="true"
                      value   = "<?php echo htmlspecialchars( $frete["LOCAL_SAIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                      
                      >
                    </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group bmd-form-group">
                      <label class="bmd-label bmd-label-floating"> Data de Saída *</label>
                      <input
                      id      ="DATA_SAIDA"
                      name    ="DATA_SAIDA"
                      type    ="text"
                      class   ="form-control maskData"
                      required="true"
                      value   = <?php echo convertDatasHorasBR($frete["DATA_SAIDA"]); ?>
                      
                      >
                    </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                      <label class="bmd-label bmd-label-floating"> Local de Chegada *</label>
                      <input
                      id      ="LOCAL_CHEGADA"
                      name    ="LOCAL_CHEGADA"
                      type    ="text"
                      class   ="form-control"
                      required="true"
                      value   = "<?php echo htmlspecialchars( $frete["LOCAL_CHEGADA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                      
                      >
                    </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group bmd-form-group">
                      <label class="bmd-label bmd-label-floating"> Data de Chegada *</label>
                      <input
                      id      ="DATA_CHEGADA"
                      name    ="DATA_CHEGADA"
                      type    ="text"
                      class   ="form-control maskData"
                      value   = <?php echo convertDatasHorasBR($frete["DATA_CHEGADA"]); ?>
                      >
                    </div>
              </div>

            </div>
            <br>
            <!-- third nivel --> 
          </div>
        </div>
  
        <!-- card de cadastro de valores -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">attach_money</i>
            </div>
            <h4 class="card-title">Valores
            </h4>
          </div>
          <div class="card-body">            
            <!-- card de cadastro de valores -->
            <div class="row">
              <div class="col-md-3">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label bmd-label-floating"> Adiantamento</label>
                  <input
                  id      ="ADIANTAMENTO"
                  name    ="ADIANTAMENTO"
                  type    ="text"
                  class   ="form-control maskMoney"
                  value   = <?php echo formatPrice($frete["ADIANTAMENTO"]); ?>
                  
                  >
                </div>                  
              </div>
              <div class="col-md-3">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label bmd-label-floating"> Preço Tonelada</label>
                  <input
                  id      ="PRECO_TONELADA"
                  name    ="PRECO_TONELADA"
                  type    ="text"
                  class   ="form-control maskMoney"
                  required
                  value   = <?php echo formatPrice($frete["PRECO_TONELADA"]); ?>                
                  >
                </div>                  
              </div>
  
            </div>                       
          </div>
          <br>
        </div>


        <!-- card de cadastro de Motorista -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">perm_contact_calendar</i>
            </div>
            <h4 class="card-title">Motorista
            </h4>
          </div>
          <div class="card-body">            

            <div class="row">
              <div class="col-md-3">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label bmd-label-floating"> Comissão %</label>
                  <input
                  id      ="COMISSAO"
                  name    ="COMISSAO"
                  type    ="text"
                  class   ="form-control maskPercent"
                  value   = <?php echo formatPercent($frete["COMISSAO"]); ?>
                  
                  >
                </div>                  
              </div>
              <div class="col-md-3">
                <div class="form-group bmd-form-group">
                  <label class="bmd-label bmd-label-floating"> Estadia %</label>
                  <input
                  id      ="ESTADIA"
                  name    ="ESTADIA"
                  type    ="text"
                  class   ="form-control maskPercent"
                  value   = <?php echo formatPercent($frete["ESTADIA"]); ?>
                                  
                  >
                </div>                  
              </div>
  
            </div>                       
          </div>
          <br>
        </div>
  
        <!-- card de cadastro de Observações -->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">attach_money</i>
            </div>
            <h4 class="card-title">Observações
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
                  <option value ="<?php echo htmlspecialchars( $frete["STATUS"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $frete["STATUS"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <option value="Em Processo">Em Processo</option>
                  <option value="Concluído">Concluído</option>
                </select>
              </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Observações</label>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating"></label>
                  <textarea id="OBS" name="OBS" class="form-control" rows="5"><?php echo htmlspecialchars( $frete["OBS"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                </div>
              </div>
            </div>
          </div>
  
            </div>                       
          </div>
          <br>
        </div>

        <!-- obs data-->
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">aspect_ratio</i>
            </div>
            <h4 class="card-title"> Somatória
            </h4>
          </div>
          <div class="card-body"> 
            
            <div class="row">
              <div class="col-md-3">
                <div class="form-group bmd-form-group">
                    <h3>Total Bruto</h3>
                    <input
                    id      ="txt_totalbruto"
                    name    ="txt_totalbruto"
                    type    ="text"
                    class   ="form-control maskMoney"
                    disabled
                    value = <?php echo formatPrice($freteTotais["TOTAL_BRUTO"]); ?>
                    >
                  </div>

                  <div class="form-group bmd-form-group">
                    <h3>Recebido</h3>
                    <input
                    id      ="txt_recebido"
                    name    ="txt_recebido"
                    type    ="text"
                    class   ="form-control maskMoney"
                    disabled
                    value = <?php echo formatPrice($freteTotais["TOTAL_RECEBIDO"]); ?>
                    >
                  </div>
                  <div class="form-group bmd-form-group">
                    <h3>Saldo</h3>
                    <input
                    id      ="txt_saldo"
                    name    ="txt_saldo"
                    type    ="text"
                    class   ="form-control maskMoney"
                    disabled
                    value = <?php echo formatPrice($freteTotais["SALDO"]); ?>
                    >
                  </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group bmd-form-group">
                  <h3>Impostos</h3>
                  <input
                  id      ="txt_imposto"
                  name    ="txt_imposto"
                  type    ="text"
                  class   ="form-control maskMoney"
                  disabled
                  value = <?php echo formatPrice($freteTotais["TOTAL_IMPOSTOS"]); ?>
                  >
                </div>

                <div class="form-group bmd-form-group">
                  <h3>Motorista</h3>
                  <input
                  id      ="txt_Motorista"
                  name    ="txt_Motorista"
                  type    ="text"
                  class   ="form-control maskMoney"
                  disabled
                  value = <?php echo formatPrice($freteTotais["TOTAL_MOTORISTA"]); ?>
                  >
                </div>
                <div class="form-group bmd-form-group">
                  <h3>Despesas</h3>
                  <input
                  id      ="txt_Despesas"
                  name    ="txt_Despesas"
                  type    ="text"
                  class   ="form-control maskMoney"
                  disabled
                  value = <?php echo formatPrice($freteTotais["TOTAL_DESPESAS"]); ?>
                  >
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group bmd-form-group">
                  <h3>Resultado</h3>
                  <input
                  id      ="txt_Resultado"
                  name    ="txt_Resultado"
                  type    ="text"
                  class   ="form-control maskMoney"
                  disabled
                  value = <?php echo formatPrice($freteTotais["RESULTADO"]); ?>
                  >
                </div>
            </div>
            </div>
             
            <!-- buttons of register -->
            <div class="row">
              <!-- button back -->
              <div class="col-md-3 text-left">
                <a class="btn" href="/admin/frete">
                  <i class="material-icons">undo</i>
                  <span class="sidebar-normal"> Voltar a lista de fretes</span>
                </a>
              </div>
              <!-- button save -->
              <div class="col-md-9 text-right">
                <button class="btn btn-success pull-right">
                  <span class="btn-label">
                    <i class="material-icons">check</i>
                  </span>
                  Atualizar
                </button>
                <a href="/admin/frete/imposto/<?php echo htmlspecialchars( $frete["COD_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-large btn-danger">
                  <i class="material-icons">thumb_down</i>&nbsp; Impostos
                </a>    
                <a href="/admin/frete/despesa/<?php echo htmlspecialchars( $frete["COD_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-large btn-warning">
                  <i class="material-icons">trending_down</i>&nbsp; Despesas
                </a> 
                <a href="/admin/frete/deposito/<?php echo htmlspecialchars( $frete["COD_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-large btn-info">
                    <i class="material-icons">trending_up</i>&nbsp; Depósitos
                  </a>                 
              </div>
            </div>
            <!-- /buttons of register -->

          </div>
        </div>
      </form>
    </div>
  
  </div>
  
  <?php }else{ ?>
  <div class="alert alert-danger" role="alert">
    <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
  </div>
<?php } ?>
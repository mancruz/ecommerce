<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["2"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<div class="content">

    <div class="col-md-12">
      <form role="form" action="/admin/frete/create" method="post">
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
                    <option value ="">Selecione o motorista...</option>
                      <?php $counter1=-1;  if( isset($driver) && ( is_array($driver) || $driver instanceof Traversable ) && sizeof($driver) ) foreach( $driver as $key1 => $value1 ){ $counter1++; ?>
                        <option value="<?php echo htmlspecialchars( $value1["cod_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
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
                    <option value ="">Selecione o cliente...</option>
                      <?php $counter1=-1;  if( isset($clienteFrete) && ( is_array($clienteFrete) || $clienteFrete instanceof Traversable ) && sizeof($clienteFrete) ) foreach( $clienteFrete as $key1 => $value1 ){ $counter1++; ?>
                        <option value="<?php echo htmlspecialchars( $value1["COD_CLI_FORN"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["NOME"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
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
                        id      ="KM_SAIDA"
                        name    ="KM_SAIDA"
                        type    ="text"
                        class   ="form-control inputNumber"
                        required="true"
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
                      <option value ="">Selecione o veículo</option>
                        <?php $counter1=-1;  if( isset($freteCavalo) && ( is_array($freteCavalo) || $freteCavalo instanceof Traversable ) && sizeof($freteCavalo) ) foreach( $freteCavalo as $key1 => $value1 ){ $counter1++; ?>
                          <option value="<?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["FABRICANTE"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["MODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
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
                  <option value ="">Status do frete...</option>
                  <option value="Em Processo">Em Processo</option>
                  <option value="Concluído">Concluído</option>
                  <option value="Cancelado">Cancelado</option>
                </select>
              </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Observações</label>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-floating"></label>
                  <textarea id="OBS" name="OBS" class="form-control" rows="5"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <!-- button back -->
              <div class="col-md-6 text-left">
                <a class="btn" href="/admin/frete">
                  <i class="material-icons">undo</i>
                  <span class="sidebar-normal"> Voltar a lista de fretes</span>
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
              </div>
            </div>  
            </div>                       
          </div>
          <br>
        </div>
      </form>
    </div>
  
  </div>
  
  <?php }else{ ?>
  <div class="alert alert-danger" role="alert">
    <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
  </div>
<?php } ?>
<?php if(!class_exists('Rain\Tpl')){exit;}?>
      <div class="content">

        <div class="col-md-12">
          <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">perm_identity</i>
                          </div>
                          <h4 class="card-title">Dados Pessoais
                          </h4>
                        </div>
                        <div class="card-body">
                          <form role="form" action="/admin/cliente-fornecedor/<?php echo htmlspecialchars( $clienteFornecedor["COD_CLI_FORN"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                            <input type="hidden" id="COD_CLI_FORN" name="COD_CLI_FORN" value = "<?php echo htmlspecialchars( $clienteFornecedor["COD_CLI_FORN"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            
                            <!-- first nivel -->
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label bmd-label-floating"> Nome *</label>
                                  <input
                                    id      ="NOME"
                                    name    ="NOME"
                                    type    ="text"
                                    class   ="form-control"
                                    required="true"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["NOME"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Razão Social *</label>
                                  <input
                                    id      ="RAZAO_SOCIAL"
                                    name    ="RAZAO_SOCIAL"
                                    type    ="text"
                                    class   ="form-control"
                                    required="true"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["RAZAO_SOCIAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                            </div>
                            <!-- second nivel -->
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Contato *</label>
                                  <input
                                    id      ="CONTATO"
                                    name    ="CONTATO"
                                    type    ="text"
                                    class   ="form-control"
                                    required="true"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["CONTATO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Tel Comercial *</label>
                                  <input
                                    id      ="TEL_COMER"
                                    name    ="TEL_COMER"
                                    type    ="text"
                                    class   ="form-control maskPhone"
                                    required="true"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["TEL_COMER"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Tel Fixo</label>
                                  <input
                                    id      ="TEL_FIXO"
                                    name    ="TEL_FIXO"
                                    type    ="text"
                                    class   ="form-control maskPhone"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["TEL_FIXO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
        
                                  >
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Tel Celular</label>
                                  <input
                                    id      ="TEL_CEL"
                                    name    ="TEL_CEL"
                                    type    ="text"
                                    class   ="form-control maskCellPhone"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["TEL_CEL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
        
                                  >
                                </div>
                              </div>
                            </div>
                            <!-- third nivel -->
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> RG</label>
                                  <input
                                    id      ="RG"
                                    name    ="RG"
                                    type    ="text"
                                    class   ="form-control maskRG"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["RG"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
        
                                  >
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> CPF</label>
                                  <input
                                    id      ="CPF"
                                    name    ="CPF"
                                    type    ="text"
                                    class   ="form-control maskCPF"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["CPF"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> E-mail</label>
                                  <input
                                    id      ="EMAIL"
                                    name    ="EMAIL"
                                    type    ="email"
                                    class   ="form-control"
                                    required="true"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["EMAIL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Data Nascimento</label>
                                  <input
                                    id      ="DATA_NASCIMENTO"
                                    name    ="DATA_NASCIMENTO"
                                    type    ="text"
                                    class   ="form-control maskData"
                                    value   ="<?php echo htmlspecialchars( $clienteFornecedor["DATA_NASCIMENTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
        
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Inscrição Estadual</label>
                                  <input
                                    id      ="INSCRICAO_ESTADUAL"
                                    name    ="INSCRICAO_ESTADUAL"
                                    type    ="text"
                                    class   ="form-control"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["INSCRICAO_ESTADUAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> CNPJ</label>
                                  <input
                                    id      ="CNPJ"
                                    name    ="CNPJ"
                                    type    ="text"
                                    class   ="form-control maskCNPJ"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["CNPJ"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Suframa</label>
                                  <input
                                    id      ="INSCRICAO_SUFRAMA"
                                    name    ="INSCRICAO_SUFRAMA"
                                    type    ="text"
                                    class   ="form-control"
                                    value="<?php echo htmlspecialchars( $clienteFornecedor["INSCRICAO_SUFRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-sm-4 col-sm-offset-1 checkbox-radios">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input
                                      type="checkbox"
                                      name = "ISENTO_ICMS"
                                      class="form-check-input"
                                      <?php if( $clienteFornecedor["ISENTO_ICMS"] == 1 ){ ?>checked<?php } ?>                                  
                                      
                                    > Isento ICMS
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-2">
                                <select id="TIPO_CADASTRO" name="TIPO_CADASTRO" class="form-control" required="true">
                                <option selected>
                                  <?php if( isset($clienteFornecedor["TIPO_CADASTRO"]) ){ ?> 
                                          
                                    <?php echo htmlspecialchars( $clienteFornecedor["TIPO_CADASTRO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                      
                                  <?php }else{ ?>
                                      
                                    Tipo de Cadastro...
                                      
                                  <?php } ?>
                                      
                              </option>
                                  
                                  <option>Cliente</option>
                                  <option>Fornecedor</option>
                                  <option>Cliente e Fornecedor</option>
                                </select>
                              </div>
        
                              <div class="form-group col-md-2">
                                <select id="STATUS" name="STATUS" class="form-control" required="true">
                                <option selected>
                                  <?php if( isset($clienteFornecedor["STATUS"]) ){ ?>

                                          <?php echo htmlspecialchars( $clienteFornecedor["STATUS"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                                      <?php }else{ ?>
                                      
                                          Status...
                                      <?php } ?>
                                      
                              </option>
                                  <option>Ativado</option>
                                  <option>Bloqueado</option>
                                  <option>Cancelado</option>
                                </select>
                              </div>
        
                            </div>
                            <br><h4>Endereço<h4>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Logradouro</label>
                                  <input
                                    id      ="LOGRADOURO"
                                    name    ="LOGRADOURO"
                                    type    ="text"
                                    class   ="form-control"
                                    value   = "<?php echo htmlspecialchars( $clienteFornecedor["LOGRADOURO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
        
                              <div class="col-md-1">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Número</label>
                                  <input
                                    id      ="NUMERO"
                                    name    ="NUMERO"
                                    type    ="text"
                                    class   ="form-control"
                                    value   = "<?php echo htmlspecialchars( $clienteFornecedor["NUMERO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
        
                              <div class="col-md-5">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Complemento</label>
                                  <input
                                    id      ="COMPLEMENTO"
                                    name    ="COMPLEMENTO"
                                    type    ="text"
                                    class   ="form-control"
                                    value   = "<?php echo htmlspecialchars( $clienteFornecedor["COMPLEMENTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>                               
                            </div>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> CEP</label>
                                  <input
                                    id      ="CEP"
                                    name    ="CEP"
                                    type    ="text"
                                    class   ="form-control maskCEP"
                                    value   = "<?php echo htmlspecialchars( $clienteFornecedor["CEP"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div> 
        
                              <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Bairro</label>
                                  <input
                                    id      ="BAIRRO"
                                    name    ="BAIRRO"
                                    type    ="text"
                                    class   ="form-control"
                                    value   = "<?php echo htmlspecialchars( $clienteFornecedor["BAIRRO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div> 
        
                              <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> Cidade</label>
                                  <input
                                    id      ="CIDADE"
                                    name    ="CIDADE"
                                    type    ="text"
                                    class   ="form-control"
                                    value   = "<?php echo htmlspecialchars( $clienteFornecedor["CIDADE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div>
                              <div class="col-md-1">
                                <div class="form-group bmd-form-group">
                                  <label class="bmd-label-floating"> UF</label>
                                  <input
                                    id      ="ESTADO"
                                    name    ="ESTADO"
                                    type    ="text"
                                    class   ="form-control maskUf"
                                    value   = "<?php echo htmlspecialchars( $clienteFornecedor["ESTADO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  >
                                </div>
                              </div> 
         
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Observações</label>
                                  <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating"></label>
                                    <textarea id="OBSERVACAO" name="OBSERVACAO" class="form-control" rows="5"><?php echo htmlspecialchars( $clienteFornecedor["OBSERVACAO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 text-left">
                                <a class="btn" href="/admin/cliente-fornecedor">
                                  <i class="material-icons">undo</i>
                                  <span class="sidebar-normal"> Voltar a lista de cliente</span>
                                </a>
                              </div>
                              <div class="col-md-6 text-right">
                                <button class="btn btn-success pull-right">
                                  <span class="btn-label">
                                    <i class="material-icons">check</i>
                                  </span>
                                Atualizar
                                </button>                     
                              </div>
        
                            </div>
        
                          </form>
                        </div>
          </div>
        </div>
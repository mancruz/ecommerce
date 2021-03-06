<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["8"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>

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
                    <form role="form" action="/admin/cliente-fornecedor/create" method="post">
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
                              autofocus
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
                            >
                          </div>
                        </div>
                        <div class="col-sm-4 col-sm-offset-1 checkbox-radios">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input
                                id = "ISENTO_ICMS"
                                name = "ISENTO_ICMS"
                                type="checkbox"
                                class="form-check-input"
                                value= 
  
                                
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
                            <option selected="">Tipo de Cadastro...</option>
                            <option>Cliente</option>
                            <option>Fornecedor</option>
                            <option>Cliente e Fornecedor</option>
                          </select>
                        </div>
  
                        <div class="form-group col-md-2">
                          <select id="STATUS" name="STATUS" class="form-control" required="true">
                            <option selected="">Status...</option>
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
                              <textarea id="OBSERVACAO" name="OBSERVACAO" class="form-control" rows="5"></textarea>
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
                          Salvar
                          </button>                     
                        </div>
  
                      </div>
  
  
                    </form>
                  </div>
    </div>
  </div>
<?php }else{ ?>
<div class="alert alert-danger" role="alert">
  <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
</div>  
<?php } ?>
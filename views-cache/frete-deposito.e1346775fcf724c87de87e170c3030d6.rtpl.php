<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["6"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<div class="content">

  <div class="col-md-12">
    <div class="card">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">event_seat</i>
                    </div>
                    <h4 class="card-title">Cadastro de Impostos do Frete
                    </h4>
                  </div>
                  <div class="card-body">
                    <form role="form" action="/admin/frete/deposito/create" method="post">
                      <input type="hidden" id="COD_FRETE" name="COD_FRETE" value = "<?php echo htmlspecialchars( $frete, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <!-- first nivel -->
                      <div class="row">
                        <div class="form-group col-md-2">
                            Data
                            <input
                                type="text"
                                class="form-control calendario"
                                id="DATA_DEPOSITO"
                                name="DATA_DEPOSITO"
                            >
                        </div>
                        <div class="form-group col-md-6">
                            Descrição
                            <input
                                type="text"
                                class="form-control"
                                id="OBS"
                                name="OBS"
                            >
                        </div>
          
                        <div class="col-md-2">
                            <div class="form-group bmd-form-group">
                                Valor
                                <input
                                id      ="VALOR"
                                name    ="VALOR"
                                type    ="text"
                                class   ="form-control maskMoney"
                                >
                              </div>
                        </div>
                        <div class="col-md-2 text-right">
                          <button class="btn btn-success pull-right">
                            <span class="btn-label">
                              <i class="material-icons">library_books</i>
                            </span>
                          Adicionar
                          </button>                     
                        </div>
                        
                      </div> 
                      <br>
                    </form>
                      <div class="row">
                        <div class="col-sm-8">
                          <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <thead>
                              <tr role="row">
                                <th>Data</th>
                                <th>Descrição Desósito</th>
                                <th>Valor</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $counter1=-1;  if( isset($freteDeposito) && ( is_array($freteDeposito) || $freteDeposito instanceof Traversable ) && sizeof($freteDeposito) ) foreach( $freteDeposito as $key1 => $value1 ){ $counter1++; ?>
                              <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1"><?php echo converterDatas($value1["DATA_DEPOSITO"]); ?></td>
                                <td><?php echo htmlspecialchars( $value1["OBS"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo formatPrice($value1["VALOR"]); ?></td>

                                <td class="text-right">
                                  <a href="/admin/frete/deposito/<?php echo htmlspecialchars( $value1["COD_DEPOSITO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" class="btn btn-link btn-danger btn-just-icon remove">
                                    <i class="material-icons">clear</i>
                                  </a>
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <a class="btn" href="/admin/frete/<?php echo htmlspecialchars( $frete, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            <i class="material-icons">undo</i>
                            <span class="sidebar-normal"> Voltar ao frete</span>
                          </a>
                        </div>

  
                      </div>
  
  
                    
                  </div>

                          <!-- card work data -->
    </div>

    
  </div>
</div>

<?php }else{ ?>
  <div class="alert alert-danger" role="alert">
    <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
  </div>
<?php } ?> 
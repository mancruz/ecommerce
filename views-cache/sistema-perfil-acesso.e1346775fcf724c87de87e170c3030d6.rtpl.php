<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["26"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<div class="content">

  <div class="col-md-12">
    
      <div class="card">
  
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">important_devices</i>
            </div>
      
      
          <h4 class="card-title">Lista de Páginas do Sistema Para Controle</h4>
        </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            
            <form role="form" action="/admin/sistema-perfil-acesso/<?php echo htmlspecialchars( $idPerfil, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST">
            <div class="material-datatables">
              <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                      <thead>
                        <tr role="row">
                          <th>Página</th>
                          <th>Visualizar</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                            <?php $counter1=-1;  if( isset($perfilAcesso) && ( is_array($perfilAcesso) || $perfilAcesso instanceof Traversable ) && sizeof($perfilAcesso) ) foreach( $perfilAcesso as $key1 => $value1 ){ $counter1++; ?>
                            
                            <tr role="row" class="odd">
                              <td tabindex="0" class="sorting_1"><?php echo utf8_encode($value1["Nome_Formulario"]); ?></td>
                              <td>
                                <select
                                  id="visualizar<?php echo htmlspecialchars( $value1["COD_LINK_FORM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  name="visualizar<?php echo htmlspecialchars( $value1["COD_LINK_FORM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                  class="form-control selectpicker"
                                  data-style="btn btn-link"
                                  >
                                  <option value="<?php echo htmlspecialchars( $value1["PERMISSAO_VISUALIZAR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $value1["PERMISSAO_VISUALIZAR"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                      <?php if( $value1["PERMISSAO_VISUALIZAR"] == 'SIM' ){ ?>
                                        <option value = "NAO">NÃO</option>
                                      <?php }else{ ?>
                                        <option value = "SIM">SIM</option>
                                      <?php } ?>
                                </select>        
                              </td>
                            </tr>
                          
                            <?php } ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 text-left">
                    <a class="btn" href="/admin/sistema-perfil">
                      <i class="material-icons">undo</i>
                      <span class="sidebar-normal"> Voltar a lista de perfis</span>
                    </a>
                  </div>
                  <div class="col-md-6 text-right">
                    <button class="btn btn-success pull-right">
                      <span class="btn-label">
                        <i class="material-icons">save</i>
                      </span>
                    Salvar
                    </button>  
                  </div>
              </div>
            </form>
            </div>
          </div>
        </div>
        <!-- end content-->
        </div>
  <!--  end card  -->
  </div>
</div>
<?php }else{ ?>
  <div class="alert alert-danger" role="alert">
    <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
  </div>
<?php } ?>
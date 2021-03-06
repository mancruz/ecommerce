<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["24"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<div class="content">

  <div class="col-md-12">
    <div class="card">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">important_devices</i>
                    </div>
                    <h4 class="card-title">Lista de Perfil
                    </h4>
                  </div>
                  <div class="card-body">
                    <form role="form" action="/admin/sistema-perfil/create" method="post">
                      <!-- first nivel -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Perfil</label>
                            <input
                              id      ="PERFIL"
                              name    ="PERFIL"
                              type    ="text"
                              class   ="form-control"
                              required
                              autofocus
                            >
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Descrição</label>
                            <input
                              id      ="OBS"
                              name    ="OBS"
                              type    ="text"
                              class   ="form-control"
                              required
                            >
                          </div>
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
</div>

<?php }else{ ?>
  <div class="alert alert-danger" role="alert">
    <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
  </div>
<?php } ?>
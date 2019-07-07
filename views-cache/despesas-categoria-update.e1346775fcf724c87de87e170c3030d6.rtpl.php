<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="content">

  <div class="col-md-12">
    <div class="card">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">event_seat</i>
                    </div>
                    <h4 class="card-title">Dados da Categoria
                    </h4>
                  </div>
                  <div class="card-body">
                    <form role="form" action="/admin/despesas-categoria/create" method="post">
                      <input type="hidden" id="COD_DESP_FRET_CAT" name="COD_DESP_FRET_CAT" value = "<?php echo htmlspecialchars( $despesa["COD_DESP_FRET_CAT"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <!-- first nivel -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Despesa</label>
                            <input
                              id      ="DESPESA"
                              name    ="DESPESA"
                              type    ="text"
                              class   ="form-control"
                              value   ="<?php echo htmlspecialchars( $despesa["DESPESA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                              required
                              autofocus
                            >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 text-left">
                          <a class="btn" href="/admin/despesas-categoria">
                            <i class="material-icons">undo</i>
                            <span class="sidebar-normal"> Voltar a lista de despesas</span>
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
</div>

  
<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="content">

  <div class="col-md-12">
    <div class="card">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">event_seat</i>
                    </div>
                    <h4 class="card-title">Categoria de Despesa
                    </h4>
                  </div>
                  <div class="card-body">
                    <form role="form" action="/admin/despesas-categoria/create" method="post">
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
                          Salvar
                          </button>                     
                        </div>
  
                      </div>
  
  
                    </form>
                  </div>
               
    </div>
  </div>
</div>

  
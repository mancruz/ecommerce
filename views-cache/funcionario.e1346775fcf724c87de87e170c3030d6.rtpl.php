<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["20"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<script type="text/javascript">

function confirmCancel(id){
    Swal.fire({
    title: 'Você tem certeza?',
    text: "Você deseja cancelar o registro do funcionário " + id + "?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, cancele!',
    cancelButtonText: 'Não!'
  }).then((result) => {
    if (result.value) {
      Swal.fire(
        'Cancelado!',
        'O registgro foi cancelado com sucesso!',
        'success'
      )
      window.location.href = "/admin/funcionario/" + id + "/cancel";
    }
  })
  }

</script>

<div class="content">

  <div class="col-md-12">
  
  <div class="card">

    <div class="card-header card-header-primary card-header-icon">
      <div class="card-icon">
        <i class="material-icons">assignment</i>
      </div>


    <h4 class="card-title">Lista de Funcionário</h4>
  </div>
    <div class="card-body">
      <div class="toolbar">
        <!--        Here you can write extra buttons/actions for the toolbar              -->
        <div class="text-right">
          <a class="btn btn-primary btn-round" href="/admin/funcionario/create">
            <i class="material-icons">add</i>
            <span class="sidebar-normal"> Novo... </span>
          </a>
        </div>
      </div>
      <div class="material-datatables">
        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <form action="/admin/funcionario">
          <div class="row">
            <div class="col-md-6">
              <div class="dataTables_length" id="datatables_length">
                <label>Exibir 
                  <select name="itensPerPage" name="itensPerPage" aria-controls="datatables" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="<?php echo htmlspecialchars( $itensPerPage, ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $itensPerPage, ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <option value="2">2</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="50">100</option>
                  </select> registros
                </label>
               <div class="input-group no-border">
                <input type="text" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="search" class="form-control" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
              </div>
            </div>

          </div>
          </form>
          <div class="row">
            <div class="col-sm-12">
              <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                <thead>
                  <tr role="row">
                    <th>Nome</th>
                    <th>Tel. Fixo</th>
                    <th>Tel. Celular</th>
                    <th>Tel. Emergência</th>
                    <th>E-mail</th>
                    <th class="text-center">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($funcionario) && ( is_array($funcionario) || $funcionario instanceof Traversable ) && sizeof($funcionario) ) foreach( $funcionario as $key1 => $value1 ){ $counter1++; ?>
                  <tr role="row" class="odd">
                    <td tabindex="0" class="sorting_1"><?php echo htmlspecialchars( $value1["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["telefone_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["telefone_cel_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["TEL_CEL_EMERGENCIA_FUNC"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["email_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td class="text-right">
                      <a href="/admin/funcionario/<?php echo htmlspecialchars( $value1["cod_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-link btn-warning btn-just-icon edit">
                        <i class="material-icons">dvr</i>
                      </a>
                      <a href="#" onclick="confirmCancel('<?php echo htmlspecialchars( $value1["cod_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- pagination -->
          <div class="row">
            <div class="col-sm-12 col-md-5">
              <div class="dataTables_info" id="datatables_info" role="status" aria-live="polite">
                Exibindo <?php echo htmlspecialchars( $currentPage, ENT_COMPAT, 'UTF-8', FALSE ); ?> para <?php echo htmlspecialchars( $itensPerPage, ENT_COMPAT, 'UTF-8', FALSE ); ?> de <?php echo htmlspecialchars( $totalRegister, ENT_COMPAT, 'UTF-8', FALSE ); ?> registros
              </div>
            </div>
              <div class="col-xs-12 col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="dom-jqry_paginate">
                  <ul class="pagination">
                    
                    <?php if( $currentPage > 1 ){ ?>
                      <li class="paginate_button page-item  previous" id="dom-jqry_previous">
                        <a href="<?php echo htmlspecialchars( $firstPage, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="0" tabindex="0" class="page-link">Primeiro</a>
                      </li>
                      <li class="paginate_button page-item previous" id="dom-jqry_previous">
                        <a href="<?php echo htmlspecialchars( $pagePreview, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="0" tabindex="0" class="page-link">Anterior</a>
                      </li>
                    <?php }else{ ?>
                      <li class="paginate_button page-item  previous disabled" id="dom-jqry_previous">
                        <a href="<?php echo htmlspecialchars( $firstPage, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="0" tabindex="0" class="page-link">Primeiro</a>
                      </li>
                      <li class="paginate_button page-item previous disabled" id="dom-jqry_previous">
                        <a href="<?php echo htmlspecialchars( $pagePreview, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="0" tabindex="0" class="page-link">Anterior</a>
                      </li>
                    <?php } ?>

                    <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                      
                      <?php if( $currentPage == $value1["text"] ){ ?>
                        <li class="paginate_button page-item  active">
                          <a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="1" tabindex="0" class="page-link"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                        </li>
                      <?php }else{ ?>
                        <li class="paginate_button page-item">
                          <a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="1" tabindex="0" class="page-link"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                        </li>
                      <?php } ?>
                    <?php } ?>
                    
                    <?php if( $currentPage == $totalPages ){ ?>
                      <li class="paginate_button page-item next disabled" id="dom-jqry_next">
                        <a href="#" aria-controls="dom-jqry" data-dt-idx="3" tabindex="0" class="page-link">Próximo</a>
                      </li>
                      <li class="paginate_button page-item next disabled" id="dom-jqry_next">
                        <a href="#" aria-controls="dom-jqry" data-dt-idx="3" tabindex="0" class="page-link">Último</a>
                      </li>
                    <?php }else{ ?>
                    <li class="paginate_button page-item next" id="dom-jqry_next">
                      <a href="<?php echo htmlspecialchars( $pageNext, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="3" tabindex="0" class="page-link">Próximo</a>
                    </li>
                    <li class="paginate_button page-item next" id="dom-jqry_next">
                      <a href="<?php echo htmlspecialchars( $lastPage, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-controls="dom-jqry" data-dt-idx="3" tabindex="0" class="page-link">Último</a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
          </div>
          <!-- end pagination -->
        </div>
      </div>
    </div>
  </div>
  <!-- end content-->
  </div>
<!--  end card  -->
</div>
<?php }else{ ?>
<div class="alert alert-danger" role="alert">
  <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
</div>
<?php } ?>
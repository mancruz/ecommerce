<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["16"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>
<script type="text/javascript">

function confirmDelete2(id) {

  swal({
    title: "Detele!",
    text: "Registro deletado com sucesso! ",
    type: "success"
 }).then(okay => {
   if (okay) {
    window.location.href = "/admin/manutencao/" + id + "/cancel";
  }
});
		
}
</script>

<div class="content">

  <div class="col-md-12">
  
  <div class="card">

    <div class="card-header card-header-primary card-header-icon">
      <div class="card-icon">
        <i class="material-icons">assignment</i>
      </div>


    <h4 class="card-title">Lista de Manutenções</h4>
  </div>
    <div class="card-body">
      <div class="toolbar">
        <!--        Here you can write extra buttons/actions for the toolbar              -->
        <div class="text-right">
          <a class="btn btn-primary btn-round" href="/admin/manutencao/create">
            <i class="material-icons">add</i>
            <span class="sidebar-normal"> Novo... </span>
          </a>
        </div>
      </div>
      <div class="material-datatables">
        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <form action="/admin/manutencao">
            <div class="row">
                <div class="form-group col-md-3" id="datatables_length">
                
                    <select name="itensPerPage" name="itensPerPage" data-style="btn btn-link" class="form-control selectpicker">
                        <option value="<?php echo htmlspecialchars( $itensPerPage, ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected> Exibir <?php echo htmlspecialchars( $itensPerPage, ENT_COMPAT, 'UTF-8', FALSE ); ?> registros</option>
                        <option value="10"> Exibir 10 registros</option>
                        <option value="25"> Exibir 25 registros</option>
                        <option value="50"> Exibir 50 registros</option>
                        <option value="50"> Exibir 100 registros</option>
                      </select>
                
              </div>
                <div class="form-group col-md-2">
                    <label for="inputdataini">Período de</label>
                    <input type="text" class="form-control calendario" id="inputdataini" name="inputdataini" value="<?php echo htmlspecialchars( $DataDe, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
  
                  <div class="form-group col-md-2">
                    <label for="inputdatafim">até</label>
                    <input type="text" class="form-control calendario" id="inputdatafim" name="inputdatafim" value="<?php echo htmlspecialchars( $DataAte, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
            </div>
          <div class="row">

            
              <span class="bmd-form-group  col-md-7">
                <div class="input-group no-border">
                  <input type="text" value="<?php echo htmlspecialchars( $search, ENT_COMPAT, 'UTF-8', FALSE ); ?>" name="search" class="form-control" placeholder="Pesquisar...">
                  <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                  </button>
                </div>
              </span>


          </div>
          </form>
          <div class="row">
            <div class="col-sm-12">
              <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                <thead>
                  <tr role="row">
                    <th>Data</th>
                    <th>Placa</th>
                    <th>Fabricante</th>
                    <th>Veículo</th>
                    <th>Manutenção</th>
                    <th>Status</th>
                    <th class="text-right">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($manutencao) && ( is_array($manutencao) || $manutencao instanceof Traversable ) && sizeof($manutencao) ) foreach( $manutencao as $key1 => $value1 ){ $counter1++; ?>
                  <tr role="row" class="odd">
                    <td tabindex="0" class="sorting_1"><?php echo convertDatasHorasBR($value1["DATE_MANUTENCE_START"]); ?></td>
                      <td><?php echo htmlspecialchars( $value1["PLACA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["FABRICANTE"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["MODELO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["TIPO_MANUTENCAO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td><?php echo htmlspecialchars( $value1["STATUS"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <?php if( $drawMenu["16"]['PERMISSAO_EDITAR']== 'SIM' ){ ?>  
                    <td class="text-right">
                      <a href="/admin/manutencao/<?php echo htmlspecialchars( $value1["ID_MANUTENCE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-link btn-warning btn-just-icon edit">
                        <i class="material-icons">dvr</i>
                      </a>
                      <!--<a href="#" onclick="confirmDelete2('<?php echo htmlspecialchars( $value1["ID_MANUTENCE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>')" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>-->
                    </td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- pagination -->
          <div class="row">
            <div class="col-xs-5 col-sm-5 col-md-5">
              <div class="dataTables_info" id="datatables_info" role="status" aria-live="polite">
                Exibindo <?php echo htmlspecialchars( $currentPage, ENT_COMPAT, 'UTF-8', FALSE ); ?> para <?php echo htmlspecialchars( $itensPerPage, ENT_COMPAT, 'UTF-8', FALSE ); ?> de <?php echo htmlspecialchars( $totalRegister, ENT_COMPAT, 'UTF-8', FALSE ); ?> registros
              </div>
            </div>
              <div class="col-xs-7 col-sm-7 col-md-7">
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
<?php } ?>
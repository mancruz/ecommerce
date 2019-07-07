<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/res/admin/material/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/res/admin/material/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SGF | Sistema para Genrenciamento de Frotas
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro" />
  <!--  Social tags      -->
  <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, material dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, material design, material dashboard bootstrap 4 dashboard">
  <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Material Dashboard PRO by Creative Tim">
  <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim">
  <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Material Dashboard PRO by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg" />
  <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design." />
  <meta property="og:site_name" content="Creative Tim" />
  <!--     Fonts and icons      
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  -->

  <link rel="stylesheet" type="text/css" href="/res/admin/material/assets/css/Roboto.css" />
  <link rel="stylesheet" href="/res/admin/material/assets/css/font-awesome.min.css">

  <!-- CSS Files -->
  <link href="/res/admin/material/assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/res/admin/material/assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

  
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
      -->
      <div class="logo">
        <a href="/admin" class="simple-text logo-normal">
          SGF Expert
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          
          <!-- menu dashboard -->
          <?php if( $drawMenu["0"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
          <?php if( $menuOption == 'admin' ){ ?>
            <li class="nav-item active">
          <?php }else{ ?>
            <li class="nav-item ">
          <?php } ?>
              <a class="nav-link" href="/admin">
                <i class="material-icons">dashboard</i>
                <p> Dashboard </p>
              </a>
            </li>
          <?php } ?>
          <!-- fecha menu dashboard -->

          <!-- menu Controle de Frete -->
          <?php if( $drawMenu["1"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
          <?php if( $menuOption == 'ControleDeFrete' ){ ?>
          <li class="nav-item active">
          <?php }else{ ?>
          <li class="nav-item ">
          <?php } ?>
            <a class="nav-link" href="/admin/frete">
              <i class="material-icons">event_seat</i>
              <p> Controle de Frete </p>
            </a>
          </li>
          <?php } ?>
          <!-- fecha menu Controle de Frete -->
          
          <!-- menu Cadastro -->
          <?php if( $menu == 'Cadastros' ){ ?>
            <li class="nav-item active">
          <?php }else{ ?>
            <li class="nav-item ">
          <?php } ?>

              <?php if( $menu == 'Cadastros' ){ ?>
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples" aria-expanded="true">
              <?php }else{ ?>
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples" aria-expanded="false">
              <?php } ?>
                  <i class="material-icons">work_outline</i>
                  <p> Cadastros
                    <b class="caret"></b>
                  </p>
                </a>
                
                <?php if( $menu == 'Cadastros' ){ ?>
                  <div class="collapse show" id="pagesExamples">
                <?php }else{ ?>
                  <div class="collapse" id="pagesExamples">
                <?php } ?>
                    <ul class="nav">
                      
                      <!-- initiates the client option -->
                      <?php if( $drawMenu["2"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
                      <?php if( $menuOption == 'cliente' ){ ?>
                        <li class="nav-item active">
                      <?php }else{ ?>
                        <li class="nav-item ">
                      <?php } ?>
                          <a class="nav-link" href="/admin/cliente-fornecedor">
                            <span class="sidebar-mini"> CF </span>
                            <span class="sidebar-normal"> Clientes e Fornecedores </span>
                          </a>
                        </li>
                      <?php } ?>
                      <!-- ends the client option -->
                      
                      <!-- initiates the vehicle option -->
                      <?php if( $drawMenu["3"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
                        <?php if( $menuOption == 'Frota' ){ ?>
                          <li class="nav-item active">
                        <?php }else{ ?>
                          <li class="nav-item ">
                        <?php } ?>
                          <a class="nav-link" href="/admin/frota">
                            <span class="sidebar-mini"> V </span>
                            <span class="sidebar-normal"> Veículos </span>
                          </a>
                        </li>
                        <?php } ?>
                        <!-- ends the vehicle option -->

                        <!-- initiates the expense category -->
                        <?php if( $drawMenu["4"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
                        <?php if( $menuOption == 'CategoriaDespesa' ){ ?>
                          <li class="nav-item active">
                        <?php }else{ ?>
                        <li class="nav-item ">
                        <?php } ?>
                          <a class="nav-link" href="/admin/despesas-categoria">
                            <span class="sidebar-mini"> CD </span>
                            <span class="sidebar-normal"> Categoria de Despesas </span>
                          </a>
                        </li>
                        <?php } ?>
                        <!-- ends the expense category -->
                        
                      </ul>
                    </div>
          <!-- fecha menu Cadastro -->

          <!-- initiates the fleet management menu -->
          <?php if( $drawMenu["16"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
          <?php if( $menu == 'GestaoDeFrota' ){ ?>
          <li class="nav-item active">
        <?php }else{ ?>
          <li class="nav-item ">
        <?php } ?>

            <?php if( $menu == 'GestaoDeFrota' ){ ?>
              <a class="nav-link" data-toggle="collapse" href="#GestaoDeFrota" aria-expanded="true">
            <?php }else{ ?>
              <a class="nav-link" data-toggle="collapse" href="#GestaoDeFrota" aria-expanded="false">
            <?php } ?>
                <i class="material-icons">commute</i>
                <p> Gestão de Frota
                  <b class="caret"></b>
                </p>
              </a>
              

              <?php if( $menu == 'GestaoDeFrota' ){ ?>
                <div class="collapse show" id="GestaoDeFrota">
              <?php }else{ ?>
                <div class="collapse" id="GestaoDeFrota">
              <?php } ?>
                  <ul class="nav">
                    
                    <!-- initiates the maintance option -->
                    <?php if( $drawMenu["16"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
                      <?php if( $menuOption == 'Manutencao' ){ ?>
                        <li class="nav-item active">
                      <?php }else{ ?>
                        <li class="nav-item ">
                      <?php } ?>
                          <a class="nav-link" href="/admin/manutencao">
                            <span class="sidebar-mini"> M </span>
                            <span class="sidebar-normal"> Manutenção </span>
                          </a>
                        </li>
                    <?php } ?>
                    <!-- ends the maintance option -->
                      
                  </ul>
                  </div>
              <?php } ?>
              <!-- ends the fleet management menu -->



          <!-- fecha Gestão de Frota -->
                    
          <!-- initiate RH menu -->
          <?php if( $drawMenu["6"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
          <?php if( $menu == 'RH' ){ ?>
          <li class="nav-item active">
          <?php }else{ ?>
          <li class="nav-item ">
          <?php } ?>
            
            <?php if( $menu == 'RH' ){ ?>
              <a class="nav-link" data-toggle="collapse" href="#formsExamples" aria-expanded="true">
            <?php }else{ ?>
              <a class="nav-link" data-toggle="collapse" href="#formsExamples" >
            <?php } ?>
              <i class="material-icons">content_paste</i>
              <p> RH
                <b class="caret"></b>
              </p>
            </a>

            <?php if( $menuOption == 'RH' ){ ?>
            <div class="collapse show" id="formsExamples">
            <?php }else{ ?>
            <div class="collapse" id="formsExamples">
            <?php } ?>
              <ul class="nav">

                <!-- initiate the employee option -->
                <?php if( $drawMenu["6"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
                  <?php if( $menuOption == 'Funcionários' ){ ?>
                  <li class="nav-item active">
                  <?php }else{ ?>
                  <li class="nav-item">
                  <?php } ?>
                  <a class="nav-link" href="/admin/funcionario">
                    <span class="sidebar-mini"> F </span>
                    <span class="sidebar-normal"> Funcionários </span>
                  </a>
                </li>
                <?php } ?>
                <!-- ends the employee option -->
              </ul>

            </div>
            <?php } ?>
 
          <!-- ends RH menu -->



          <!-------------------------------------------------->

          <!-- menu Configurações -->
          <?php if( $menuOption == 'SistemaPerfil' ){ ?>
          <li class="nav-item active">
          <?php }else{ ?>
          <li class="nav-item ">
          <?php } ?>
            
            <?php if( $menuOption == 'SistemaPerfil' ){ ?>
              <a class="nav-link" data-toggle="collapse" href="#formsPerfil" aria-expanded="true">
            <?php }else{ ?>
              <a class="nav-link" data-toggle="collapse" href="#formsPerfil" >
            <?php } ?>
              <i class="material-icons">settings</i>
              <p> Configurações
                <b class="caret"></b>
              </p>
            </a>

            <?php if( $menuOption == 'SistemaPerfil' ){ ?>
            <div class="collapse show" id="formsPerfil">
            <?php }else{ ?>
            <div class="collapse" id="formsPerfil">
            <?php } ?>
              <ul class="nav">
                  <?php if( $menuOption == 'SistemaPerfil' ){ ?>
                <li class="nav-item active">
                  <?php }else{ ?>
                  <li class="nav-item">
                  <?php } ?>
                  <a class="nav-link" href="/admin/sistema-perfil">
                    <span class="sidebar-mini"> F </span>
                    <span class="sidebar-normal"> Perfil do Sistema </span>
                  </a>
                </li>
              </ul>
            </div>

          <!-- fecha menu Configurações -->


          </ul>
                </div>
    </div>
      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                  <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                  <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
              </div>
              <a class="navbar-brand" href="#pablo"><?php echo htmlspecialchars( $titlePage, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            
            
            <div class="collapse navbar-collapse justify-content-end">

              <ul class="navbar-nav">
                <?php if( $drawMenu["0"]['PERMISSAO_VISUALIZAR'] == 'SIM' ){ ?>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <p class="d-lg-none d-md-block">
                      Some Actions
                    </p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" aria-labelledby="navbarDropdownMenuLink"" href="#">Ano Base para o Dashboard</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#resumoFinanFrete" aria-labelledby="navbarDropdownMenuLink"" href="#">Resumo financeiro de Fretes</a>
                  </div>
                </li>
                <?php } ?>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">person</i>
                    <p class="d-lg-none d-md-block">
                      Account
                    </p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                    <a class="dropdown-item" href="/admin/trocar-senha">Trocar senha</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/admin/logout">Log out</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>                
        <!-- End Navbar -->

        <!-- Modal to dashboard-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ano Base para o DashBoard</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" action="/admin"</form>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label bmd-label-floating"> Ano de Pesquisa</label>
                            <input
                            id      ="inputYear"
                            name    ="inputYear"
                            type    ="text"
                            class   ="form-control"
                            value   ="<?php echo htmlspecialchars( $anoBaseDashBoard, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            required="true"
                            >
                          </div>
                        </div>
                    </div>
                    <br>
                    <p>Selecione o ano para ser exibido no dashboard</p>
              </div>




              <div class="modal-footer">

                  <button class="btn btn-success pull-right">
                      <span class="btn-label">
                        <i class="material-icons">search</i>
                      </span>
                      Pesquisar
                    </button>  
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Modal Year Base to Dashboard -->

        <!-- Modal  to generate PDF-->
        <div class="modal fade" id="resumoFinanFrete" tabindex="-1" role="dialog" aria-labelledby="resumoFinanFreteLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="resumoFinanFreteLabel">Selecionae um Peíodo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" action="/admin/resumo-fretes"</form>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label bmd-label-floating"> Data Inicial *</label>
                            <input
                            id      ="inputdataini"
                            name    ="inputdataini"
                            type    ="text"
                            class   ="form-control maskData"
                            required="true"
                            autofocus
                            >
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                              <label class="bmd-label bmd-label-floating"> Data Final *</label>
                              <input
                              id      ="inputdatafim"
                              name    ="inputdatafim"
                              type    ="text"
                              class   ="form-control maskData"
                              required="true"
                              autofocus
                              >
                            </div>
                          </div>
                    </div>
                    <br>
                    <p>Os dados são selecionados com base nas datas de chegada dos fretes</p>
              </div>




              <div class="modal-footer">

                  <button class="btn btn-success pull-right">
                      <span class="btn-label">
                        <i class="material-icons">search</i>
                      </span>
                      Pesquisar
                    </button>  
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Modal -->
                <div class="content">
                  
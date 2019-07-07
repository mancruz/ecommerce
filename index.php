<?php 
session_start();
require_once("vendor/autoload.php");
require_once("vendor/myFunction/myfunction.php");

use Dompdf\Dompdf;
use Dompdf\Options;
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\DashBoard;
use \Hcode\Model\User;
use \Hcode\Model\funcionario;
use \Hcode\Model\ClienteFornecedor;
use \Hcode\Model\Frota;
use \Hcode\model\despesaCategoria;
use \Hcode\model\Manutencao;
use \Hcode\model\SistemaPerfil;
use \Hcode\model\SistemaPerfilEdita;
use \Hcode\model\Frete;
use \Hcode\model\FreteDespesa;
use \Hcode\model\FreteImposto;
use \Hcode\model\FreteDeposito;

$app = new Slim();
$app->config('debug', true);

$app->get('/', function() {
    
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login",[
		'error'=>User::getError()
	]);
});

$app->get('/admin', function() {
	
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	# carrega a classe DashBoard
	$dashboard = new DashBoard();

	# carrega os dados para o dashboard
	$dadosDashboard = $dashboard::getDataDashBoard();

	# carrega dados para os charts do dashboard
	$dadosCharts 	= $dashboard::getFreteCharts($anoBaseDashBoard);	

	# carrega informações para o arquivo de cabeçalho das páginas do sistema
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'					=>	'',
			"menuOption"			=>	"admin",
			"titlePage"				=>	"DashBoard - Ano Base: $anoBaseDashBoard",
			'drawMenu' 				=>	$nivelAcesso,
			'anoBaseDashBoard'		=>	$anoBaseDashBoard
		)

	));	

	$page->setTpl("index", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[0]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[0]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[0]['PERMISSAO_EDITAR'],
		'TotalFrota'			=> 	$dadosDashboard['TotalFrota'],
		'TotalClientes'			=> 	$dadosDashboard['TotalClientes'],
		'TotalFrete'			=> 	$dadosDashboard['TotalFrete'],
		'TotalFreteMensal'		=> 	$dadosDashboard['TotalFreteMensal'],
		'chartQtdFreightMonth'	=>	$dadosCharts['totalFreteCruzado'],
		'dadosChartsBarResult'	=>	$dadosCharts['totalResultadoMes']
				
	));

});

$app->get('/admin/login', function() {
    
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login",[
		'error'=>User::getError()
	]);
});

$app->post("/admin/login", function(){
	
	# verifica se o usuário tem acesso
	try {
		
		User::login($_POST["email"],$_POST["password"]);

	} catch (\Exception $e) {
		
		User::setError($e->getMessage());

	}

		header("location: /admin");
	
		exit;
});

$app->get("/admin/logout", function(){
	# Clean the SESSION
	User::logOut();

	# send the user to login page
	header("location: /admin/login");
	
	# finish the process
	exit;
	
});

$app->get("/admin/forgot", function(){
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("forgot");
});

$app->post("/admin/forgot", function(){
	$user = User::getForgot($_POST["email"]);
	header("location: /admin/forgot/sent");
	exit;
});

$app->get("/admin/forgot/sent", function(){
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("forgot-sent");		
});

$app->get("/admin/forgot/reset", function(){
	$user = User::validForgotDecrypt($_GET["code"]);
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));		
});

$app->post("/admin/forgot/reset", function(){
	$forgot = User::validForgotDecrypt($_POST["code"]);
	User::setForgotUsed($forgot["idrecovery"]);
	$user = new User;
	
	$user->get((int)$forgot["iduser"]);
	$newPassword = password_hash($_POST["password"],PASSWORD_DEFAULT,[
		"cost"=>12
	]);
	$user->setPassword($newPassword);
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("forgot-reset-success");
});

$app->get("/admin/trocar-senha", function(){
	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');	

	$page = new PageAdmin(array
		(
			"data"=>array
			(
				// variável
				'menu'				=>	'',
				"menuOption"		=>	"admin",
				"titlePage"			=>	"Trocar Senha",
				'drawMenu' 			=>	$nivelAcesso,
				'anoBaseDashBoard'	=>	$anoBaseDashBoard
			)
		)
	);	

	$page->setTpl("/admin/trocar-senha",[
		'changePassError'=>User::getError(),
		'chagePassSucess'=>User::getSuccess()
	]);

	exit;
	
});

$app->post("/admin/trocar-senha", function(){

	User::verifyLogin();

	# check the field is input
	if (!isset($_POST['current_pass']) || $_POST['current_pass'] ===''){

		User::setError('Você deve preencher todos os campos!');
		header("location: /admin/trocar-senha");
		exit;
		
	}

	# check the field is input
	if (!isset($_POST['new-pass']) || $_POST['new-pass'] ===''){

		User::setError('Você deve preencher todos os campos!');
		header("location: /admin/trocar-senha");
		exit;
		
	}

	# check the field is input
	if (!isset($_POST['confirm-pass']) || $_POST['confirm-pass'] ===''){

		User::setError('Você deve preencher todos os campos!');
		header("location: /admin/trocar-senha");
		exit;
		
	}

		# check the fields have the iqual values
		if ($_POST['new-pass'] !== $_POST['confirm-pass']){

			User::setError('Você digitou a senha de confirmação diferente!');
			header("location: /admin/trocar-senha");
			exit;
			
		}

		$user = User::getFromSession();

		if(!password_verify($_POST['current_pass'], $user->getsenha())){
			User::setError('Senha atual inválida!');
			header("location: /admin/trocar-senha");
			exit;
		}

		$user->setsenha($_POST['new-pass']);

		$user->update();

		User::setSuccess('Senha alterada com sucesso!');
		header("location: /admin/trocar-senha");
		exit;

});

# exibition of costumer and fornecedores on the site
$app->get("/admin/cliente-fornecedor", function(){

	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');	

	$ClienteFornecedor = new ClienteFornecedor();

	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
	$itensPerPage = (isset($_GET['itensPerPage'])) ? $_GET['itensPerPage'] : 10;
	
	# verifica se o usuário digitou algo no campo serch
	if($search != ''){

		$pagination = $ClienteFornecedor::getPageSearch($search, $currentPage, $itensPerPage);
		
	}else{

		$pagination = $ClienteFornecedor::getPage($currentPage, $itensPerPage);

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){

		array_push($pages,[
				'href'	=> '/admin/cliente-fornecedor?' . http_build_query([
				'page' 	=>	$x+1,
				'search'=> 	$search,
				'itensPerPage' => $itensPerPage
			]),
			'text' => $x+1 
		]);
	}
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Cadastros',
    		'menuOption' 		=> 'cliente',
			'titlePage'			=> 'Clientes e Fornecedores',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
		)));
	
	# calcula página anterior
	if($currentPage == 1){
		
		$numPagePreview = 1;
		
	} else{

		$numPagePreview = $currentPage-1;
	}

	# pega a próxima página
	if($pagination['pages'] == $currentPage){

		$numPageNext = $pagination['pages']-1;

	}else{

		$numPageNext = $currentPage+1;

	}


	if($pagination['pages'] >0) {
	
		if($pagination['pages'] == 1){
			
			$nextPage = $pages[0]['href'];
			$pagePreview = $nextPage;

		} else{

			$nextPage    = $pages[$numPageNext-1]['href'];
			$pagePreview = $pages[$numPagePreview-1]['href'];

		}

	}else{

		$nextPage = '';
		$pagePreview ='';
	}

	$page->setTpl("cliente-fornecedor", array(
		"clienteFornecedor"		=>	$pagination['data'],
		"search"				=>	$search,
		"itensPerPage" 			=> 	$itensPerPage,
		"pages"					=>	$pages,
		"currentPage"			=>	$pagination['currentPage'],
		"totalPages"			=>	$pagination['pages'],
		"pageNext"				=> 	$nextPage ,
		"lastPage"				=>	(isset($pages[$pagination['pages']-1]['href'])) ? $pages[$pagination['pages']-1]['href'] : '',
		"totalRegister" 		=>	(isset($pagination['total'])) ? $pagination['total'] : '',
		"firstPage" 			=>	(isset($pages[0]['href'])) ? $pages[0]['href'] : '',
		"pagePreview" 			=>	$pagePreview,
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[7]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[7]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[7]['PERMISSAO_EDITAR']
	));
});

# acessa apágina de cadastro de clientes e fornecedores
$app->get("/admin/cliente-fornecedor/create", function(){
	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$ClienteFornecedor = new ClienteFornecedor();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'			=> 'Cadastros',
    		'menuOption' 	=> 'cliente',
			'titlePage'		=> 'Clientes e Fornecedores -> Novo',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	$page->setTpl("cliente-fornecedor-create", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[8]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[8]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[8]['PERMISSAO_EDITAR']
	));

	$page->setTpl("findCEP");
});

# salva registro do cliente e fornecedor
$app->post("/admin/cliente-fornecedor/create", function(){
	User::verifyLogin();
	# carrega a classe na variável
	$ClienteFornecedor = new ClienteFornecedor();

	# chama o metodo na categoria para salvar os registros
	$ClienteFornecedor->save($_POST);

	# encerra o processo
	exit;
});

# acessa apágina de cadastro de clientes e fornecedores para editar
$app->get("/admin/cliente-fornecedor/:idclienteFornecedor", function($idclienteFornecedor){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	# carrega a classe na variável
	$ClienteFornecedor = new ClienteFornecedor();

	# pega a categoria no banco de dados
	$ClienteFornecedor->get((int)$idclienteFornecedor);

	$page = new PageAdmin(array(
        "data"=>array(
			// variável	
			'menu'				=> 'Cadastros',	
    		'menuOption' 		=> 'cliente',
			'titlePage'			=> 'Clientes e Fornecedores -> Editar',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
		))
	);
		
	# pega a página, aqui você dve indicar apenas o nome da página mais os parametros
	$page->setTpl("cliente-fornecedor-update", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[9]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[9]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[9]['PERMISSAO_EDITAR'],
		'clienteFornecedor'		=>$ClienteFornecedor->getValues()
	));
	$page->setTpl("findCEP");

	# encerra o processo
	exit;
	
});

# save the reister of cliente or fornecedor
$app->post("/admin/cliente-fornecedor/:idclienteFornecedor", function($idclienteFornecedor){
	User::verifyLogin();
	# carrega a classe na variável
	$ClienteFornecedor = new ClienteFornecedor();

	# chama o metodo na categoria para salvar os registros
	$ClienteFornecedor->save($_POST);

	# encerra o processo
	exit;
});

$app->get("/admin/cliente-fornecedor/:idclienteFornecedor/cancel", function($idclienteFornecedor){
	User::verifyLogin();

	# carrega a classe na variável
	$ClienteFornecedor = new ClienteFornecedor();

	# chama o metodo to cancel the record
	$ClienteFornecedor->cancel((int)$idclienteFornecedor);
	
	# redireciona o usuário
	header("location: /admin/cliente-fornecedor");
	
	# encerra o processo
	exit;
});

# exibition of funcionarios on the site
$app->get("/admin/funcionario", function(){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');
	
	$funcionario = new funcionario();

	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
	$itensPerPage = (isset($_GET['itensPerPage'])) ? $_GET['itensPerPage'] : 10;
	
	# verifica se o usuário digitou algo no campo serch
	if($search != ''){

		$pagination = $funcionario::getPageSearch($search, $currentPage, $itensPerPage);
		
	}else{

		$pagination = $funcionario::getPage($currentPage, $itensPerPage);

	}


	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){

		array_push($pages,[
				'href'	=> '/admin/funcionario?' . http_build_query([
				'page' 	=>	$x+1,
				'search'=> 	$search,
				'itensPerPage' => $itensPerPage
			]),
			'text' => $x+1 
		]);
	}

	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 	'RH',
    		'menuOption' 		=> 	'Funcionários',
			'titlePage'			=>	'Funcionários',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	# calcula página anterior
	if($currentPage == 1){
		
		$numPagePreview = 1;
		
	} else{

		$numPagePreview = $currentPage-1;
	}

	# pega a próxima página
	if($pagination['pages'] == $currentPage){

		$numPageNext = $pagination['pages']-1;

	}else{

		$numPageNext = $currentPage+1;

	}


	if($pagination['pages'] >0) {
	
		if($pagination['pages'] == 1){
			
			$nextPage = $pages[0]['href'];
			$pagePreview = $nextPage;

		} else{

			$nextPage    = $pages[$numPageNext-1]['href'];
			$pagePreview = $pages[$numPagePreview-1]['href'];

		}

	}else{

		$nextPage = '';
		$pagePreview ='';
	}

	$page->setTpl("funcionario", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[20]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[20]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[20]['PERMISSAO_EDITAR'],
		"funcionario"			=>	$pagination['data'],
		"search"				=>	$search,
		"itensPerPage" 			=> 	$itensPerPage,
		"pages"					=>	$pages,
		"currentPage"			=>	$pagination['currentPage'],
		"totalPages"			=>	$pagination['pages'],
		"pageNext"				=> 	$nextPage ,
		"lastPage"				=>	(isset($pages[$pagination['pages']-1]['href'])) ? $pages[$pagination['pages']-1]['href'] : '',
		"totalRegister" 		=>	(isset($pagination['total'])) ? $pagination['total'] : '',
		"firstPage" 			=>	(isset($pages[0]['href'])) ? $pages[0]['href'] : '',
		"pagePreview" 			=>	$pagePreview
	));
});

# acessa apágina de cadastro de clientes e fornecedores
$app->get("/admin/funcionario/create", function(){
	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$funcionario = new funcionario();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'RH',
    		'menuOption' 		=> 'Funcionários',
    		'titlePage'			=>	'Funcionário -> Novo',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	$page->setTpl("funcionario-create", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[21]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[21]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[21]['PERMISSAO_EDITAR'],
		'perfis'				=>	$funcionario::listPerfil(),
		'cargo'					=>	$funcionario::listCargo()
	));

	$page->setTpl("findCEP");
});

# salva registro do cliente e fornecedor
$app->post("/admin/funcionario/create", function(){
	User::verifyLogin();
	# carrega a classe na variável
	$funcionario = new funcionario();

	# chama o metodo na categoria para salvar os registros
	$funcionario->save($_POST);

	# encerra o processo
	exit;
});

# acessa apágina de cadastro de clientes e fornecedores para editar
$app->get("/admin/funcionario/:idfuncionario", function($idfuncionario){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	# carrega a classe na variável
	$funcionario = new funcionario();

	# pega a categoria no banco de dados
	$funcionario->get((int)$idfuncionario);

	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'RH',
    		'menuOption' 		=> 'Funcionário',
			'titlePage'			=> 'Funcionário -> Editar',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
		))
	);
		
	# pega a página, aqui você dve indicar apenas o nome da página mais os parametros
	$page->setTpl("funcionario-update", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[22]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[22]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[22]['PERMISSAO_EDITAR'],
		'funcionario'=>$funcionario->getValues(),
		'cargo'=>$funcionario::listCargo(),
		'perfis'=>$funcionario::listPerfil(),
		
	));

	$page->setTpl("findCEP");

	# encerra o processo
	exit;
	
});

# save the reister of funcionario
$app->post("/admin/funcionario/:idfuncionario", function($idfuncionario){
	User::verifyLogin();
	# carrega a classe na variável
	$Funcionario = new funcionario();

	# chama o metodo na categoria para salvar os registros
	$Funcionario->save($_POST);

	# encerra o processo
	exit;
});

$app->get("/admin/funcionario/:idfuncionario/cancel", function($idfuncionario){
	User::verifyLogin();

	# carrega a classe na variável
	$Funcionario = new funcionario();

	# chama o metodo to cancel the record
	$Funcionario->cancel((int)$idfuncionario);
	
	# redireciona o usuário
	header("location: /admin/funcionario");
	
	# encerra o processo
	exit;
});


# ---------------------------- FROTA -----------------------------------------------
# exibition of frota on the site
$app->get("/admin/frota", function(){
	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');	

	$frota = new Frota();

	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
	$itensPerPage = (isset($_GET['itensPerPage'])) ? $_GET['itensPerPage'] : 10;
	
	# verifica se o usuário digitou algo no campo serch
	if($search != ''){

		$pagination = $frota::getPageSearch($search, $currentPage, $itensPerPage);
		
	}else{

		$pagination = $frota::getPage($currentPage, $itensPerPage);

	}


	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){

		array_push($pages,[
				'href'	=> '/admin/frota?' . http_build_query([
				'page' 	=>	$x+1,
				'search'=> 	$search,
				'itensPerPage' => $itensPerPage
			]),
			'text' => $x+1 
		]);
	}

	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Cadastros',		
    		'menuOption'		=> 'Frota',
			'titlePage'			=> 'Veículos',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	# calcula página anterior
	if($currentPage == 1){
		
		$numPagePreview = 1;
		
	} else{

		$numPagePreview = $currentPage-1;
	}

	# pega a próxima página
	if($pagination['pages'] == $currentPage){

		$numPageNext = $pagination['pages']-1;

	}else{

		$numPageNext = $currentPage+1;

	}


	if($pagination['pages'] >0) {
	
		if($pagination['pages'] == 1){
			
			$nextPage = $pages[0]['href'];
			$pagePreview = $nextPage;

		} else{

			$nextPage    = $pages[$numPageNext-1]['href'];
			$pagePreview = $pages[$numPagePreview-1]['href'];

		}

	}else{

		$nextPage = '';
		$pagePreview ='';
	}

	$page->setTpl("frota", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[10]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[10]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[10]['PERMISSAO_EDITAR'],
		"frota"					=>	$pagination['data'],
		"search"				=>	$search,
		"itensPerPage" 			=> 	$itensPerPage,
		"pages"					=>	$pages,
		"currentPage"			=>	$pagination['currentPage'],
		"totalPages"			=>	$pagination['pages'],
		"pageNext"				=> 	$nextPage ,
		"lastPage"				=>	(isset($pages[$pagination['pages']-1]['href'])) ? $pages[$pagination['pages']-1]['href'] : '',
		"totalRegister" 		=>	(isset($pagination['total'])) ? $pagination['total'] : '',
		"firstPage" 			=>	(isset($pages[0]['href'])) ? $pages[0]['href'] : '',
		"pagePreview" 			=>	$pagePreview
	));
});

# acessa apágina de cadastro de clientes e fornecedores
$app->get("/admin/frota/create", function(){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	#$frota = new Frota();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'			=> 'Cadastros',
    		'menuOption' 	=> 'Frota',
    		'titlePage'		=> 'Veículos -> Novo',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	$page->setTpl("frota-create", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[11]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[11]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[11]['PERMISSAO_EDITAR']
	));

});

# salva registro da frota
$app->post("/admin/frota/create", function(){
	User::verifyLogin();
	# carrega a classe na variável
	$frota = new Frota();

	# chama o metodo na categoria para salvar os registros
	$frota->save($_POST);

	# redireciona o usuário
	# header("location: /admin/cliente-fornecedor");

	# encerra o processo
	exit;
});

# acessa apágina de cadastro de clientes e fornecedores para editar
$app->get("/admin/frota/:idVeiculo", function($idVeiculo){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');


	# carrega a classe na variável
	$frota = new Frota();

	# pega a categoria no banco de dados
	$frota->get((int)$idVeiculo);

	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Cadastros',
    		'menuOption' 		=> 'Frota',
    		'titlePage'			=> 'Veículos -> Editar',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
		))
	);
		
	# pega a página, aqui você dve indicar apenas o nome da página mais os parametros
	$page->setTpl("frota-update", [
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[12]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[12]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[12]['PERMISSAO_EDITAR'],
		'frota'					=>	$frota->getValues()
		
	]);

	# encerra o processo
	exit;
	
});

# save the reister of funcionario
$app->post("/admin/frota/:idVeiculo", function($idVeiculo){
	User::verifyLogin();
	# carrega a classe na variável
	$frota = new Frota();

	# chama o metodo na categoria para salvar os registros
	$frota->save($_POST);

	# encerra o processo
	exit;
});

$app->get("/admin/frota/:idVeiculo/cancel", function($idVeiculo){
	User::verifyLogin();

	# carrega a classe na variável
	$frota = new Frota();

	# chama o metodo to cancel the record
	$frota->cancel((int)$idVeiculo);
	
	# encerra o processo
	exit;
});


# ---------------------------- CATEGORIAS DESPESAS -----------------------------------------------
# exibition of expenses freith on the site
$app->get("/admin/despesas-categoria", function(){
	
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$despesaCategoria = new despesaCategoria();

	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
	$itensPerPage = (isset($_GET['itensPerPage'])) ? $_GET['itensPerPage'] : 10;
	
	# verifica se o usuário digitou algo no campo serch
	if($search != ''){

		$pagination = $despesaCategoria::getPageSearch($search, $currentPage, $itensPerPage);
		
	}else{

		$pagination = $despesaCategoria::getPage($currentPage, $itensPerPage);

	}


	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){

		array_push($pages,[
				'href'	=> '/admin/despesas-categoria?' . http_build_query([
				'page' 	=>	$x+1,
				'search'=> 	$search,
				'itensPerPage' => $itensPerPage
			]),
			'text' => $x+1 
		]);
	}

	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'					=> 'Cadastros',		
    		'menuOption'			=> 'CategoriaDespesa',
			'titlePage'				=> 'Lista de Categorias de Despesas',
			'drawMenu' 				=>	$nivelAcesso,
			'anoBaseDashBoard'		=>	$anoBaseDashBoard
        )));
	
	# calcula página anterior
	if($currentPage == 1){
		
		$numPagePreview = 1;
		
	} else{

		$numPagePreview = $currentPage-1;
	}

	# pega a próxima página
	if($pagination['pages'] == $currentPage){

		$numPageNext = $pagination['pages']-1;

	}else{

		$numPageNext = $currentPage+1;

	}



	if($pagination['pages'] > 0){

		if($pagination['pages'] == 1){
			
			$nextPage = $pages[0]['href'];
			$pagePreview = $nextPage;

		} else{

			$nextPage    = $pages[$numPageNext-1]['href'];
			$pagePreview = $pages[$numPagePreview-1]['href'];

		}
	}else{

		$nextPage = 0;
		$pagePreview = 0;

	}

	$page->setTpl("despesas-categoria", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[13]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[13]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[13]['PERMISSAO_EDITAR'],
		"despesa"				=>	$pagination['data'],
		"itensPerPage" 			=>	$itensPerPage,
		"search"				=>	$search,
		"pages"					=>	$pages,
		"currentPage"			=>	$pagination['currentPage'],
		"totalPages"			=>	$pagination['pages'],
		"pageNext"				=>	$nextPage ,
		"lastPage"				=>	(isset($pages[$pagination['pages']-1]['href'])) ? $pages[$pagination['pages']-1]['href'] : '',
		"totalRegister" 		=>	(isset($pagination['total'])) ? $pagination['total'] : '',
		"firstPage" 			=>	(isset($pages[0]['href'])) ? $pages[0]['href'] : '',
		"pagePreview" 			=>	$pagePreview
	));
});

# acessa apágina de cadastro de clientes e fornecedores
$app->get("/admin/despesas-categoria/create", function(){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

		
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Cadastros',
    		'menuOption' 		=> 'CategoriaDespesa',
    		'titlePage'			=> 'Categoria de Despesa -> Novo',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	$page->setTpl("despesas-categoria-create", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[14]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[14]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[14]['PERMISSAO_EDITAR']
	));

});

# salva registro do cliente e fornecedor
$app->post("/admin/despesas-categoria/create", function(){
	User::verifyLogin();
	# carrega a classe na variável
	$despesa = new despesaCategoria();

	# chama o metodo na categoria para salvar os registros
	$despesa->save($_POST);

	# redireciona o usuário
	# header("location: /admin/cliente-fornecedor");

	# encerra o processo
	exit;
});

# acessa apágina de cadastro de clientes e fornecedores para editar
$app->get("/admin/despesas-categoria/:idDespesaCategoria", function($idDespesaCategoria){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	# carrega a classe na variável
	$despesa = new despesaCategoria();

	# pega a categoria no banco de dados
	$despesa->get((int)$idDespesaCategoria);

	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Cadastros',
    		'menuOption'		=> 'CategoriaDespesa',
    		'titlePage'			=> 'Categoria de Despesa - Editar',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
		))
	);
		
	# pega a página, aqui você dve indicar apenas o nome da página mais os parametros
	$page->setTpl("despesas-categoria-update", [
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[15]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[15]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[15]['PERMISSAO_EDITAR'],
		'despesa'				=>	$despesa->getValues()
		
	]);

	# encerra o processo
	exit;
	
});

# save the reister of funcionario
$app->post("/admin/despesas-categoria/:idDespesaCategoria", function($idDespesaCategoria){
	User::verifyLogin();
	# carrega a classe na variável
	$despesa = new despesaCategoria();

	# chama o metodo na categoria para salvar os registros
	$despesa->save($_POST);

	# encerra o processo
	exit;
});


# ---------------------------- MANUTENÇÃO -----------------------------------------------
# exibition of manutation on the site
$app->get("/admin/manutencao", function(){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');
	
	$manutencao = new Manutencao();

	$dtDe 		  = (isset($_GET['inputdataini']))	? $_GET['inputdataini'] 	: date('01/m/Y');
	$dtAte 		  = (isset($_GET['inputdatafim']))	? $_GET['inputdatafim'] 	: date('t/m/Y');
	$search 	  = (isset($_GET['search']))		? $_GET['search'] 			: '';
	$currentPage  = (isset($_GET['page']) 			? $_GET['page'] 			: 1);
	$itensPerPage = (isset($_GET['itensPerPage'])) 	? $_GET['itensPerPage'] 	: 10;
	
	# verifica se o usuário digitou algo no campo serch
	if($search != ''){

		#$pagination = $manutencao::getPage($dtDe, $dtAte, $search, $currentPage, $itensPerPage);
		$pagination = $manutencao::getPage($dtDe, $dtAte, $currentPage, $itensPerPage, $search);
		
	}else{

		$pagination = $manutencao::getPage($dtDe, $dtAte, $currentPage, $itensPerPage, $search);

	}


	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){

		array_push($pages,[
				'href'	=> '/admin/manutencao?' . http_build_query([
				'page' 	=>	$x+1,
				'dtDe'	=>	$dtDe,
				'dtAte'	=>	$dtAte,
				'search'=> 	$search,
				'itensPerPage' => $itensPerPage
			]),
			'text' => $x+1 
		]);
	}

	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',		
    		'menuOption'		=> 'Manutencao',
			'titlePage'			=> 'Administração de Manutenções',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	# calcula página anterior
	if($currentPage == 1){
		
		$numPagePreview = 1;
		
	} else{

		$numPagePreview = $currentPage-1;
	}

	# pega a próxima página
	if($pagination['pages'] == $currentPage){

		$numPageNext = $pagination['pages']-1;

	}else{

		$numPageNext = $currentPage+1;

	}

	# caso não exista nenhum registro cadastrado ele retorna 0 nas variáveis
	if($pagination['pages'] >0) {
	
		if($pagination['pages'] == 1){
			
			$nextPage = $pages[0]['href'];
			$pagePreview = $nextPage;

		} else{

			$nextPage    = $pages[$numPageNext-1]['href'];
			$pagePreview = $pages[$numPagePreview-1]['href'];

		}

	}else{

		$nextPage = '';
		$pagePreview ='';
	}

	$page->setTpl("manutencao", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[16]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[16]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[16]['PERMISSAO_EDITAR'],
		"manutencao"			=>	$pagination['data'],
		"search"				=>	$search,
		"itensPerPage" 			=> 	$itensPerPage,
		"pages"					=>	$pages,
		"DataDe"				=>	$dtDe,
		"DataAte"				=>	$dtAte,
		"currentPage"			=>	$pagination['currentPage'],
		"totalPages"			=>	$pagination['pages'],
		"pageNext"				=> 	$nextPage ,
		"lastPage"				=>	(isset($pages[$pagination['pages']-1]['href'])) ? $pages[$pagination['pages']-1]['href'] : '',
		"totalRegister" 		=>	(isset($pagination['total'])) ? $pagination['total'] : '',
		"firstPage" 			=>	(isset($pages[0]['href'])) ? $pages[0]['href'] : '',
		"pagePreview" 			=>	$pagePreview
	));
});

# open the page to insert new register
$app->get("/admin/manutencao/create", function(){
	
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$verificAcess = new User;

	$manutencao = new Manutencao();

	$cavalo = $manutencao::getManutencaoCavalo();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
    		'menuOption'	 	=> 'Manutencao',
			'titlePage'			=> 'Administração de Manutenções -> Novo',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
    )));
	
	$page->setTpl("manutencao-create", [
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[17]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[17]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[17]['PERMISSAO_EDITAR'],
		'manutencaoCavalo'		=>	$cavalo['manutencaoCavalo'],
	
	]);

});

# open page to edit register
$app->get("/admin/manutencao/:ID_MANUTENCE", function($ID_MANUTENCE){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$manutencao = new Manutencao();
	
	# load the list of profiles
	$manutencao->get($ID_MANUTENCE);

	# load the list of drivers
	$listaVeiculos = $manutencao::getManutencaoCavalo();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
			'menuOption'		=> 'Manutencao',
			'titlePage'			=> 'Administração de Manutenções -> Editar',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));


	$page->setTpl("manutencao-update", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[18]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[18]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[18]['PERMISSAO_EDITAR'],
		'manutencaoCavalo'		=>	$manutencao->getValues(),
		'ID_MANUTENCE'			=>	$ID_MANUTENCE,
		'listaVeiculos'			=> 	$listaVeiculos['manutencaoCavalo']

	));
});

# open page to insert maintenance item
$app->get("/admin/manutencao/:ID_MANUTENCE/item", function($ID_MANUTENCE){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$manutencaoItens = new Manutencao();
	
	# load the list of itens resgistered
	$manu_itens_cadastrados = $manutencaoItens::getItens($ID_MANUTENCE);

	# load the list of providers
	$fornecedores = $manutencaoItens::getFornecedores();
	
	$page = new PageAdmin(array(
        "data"=>array(
					// variável
					'menu'				=> 'GestaoDeFrota',
					'menuOption'		=> 'Manutencao',
					'titlePage'			=> 'Cadastro de Manutenções -> Ítens',
					'drawMenu' 			=>	$nivelAcesso,
					'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));


	$page->setTpl("manutencao-itens", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[19]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[19]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[19]['PERMISSAO_EDITAR'],
		'manutencaoItens'		=>	$manu_itens_cadastrados['manutencaoItens'],
		'fornecedores'			=>	$fornecedores['driver'],
		'ID_MANUTENCE'			=> 	$ID_MANUTENCE,
		'calcular'				=>	0

	));
});


# save item of maintenance
$app->post("/admin/manutencao/:ID_MANUTENCE/item", function($ID_MANUTENCE){
	# verifica se o usuário have access
	User::verifyLogin();

	$manutencaoItens = new Manutencao();

	IF($_POST['GARANTIA_DIAS'] ==''){
		$_POST['GARANTIA_DIAS'] = 0;
	} 

	# format the datas os POST
	$dataFormated =  $manutencaoItens->setDataFormat($_POST);

	# chama o metodo na categoria para salvar os registros
	$manutencaoItens->setData($dataFormated);

	$manutencaoItens->saveItem();

	# redireciona o usuário
	header("location: /admin/manutencao/" . $ID_MANUTENCE . "/item");

	# encerra o processo
	exit;

});

# delete the register of intem in maintenance
$app->get("/admin/manutencao/:id_Manutencao_Item/:id_Manutencao/item/cancel", function($id_Manutencao_Item, $id_Manutencao){
	User::verifyLogin();

	# carrega a classe na variável
	$manutencaoItem = new Manutencao();

	# chama o metodo to cancel the record
	$manutencaoItem->deleteItem((int)$id_Manutencao_Item);
	
	# redireciona o usuário
	header("location: /admin/manutencao/" . $id_Manutencao . "/item");
	
	# encerra o processo
	exit;
});


# salva a manutnção
$app->post("/admin/manutencao/create", function(){
	
	# Verifica se o usuário tem acesso 
	User::verifyLogin();

	# carrega a classe na variável
	$manutencao = new Manutencao();
	
	# DEFINI UM USUÁRIO PARA O CADASTRO - ISSO DEERA SER ALTERADO PARA PEGAR AUTOMATICAMENTE
	$_POST["COD_USU"] = 1;

	# format the datas os POST
	$dataFormated =  $manutencao->setDataFormat($_POST);

	# chama o metodo na categoria para salvar os registros
	$manutencao->setData($dataFormated);

	$manutencao->save();

	# redireciona o usuário
	header("location: /admin/manutencao/" . $manutencao->getID_MANUTENCE());

	# encerra o processo
	exit;
	
});

# deleta o registro de manutenção
$app->get("/admin/manutencao/:id_Manutencao/cancel", function($id_Manutencao){
	User::verifyLogin();

	# carrega a classe na variável
	$manutencao = new Manutencao();

	# chama o metodo to cancel the record
	$manutencao->delete((int)$id_Manutencao);
	
	# redireciona o usuário
	header("location: /admin/manutencao");
	
	# encerra o processo
	exit;
});

# ---------------------------- PERFIL DE ACESSO -----------------------------------------------
# exibition of perfil on the site
$app->get("/admin/sistema-perfil", function(){

	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');	

	$sistemaPerfil = new SistemaPerfil();

	$search = (isset($_GET['search'])) ? $_GET['search'] : '';
	$currentPage = (isset($_GET['page']) ? $_GET['page'] : 1);
	$itensPerPage = (isset($_GET['itensPerPage'])) ? $_GET['itensPerPage'] : 10;
	
	# verifica se o usuário digitou algo no campo serch
	if($search != ''){

		$pagination = $sistemaPerfil::getPageSearch($search, $currentPage, $itensPerPage);
		
	}else{

		$pagination = $sistemaPerfil::getPage($currentPage, $itensPerPage);

	}


	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){

		array_push($pages,[
				'href'	=> '/admin/sistema-perfil?' . http_build_query([
				'page' 	=>	$x+1,
				'search'=> 	$search,
				'itensPerPage' => $itensPerPage
			]),
			'text' => $x+1 
		]);
	}

	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Configuracao',		
    		'menuOption'		=> 'SistemaPerfil',
			'titlePage'			=> 'Lista de Perfis',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
		
        )));
	
	# calcula página anterior
	if($currentPage == 1){
		
		$numPagePreview = 1;
		
	} else{

		$numPagePreview = $currentPage-1;
	}

	# pega a próxima página
	if($pagination['pages'] == $currentPage){

		$numPageNext = $pagination['pages']-1;

	}else{

		$numPageNext = $currentPage+1;

	}


	if($pagination['pages'] >0) {
	
		if($pagination['pages'] == 1){
			
			$nextPage = $pages[0]['href'];
			$pagePreview = $nextPage;

		} else{

			$nextPage    = $pages[$numPageNext-1]['href'];
			$pagePreview = $pages[$numPagePreview-1]['href'];

		}

	}else{

		$nextPage = '';
		$pagePreview ='';
	}

	$page->setTpl("sistema-perfil", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[23]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[23]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[23]['PERMISSAO_EDITAR'],
		"perfil"=>$pagination['data'], # variable to load the data of perfil for the site
		"search"=>$search,				
		"itensPerPage" => $itensPerPage,
		"pages"=>$pages,
		"currentPage"=>$pagination['currentPage'],
		"totalPages"=>$pagination['pages'],
		"pageNext"=> $nextPage ,
		"lastPage"		=>	(isset($pages[$pagination['pages']-1]['href'])) ? $pages[$pagination['pages']-1]['href'] : '',
		"totalRegister" =>	(isset($pagination['total'])) ? $pagination['total'] : '',
		"firstPage" 	=>	(isset($pages[0]['href'])) ? $pages[0]['href'] : '',
		"pagePreview" 	=>	$pagePreview
	));
});

# acessa apágina para cadastrar um novo perfil
$app->get("/admin/sistema-perfil/create", function(){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');	

	$perfil = new SistemaPerfil();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Configuracao',
    		'menuOption' 		=> 'SistemaPerfil',
			'titlePage'			=> 'Lista de Perfis -> Novo',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	$page->setTpl("sistema-perfil-create", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[24]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[24]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[24]['PERMISSAO_EDITAR']
	));

});

# salva o pefil
$app->post("/admin/sistema-perfil/create", function(){
	User::verifyLogin();
	# carrega a classe na variável
	$perfil = new SistemaPerfil();

	# chama o metodo na categoria para salvar os registros
	$perfil->setData($_POST);

	$perfil->save();

	# redireciona o usuário
	header("location: /admin/sistema-perfil");

	# encerra o processo
	exit;
});

# acessa apágina de cadastro de clientes e fornecedores para editar
$app->get("/admin/sistema-perfil/:idsistemaPerfil", function($idsistemaPerfil){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');	
	
	# carrega a classe na variável
	$perfil = new SistemaPerfil();

	# pega a categoria no banco de dados
	$perfil->get((int)$idsistemaPerfil);

	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Configuracao',
    		'menuOption'		=> 'SistemaPerfil',
			'titlePage'			=> 'Lista de Perfis -> Editar',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
		))
	);
		
	# pega a página, aqui você deve indicar apenas o nome da página mais os parametros
	$page->setTpl("sistema-perfil-update", [
		'perfil'=>$perfil->getValues(),
		'PERMISSAO_VISUALIZAR'	=> $nivelAcesso[25]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> $nivelAcesso[25]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR'		=> $nivelAcesso[25]['PERMISSAO_EDITAR']
		
	]);

	# encerra o processo
	exit;
	
});

# save the file of perfil
$app->post("/admin/sistema-perfil/:idsistemaPerfil", function($idsistemaPerfil){
	User::verifyLogin();
	# carrega a classe na variável
	$perfil = new sistemaPerfil();

	# chama o metodo na categoria para salvar os registros
	$perfil->save($_POST);

	# encerra o processo
	exit;
});


# exibition of profile on the site
$app->get("/admin/sistema-perfil-acesso/:idsistemaPE", function($idsistemaPE){

	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$sistemaPE = new SistemaPerfilEdita();

	$idPerfilAcesso = (isset($idsistemaPE)) ? $idsistemaPE : '';
	
	# load the list of profiles
	$pagination = $sistemaPE::getPageSearch($idPerfilAcesso);
		
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'Configuracao',
    		'menuOption'		=> 'SistemaPerfil',
			'titlePage'			=> 'Perfil do Sistema - Acessos',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));


	$page->setTpl("sistema-perfil-acesso", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[26]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[26]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[26]['PERMISSAO_EDITAR'],
		"perfilAcesso"			=>	$pagination['data'],
		"idPerfil"				=>	$idsistemaPE
		
	));
});

# salva registro do cliente e fornecedor
$app->post("/admin/sistema-perfil-acesso/:idLinkPerfilAcesso", function($idLinkPerfilAcesso){
	User::verifyLogin(false);
	# carrega a classe na variável
	$linkPerfilEdit = new SistemaPerfilEdita();

	# chama o metodo na categoria para salvar os registros
	#$perfil->setData($_POST,$idLinkPerfilAcesso);

	$linkPerfilEdit->save($_POST,$idLinkPerfilAcesso);

	# redireciona o usuário
	header("location: /admin/sistema-perfil-acesso/$idLinkPerfilAcesso");

	# encerra o processo
	exit;
});

# ---------------------------- FREIGHT -----------------------------------------------
# exibition of freight on the site
$app->get("/admin/frete", function(){
	
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);

	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard 	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');	

	
	$frete = new Frete();

	$dtDe 		  = (isset($_GET['inputdataini']))	? $_GET['inputdataini'] 	: date('01/m/Y');
	$dtAte 		  = (isset($_GET['inputdatafim']))	? $_GET['inputdatafim'] 	: date('t/m/Y');
	$search 	  = (isset($_GET['search']))		? $_GET['search'] 			: NULL;
	$currentPage  = (isset($_GET['page'])) 			? $_GET['page'] 			: 1;
	$itensPerPage = (isset($_GET['itensPerPage'])) 	? $_GET['itensPerPage'] 	: 10;
	
	# verifica se o usuário digitou algo no campo serch
	$pagination = $frete::getPageSearch($dtDe, $dtAte, $search, $currentPage, $itensPerPage);


	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++){

		array_push($pages,[
				'href'			=> '/admin/frete?' . http_build_query([
				'page' 			=>	$x+1,
				'inputdataini'	=>	$dtDe,
				'inputdatafim'	=>	$dtAte,
				'search'		=> 	$search,
				'itensPerPage' 	=> $itensPerPage
			]),
			'text' => $x+1 
		]);
	}

	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
    		'menuOption'		=> 'ControleDeFrete',
			'titlePage'			=> 'Controle de Fretes',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	# calcula página anterior
	if($currentPage == 1){
		
		$numPagePreview = 1;
		
	} else{

		$numPagePreview = $currentPage-1;
	}

	# pega a próxima página
	if($pagination['pages'] == $currentPage){

		$numPageNext = $pagination['pages']-1;

	}else{

		$numPageNext = $currentPage+1;

	}

	# caso não exista nenhum registro cadastrado ele retorna 0 nas variáveis
	if($pagination['pages'] >0) {
	
		if($pagination['pages'] == 1){
			
			$nextPage = $pages[0]['href'];
			$pagePreview = $nextPage;

		} else{

			$nextPage    = $pages[$numPageNext-1]['href'];
			$pagePreview = $pages[$numPagePreview-1]['href'];

		}

	}else{

		$nextPage = '';
		$pagePreview ='';
	}

	$page->setTpl("frete", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[1]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[1]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[1]['PERMISSAO_EDITAR'],
		"frete"					=>	$pagination['data'],
		"search"				=>	$search,
		"itensPerPage" 			=> 	$itensPerPage,
		"pages"					=>	$pages,
		"DataDe"				=>	$dtDe,
		"DataAte"				=>	$dtAte,
		"currentPage"			=>	$pagination['currentPage'],
		"totalPages"			=>	$pagination['pages'],
		"pageNext"				=> 	$nextPage ,
		"lastPage"				=>	(isset($pages[$pagination['pages']-1]['href'])) ? $pages[$pagination['pages']-1]['href'] : '',
		"totalRegister" 		=>	(isset($pagination['total'])) ? $pagination['total'] : '',
		"firstPage" 			=>	(isset($pages[0]['href'])) ? $pages[0]['href'] : '',
		"pagePreview" 			=>	$pagePreview
	));
});

# Into the page for input new freight
$app->get("/admin/frete/create", function(){
	
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	
	# instanceia a classe de frete
	$frete = new Frete();
	
	# load the list of drivers
	$driver 	= $frete::getMotorista();
	$costumer	= $frete::getClienteFrete();
	$cavalo 	= $frete::getFreteCavalo();

	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
    		'menuOption'		=> 'ControleDeFrete',
			'titlePage'			=> 'Controle de Fretes -> Novo',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));
	
	$page->setTpl("frete-create", array(		
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[2]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[2]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[2]['PERMISSAO_EDITAR'],
		'driver'				=>	$driver['driver'],
		'clienteFrete'			=>	$costumer['clienteFrete'],
		'freteCavalo'			=>	$cavalo['freteCavalo']
			
	));

});

# exibition of freight for edit
$app->get("/admin/frete/:idFrete", function($idFrete){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');


	$frete = new Frete();
	
	# load the list of profiles
	$frete->get($idFrete);

	# load the list of drivers
	$driver = $frete::getMotorista();
	$costumer = $frete::getClienteFrete();
	$cavalo = $frete::getFreteCavalo();	
	$freteTotais = $frete::getFreteTotais($idFrete);
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
    		'menuOption'		=> 'ControleDeFrete',
			'titlePage'			=> 'Controle de Fretes -> Editar',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));


	$page->setTpl("frete-update", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[3]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[3]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[3]['PERMISSAO_EDITAR'],
		'frete'					=>	$frete->getValues(),
		'driver'				=>	$driver['driver'],
		'clienteFrete'			=>	$costumer['clienteFrete'],
		'freteCavalo'			=>	$cavalo['freteCavalo'],
		'freteTotais'			=>	$freteTotais[0]

	));
});

# save the freight
$app->post("/admin/frete/create", function(){
	
	# Verifica se o usuário tem acesso 
	User::verifyLogin();

	# carrega a classe na variável
	$frete = new Frete();
	
	# format the datas os POST
	$dataFormated =  $frete->setDataFormat($_POST);

	# get the user loged in system
	$dataFormated['COD_USU'] = $_SESSION['User']['cod_func'];

	# calculate the distance
	$dataFormated['DESLOCAMENTO'] = $dataFormated['KM_CHEGADA']-$dataFormated['KM_SAIDA'];

	# Format the comission
	if($dataFormated['COMISSAO'] ==''){
		$dataFormated['COMISSAO'] = 0;
	}

	# Format the comission
	if($dataFormated['ESTADIA'] ==''){
		$dataFormated['ESTADIA'] = 0;
	}

	# chama o metodo na categoria para salvar os registros
	$frete->setData($dataFormated);
	
	$dataFeedBack = $frete->save();

	# redireciona o usuário
	header("location: /admin/frete/" . $dataFeedBack['COD_FRETE']);

	# encerra o processo
	exit;
	
});

#Cancel the freight
$app->get("/admin/frete/:idFrete/cancel", function($idFrete){

	# verifica se p usuário está logado
	User::verifyLogin();

	# instanceia a classe
	$frete = new Frete();

	# carrega os dados do freight
	$frete->get((int)$idFrete);

	# Cancela o frete em questão
	$frete->cancel();

	# envia o usuário para a rota
	header("Location: /admin/frete");

	# encerra o processo
	exit;

});

# ---------------------------- freight expenses -----------------------------------------------
# exibition of freright for edit
$app->get("/admin/frete/despesa/:idFrete", function($idFrete){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$freteDespesa = new FreteDespesa();
	
	# load the list of profiles
	$pagination = $freteDespesa::get($idFrete);
	#$pagination = $despesaCategoria::getPage($currentPage, $itensPerPage);

	# load the list of drivers
	$despesaCategoria = $freteDespesa::getDespesaCategorias();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
    		'menuOption'		=> 'ControleDeFrete',
			'titlePage'			=> 'Controle de Fretes -> Cadastro de Despesas',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));


	$page->setTpl("frete-despesas", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[5]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[5]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[5]['PERMISSAO_EDITAR'],
		'freteDespesa'			=>	$pagination['dataDespesa'],
		'despesaCategoria'		=>	$despesaCategoria['despesaCategoria'],
		'frete'					=>	$idFrete

	));
});

# save to expenses freight
$app->post("/admin/frete/despesa/create", function(){
	
	# Verifica se o usuário tem acesso 
	User::verifyLogin();

	# carrega a classe na variável
	$frete = new FreteDespesa();
	
	# format the datas os POST
	$dataFormated =  $frete->setDataFormat($_POST);

	# chama o metodo na categoria para salvar os registros
	$frete->setData($dataFormated);

	$frete->save();

	# redireciona o usuário
	header("location: /admin/frete/despesa/" . $_POST['COD_FRETE']);

	# encerra o processo
	exit;
	
});

# procediemento para deletar despesas do frete
$app->get("/admin/frete/despesa/:COD_DESPESA/delete", function($COD_DESPESA){
	# verifica se o usuário está concectado
	User::verifyLogin();

	# carrega a classe na variável
	$freteDespesa = new FreteDespesa();

	# carrega despesa
	$freteDespesa->getDespesa((int)$COD_DESPESA);

	# pega o id de frete
	$id_Frete = $freteDespesa->getCOD_FRETE();

	# chama o metodo to canceldelete the record
	$freteDespesa->delete();
	
	# redirect the user
	header("location: /admin/frete/despesa/".$id_Frete);
	
	# stop de process
	exit;
});

# ---------------------------- FRETE IMPOSTO -----------------------------------------------
# exibition of frerte to edit
$app->get("/admin/frete/imposto/:idFrete", function($idFrete){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$freteImposto = new FreteImposto();
	
	# load the list of profiles
	$pagination = $freteImposto::get($idFrete);

	# load the list of drivers
	$impostoCategoria = $freteImposto::getImpostoCategorias();
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
    		'menuOption'		=> 'ControleDeFrete',
			'titlePage'			=> 'Controle de Fretes -> Cadastro de Impostos',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));


	$page->setTpl("frete-imposto", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[4]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[4]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[4]['PERMISSAO_EDITAR'],
		'freteImposto'			=>	$pagination['dataImposto'],
		'impostoCategoria'		=>	$impostoCategoria['ImpostoCategoria'],
		'frete'					=>	$idFrete

	));
});

# salva o frete
$app->post("/admin/frete/imposto/create", function(){
	
	# Verifica se o usuário tem acesso 
	User::verifyLogin();

	# carrega a classe na variável
	$frete = new FreteImposto();
	
	# format the datas os POST
	$dataFormated =  $frete->setDataFormat($_POST);

	# chama o metodo na categoria para salvar os registros
	$frete->setData($dataFormated);

	$frete->save();

	# redireciona o usuário
	header("location: /admin/frete/imposto/" . $_POST['COD_FRETE']);

	# encerra o processo
	exit;
	
});

# procediemento para deletar impostos do frete
$app->get("/admin/frete/imposto/:COD_IMPOSTO/delete", function($COD_IMPOSTO){
	# verifica se o usuário está concectado
	User::verifyLogin();

	# carrega a classe na variável
	$freteImposto = new FreteImposto();

	# carrega imposto
	$freteImposto->getImposto((int)$COD_IMPOSTO);

	# pega o id de frete
	$id_Frete = $freteImposto->getCOD_FRETE();

	# chama o metodo to canceldelete the record
	$freteImposto->delete();
	
	# redirect the user
	header("location: /admin/frete/imposto/".$id_Frete);
	
	# stop de process
	exit;
});

# ---------------------------- FRETE DEPÓSITO -----------------------------------------------
# exibition of frerte to edit
$app->get("/admin/frete/deposito/:idFrete", function($idFrete){
	# verifica se o usuário está logado
	User::verifyLogin();

	# carrega a classe User
	$verificAcess = new User;

	# pega dados de acessos do usuário
	$nivelAcesso	=	$verificAcess::getAcess($_SESSION['User']['email_func']);
	
	# pega o ano para exibir no Dashboard
	$anoBaseDashBoard	= (isset($_GET['inputYear']))	? $_GET['inputYear'] 	: date('Y');

	$freteDeposito = new FreteDeposito();
	
	# load the list of profiles
	$pagination = $freteDeposito::get($idFrete);
	
	$page = new PageAdmin(array(
        "data"=>array(
			// variável
			'menu'				=> 'GestaoDeFrota',
    		'menuOption'		=> 'ControleDeFrete',
			'titlePage'			=> 'Controle de Fretes -> Cadastro de Despósitos',
			'drawMenu' 			=>	$nivelAcesso,
			'anoBaseDashBoard'	=>	$anoBaseDashBoard
        )));


	$page->setTpl("frete-deposito", array(
		'PERMISSAO_VISUALIZAR'	=> 	$nivelAcesso[6]['PERMISSAO_VISUALIZAR'],
		'PERMISSAO_INCLUIR' 	=> 	$nivelAcesso[6]['PERMISSAO_INCLUIR'],
		'PERMISSAO_EDITAR' 		=> 	$nivelAcesso[6]['PERMISSAO_EDITAR'],
		'freteDeposito'=>$pagination['dataDeposito'],
		'frete'=>$idFrete

	));
});

# salva o frete
$app->post("/admin/frete/deposito/create", function(){
	
	# Verifica se o usuário tem acesso 
	User::verifyLogin();

	# carrega a classe na variável
	$frete = new FreteDeposito();
	
	# format the datas os POST
	$dataFormated =  $frete->setDataFormat($_POST);

	# chama o metodo na categoria para salvar os registros
	$frete->setData($dataFormated);

	$frete->save();

	# redireciona o usuário
	header("location: /admin/frete/deposito/" . $_POST['COD_FRETE']);

	# encerra o processo
	exit;
	
});

# procediemento para deletar impostos do frete
$app->get("/admin/frete/deposito/:COD_DEPOSITO/delete", function($COD_DEPOSITO){
	# verifica se o usuário está concectado
	User::verifyLogin();

	# carrega a classe na variável
	$freteDeposito = new FreteDeposito();

	# carrega imposto
	$freteDeposito->getDeposito((int)$COD_DEPOSITO);

	# pega o id de frete
	$id_Frete = $freteDeposito->getCOD_FRETE();

	# chama o metodo to canceldelete the record
	$freteDeposito->delete();
	
	# redirect the user
	header("location: /admin/frete/deposito/".$id_Frete);
	
	# stop de process
	exit;
});

# --------------------Dashboard----------------------
$app->get("/admin/resumo-fretes", function(){
	
	User::verifyLogin();
	
	$frete = new DashBoard();

	$dtDe 		  = (isset($_GET['inputdataini']))	? $_GET['inputdataini'] 	: date('01/m/Y');
	$dtAte 		  = (isset($_GET['inputdatafim']))	? $_GET['inputdatafim'] 	: date('t/m/Y');
	$search 	  = (isset($_GET['search']))		? $_GET['search'] 			: NULL;
	
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
		# verifica se o usuário digitou algo no campo serch
		$resumo = $frete::getResumoFrete($dtDe, $dtAte, $search);


	$html = $page->setTpl("resumo-financeiro-frete", array(
		"dados"				=>$resumo['data'],
		"TOTAL_BRUTO"		=>$resumo['totais']['TOTAL_BRUTO'],
		"TOTAL_MOTORISTA"	=>$resumo['totais']['TOTAL_MOTORISTA'],
		"TOTAL_IMPOSTOS"	=>$resumo['totais']['TOTAL_IMPOSTOS'],
		"TOTAL_DESPESAS"	=>$resumo['totais']['TOTAL_DESPESAS'],
		"TOTAL_RECEBIDO"	=>$resumo['totais']['TOTAL_RECEBIDO'],
		"TOTAL_RESULTADO"	=>$resumo['totais']['TOTAL_RESULTADO'],
		"TOTAL_SALDO"		=>$resumo['totais']['TOTAL_SALDO']
	),true);

		#($html);

		#exit;
#----------------GERA O PDF----------------------------

  // cria a instancia
  #$domPDF 	= new Dompdf();
  $options	= new Options();

  $options->set('defaultFont', 'Courier');
  $domPDF = new Dompdf($options);
  
  $domPDF->loadHtml($html);

  $domPDF->set_base_path("");

  // formato da página
  $domPDF->set_paper("A4");
  
  $pdf = $domPDF->render();
  
  $canvas = $domPDF->get_canvas(); 

  $canvas->page_text(540,20, "Pág.{PAGE_NUM} de {PAGE_COUNT}","",6,array(0,0,0));

  $canvas->page_text(270,792,"Copyright @ 2018 - Transporte Estrela Guia","",6,array(0,0,0));

  header("Content-type:application/pdf");

  echo $domPDF->output();

  unset($domPDF);
exit;

});

# detalhes
# GET carrega páginas
# POST - Salva registros
$app->run();
 ?>
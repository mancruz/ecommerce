<?php 

	namespace Hcode\Model;
	
	use \Hcode\DB\Sql;
	use \Hcode\Model;
	use \Hcode\FUNCTIONS\Converter;

	class funcionario extends Model{


		public static function listAll(){

			$sql = new Sql();

				return $sql->select("SELECT * FROM tb_funcionario ORDER BY nome_func");
		}	

		# get the list with perfis in the system
		public static function listPerfil(){

			$sql = new Sql();

				return $sql->select("SELECT * FROM tb_perfil ORDER BY PERFIL;");
		}

		# get the list with perfis in the system
		public static function listCargo(){

			$sql = new Sql();

				return $sql->select("SELECT * FROM tb_cargo ORDER BY CARGO;");
		}

		public function save($funcionario){

			$sql = new Sql();

			$conversor = new Converter;

			# cria o objeto cliente
			$funcionario = new funcionario;

			# coloca os valores dos dados do formulário nas variáveis
			$cod_func					= isset($_POST["cod_func"]) 				? strip_tags(filter_input(INPUT_POST,"cod_func")) 					: NULL;
			$apelido_func 				= isset($_POST["apelido_func"]) 			? strip_tags(filter_input(INPUT_POST,"apelido_func")) 				: NULL;	 
			$telefone_func 				= isset($_POST["telefone_func"]) 			? strip_tags(filter_input(INPUT_POST,"telefone_func")) 				: NULL;
			$telefone_cel_func 			= isset($_POST["telefone_cel_func"]) 		? strip_tags(filter_input(INPUT_POST,"telefone_cel_func")) 			: NULL;
			$nome_func					= isset($_POST["nome_func"]) 				? strip_tags(filter_input(INPUT_POST,"nome_func")) 					: NULL;
			$email_func 				= isset($_POST["email_func"]) 				? strip_tags(filter_input(INPUT_POST,"email_func")) 				: NULL;
			$rg_func 					= isset($_POST["rg_func"]) 					? strip_tags(filter_input(INPUT_POST,"rg_func")) 					: NULL;
			$cpf_func 					= isset($_POST["cpf_func"]) 				? strip_tags(filter_input(INPUT_POST,"cpf_func")) 					: NULL;
			$dt_nasc_func 				= isset($_POST["dt_nasc_func"]) 			? strip_tags(filter_input(INPUT_POST,"dt_nasc_func")) 				: NULL;
			$obs_func 					= isset($_POST["obs_func"]) 				? strip_tags(filter_input(INPUT_POST,"obs_func")) 					: NULL;
			$logradouro_func			= isset($_POST["logradouro_func"])			? strip_tags(filter_input(INPUT_POST,"logradouro_func"))			: NULL;	 
			$num_logr_func 				= isset($_POST["num_logr_func"])			? strip_tags(filter_input(INPUT_POST,"num_logr_func")) 				: NULL;
			$Comp_logr_func				= isset($_POST["Comp_logr_func"]) 			? strip_tags(filter_input(INPUT_POST,"Comp_logr_func")) 			: NULL;
			$bairro_func 				= isset($_POST["bairro_func"])				? strip_tags(filter_input(INPUT_POST,"bairro_func"))				: NULL;
			$cep_func					= isset($_POST["cep_func"]) 				? strip_tags(filter_input(INPUT_POST,"cep_func")) 					: NULL;
			$cidade_func 				= isset($_POST["cidade_func"]) 				? strip_tags(filter_input(INPUT_POST,"cidade_func")) 				: NULL;
			$estado 					= isset($_POST["estado"]) 					? strip_tags(filter_input(INPUT_POST,"estado")) 					: NULL;
			$status_func				= isset($_POST["status_func"]) 				? strip_tags(filter_input(INPUT_POST,"status_func")) 				: NULL;
			$depart_func				= isset($_POST["depart_func"]) 				? strip_tags(filter_input(INPUT_POST,"depart_func")) 				: NULL;
			$num_func					= isset($_POST["num_func"]) 				? strip_tags(filter_input(INPUT_POST,"num_func")) 					: NULL;
			$num_cart_func				= isset($_POST["num_cart_func"]) 			? strip_tags(filter_input(INPUT_POST,"num_cart_func")) 				: NULL;
			$num_inps_func				= isset($_POST["num_inps_func"]) 			? strip_tags(filter_input(INPUT_POST,"num_inps_func")) 				: NULL;
			$cargo_func					= isset($_POST["cargo_func"]) 				? strip_tags(filter_input(INPUT_POST,"cargo_func")) 				: NULL;
			$salario_func				= isset($_POST["salario_func"]) 			? strip_tags(filter_input(INPUT_POST,"salario_func")) 				: NULL;
			$senha						= isset($_POST["senha"]) 					? strip_tags(filter_input(INPUT_POST,"senha")) 						: NULL;
			$acesso_sistema				= isset($_POST["acesso_sistema"]) 			? strip_tags(filter_input(INPUT_POST,"acesso_sistema")) 			: NULL;
			$tipo_usu					= isset($_POST["tipo_usu"]) 				? strip_tags(filter_input(INPUT_POST,"tipo_usu")) 					: NULL;
			$CONTATO_EMERGENCIA_FUNC	= isset($_POST["CONTATO_EMERGENCIA_FUNC"])	? strip_tags(filter_input(INPUT_POST,"CONTATO_EMERGENCIA_FUNC")) 	: NULL;
			$TEL_CEL_EMERGENCIA_FUNC	= isset($_POST["TEL_CEL_EMERGENCIA_FUNC"]) 	? strip_tags(filter_input(INPUT_POST,"TEL_CEL_EMERGENCIA_FUNC")) 	: NULL;
			$TEL_FIXO_EMERGENCIA_FUNC	= isset($_POST["TEL_FIXO_EMERGENCIA_FUNC"]) ? strip_tags(filter_input(INPUT_POST,"TEL_FIXO_EMERGENCIA_FUNC"))	: NULL;
			$TIPO_SANGUE				= isset($_POST["TIPO_SANGUE"]) 				? strip_tags(filter_input(INPUT_POST,"TIPO_SANGUE")) 				: NULL;
			$revogado					= isset($_POST["revogado"]) 				? strip_tags(filter_input(INPUT_POST,"revogado")) 					: NULL;


			# Format the datas
			
			# here, format the date to insert in database 
			$dt_nasc_func = $conversor->converterDatas($dt_nasc_func);
			
			if ($salario_func <> NULL){
				
				$salario_func = $conversor->convertPrice($salario_func);
			}

			$senha = $sql->encriptPass($senha);

			# coloca os dados dentro de uma array
			$dados = array(
							'apelido_func'=>$apelido_func,
							'telefone_func'=>$telefone_func,
							'telefone_cel_func'=>$telefone_cel_func,
							'nome_func'=>$nome_func,
							'email_func'=>$email_func,
							'rg_func'=>$rg_func,
							'cpf_func'=>$cpf_func,
							'dt_nasc_func'=>$dt_nasc_func,
							'obs_func'=>$obs_func,
							'logradouro_func'=>$logradouro_func,
							'num_logr_func'=>$num_logr_func,
							'Comp_logr_func'=>$Comp_logr_func,
							'bairro_func'=>$bairro_func,
							'cep_func'=>$cep_func,
							'cidade_func'=>$cidade_func,
							'estado'=>$estado,
							'status_func'=>$status_func,
							'depart_func'=>$depart_func,
							'num_func'=>$num_func,
							'num_cart_func'=>$num_cart_func,
							'num_inps_func'=>$num_inps_func,
							'cargo_func'=>$cargo_func,
							'salario_func'=>$salario_func,
							'senha'=>$senha,
							'acesso_sistema'=>$acesso_sistema,
							'tipo_usu'=>$tipo_usu,
							'CONTATO_EMERGENCIA_FUNC'=>$CONTATO_EMERGENCIA_FUNC,
							'TEL_CEL_EMERGENCIA_FUNC'=>$TEL_CEL_EMERGENCIA_FUNC,
							'TEL_FIXO_EMERGENCIA_FUNC'=>$TEL_FIXO_EMERGENCIA_FUNC,
							'TIPO_SANGUE'=>$TIPO_SANGUE,
							'revogado'=>$revogado
						);
			if($cod_func){
				
				unset($dados['senha']);
				
				$funcionario->upDate(array_filter($dados),(int)$cod_func);

			} else{	

				$funcionario->insert(array_filter($dados));
			}	
		}

		public function get($funcionario){

			$conversor = new Converter;

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_funcionario WHERE cod_func = :funcionario", [
	
				":funcionario"=> $funcionario
			
			]);
			
			# converte a data para ser exibida na página
			$dtNascimento = $results[0]['dt_nasc_func'];			
			$results[0]['dt_nasc_func'] = $conversor->converterDatas($dtNascimento);

			# converte para moeda real
			$salario = $results[0]['salario_func'];
			$results[0]['salario_func'] = number_format((float)$salario,2,',','.');

			$this->setData($results[0]);
		}

		public function cancel($id_funcionario){

			$codiCliente = $id_funcionario;

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_funcionario SET status_func = 'Cancelado'  WHERE cod_func = :cod_func;";

			$funcionarioDados["cod_func"] = $codiCliente;
			
			$sqlUpdate->query($sql, $funcionarioDados);
			
			header('location: /admin/funcionario');
	
		}

		# pagination the site
		public static function getPage($page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM tb_funcionario
				ORDER BY nome_func
				LIMIT $start, $itensPerPage;
			
			");

			$resultadoTotal = $sql->select("SELECT FOUND_ROWS() AS nrTotal;");

			return [
				'data'=>$results,
				'total'=>(int)$resultadoTotal[0]['nrTotal'],
				'pages'=>ceil($resultadoTotal[0]['nrTotal'] / $itensPerPage),
				'currentPage'=>$page

			];
		}

		# serach and pagination of the site
		public static function getPageSearch($search, $page, $itensPerPage){

			$start = ($page - 1) * $itensPerPage;

			$sql = new Sql;

			$results = $sql->select("
				SELECT SQL_CALC_FOUND_ROWS * 
				FROM tb_funcionario
				WHERE nome_func LIKE :search
				ORDER BY nome_func
				LIMIT $start, $itensPerPage;
			
			", [
				':search'=>'%'.$search.'%'
			]);

			$resultadoTotal = $sql->select("SELECT FOUND_ROWS() AS nrTotal;");

			return [
				'data'=>$results,
				'total'=>(int)$resultadoTotal[0]['nrTotal'],
				'pages'=>ceil($resultadoTotal[0]['nrTotal'] / $itensPerPage),
				'currentPage'=>$page,
				

			];
		}

		# insert the new record
		public function insert($funcionarioDados = array()){

			$sqlInsert = new Sql();

			$sql = "INSERT INTO tb_funcionario (";

			foreach ($funcionarioDados as $key => $value) {
				# code...
				$sql = $sql . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ") VALUES (";

			foreach ($funcionarioDados as $key => $value) {
				# code...
				$sql = $sql . ":" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . ")";

			$sqlInsert->query($sql, $funcionarioDados);
			
			header('location: /admin/funcionario');


		}

		# update the record
		public function upDate($funcionarioDados = array(),$id_funcionario){

			$sqlUpdate = new Sql;
			
			$sql = "UPDATE tb_funcionario SET ";

			foreach ($funcionarioDados as $key => $value) {
				# code...
				$sql = $sql . $key . " = :" . $key . ", ";
			}

			# remove  última virgula
			$sql = substr($sql,0,-2);
			$sql = $sql . " WHERE cod_func = :cod_func";

			$funcionarioDados["cod_func"] = $id_funcionario;
			$sqlUpdate->query($sql, $funcionarioDados);
			
			header('location: /admin/funcionario/'.  $id_funcionario);

		}

	}

 ?>